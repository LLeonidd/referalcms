<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic;

class StatisticsPageController extends Controller
{
  public function main()
  {
    $content = [
      'user' => Auth::user(),
      'statistics' => Statistic::select([
        "referer_host",
        "sites.url as url",
        "users.name as name",
        "statistics.user_agent as user_agent",
        "statistics.session_id as session_id",
        "statistics.created_at as ca",
        "statistics.datetime_end as ce",
      ])
        ->leftJoin('sites', 'sites.id', 'statistics.site_id')
        ->leftJoin('users', 'users.id', 'statistics.user_id')
        ->where('user_id', Auth::user()->id)->get(),
    ];
    return view('statistics', $content);
  }
}
