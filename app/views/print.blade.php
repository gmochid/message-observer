<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Kontrol Surat</title>
  <script type="text/javascript" src="<?php echo asset('lib/js/jquery/dist/jquery.min.js'); ?>"></script>

  <link href="<?php echo asset('lib/js/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
  <script type="text/javascript" src="<?php echo asset('lib/js/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

  <style type="text/css">
    table.fixed { table-layout:fixed; }
    table.fixed td { overflow: hidden; }

    .table-responsive {
      overflow-x: visible !important;
      overflow-y: visible !important;
    }


  </style>
</head>
<body>
  <div class="table-responsive">
    <table class="table table-striped">
      @foreach ($allSurat as $index=>$surat)
        <tr>
          <td>
            <div class="row">

              <div class="col-md-6">
                <div>
                  <span class="text-primary">{{ $surat->tanggal->format('d F Y') }}</span>
                  @if ($surat->final == 0)
                    <span class="label label-primary">Proses</span>
                  @else
                    <span class="label label-success">Selesai</span>
                  @endif
                </div>
                <div>
                  <span class="text-muted">Nomor Surat : {{ $surat->no }}</span>
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
                  <div style="color: #D0D0D0"><b>{{ strtok($log->created_at, " ") }}, {{ $log->user->nickname }}, {{ $log->status->detail }}</b></div>
                  <?php } ?>
                @endif
              </div>

            </div>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</body>
</html>
