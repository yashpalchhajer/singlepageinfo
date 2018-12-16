<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Libraries\Common;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getGraphData(){
        try{
            $resArr['status'] = 0;
            /** get count of enquiries */
            $daysOfMonth = Common::getDaysOfMonth();
            $retArr['data']['daysOfMonth'] = $daysOfMonth;

            /** get count of subscribers */
            $subs = \App\Models\Subscriber::get()->count();
            $retArr['data']['totalSubs'] = $subs;

            /** get count of visitors */
            $visits = \App\Models\Visitor::get()->count();
            $retArr['data']['totalVisitors'] = $visits;

            /** get count of enquiries */
            $retArr['data']['totalEnquiries'] = \App\Models\Enquiry::get()->count();

            /** get count of replies */
            $retArr['data']['totalReplies'] = \App\Models\Enquiry::where('reply_date','!=','NULL')->get()->count();
            
        }catch(\Exception $e){
            $retArr = ['status' => 1,$e->getMessage()];
        }
        return json_encode($retArr);
    }
}
