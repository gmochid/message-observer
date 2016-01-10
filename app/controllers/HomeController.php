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
		$allSurat = $this->getSuratFromRequest();

		return View::make(
			'dashboard', 
			array('allSurat' => $allSurat)
		);
	}

	public function showLogin()
	{
		return View::make('login');		
	}

	private function getSuratFromRequest()
	{
		$status = Input::get('status', '');
		$from = Input::get('from', '0');
		$to = Input::get('to', '0');
		$query = Input::get('query', '');

		$allSurat = Surat::query();

		if($status == 'DONE')
		{
			$allSurat = $allSurat->status(1);
		}
		else if($status == 'NOTDONE')
		{
			$allSurat = $allSurat->status(0);
		}

		if($from == '1')
		{
			$allSurat = $allSurat->fromTanggal(Input::get('from-month'), Input::get('from-year'));
		}

		if($to == '1')
		{
			$allSurat = $allSurat->toTanggal(Input::get('to-month'), Input::get('to-year'));
		}

		if($query != '')
		{
			$allSurat = $allSurat->perihal($query);
		}

		$allSurat = $allSurat->orderBy('updated_at', 'desc');
		$allSurat = $allSurat->paginate(10);

		return $allSurat;
	}

}