<!doctype html>
<html>
<head>
	<title>Aplikasi Kontrol Surat</title>
	<script type="text/javascript" src="<?php echo asset('lib/js/jquery-1.10.2.min.js'); ?>"></script>

	<link href="<?php echo asset('lib/css/bootstrap.min.css')?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo asset('lib/js/bootstrap.min.js') ?>"></script>
  
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

    <form action="/surat/finalize" method="post">
    <div class="panel panel-default">

      <div class="panel-heading">
        Update Status Surat
      </div>

      <div class="panel-body">

    		<div class="form-group">
          <label>Nomor Surat</label>
          <input readonly type="text" class="form-control" name="no" value="<?php echo $surat->no; ?>" />
        </div>

        <div class="form-group">
          <label>Perihal</label>
          <input readonly type="text" class="form-control" name="perihal" value="<?php echo $surat->perihal; ?>" />
        </div>

        <div class="form-group">
          <label>Asal</label>
          <input readonly type="text" class="form-control" name="asal" value="<?php echo $surat->asal; ?>" />
        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" value="<?php echo $surat->keterangan; ?>" />
        </div>

        <button class="btn btn-default btn-success form-group" type="submit">Finalisasi</button>
      </div>

    </div>
    </form>

    <?php if(isset($error)) { ?>
    <div class="panel panel-danger">
      <div class="panel-heading">
        <?php echo $error; ?>
      </div>
    </div>
    <?php } ?>
	</div>
</body>
</html>
