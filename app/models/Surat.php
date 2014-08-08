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

	public function logs()
	{
		return $this->hasMany('Logs', 'no', 'no');
	}
}
