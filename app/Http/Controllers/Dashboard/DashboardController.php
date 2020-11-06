<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Terms\TermListItemResource;

class DashboardController extends Controller
{
  public function lastCreated(Request $request)
  {
    return TermListItemResource::collection(
      $request->user()->terms()
        ->dictionnary($request->get('dictionnary', 'fra'))
        ->latest('created_at')
        ->limit(50)->get()
    );
  }

  public function lastUpdated(Request $request)
  {
    return TermListItemResource::collection(
      $request->user()->terms()
        ->dictionnary($request->get('dictionnary', 'fra'))
        ->latest('updated_at')->limit(50)->get()
    );
  }

  public function mostViewed(Request $request)
  {
    return TermListItemResource::collection(
      $request->user()->terms
        ->dictionnary($request->get('dictionnary', 'fra'))
        ->latest('viewed')
        ->latest('updated_at')->limit(50)->get()
    );
  }

  public function statistics(Request $request)
  {
    return [
      'data' => [
        'today_count' => $request->user()->terms()->whereDate('created_at', Carbon::today())->count(),
        'last_week_count' => $request->user()->terms()->where('created_at', '>', Carbon::today()->subDays(7))->count(),
        'last_month_count' => $request->user()->terms()->where('created_at', '>', Carbon::today()->subMonth(1))->count(),
        'count' => $request->user()->terms()->count(),
      ]
    ];
  }
}
