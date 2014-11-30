<!doctype html>
<html>
<head>
	<title>Mailon</title>
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
		  <h1><a href="/dashboard">Mailon</a> <small>Input Surat Baru</small></h1>
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
          <label>Alamat Email</label>
          <input type="text" class="form-control" name="email" />
        </div>

        <div class="form-group">
          <label>Barcode</label>
          <input type="text" class="form-control" name="barcode" />
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
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" />
        </div>

        <button class="btn btn-default btn-info form-group" type="submit">Submit</button>
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
