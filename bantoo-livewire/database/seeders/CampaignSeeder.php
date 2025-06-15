<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 1,
      "title"          => "Bantu Sarah melawan kanker",
      "category"       => "HEALTH",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/health.avif",
      "description"    => "Sarah baru-baru ini didiagnosis kanker payudara stadium 4 dan membutuhkan bantuan untuk biaya pengobatan.",
      "targetfunding"  => 720000000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);

    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 1,
      "title"          => "Dukung perlengkapan sekolah lokal",
      "category"       => "EDUCATION",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/edu.avif",
      "description"    => "Bantu kami menyediakan perlengkapan sekolah untuk 500 anak kurang mampu di komunitas kami.",
      "targetfunding"  => 216000000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);

    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 1,
      "title"          => "Selamatkan tempat penampungan hewan kami",
      "category"       => "PETS",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/community.avif",
      "description"    => "Tempat penampungan hewan lokal kami berisiko ditutup. Bantu kami tetap membukanya dan selamatkan ratusan hewan.",
      "targetfunding"  => 432000000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);

    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 1,
      "title"          => "Biaya kuliah untuk anak petani",
      "category"       => "EDUCATION",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/community.avif",
      "description"    => "Bantu Rizal menyelesaikan pendidikan kedokterannya. Orang tuanya petani yang kesulitan membiayai kuliah.",
      "targetfunding"  => 21600000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);

    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 2,
      "title"          => "Operasi jantung untuk Max",
      "category"       => "PETS",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/community.avif",
      "description"    => "Kucing kami Max membutuhkan operasi jantung darurat. Dia sudah menjadi bagian keluarga kami selama 18 tahun.",
      "targetfunding"  => 15000000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);

    DB::table('campaigns')->insert([
      "status"         => "ACTIVE",
      "owner"          => 2,
      "title"          => "Buku cerita anak berkebutuhan khusus",
      "category"       => "CREATIVITY",
      "location"       => "Jakarta Kota",
      "photo"          => "campaign/community.avif",
      "description"    => "Saya ingin menerbitkan buku cerita khusus untuk anak berkebutuhan khusus dengan ilustrasi yang ramah sensorik.",
      "targetfunding"  => 18000000,
      "deadline"       => "2025-06-30",
      "accounttype"    => "PERSONAL",
      "accountbank"    => "MANDIRI",
      "accountholder"  => "1234",
      "accountno"      => "1234",
      "created_at"     => "1970-01-01 00:00:00",
      "updated_at"     => "1970-01-01 00:00:00"
    ]);
  }
}
