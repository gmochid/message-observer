<?php

class SuratController extends BaseController {

	public function __construct() 
	{
		$this->beforeFilter('auth');
	}

	public function showCreate()
	{
		return View::make('surat.create');
	}

	public function showEdit()
	{
		$surat = Surat::getSuratFromRequest();

		return View::make('surat.edit', array('surat' => $surat));
	}

	public function showUpdate()
	{
		$surat = Surat::getSuratFromRequest();

		return View::make('surat.update', array('surat' => $surat, 'allStatus' => Status::all()));
	}

	public function showFinalize()
	{
		$surat = Surat::getSuratFromRequest();

		return View::make('surat.finalize', array('surat' => $surat));
	}


	public function create()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''));
		if($surat->count() != 0)
		{
			return View::make('surat.create', array('error' => 'Nomor surat telah terdaftar'));
		}

		$surat 	= new Surat;
		$surat->no 				= Input::get('no', '');
		$surat->perihal 		= Input::get('perihal', '');
		$surat->asal 			= Input::get('asal', '');
		$surat->keterangan 		= Input::get('keterangan', '');
		$surat->tanggal 		= Carbon\Carbon::createFromFormat('d/m/Y', Input::get('tanggal', ''));
		$surat->final 			= 0;

		if (($surat->no == '') || ($surat->perihal == '') || ($surat->asal == ''))
		{
			return View::make('surat.create', array('error' => 'Nomor, email, perihal, tanggal dan asal tidak boleh kosong'));
		}

		try{
			$surat->save();
		} catch (\Exception $e) {
			return View::make('surat.create', array('error' => 'Gagal membuat surat baru'));
		}

		$log	= new Logs;
		$log->no 					= Input::get('no', '');
		$log->username 				= Auth::user()->username;
		$log->status_id 			= 1; // surat diterima front office

		$log->save();

		return Redirect::to('/dashboard');
	}

	public function edit()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return View::make('surat.update', array('error' => 'Nomor surat tidak ditemukan'));
		}		

		$surat->no				= Input::get('no', $surat->no);
		$surat->perihal			= Input::get('perihal', $surat->perihal);
		$surat->asal			= Input::get('asal', $surat->asal);
		$surat->tanggal			= Carbon\Carbon::createFromFormat('d/m/Y', Input::get('tanggal', ''));
		$surat->keterangan		= Input::get('keterangan', $surat->keterangan);
		$surat->save();

		return Redirect::to('/dashboard');
	}

	public function update()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return View::make('surat.update', array('error' => 'Nomor surat tidak ditemukan'));
		}		

		$surat->keterangan		= Input::get('keterangan', $surat->keterangan);
		$surat->save();

		$log	= new Logs;
		$log->no 				= $surat->no;		
		$log->username 			= Auth::user()->username;
		$log->status_id 		= Input::get('status');

		$log->save();
		
		$data = array(			
			'status'		=> Status::find($log->status_id)
		);
		
		$email = Input::get('email', '');

		return Redirect::to('/dashboard');
	}

	public function finalize()
	{
		$surat = Surat::getSuratFromRequest();

		$surat->keterangan		= Input::get('keterangan', $surat->keterangan);
		$surat->final 			= 1;
		$surat->save();

		$log	= new Logs;
		$log->no 				= $surat->no;
		$log->username 			= Auth::user()->username;
		$log->status_id 		= 0; // surat telah dijawab

		$log->save();

		return Redirect::to('/dashboard');
	}

}
