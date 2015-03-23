<?php

class Surat extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'surat';

	/**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

	/**
	 * The primary key of this model
	 */
	protected $primaryKey = 'no';

	protected $hidden = array();

	protected $dates = ['created_at', 'updated_at', 'tanggal'];

	public function logs()
	{
		return $this->hasMany('Logs', 'no', 'no');
	}
}
