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

     public function seed_for_user($user, $site)
     {
       //$site = Site::factory()->create();
       // For stress filling
       Phone::factory()->for($user)->count(5)->create();
       Email::factory()->for($user)->count(2)->create();

       // ManyToOne Relationship
       $phone = Phone::factory()->for($user)->create();
       $email = Email::factory()->for($user)->create();
       $address = Address::factory()->for($user)->create();
       // ManyToMany Relationship
       Setting::factory()
        ->for($user)
        ->for($site)
        ->for($phone)
        ->for($email)
        ->for($address)->create();
       Statistic::factory()->for($user)->for($site)->count(5)->create();
     }

    public function run()
    {
      //Create SuperUser
      $super_user = User::create([
                      'name' => 'admin',
                      'password' => Hash::make('12345678'),
                      'email' => 'admin@gmail.com',
                    ]);

      $user = User::factory()->create();

      $site_local = Site::create([
          'url' => '127.0.0.1:8000',
          'rules' => '',
      ]);
      $site_remote = Site::create([
          'url' => 'zhaluzi-v-krasnodare.ru',
          'rules' => '',
      ]);

      $this->seed_for_user($user, $site_remote);
      $this->seed_for_user($super_user, $site_local);

    }



}
