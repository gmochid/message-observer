<?php

use Carbon\Carbon;

class HomeController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('guest', array('only' => array('showLogin')));

		$this->beforeFilter('auth', array('only' => array('showDashboard')));
	}

	public function showHome()
	{
		$allSurat = Surat::getSuratFromQuery();		

		return View::make(
			'home', 
			array('allSurat' => $allSurat)
		);
	}

	public function showDashboard()
	{
		$allSurat = Surat::fromTanggal(12, 2015);
		$allSurat = $allSurat->toTanggal(12, 2015);
		$allSurat = $allSurat->paginate(10);

		return View::make(
			'dashboard', 
			array('allSurat' => $allSurat)
		);
	}

	public function showLogin()
	{
		return View::make('login');		
	}

}