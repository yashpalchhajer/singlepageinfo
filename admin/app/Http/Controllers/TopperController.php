<?php

namespace App\Http\Controllers;

use App\Models\Topper;
use Illuminate\Http\Request;

class TopperController extends Controller
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
		$data = Topper::latest()->get();
		return view('toppers.index',compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('toppers.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// dd($request->all());
		$request->validate([
			'name' => 'required|string|max:100',
			'course' => 'required|max:80',
			'image' => 'mimes:jpeg,png,jpg'
		]);

		if($request->hasfile('image')) 
		{ 
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension(); // getting image extension
			$filename = $request->name .'_' . time().'.'.$extension;
			$file->move('uploads/toppers/', $filename);

			$createData = Topper::create([
				'name' => $request->name,
				'course' => $request->course,
				'description' => $request->description,
				'exm_session' => $request->exm_session,
				'img_path' => $filename
			]);
			$createData->save();
						
			return back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Topper  $topper
	 * @return \Illuminate\Http\Response
	 */
	public function show(Topper $topper)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Topper  $topper
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Topper $topper)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Topper  $topper
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Topper $topper)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$data = Topper::findOrFail($id);
		$data->delete();
		return back();
	}
}
