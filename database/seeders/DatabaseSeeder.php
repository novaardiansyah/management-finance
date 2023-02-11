<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name'              => 'Nova Ardiansyah',
      'email'             => 'novaardiansyah78@gmail.com',
      'email_verified_at' => now(),
      'password'          => Hash::make('123456')
    ]);

    Menu::create([
      'name'       => 'Dashboard',
      'icon'       => 'fa-tachometer-alt',
      'url'        => '/dashboard',
      'is_active'  => 1
    ]);
    
    Menu::create([
      'name'       => 'Master Data',
      'icon'       => 'fa-database',
      'url'        => '/master-data/menu',
      'is_parent'  => 1,
      'is_active'  => 1
    ]);
  }
}
