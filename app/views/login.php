<!doctype html>
<html>
<head>
	<title>Aplikasi Kontrol Surat</title>
	<script type="text/javascript" src="<?php echo asset('lib/js/jquery-1.10.2.min.js'); ?>"></script>

	<link href="<?php echo asset('lib/css/bootstrap.min.css')?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo asset('lib/js/bootstrap.min.js') ?>"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">

	      <form id="login-form" role="form" class="form-horizontal" method="post"
	        action="<?php echo url('/login'); ?>">

	        <div class="text-center">
	          <h2>Aplikasi Kontrol Surat</h2>
	          <!-- <a href="/">Home (Live Update)</a> -->
	          <br/>
	          <br/>
	        </div>

	        <div class="form-group">
	          <label for="username" class="col-md-5 control-label">Username</label>
	          <div class="col-md-5">
	            <input type="text" placeholder="Username" class="form-control" name="username">
	          </div>
	        </div>

	        <div class="form-group">
	          <label for="username" class="col-md-5 control-label">Password</label>
	          <div class="col-md-5">
	            <input type="password" placeholder="Password" class="form-control" name="password">
	          </div>
	        </div>

	        <div class="form-group">
	          <div class="col-md-offset-5 col-md-5">
	            <button class="btn btn-primary" type="submit">Masuk</button>
	          </div>
	        </div>
	      </form>

		  </div>
		</div>
	</div>
</body>
</html>
