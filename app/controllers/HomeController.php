<?php

use Carbon\Carbon;

class HomeController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('guest', array('only' => array('showLogin')));

		$this->beforeFilter('auth', array('except' => array('showLogin')));
	}

	public function showHome()
	{
		$allSurat = $this->getSuratFromRequest();

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

	public function showPrint()
	{
		$allSurat = $this->getSuratFromRequest();

		return View::make(
			'print',
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
		$perihal = Input::get('perihal', '');
		$no = Input::get('no', '');
		$asal = Input::get('asal', '');
		$orderBy = Input::get('order-by', 'updated_at');
		$printType = Input::get('print-type', 'current-page');

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

		if($perihal != '')
		{
			$allSurat = $allSurat->perihal($perihal);
		}

		if($no != '')
		{
			$allSurat = $allSurat->no($no);
		}

		if($asal != '')
		{
			$allSurat = $allSurat->asal($asal);
		}

		$allSurat = $allSurat->orderBy($orderBy, 'desc');

		if($printType == 'all')
		{
			$allSurat = $allSurat->get();
		}
		else
		{
			$allSurat = $allSurat->paginate(10);
		}

		return $allSurat;
	}

}