<!doctype html>
<html>
<head>
	<title>Aplikasi Kontrol Surat</title>
  <script type="text/javascript" src="<?php echo asset('lib/js/jquery/dist/jquery.min.js'); ?>"></script>

  <link href="<?php echo asset('lib/js/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
  <script type="text/javascript" src="<?php echo asset('lib/js/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  
  <style type="text/css">
    table.fixed { table-layout:fixed; }
    table.fixed td { overflow: hidden; }
  </style>
</head>
<body>
	<div class="container">
		<div class="page-header">
		  <h1><a href="/dashboard">Aplikasi Kontrol Surat</a> <small>Update Status Surat</small></h1>
		</div>

    <form action="/surat/update" method="post">
    <div class="panel panel-default">

      <div class="panel-heading">
        Update Status Surat
      </div>

      <div class="panel-body">

        <input type="hidden" class="form-control" name="barcode" value="{{ $surat->barcode }}" />
        <input type="hidden" class="form-control" name="email" value="{{ $surat->email }}" />

    		<div class="form-group">
          <label>Nomor Surat</label>
          <input readonly type="text" class="form-control" name="no" value="{{ $surat->no }}" />
        </div>

        <div class="form-group">
          <label>Perihal</label>
          <input readonly type="text" class="form-control" name="perihal" value="{{ $surat->perihal }}" />
        </div>

        <div class="form-group">
          <label>Asal</label>
          <input readonly type="text" class="form-control" name="asal" value="{{ $surat->asal }}" />
        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" value="{{ $surat->keterangan }}" />
        </div>

        <div class="form-group">
          <div style="font-weight: bold">Status Surat</div>
          <ul class="list-group">
            @foreach($surat->logs as $i => $log)
              <li class="list-group-item">{{$i+1}}. {{ strtok($log->created_at, " ") }}, {{ $log->user->nickname }}, {{ $log->status->detail }}</li>
            @endforeach
          </ul>
        </div>

        <div class="form-group">
          <label>Status Terbaru</label>
          <div class="row">
          @foreach ($allStatus as $status)
            <div class="col-lg-3 col-md-4 col-xs-6">
              <input type="radio" name="status" value="{{ $status->status_id }}">{{ $status->detail }}
            </div>
          @endforeach
          </div>
        </div>

        <button class="btn btn-default btn-info form-group" type="submit">Submit</button>
      </div>

    </div>
    </form>

    @if (isset($error))
    <div class="panel panel-danger">
      <div class="panel-heading">
        {{ $error }}
      </div>
    </div>
    @endif
	</div>
</body>
</html>
