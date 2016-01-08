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
    login {text-align: right; }
  </style>
</head>
<body>
  <div class="container">
    <div class="page-header">
      <h1>Aplikasi Kontrol Surat <small>Live Update</small></h1>
      @if (Auth::check())
      <a href="/dashboard">Dashboard</a><br/>
      @endif
      @if (Auth::guest())
      <div class="login">
        <a href="/login">Login</a>
      </div>
      @endif
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form method="get" action="/">
          <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                <div class="col-md-3">
                  <input class="form-control" type="text" name="query" value="{{ Input::get('query') }}" />
                </div>

                <div class="col-md-3">
                  <select class="form-control" name="status">
                    <option value="">Semua</option>
                    <option value="DONE" {{ Input::get('status') == "DONE" ? "selected" : "" }}>Sudah Final</option>
                    <option value="NOTDONE" {{ Input::get('status') == "NOTDONE" ? "selected" : "" }}>Belum Final</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <button type="submit" class="btn btn-primary form-control">Cari</button>
                </div>

                @if (Input::get('query') != '' || Input::get('status') != '')
                <div class="col-md-3">
                  <a href="/" class="btn btn-danger form-control">Hapus Pencarian</a>
                </div>
                @endif

              </div>

            </div>
          </div>

        </form>
      </div>
    </div>

    <div class="text-center">
      <?php echo $allSurat->appends(Input::except('page'))->links(); ?>
    </div>

    <div class="table-responsive">
    <table class="table table-striped">
      @foreach ($allSurat as $index=>$surat)
      <tr>
        <td>
          <div class="row">

            <div class="col-md-8">
              <div>
                <span class="text-primary">{{ $surat->tanggal->format('d F Y') }}</span>
                @if ($surat->final == 0)
                <span class="label label-primary">Proses</span>
                @else
                <span class="label label-success">Selesai</span>
                @endif
              </div>
              <div>
                <span class="text-muted">{{ $surat->no }}</span>
              </div>
              <div style="font-size: 16px; font-family: Georgia; font-weight: bold">
                {{ $surat->perihal }}
              </div>
              <div style="font-family: 'Palatino Linotype'">
                Asal Surat : {{ $surat->asal }}
              </div>
            </div>

            <div class="col-md-4">
              @if (sizeof($surat->logs) > 0)
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
              @endif
            </div>

          </div>
        </td>
      </tr>
      @endforeach
    </table>
    </div>

  </div>
</body>

<script type="text/javascript">
  $(document).ready(function() {
    setInterval("location.reload(true)", 300000);
  });
</script>

</html>
