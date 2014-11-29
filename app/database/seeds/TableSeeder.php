<?php
class TableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->deleteCurrent();
		$this->seedStatus();
		$this->seedUser();
		$this->seedSurat();
		$this->seedLog();
	}

	public function deleteCurrent()
	{
		DB::table('log')->delete();
		DB::table('status')->delete();
		DB::table('surat')->delete();
		DB::table('user')->delete();
	}

	public function seedStatus()
	{
		Status::create(
			array(
				'status_id'		=> 0,
				'detail'		=> 'TELAH DIJAWAB',
			)
		);

		Status::create(
			array(
				'status_id'		=> 1,
				'detail'		=> 'FRONT OFFICE',
			)
		);

		Status::create(
			array(
				'status_id'		=> 2,
				'detail'		=> 'SEKRETARIS UMUM',
			)
		);

		Status::create(
			array(
				'status_id'		=> 3,
				'detail'		=> 'KETUA UMUM',
			)
		);

		Status::create(
			array(
				'status_id'		=> 4,
				'detail'		=> 'BENDAHARA',
			)
		);

		Status::create(
			array(
				'status_id'		=> 5,
				'detail'		=> 'KASIR YBWSA',
			)
		);

		Status::create(
			array(
				'status_id'		=> 6,
				'detail'		=> 'SEKRETARIS BIRO',
			)
		);

		Status::create(
			array(
				'status_id'		=> 7,
				'detail'		=> 'TIM REVIEW',
			)
		);

	}

	public function seedUser()
	{
		User::create(
			array(
				'username'		=> 'budi',
				'password'		=> Hash::make('budi'),
				'nickname'		=> 'BR',
			)
		);

		User::create(
			array(
				'username'		=> 'didi',
				'password'		=> Hash::make('didi'),
				'nickname'		=> 'DS',
			)
		);

		User::create(
			array(
				'username'		=> 'nini',
				'password'		=> Hash::make('nini'),
				'nickname'		=> 'NB',
			)
		);
	}

	public function seedSurat()
	{
		Surat::create(
			array(
				'no'			=> 'PM_61.01-0001',
				'email'			=> 'coba@email.com',
				'barcode'		=> '123456789',
				'perihal'		=> 'Permohonan Anggaran Pelatihan',
				'asal'			=> 'UNISSULA - FK. Farmasi',
				'keterangan'	=> '',
				'final'			=> 0,
			)
		);

		Surat::create(
			array(
				'no'			=> 'PM_61.08-0002',
				'email'			=> 'user@mail.com',
				'barcode'		=> '0987654321',
				'perihal'		=> 'Permohonan Dana Pembangunan',
				'asal'			=> 'Bagian Pembangunan YBWSA',
				'keterangan'	=> 'Dana sudah disetujui',
				'final'			=> 1,
			)
		);
	}

	public function seedLog()
	{
		Logs::create(
			array(
				'username'		=> 'budi',
				'status_id'		=> '1',
				'no'			=> 'PM_61.01-0001',
			)
		);
		Logs::create(
			array(
				'username'		=> 'budi',
				'status_id'		=> '2',
				'no'			=> 'PM_61.01-0001',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '3',
				'no'			=> 'PM_61.01-0001',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '4',
				'no'			=> 'PM_61.01-0001',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '3',
				'no'			=> 'PM_61.01-0001',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '4',
				'no'			=> 'PM_61.01-0001',
			)
		);
		
		Logs::create(
			array(
				'username'		=> 'budi',
				'status_id'		=> '1',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'budi',
				'status_id'		=> '2',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '3',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '2',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '4',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'didi',
				'status_id'		=> '5',
				'no'			=> 'PM_61.08-0002',
			)
		);
		Logs::create(
			array(
				'username'		=> 'nini',
				'status_id'		=> '0',
				'no'			=> 'PM_61.08-0002',
			)
		);
	}

}
