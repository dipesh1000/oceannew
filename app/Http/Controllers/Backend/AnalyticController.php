<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class AnalyticController extends Controller
{
    public function index(){

        $getTopReferrers =   Analytics::fetchTopReferrers(Period::years(1));
        $getMostVisitedPages =   Analytics::fetchMostVisitedPages(Period::years(1));
        $visitorTypes =  Analytics::fetchUserTypes(Period::years(1));
        $browsers =  Analytics::fetchTopBrowsers(Period::years(1));
        $totalBrowsersSession=0;
        $otherBrowsersSession=0;
        foreach ($browsers as $key => $browser){
            if($key == 0 || $key == 1){

            }else{
                $otherBrowsersSession += $browser['sessions'];
                unset($browsers[$key]);
            }
            $totalBrowsersSession += $browser['sessions'];
        }

        $getTotalVisitorAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::years(1));
        $totalVisitor =  0;
        $totalPageviews =  0;
        foreach ($getTotalVisitorAndPageViews as $totalVisitorAndPageView){
            $totalVisitor += $totalVisitorAndPageView['visitors'];
            $totalPageviews += $totalVisitorAndPageView['pageViews'];
        }

        return view('admin.analytic.index', compact('totalPageviews', 'totalVisitor', 'browsers', 'totalBrowsersSession', 'otherBrowsersSession', 'visitorTypes', 'getMostVisitedPages', 'getTopReferrers'));

    }


    public function getRealTimeVisitor(){
        $getRealTimeVisitor = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];
        return $getRealTimeVisitor;
    }

}
