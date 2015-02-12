<?php

class HomeController extends BaseController {

	public function __construct()
	{
		Log::info('cek gan');
		$this->beforeFilter('guest', array('only' => array('showLogin')));

		$this->beforeFilter('auth', array('only' => array('showDashboard')));
	}

	public function showHome()
	{
		$allSurat = Surat::all();		

		return View::make('home', array('allSurat' => $allSurat));
	}

	public function showDashboard()
	{
		$allSurat = Surat::all();

		return View::make('dashboard', array('allSurat' => $allSurat));
	}

	public function showLogin()
	{

		return View::make('login');		
	}

}
