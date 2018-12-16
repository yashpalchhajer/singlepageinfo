<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$news = News::latest()->get();
		return view('news.index',compact('news'));
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

		$request->validate([
			'title' => 'required|max:100',
			'description' => 'required'
		]);

			

		News::create($request->all());
		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\News  $news
	 * @return \Illuminate\Http\Response
	 */
	public function show(News $news)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\News  $news
	 * @return \Illuminate\Http\Response
	 */
	public function edit(News $news)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$request->validate([
			'id' => 'integer|required',
			'title' => 'required|max:100',
			'description' => 'required'
		]);
		
		$news = News::findOrFail($request->news_id);
		$news->update($request->all());

		return back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Illuminate\Http\Request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{	
		$data = News::findOrFail($id);
		$data->delete();
		return back();
	}

}
