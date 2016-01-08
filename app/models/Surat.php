<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

	public function scopePerihal($query, $keyword)
	{
		return $query->where('perihal', 'like', '%'.$keyword.'%');
	}

	public function scopeFromTanggal($query, $fromMonth, $fromYear)
	{
		return $query->where('tanggal', '>=', Carbon::createFromDate($fromYear, $fromMonth)->startOfMonth());
	}

	public function scopeToTanggal($query, $toMonth, $toYear)
	{
		return $query->where('tanggal', '<=', Carbon::createFromDate($toYear, $toMonth)->endOfMonth());
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
