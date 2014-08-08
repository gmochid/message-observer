<?php

class UserController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('guest', array('only' => array('login')));

		$this->beforeFilter('auth', array('only' => array('logout')));
	}

	public function login()
	{
		$user = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password')
		);

		if(Auth::attempt($user)) {
			return Redirect::to('/dashboard');
		}

		return Redirect::to('/login');
	}

	public function logout()
	{
		$user = Auth::user();
		Auth::logout();

		Redirect::to('/');
	}
}
