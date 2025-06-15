<?php

namespace App\Models;

use App\Utils\Log;
use PDOStatement;

final class Bantoo {
  private static $dsn = "mysql:host=localhost;port=3306;dbname=bantoo;charset=UTF8";
  
  private static $username = "pemweb";
  private static $password = "";
  
  private static $options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
  // Store the single instance
  private static ?Bantoo $instance = null;
  
  // Database connection object
  private \PDO $connection;
  
  // Private constructor to prevent direct instantiation
  private function __construct() {
    $this->connection = new \PDO(Bantoo::$dsn, Bantoo::$username, Bantoo::$password, Bantoo::$options);
  }
  
  private function __clone() {
    throw new \Exception("Can't clone a singleton");
  }
  
  // The method to get the singleton instance
  public static function DB(): ?Bantoo {
    if (self::$instance === null) {
      $className = __CLASS__;
      self::$instance = new $className;
    }
    
    return self::$instance;
  }

  public function getCampaignData(object $campaign): bool | PDOStatement {
    $allCampaignSql = <<<SQL
    with 
      active as (select c.* from all_campaigns c where rid > :lastindex limit :pagesize)
    select
      a.*, p.* 
    from 
      active a 
    inner join 
      campaign_progress p on p.pid = a.id
    SQL;

    $activeCampaignSql = <<<SQL
    with
      maintainer as (select m.campaign_id as cid, m.maintainer_id as uid from campaign_maintainer m where maintainer_id = :mid),
      active as (select c.* from active_campaigns c where rid > :lastindex limit :pagesize)
    select
    coalesce(m.uid, 0) mid, a.*, p.*
    from 
      active a 
    inner join 
      campaign_progress p on p.pid = a.id
    left outer join
      maintainer m on m.cid = a.id
    SQL;
    
    $stmt = $this->connection->prepare($campaign->isActive ? $activeCampaignSql : $allCampaignSql);
    $stmt->bindParam('lastindex', $campaign->lastindex);
    $stmt->bindParam('pagesize', $campaign->pagesize);

    if ($campaign->isActive) {
      $stmt->bindParam('mid', $campaign->maintainerId);
    }

    $stmt->execute();
    
    return $stmt;
  }

  public function getCampaign(int $cid) {
    $sql = <<<SQL
    select c.* from campaigns c where c.status='ONGOING' and c.id = :id;
    SQL;

    $stmt = $this->connection->prepare($sql);
    $stmt->execute(['id' => $cid]);
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result[0];
  }

  public function amendCampaign(object $campaign): bool {
    $sql = <<<SQL
    update campaign set title = :title, description = :desc, target_donasi = :target, status = 'PENDING' where id = :id;
    SQL;

    $stmt = $this->connection->prepare($sql);
    return $stmt->execute([
      'id'     => $campaign->id,
      'title'  => $campaign->title,
      'desc'   => $campaign->description,
      'target' => $this->numberFromString($campaign->target)
    ]);
  }

  public function getLatestCampaignData(): bool | PDOStatement {
    $sql = <<<SQL
    select * from active_campaigns_progress
    SQL;
    
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    
    return $stmt;
  }

  public function setStatus(int $id, string $status, string $newStatus): bool {
    $sql = <<<SQL
    update campaign set status = upper(:new_status) where id = :id and status = upper(:status)
    SQL;
    
    $stmt = $this->connection->prepare($sql);
    $stmt->execute(['id' => $id, 'status' => $status, 'new_status' => $newStatus]);
    
    return $stmt->rowCount() > 0;
  }

  public function acceptDonation(int $campaign_id, object $donation): bool {
    $sql = <<<SQL
    insert into campaign_donation(campaign_id, donatur_id, amount, message) values (:campaign_id, :donatur_id, :amount, :message);
    SQL;

    return $this->connection
      ->prepare($sql)
      ->execute([
        'campaign_id' => $campaign_id,
        'donatur_id'  => $donation->donatur_id,
        'amount'      => $this->numberFromString($donation->jumlah),
        'message'     => $donation->pesan,
      ]);
  }

  public function getUser($email, $password): bool | PDOStatement {
    $sql = <<<SQL
    select id, name, role from user where email = :email and password = :password
    SQL;

    $stmt = $this->connection->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $password]);

    return $stmt;
  }

  public function registerUser(string $name, string $email, string $password, $photo): bool {
    $sql = <<<SQL
    insert into user (name, email, password, photo) values (:name, :email, :password, :photo)
    SQL;

    $stmt = $this->connection->prepare($sql);
    $stmt->bindParam(':name',    $name);
    $stmt->bindParam(':email',   $email); 
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':photo',   $photo, \PDO::PARAM_LOB);

    return $stmt->execute();
  }

  public function getUserPhoto(int $id): bool|string {
    $sql = <<<SQL
    select photo from user where id = :id
    SQL;

    $stmt = $this->connection->prepare($sql);
    $stmt->execute([ 'id' => $id]);

    if ($stmt->rowCount() === 1) {
      $photo = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['photo'];
      return $photo === null ? false : $photo;
    };

    return false;
  }

  public function registerCampaign(object $campaign): void {
    $conn = $this->connection;
    $conn->beginTransaction();

    //insert campaign
    $campaignSQL = <<<SQL
    insert into campaign(title, description, target_donasi) values (:title, :description, :target) returning id;
    SQL;

    $stmt = $conn->prepare($campaignSQL);
    $stmt->execute([
      'title'       => $campaign->title, 
      'description' => $campaign->description,
      'target'      => $this->numberFromString($campaign->target)
    ]);
    $campaignId = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['id'];

    // insert photo
    $photoSQL = <<<SQL
      insert into photo(photo) values (:photo) returning id;
    SQL;

    $stmt = $conn->prepare($photoSQL);
    $stmt->bindParam(':photo', $campaign->campaignPhoto, \PDO::PARAM_LOB);
    $stmt->execute();
    $photoId = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['id'];

    // link photo with campaign
    $campaignphotoSQL = <<<SQL
      insert into campaign_photos(campaign_id, photo_id) values (:campaign_id, :photo_id);
    SQL;

    $stmt = $conn->prepare($campaignphotoSQL);
    $stmt->execute([
      'campaign_id' => $campaignId,
      ':photo_id'   => $photoId
    ]);

    // link campaign with users as campaign maintainer
    $campaignMaintainerSQL = <<<SQL
      insert into campaign_maintainer (campaign_id, maintainer_id) values (:campaign, :maintainer);
    SQL;
    $stmt = $conn->prepare($campaignMaintainerSQL);
    $stmt->execute([
      'campaign'   => $campaignId,
      'maintainer' => (int)$campaign->maintainer_id
    ]);

    $conn->commit();
  }

  public function deleteCampaign(int $id, string $curStatus): void {
    // remove campaign itself
    $campaignSQL = <<<SQL
      delete from campaign where id = :cid;
    SQL;
    $stmt = $this->connection->prepare($campaignSQL);
    $stmt->execute(['cid' => $id]);
  }

  private function numberFromString(string $numberString): float {
    return (double)preg_replace("/[^.0-9]/", "", $numberString);
  }
}
