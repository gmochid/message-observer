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

    .table-responsive {
      overflow-x: visible !important;
      overflow-y: visible !important;
    }


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

    <div class="row">
    <div class="col-md-2 panel panel-default">
      <div class="panel-body">
        <a class="btn btn-info" href="/surat/create">Input Surat Baru</a>
        <hr/>

        <div class="checkbox">
          <label><input type="radio" value="1" name="print-type"> Semua</label>
        </div>
        <div class="checkbox">
          <label><input type="radio" value="2" name="print-type"> Halaman Ini</label>
        </div>

        <a class="btn btn-info" href="">Tampilan Print</a>
        <hr/>

        <form method="get" action="/dashboard">
          <div>
            <div class="checkbox">
              <label><input type="checkbox" value="1" name="from">Dari Tanggal</label>
            </div>
          </div>
          <div>
            <div class="form-group">
              <select class="form-control" name="from-month">
                @for($i = 1; $i <= 12; $i++)
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
          <div>
            <div class="form-group">
              <select class="form-control" name="from-year">
                @for($i = 2015; $i <= \Carbon\Carbon::now()->year; $i++)
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
          <div>
            <div class="checkbox">
              <label><input type="checkbox" value="1" name="to">Sampai Tanggal</label>
            </div>
          </div>
          <div class="form-group">
            <select class="form-control" name="to-month">
              @for($i = 1; $i <= 12; $i++)
                <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
          <div>
            <div class="form-group">
              <select class="form-control" name="to-year">
                @for($i = 2015; $i <= \Carbon\Carbon::now()->year; $i++)
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>

          <div>
            <input class="form-control" type="text" name="query" value="{{ Input::get('query') }}" placeholder="Pencarian" />
          </div>

          <div>
            <select class="form-control" name="status">
              <option value="">Semua Status</option>
              <option value="DONE" {{ Input::get('status') == "DONE" ? "selected" : "" }}>Sudah Final</option>
              <option value="NOTDONE" {{ Input::get('status') == "NOTDONE" ? "selected" : "" }}>Belum Final</option>
            </select>
          </div>

          <div>
            <button type="submit" class="btn btn-primary form-control">Cari</button>
          </div>

          @if (Input::get('query') != '' || Input::get('status') != '')
              <a href="/dashboard" class="btn btn-danger form-control">Hapus Pencarian</a>
          @endif

        </form>
      </div>
    </div>

    <div class="col-md-10">
      <div class="text-center">
        <?php echo $allSurat->appends(Input::except('page'))->links(); ?>
      </div>

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
                      <div style="color: #D0D0D0"><b>{{ strtok($log->created_at, " ") }}, {{ $log->user->nickname }}, {{ $log->status->detail }}</b></div>
                      <?php } ?>
                    @endif
                  </div>

                  @if ($surat->final == 0)
                    <div class="col-md-1">
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toogle" id="actionDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Action
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                          <li><a href="/surat/edit?no={{ $surat->no }}">Edit</a></li>
                          <li><a href="/surat/update?no={{ $surat->no }}">Update Status</a></li>
                          <li class="divider"></li>
                          <li><a href="/surat/finalize?no={{ $surat->no }}">Finalisasi</a></li>
                        </ul>
                      </div>
                    </div>
                  @endif

                </div>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted text-center">Copyright arrosyidbh@gmail.com<br>MIT License</p>
      </div>
    </footer>

  </div>

</body>
</html>
