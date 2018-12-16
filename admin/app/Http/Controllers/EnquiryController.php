<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Mail;

class EnquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Enquiry::latest()->get();
        return view('enquiry.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($enquiry);
        $data = Enquiry::find($id);
        return view('enquiry.reply',compact('data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // print_r($id);
        $request->validate([
            'reply' => 'required',
            'replyOption' => 'required|array'
        ]);
        // $updateArr['sms'] = 0;
        if(array_key_exists('sendMobile',$request->replyOption)){
            // send sms code here
            // $updateArr['sms'] = 1;
        }

        $enquiry = Enquiry::find($id);

        /** default mail will sent to all replies */
        $title = $enquiry->title;
        $reply = $request->reply;
        
        Mail::send([],[], function ($message) use ($enquiry) {
            $message->from(env('MAIL_SENDER'), 'Reply From This');
        
            $message->to($enquiry->email, $enquiry->name)
            ->setBody('<h3> this is mail body </h3>','text/html');
        
            $message->subject($enquiry->title);
        
        });
                
        $enquiry->reply = $request->reply;
        $enquiry->reply_date = \Carbon\Carbon::now();
        $enquiry->save();
        return redirect('enquiries');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enqs = Enquiry::findOrFail($id);
        $enqs->delete();
        return back();
    }
}
