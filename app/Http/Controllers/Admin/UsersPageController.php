<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersPageController extends Controller
{
    public function main()
    {
      $content = [
        'users' => User::all(),
      ];
      return view('admin_users', $content);
    }
}
