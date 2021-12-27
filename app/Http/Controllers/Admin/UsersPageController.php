<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersPageController extends Controller
{
    public function main()
    {
      return view('admin_users', []);
    }
}
