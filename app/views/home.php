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
      <h1>Aplikasi Kontrol Surat <small>Live Update</small></h1>
    </div>

		<div>
		<table class="table table-striped fixed">
      <col width="85px"></col>
      <col width="100px"></col>
      <col width="100px"></col>
      <col width="70px"></col>
      <col width="200px"></col>
      <col width="100px"></col>

      <thead>
        <tr>
          <th>No. Surat</th>
          <th>Perihal</th>
          <th>Asal Surat</th>
          <th>Tanggal Surat</th>
          <th>Status</th>
          <th>Keterangan</th>
        </tr>
      </thead>

      <tbody>
      	<?php foreach ($allSurat as $surat) { ?>
	        <tr>
	          <td><?php echo $surat->no; ?></td>
	          <td><?php echo $surat->perihal; ?></td>
	          <td><?php echo $surat->asal; ?></td>
	          <td><?php echo strtok($surat->created_at, " "); ?></td>
	          <td>
	          	<?php foreach ($surat->logs as $log) { ?>
	          		<div><?php echo strtok($log->created_at, " "); ?>, <?php echo $log->user->nickname; ?>, <?php echo $log->status->detail; ?></div>
	          	<?php } ?>
	          </td>
	          <td><?php echo $surat->Keterangan; ?></td>
	        </tr>
      	<?php } ?>
      </tbody>
    </table>
    </div>
	</div>
</body>

<script language="javascript" type="text/javascript">
  $(document).ready(function() {
    setInterval("location.reload(true)", 300000);
  });   
</script>

</html>
