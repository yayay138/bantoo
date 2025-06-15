<?php

namespace App\Livewire\Campaign;

use Livewire\Component;
use App\Models\Campaign;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;

class LatestCampaign extends Component
{
  public $campaigns;

  public $num = 1;

  public function mount()
  {
    $this->campaigns = $this->loadData($this->num);
  }

  public function render()
  {
    return view('livewire.campaign.latest-campaign');
  }

  #[On('load-more')]
  public function loadMore($page) {
    $this->num += $page;
    $this->campaigns = $this->loadData($this->num);
  }

  private function loadData($rowcount) {
    $result = [];
    $campaigns = Campaign::latest()
        ->take($rowcount)
        ->get();

    foreach ($campaigns as $campaign) {
    $donation = $campaign->donations()->sum('amount');
    $num      = $campaign->donations()->count('amount');
    $dayend   = new DateTime($campaign->deadline);
    $daynow   = new DateTime();
    $interval = $dayend->diff($daynow, true);
    $days     = $interval->format('%a');

    $data = [
    'id'          => $campaign->id,
    'category'    => $campaign->category,
    'photo'       => "/photos/{$campaign->photo}", 
    'title'       => $campaign->title,
    'description' => $campaign->description,
    'target'      => $this->humanize($campaign->targetfunding),
    'amount'      => $this->humanize($donation),
    'percent'     => ceil(($donation/$campaign->targetfunding)*100),
    'likes'       => rand(100,500),
    'donation'    => $num,
    'dayleft'     => $days,
    ];
    array_push($result, $data);
    }

    return $result;
  }

  private function humanize($number): string
  {
    $divisor = match(true) {
      $number < 1_000_000         => 1_000,
      $number < 1_000_000_000     => 1_000_000,
      $number < 1_000_000_000_000 => 1_000_000_000,
    };

    $denom = match(true) {
      $divisor == 1_000 => "ribu",
      $divisor == 1_000_000 => "juta",
      $divisor == 1_000_000_000 => "milyar",
    };

    $num = (int)floor($number / $divisor);

    return match(true) {
      $num == 0   => "{$num}",
      $num < 1000 => "{$num} {$denom}",
    };
  }

  public function donate($campaignId)
  {
    $campaign = $this->campaigns[$campaignId];
    $campaign['donatur'] = Auth::user()->name;
    $campaign['email'] = Auth::user()->email;
    $this->dispatch('make-donation', campaign: $campaign)->to(DonateCampaign::class);
  }
}

