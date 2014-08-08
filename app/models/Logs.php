<?php

class Logs extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'log';

	/**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

	protected $hidden = array();

	public function surat()
	{
		return $this->belongsTo('Surat', 'no', 'no');
	}

	public function user()
	{
		return $this->belongsTo('User', 'username', 'username');
	}

	public function status()
	{
		return $this->belongsTo('Status', 'status_id', 'status_id');
	}
}
