<!doctype html>
<html>
<head>
	<title>Aplikasi Kontrol Surat</title>
  <script type="text/javascript" src="<?php echo asset('lib/js/jquery/dist/jquery.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('lib/js/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('lib/js/moment/min/moment.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('lib/js/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo asset('lib/js/bootstrap/dist/css/bootstrap.min.css')?> " />
  <link rel="stylesheet" href="<?php echo asset('lib/js/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')?> " />
  
  <style type="text/css">
    table.fixed { table-layout:fixed; }
    table.fixed td { overflow: hidden; }
  </style>
</head>
<body>
	<div class="container">
		<div class="page-header">
		  <h1><a href="/dashboard">Aplikasi Kontrol Surat</a> <small>Input Surat Baru</small></h1>
		</div>

    <form action="/surat/create" method="post">
    <div class="panel panel-default">

      <div class="panel-heading">
        Input Surat Baru
      </div>

      <div class="panel-body">

    		<div class="form-group">
          <label>Nomor Surat</label>
          <input type="text" class="form-control" name="no" />
        </div>

        <div class="form-group">
          <label>Perihal</label>
          <input type="text" class="form-control" name="perihal" />
        </div>

        <div class="form-group">
          <label>Asal</label>
          <input type="text" class="form-control" name="asal" />
        </div>

        <div class="form-group">
          <label>Tanggal Surat</label>
          <div class=" input-group date" id='datetimepicker-tanggal'>
            <input type="text" class="form-control" name="tanggal" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
          </div>
        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" />
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

  <script type="text/javascript">
    $(function () {
      $('#datetimepicker-tanggal').datetimepicker({
        format: 'DD/MM/YYYY'
      });
    });
  </script>
</body>
</html>
