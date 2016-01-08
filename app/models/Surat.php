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

	public function scopeStatus($query, $status)
	{
		return $query->where('final', '=', $status);
	}

	public function scopeQuery($query, $keyword)
	{
		return $query->where('no', 'like', '%'.$keyword.'%')
					->orWhere('perihal', 'like', '%'.$keyword.'%')
					->orWhere('asal', 'like', '%'.$keyword.'%');
	}

	public function scopeFrom($query, $from)
	{
		return $query->where('created_at', '>=', new DateTime($from));
	}

	public function scopeTo($query, $to)
	{
		return $query->where('created_at', '<=', new DateTime($to));
	}

	public static function getSuratFromQuery()
	{
		$query = Input::get('query', '');
		$status = Input::get('status', '');
		$surat = null;

		if($query == '')
		{
			$surat = Surat::orderBy('tanggal', 'DESC');
		}
		else
		{
			$surat = Surat::where('no', 'like', '%'.$query.'%')
						->orWhere('perihal', 'like', '%'.$query.'%')
						->orWhere('asal', 'like', '%'.$query.'%');
		}

		if($status == 'DONE')
		{
			$surat = $surat->where('final', '=', 1);
		}
		else if($status == 'NOTDONE')
		{
			$surat = $surat->where('final', '=', 0);
		}

		return $surat->paginate(10);
	}
}
