<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Phone;
use App\Models\Email;
use App\Models\Address;
use App\Models\Site;
use App\Models\Setting;
use App\Models\Statistic;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $user = User::factory()->create();
      $site = Site::factory()->create();
      // ManyToOne Relationship
      Phone::factory()->for($user)->count(3)->create();
      Email::factory()->for($user)->count(3)->create();
      Address::factory()->for($user)->count(3)->create();
      // ManyToMany Relationship
      Setting::factory()->for($user)->for($site)->count(3)->create();
      Statistic::factory()->for($user)->for($site)->count(50)->create();
    }
}
