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

	public function showUpdate()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return Redirect::to('/dashboard');
		}

		return View::make('surat.update', array('surat' => $surat, 'allStatus' => Status::all()));
	}

	public function showFinalize()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return Redirect::to('/dashboard');
		}

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
		$surat->email 			= Input::get('email', '');
		$surat->barcode 		= Input::get('barcode', '');
		$surat->perihal 		= Input::get('perihal', '');
		$surat->asal 			= Input::get('asal', '');
		$surat->keterangan 		= Input::get('keterangan', '');
		$surat->final 			= 0;

		if (($surat->no == '') || ($surat->email == '') || ($surat->barcode == '') || ($surat->perihal == '') || ($surat->asal == ''))
		{
			return View::make('surat.create', array('error' => 'Nomor, email, barcode, perihal dan asal tidak boleh kosong'));
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

		//send email update	
		$content = "Surat anda telah sampai pada " . $log->status_id;
		$this->sendEmail($surat->email, $content);

		return Redirect::to('/dashboard');
	}

	public function finalize()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return Redirect::to('/dashboard');
		}

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

	public function sendEmail($adress, $content) {			
		$urlAPI = OAUTH_HOST.'/TemanDev/rest/sendEmail/';
	    $opt = array(CURLOPT_HTTPHEADER=>array('Content-Type: application/json'));
	    $body = '{"sendEmail":{"to":'$adress',"subject":"coba","content":'$content'}}';        
	    $request = new OAuthRequester($urlAPI,'POST',$tokenResultParams,$body);
	    echo 'execute api..';
	    $result = $request->doRequest(0,$opt);
	    if ($result['code'] == 200) {
	            echo $result['body'];
	    }
	    else {
	            echo 'Error: '.$result['code'];
	    }
	}
}
