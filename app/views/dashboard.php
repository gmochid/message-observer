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
		  <h1><a href="/dashboard">Aplikasi Kontrol Surat</a> <small>Dashboard</small></h1>
      <!-- <a href="/">Home (Live Update)</a><br/> -->
      <a href="/logout">Logout</a>
		</div>

    <div>
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
      	<?php foreach ($allSurat as $surat) { ?>
	        <tr>
	          <td><?php echo $surat->no; ?></td>
	          <td><?php echo $surat->perihal; ?></td>
	          <td><?php echo $surat->asal; ?></td>
	          <td><?php echo strtok($surat->created_at, " "); ?></td>
	          <td>
              <?php 
                $i=sizeof($surat->logs)-1;
                $log = $surat->logs[$i];
                $i--;                
              ?>
              <div><b><?php echo strtok($log->created_at, " "); ?>, <?php echo $log->user->nickname; ?>, <?php echo $log->status->detail; ?></b></div>
	          	<?php for ($i=$i; $i >= 0; $i--) { ?>
                <?php $log = $surat->logs[$i]; ?>
	          		<div><font color="D0D0D0"><?php echo strtok($log->created_at, " "); ?>, <?php echo $log->user->nickname; ?>, <?php echo $log->status->detail; ?></font></div>
	          	<?php } ?>
	          </td>
	          <td><?php echo $surat->keterangan; ?></td>
	          <td>
              <?php if ($surat->final == 0) { ?>
	          	<div>
	          		<a href="/surat/finalize?no=<?php echo $surat->no; ?>" class="btn btn-default btn-xs btn-success">Finalisasi</a>
	          	</div>
	          	<div>
	          		<a href="/surat/update?no=<?php echo $surat->no; ?>" class="btn btn-default btn-xs">Update</a>
	          	</div>
              <?php } ?>
	          </td>
	        </tr>
      	<?php } ?>
      </tbody>
    </table>
    </div>
	</div>
</body>
</html>
