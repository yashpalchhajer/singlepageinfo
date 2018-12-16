<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\News;
use App\Models\Topper;
use App\Models\Enquiry;
use PHPUnit\Runner\Exception;
use App\Models\Subscriber;
use App\Models\Visitor;

class ApiService extends Controller
{
    public function index(Request $request){
        /** save new visitor entry */
        Visitor::create([
            'user_ip' => $request->ip()
        ]);
        
        event(new \App\Events\NewVisitor());

        $data = [];
        $news = News::where('status','ACTIVE')->orderBy('id','desc')->get(['title','description']);
        if(count($news) > 0)
            $data['news'] = $news;
        $toppers = Topper::orderBy('id','desc')->get(['name','course','description','img_path','exm_session']);
        if(count($toppers) > 0)
            $data['toppers'] = $toppers;
        return json_encode($data);
    }

    /* public function subscribe(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);
        try{
            Subscriber::create($request->all());
            $res = json_encode(['code' => 0,'message' => 'Subscibed successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            $res = json_encode(['code' => 1,'message' => 'Some error pccured on server. Please contact to customer care.']);
        }
        return $res;
    } */

    public function enquery(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'mobile' => 'required',
            'title' => 'required',
            'enquiry' => 'required'
        ]);
        try{
            $data = [           
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'title' => $request->title,
                'enquiry' => $request->enquiry,
                'enquiry_date' => date('Y-m-d H:i:s')
            ];
            Enquiry::create($data);
            $res = json_encode(['code' => '0','message' => 'Your query has been submitted. We will get to you soon.']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            $res = json_encode(['code' => 1,'message' => 'Some error pccured on server. Please contact to customer care.']);
        }
        return $res;
    }
}
