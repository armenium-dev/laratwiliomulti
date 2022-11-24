<?php

namespace Armenium\LaraTwilioMulti\Controllers;

use Armenium\LaraTwilioMulti\Models\LaraTwilioMultiSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Flash;

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
		$settings = new LaraTwilioMultiSettings();
		$settings->params = [0 => []];

		return view('LaraTwilioMultiViews::create', compact('settings'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request){
		$input = $request->all();

		if(empty($input['name'])){
			$input['name'] = "Twilio Account";
		}

		$input['active'] = isset($input['active']) ? 1 : 0;
		$input['params'] = json_encode($input['params']);


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
		$settings->params = json_decode($settings->params, true);
		#dd($settings->params);

		return view('LaraTwilioMultiViews::edit', compact('settings'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function update($id, Request $request){
		$laraTwilioMultiSettings = LaraTwilioMultiSettings::find($id);
		$input = $request->all();
		$input['active'] = isset($input['active']) ? 1 : 0;
		$input['params'] = json_encode($input['params']);

		$laraTwilioMultiSettings->update($input);

		return redirect(route('laratwiliomultisettings.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\LaraTwilioMultiSettings $laraTwilioMultiSettings
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$laraTwilioMultiSettings = LaraTwilioMultiSettings::find($id);

		if (empty($laraTwilioMultiSettings)) {
			Flash::error('Account not found');

			return redirect(route('laratwiliomultisettings.index'));
		}

		$laraTwilioMultiSettings->delete();

		Flash::success('Account deleted successfully.');

		return redirect(route('laratwiliomultisettings.index'));
	}
}
