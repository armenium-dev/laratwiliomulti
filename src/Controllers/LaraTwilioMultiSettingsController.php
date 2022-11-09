<?php

namespace Armenium\LaraTwilioMulti\Controllers;

use Armenium\LaraTwilioMulti\Models\LaraTwilioMultiSettings;
use Illuminate\Http\Request;

class LaraTwilioMultiSettingsController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		dd(__METHOD__);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request){
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function show(LaraTwilioMultiSettings $laraTwilioMultiSettings){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function edit(LaraTwilioMultiSettings $laraTwilioMultiSettings){
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, LaraTwilioMultiSettings $laraTwilioMultiSettings){
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(LaraTwilioMultiSettings $laraTwilioMultiSettings){
		//
	}
}
