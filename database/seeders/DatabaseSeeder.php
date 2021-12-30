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
                      'name' => env('DEFAULT_USER_NAME'),
                      'password' => Hash::make(env('DEFAULT_USER_PASSWORD')),
                      'email' => env('DEFAULT_USER_EMAIL'),
                    ]);

      $user0 = User::create([
                      'name' => 'Дмитрий',
                      'password' => Hash::make('12345678'),
                      'email' => env('dmitrii@gmail.com'),
                    ]);

      $user1 = User::create([
                      'name' => 'User1',
                      'password' => Hash::make('12345678'),
                      'email' => env('user1@gmail.com'),
                    ]);

      $user2 = User::create([
                      'name' => 'User2',
                      'password' => Hash::make('12345678'),
                      'email' => env('user2@gmail.com'),
                    ]);

      $user3 = User::create([
                      'name' => 'User3',
                      'password' => Hash::make('12345678'),
                      'email' => env('user3@gmail.com'),
                    ]);


      $site_local = Site::create([
          'url' => '127.0.0.1:8000',
          'rules' => '',
      ]);
      $site_remote = Site::create([
          'url' => 'zhaluzi-v-krasnodare.ru',
          'rules' => htmlspecialchars("$('#footer_phone_number').html(formatPhoneNumber($phone_number_human));  $('#number_phone').html(formatPhoneNumber($phone_number_human));  $('#contact_items #number_phone_contact').html('<i class=\"la la-mobile-phone\"></i> '+$phone_number_human+'');  $('#contact_items #number_phone_contact').attr('href', 'tel:'+$phone_number_raw);  $('#contact_items #whatsapp_link').attr('href', 'https://api.whatsapp.com/send?phone='+$phone_number_raw+'&amp;text='+$whats_app_message); $($('.social_wrapper li')[0]).find('a').attr('href', 'https://api.whatsapp.com/send?phone='+$phone_number_raw+'&amp;text='+$whats_app_message);  $('#men_1 a').html('<i class=\"la la-mobile-phone\"></i> '+$phone_number_human);  $('#men_1 a').attr('href', 'tel:'+$phone_number_raw);  $('.phone-mobile-header a').html('<i class=\"la la-mobile-phone\"></i> '+$phone_number_human);  $('.phone-mobile-header a').attr('href', 'tel:'+$phone_number_raw);"),
      ]);

      $this->seed_for_user($super_user, $site_remote);
      $this->seed_for_user($super_user, $site_local);
      $this->seed_for_user($user0, $site_remote);
      $this->seed_for_user($user1, $site_remote);
      $this->seed_for_user($user2, $site_remote);
      $this->seed_for_user($user3, $site_remote);
      
    }



}
