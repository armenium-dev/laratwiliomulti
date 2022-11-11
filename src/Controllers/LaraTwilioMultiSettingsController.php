<?php

namespace Armenium\LaraTwilioMulti\Controllers;

use Armenium\LaraTwilioMulti\Models\LaraTwilioMultiSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaraTwilioMultiSettingsController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		$settings = LaraTwilioMultiSettings::all();

		return view('LaraTwilioMultiViews::index', compact('settings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		return view('LaraTwilioMultiViews::create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request){
		$input = $request->all();
		$input['active'] = isset($input['active']) ? 1 : 0;
		$input['params'] = json_encode($input['params']);
		unset($input['_token']);

		LaraTwilioMultiSettings::create($input);

		return redirect(route('laratwiliomultisettings.index'));
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
	public function edit($id, LaraTwilioMultiSettings $laraTwilioMultiSettings){
		$settings = $laraTwilioMultiSettings->find($id);
		#dd($settings->params['sms_from']);
		return view('LaraTwilioMultiViews::edit', compact('settings'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, LaraTwilioMultiSettings $laraTwilioMultiSettings){
		$input = $request->all();
		$input['active'] = isset($input['active']) ? 1 : 0;
		$input['params'] = json_encode($input['params']);
		unset($input['_token']);

		LaraTwilioMultiSettings::update($input);

		return redirect(route('laratwiliomultisettings.index'));
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
