<!doctype html>
<html>
<head>
	<title>Aplikasi Kontrol Surat</title>
	<script type="text/javascript" src="<?php echo asset('lib/js/jquery/dist/jquery.min.js'); ?>"></script>

	<link href="<?php echo asset('lib/css/bootstrap.min.css')?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo asset('lib/js/bootstrap.min.js') ?>"></script>

  <style type="text/css">
    table.fixed { table-layout:fixed; }
    table.fixed td { overflow: hidden; }
    loujien {text-align: right; text-size: 32px;}
  </style>
</head>
<body>
	<div class="container">
		<div class="page-header">
		  <h1>Aplikasi Kontrol Surat <small>Dashboard</small></h1>
      <a href="/">Home (Live Update)</a><br/>
      <div class="loujien">
        <a href="/logout">Logout</a>
      </div>
		</div>

    <div>
      <form method="get" action="/dashboard">
        Pencarian
        <input type="text" name="query" value="{{ Input::get('query') }}" />
        <button type="submit" class="btn btn-default">Cari</button>
      </form>

      @if (Input::get('query') != '')
      <form method="get" action="/dashboard">
        <button type="submit" class="btn btn-default">Hapus Pencarian</button>
      </form>
      @endif
      
      <a class="btn btn-info" href="/surat/create">Input Surat Baru</a>
    </div>

		<div>
		<table class="table table-striped fixed">
      <col width="85px"></col>
      <col width="100px"></col>
      <col width="100px"></col>
      <col width="70px"></col>
      <col width="200px"></col>
      <col width="100px"></col>
      <col width="50px"></col>

      <thead>
        <tr>
          <th>No. Surat</th>
          <th>Perihal</th>
          <th>Asal Surat</th>
          <th>Tanggal Surat</th>
          <th>Status</th>
          <th>Keterangan</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($allSurat as $surat)
	        <tr>
	          <td>{{ $surat->no }}</td>
	          <td>{{ $surat->perihal }}</td>
	          <td>{{ $surat->asal }}</td>
	          <td>{{ $surat->tanggal->format('d F Y') }}</td>
	          <td>
              <?php
                $i=sizeof($surat->logs)-1;
                $log = $surat->logs[$i];
                $i--;
              ?>
              <div><b>{{ strtok($log->created_at, " ") }}, {{ $log->user->nickname }}, {{ $log->status->detail }}</b></div>
	          	<?php for ($i=$i; $i >= 0; $i--) { ?>
                <?php $log = $surat->logs[$i]; ?>
                <div><font color="D0D0D0"><b>{{ strtok($log->created_at, " ") }}, {{ $log->user->nickname }}, {{ $log->status->detail }}</b></div>
	          	<?php } ?>
	          </td>
	          <td>{{ $surat->keterangan }}</td>
	          <td>
              @if ($surat->final === 0)
	          	<div>
	          		<a href="/surat/finalize?no={{ $surat->no }}" class="btn btn-default btn-xs btn-success">Finalisasi</a>
	          	</div>
	          	<div>
	          		<a href="/surat/update?no={{ $surat->no }}" class="btn btn-default btn-xs">Update</a>
	          	</div>
              @endif
	          </td>
	        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
	</div>
</body>
</html>
