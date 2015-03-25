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

	public static function getSuratFromQuery()
	{
		$query = Input::get('query', '');

		if($query == '')
		{
			return Surat::all();
		}
		else 
		{
			$surat = new Surat();
			$columns = Schema::getColumnListing($surat->table);
			return Surat::where('no', 'like', '%'.$query.'%')
						->orWhere('perihal', 'like', '%'.$query.'%')
						->orWhere('asal', 'like', '%'.$query.'%')
						->get();
		}
	}

	public static function getSuratFromRequest()
	{
		$surat = Surat::where('no', '=', Input::get('no', ''))->first();
		if($surat == null)
		{
			return Redirect::to('/dashboard');
		}

		return $surat;
	}
}
