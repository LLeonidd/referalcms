<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SitesPageController extends Controller
{
  public function main()
  {
    $sites = Site::all();
    $content = [
      'sites' => $sites,
      'sites_count' =>$sites->count(),
      'user_id' => Auth::user()->id,
    ];
    return view('sites', $content);
  }
}
