<?php
include_once app_path() . "/oauth/library/OAuthStore.php";
include_once app_path() . "/oauth/library/OAuthRequester.php";
 
define("CONSUMER_KEY", "bestapp262");
define("CONSUMER_SECRET", "UJHSG");
define("OAUTH_HOST", "http://sandbox.appprime.net");
define("REQUEST_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/RequestToken/");
define("ACCESS_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/AccessToken/");

// Init the OAuthStore
$options = array(
'consumer_key' => CONSUMER_KEY,
'consumer_secret' => CONSUMER_SECRET,
'server_uri' => OAUTH_HOST,
'request_token_uri' => REQUEST_TOKEN_URL,
'access_token_uri' => ACCESS_TOKEN_URL
);
// Note: do not use "Session" storage in production. Prefer a database storage, such as MySQL.
OAuthStore::instance("Session", $options);

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
		$surat = Surat::where('barcode', '=', Input::get('barcode', ''))->first();
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
		$surat = Surat::where('barcode', '=', Input::get('barcode', ''))->first();
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
		// $this->sendEmail($data, $email);
		$this->sendEmailTelkom($data, $email);

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

	public function sendEmail($data, $email) {
		Mail::send('emails.notif', $data, function($message) use ($email) {			
		    $message->to($email, '')->subject('Mailon Update');
		});		
	}

	public function sendEmailTelkom($data, $email) {
		try
		{
			// STEP 1: If we do not have an OAuth token yet, go get one
			$getAuthTokenParams = null;
			// get a request token	& request token secret	
			$tokenResultParams = OAuthRequester::requestRequestToken(CONSUMER_KEY, 0, $getAuthTokenParams);	
			// STEP 2: Get an access token & access token secret
			try {		
				OAuthRequester::requestAccessToken(CONSUMER_KEY, $tokenResultParams["token"], 0, 'POST');						
			} catch (OAuthException2 $e) {
				print_r($e);
				return;
			}

			 // make the docs request.
		    $urlAPI = OAUTH_HOST.'/TemanDev/rest/sendEmail/';
		    $opt = array(CURLOPT_HTTPHEADER=>array('Content-Type: application/json'));
		    // $email = "msmaromi@gmail.com";
		    $content = "Dear pengirim, Surat anda telah sampai di ";
		    $body = '{"sendEmail":{"to":"' . $email . '","subject":"coba","content":"' . $content . '"}}';
		    $request = new OAuthRequester($urlAPI,'POST',$tokenResultParams,$body);
		    echo 'execute api..';
		    $result = $request->doRequest(0,$opt);
		    if ($result['code'] == 200) {
		            echo $result['body'];
		    }
		    else {
		            echo 'Error: '.$result['code'];
		    }
		} catch(OAuthException2 $e) {
			echo "OAuthException: " . $e->getMessage();
			var_dump($e);
		}
	}

}
