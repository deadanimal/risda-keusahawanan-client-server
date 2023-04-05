<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <div class="loader">
  </div>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  --}}
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
    <title>RISDA | Keusahawanan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="../../../js/config.js"></script>
    <script src="../../../assets/overlayscrollbars/OverlayScrollbars.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="../../../assets/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="../../../css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="../../../css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="../../../css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="../../../css/user.min.css" rel="stylesheet" id="user-style-default">
    <link href="../../../css/jquery.dataTables.min.css" rel="stylesheet" id="user-style-default">
    <link href="../../../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    
    <script src="../../../assets/popper/popper.min.js"></script>
    <script src="../../../assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="../../../assets/anchorjs/anchor.min.js"></script>
    <script src="../../../assets/is/is.min.js"></script>
    <script src="../../../assets/fontawesome/all.min.js"></script>
    <script src="../../../assets/lodash/lodash.min.js"></script>
    <script src="../../../assets/list.js/list.min.js"></script>
    <script src="../../../js/theme.js"></script>
    <script src="../../../js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="../../../js/jquery.dataTables.min.js"type="text/javascript"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="../../../js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- <script src="../../../js/datatables.js"type="text/javascript"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

</head>
<script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
<body>
<main class="main" id="top">
  <?php 
  // ini_set('memory_limit', '-1');
  ?>
      <div class="container" data-layout="container" style="padding-left:40px;max-width:100%;">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">

              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

            </div><a class="navbar-brand" href="/landing">
              <div class="d-flex align-items-center py-3"><img class="me-2" src="../../../assets/img/risda.png" alt="" width="40" /><span class="font-sans-serif" style="color:#00A651">RISDA</span>
              </div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              
              <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav" style="padding-top: 15px;padding-bottom: 15px;">
                @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 7)
                <li class="nav-item">
                  <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('temulawatan.*') || request()->routeIs('dash.*') ? 'true' : 'false' }}" aria-controls="dashboard">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                    </div>
                  </a>
                  <ul class="nav collapse {{ request()->routeIs('temulawatan.*') || request()->routeIs('dash.*') ? 'show' : 'collapse' }}" id="dashboard">
                    @if (Auth::user()->role == 7)
                    <li class="nav-item"><a class="nav-link {{  request()->routeIs('temulawatan.*') ? 'active' : '' }}" href="/temulawatan">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Temujanji Lawatan</span>
                        </div>
                      </a>
                    </li>
                    @endif
                    @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 7)
                    <li class="nav-item"><a class="nav-link {{  request()->routeIs('dash.*') ? 'active' : '' }}" href="/dash">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Statistik</span>
                        </div>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
                @endif
                @if (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 7)
                <li class="nav-item">
                  <!-- label-->
                  <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Pengurusan Pengguna
                    </div>
                    <div class="col ps-0">
                      <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                  </div>
                  @if (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4)
                    <a class="nav-link {{  request()->routeIs('pegawaiWeb.*') ? 'active' : '' }}" href="/pegawaiWeb" role="button">
                      <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-flag"></span></span><span class="nav-link-text ps-1">Tetapan Pegawai</span>
                      </div>
                    </a>
                  @endif
                  @if (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 7)
                    <a class="nav-link {{  request()->routeIs('usahawanWeb.*') ? 'active' : '' }}" href="/usahawanWeb" role="button">
                      <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-flag"></span></span><span class="nav-link-text ps-1">Tetapan Usahawan</span>
                      </div>
                    </a>
                  @endif
                  @if (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 6)
                    <a class="nav-link {{  request()->routeIs('insentifWeb.*') || request()->routeIs('insentifdetail.*') ? 'active' : '' }}" href="/insentifWeb" role="button">
                      <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-globe"></span></span><span class="nav-link-text ps-1">Tambah Insentif</span>
                      </div>
                    </a>
                  @endif
                  @if (Auth::user()->role == 1)
                    <a class="nav-link dropdown-indicator" href="#komponen" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('kategorialiran.*') || request()->routeIs('tindakanlawatan.*') || request()->routeIs('jenisinsentif.*')
                    || request()->routeIs('kategoriusahawan.*') ? 'true' : 'false' }}" aria-controls="komponen">
                      <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Tetapan Komponen</span>
                      </div>
                    </a>
                    <ul class="nav collapse {{ request()->routeIs('kategorialiran.*') || request()->routeIs('tindakanlawatan.*') || request()->routeIs('jenisinsentif.*')
                      || request()->routeIs('kategoriusahawan.*') ? 'show' : 'collapse' }}" id="komponen">
                        {{-- show --}}
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('kategorialiran.*') ? 'active' : '' }}" href="/kategorialiran">
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Kategori Aliran</span>
                          </div></a>
                        </li>
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('tindakanlawatan.*') ? 'active' : '' }}" href="/tindakanlawatan">
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Tindakan Lawatan</span>
                          </div></a>
                        </li>
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('jenisinsentif.*') ? 'active' : '' }}" href="/jenisinsentif">
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jenis Insentif</span>
                          </div></a>
                        </li>
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('kategoriusahawan.*') ? 'active' : '' }}" href="/kategoriusahawan">
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Kategori Usahawan</span>
                          </div></a>
                        </li>
                      </ul>
                      <a class="nav-link {{  request()->routeIs('audittrail.*') ? 'active' : '' }}" href="/audittrail" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-globe"></span></span><span class="nav-link-text ps-1">Audit Trail</span>
                        </div>
                      </a>
                  @endif 
                  
                </li>
                @endif
                <li class="nav-item">
                  <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Pelaporan
                    </div>
                    <div class="col ps-0">
                      <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                  </div>
                    <li class="nav-item"><a class="nav-link {{  request()->routeIs('laporanprofil.*') || request()->routeIs('profdetail.*') ? 'active' : '' }}" href="/laporanprofil">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Database Usahawan</span>
                        </div>
                      </a>
                    </li>
                    <a class="nav-link dropdown-indicator" href="#pendapatanbulanan" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('pendapatanbulanan.*') || request()->routeIs('pendbulDaerah.*') || request()->routeIs('pendbulDun.*') ? 'true' : 'false' }}" aria-controls="komponen">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Laporan Jualan</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ request()->routeIs('pendapatanbulanan.*') || request()->routeIs('pendbulDaerah.*') || request()->routeIs('pendbulDun.*') ? 'show' : 'collapse' }}" id="pendapatanbulanan">
                      @if (Auth::user()->role != 4 && Auth::user()->role != 6 && Auth::user()->role != 7)
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('pendapatanbulanan.*') ? 'active' : '' }}" onclick="generatereport(1,this.href,'');return false;" href="/pendapatanbulanan">
                          {{-- href="/pendapatanbulanan" --}}
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mengikut Negeri</span>
                          </div></a>
                        </li>
                      @endif
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('pendbulDaerah.*') ? 'active' : '' }}" href="/pendbulDaerah" onclick="generatereport(2,this.href,'');return false;">
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mengikut Daerah</span>
                          </div></a>
                        </li>
                        <li class="nav-item"><a class="nav-link {{  request()->routeIs('pendbulDun.*') ? 'active' : '' }}" onclick="generatereport(3,this.href,'');return false;" href="/pendbulDun">
                          {{-- href="/pendbulDun" --}}
                          <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mengikut Parlimen/DUN</span>
                          </div></a>
                        </li>
                    </ul>
                    <a class="nav-link dropdown-indicator" href="#laporaninsentif" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('laporaninsentif.*') || request()->routeIs('insenjenis.*') || request()->routeIs('insenjantinaumur.*') ? 'true' : 'false' }}" aria-controls="komponen">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Analisa Insentif</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ request()->routeIs('laporaninsentif.*') || request()->routeIs('insenjenis.*') || request()->routeIs('insenjantinaumur.*') ? 'show' : 'collapse' }}" id="laporaninsentif">
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('laporaninsentif.*') ? 'active' : '' }}" href="/laporaninsentif" onclick="generatereport(4,this.href,'');return false;">
                        {{-- href="/laporaninsentif" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jenis Peniagaan</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('insenjenis.*') ? 'active' : '' }}" href="/insenjenis" onclick="generatereport(5,this.href,'');return false;">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jumlah/ Purata Jualan</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('insenjantinaumur.*') ? 'active' : '' }}" onclick="generatereport(6,this.href,'');return false;" href="/insenjantinaumur">
                        {{-- href="/insenjantinaumur" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jantina & Umur</span>
                        </div></a>
                      </li>
                    </ul>
                    <a class="nav-link dropdown-indicator" href="#laporanlawatan" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('pemantauanlawatan.*') || request()->routeIs('pantauDaerah.*') || request()->routeIs('pantaustafnegeri.*') || request()->routeIs('pantauindividu.*') ? 'true' : 'false' }}" aria-controls="komponen">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Pemantauan Lawatan</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ request()->routeIs('pemantauanlawatan.*') || request()->routeIs('pantauDaerah.*') || request()->routeIs('pantaustafnegeri.*') || request()->routeIs('pantauindividu.*') || request()->routeIs('pantauindividudetail.*') ? 'show' : 'collapse' }}" id="laporanlawatan">
                      @if (Auth::user()->role != 4 && Auth::user()->role != 6 && Auth::user()->role != 7)
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('pemantauanlawatan.*') ? 'active' : '' }}" href="/pemantauanlawatan" onclick="generatereport(7,this.href,'');return false;">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mengikut Negeri</span>
                        </div></a>
                      </li>
                      @endif
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('pantauDaerah.*') ? 'active' : '' }}" onclick="generatereport(8,this.href,'');return false;" href="/pantauDaerah">
                        {{-- href="/pantauDaerah" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mengikut Daerah</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('pantaustafnegeri.*') ? 'active' : '' }}" onclick="generatereport(9,this.href,'');return false;" href="/pantaustafnegeri">
                        {{-- href="/pantaustafnegeri" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Staf Mengikut Negeri</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('pantauindividu.*') || request()->routeIs('pantauindividudetail.*') ? 'active' : '' }}" href="/pantauindividu">
                        <!-- {{-- onclick="generatereport(10,this.href);return false;" --}} -->
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pemantauan Individu</span>
                        </div></a>
                      </li>
                    </ul>
                    <a class="nav-link dropdown-indicator" href="#laporanalirantunai" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('laporanalirantunai.*') || request()->routeIs('laporanalirantunaiDetail.*') || request()->routeIs('laporanlejar.*') || request()->routeIs('laporanlejarDetail.*') || request()->routeIs('penyatauntungrugi.*') || request()->routeIs('penyatauntungrugiDetail.*') ? 'true' : 'false' }}" aria-controls="komponen">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Aliran Tunai</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ request()->routeIs('laporanalirantunai.*') || request()->routeIs('laporanalirantunaiDetail.*') || request()->routeIs('laporanlejar.*') || request()->routeIs('laporanlejarDetail.*') || request()->routeIs('penyatauntungrugi.*') || request()->routeIs('penyatauntungrugiDetail.*') ? 'show' : 'collapse' }}" id="laporanalirantunai">
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('laporanalirantunai.*') || request()->routeIs('laporanalirantunaiDetail.*') ? 'active' : '' }}" href="/laporanalirantunai">
                        {{-- onclick="generatereport(11,this.href);return false;" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Buku Tunai</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('laporanlejar.*') || request()->routeIs('laporanlejarDetail.*') ? 'active' : '' }}" href="/laporanlejar">
                        {{-- onclick="generatereport(12,this.href);return false;" --}}
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Laporan Lejar</span>
                        </div></a>
                      </li>
                      <li class="nav-item"><a class="nav-link {{  request()->routeIs('penyatauntungrugi.*') || request()->routeIs('penyatauntungrugiDetail.*') ? 'active' : '' }}" onclick="generatereport(13,this.href,'');return false;" href="/penyatauntungrugi">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Penyata Untung Rugi</span>
                        </div></a>
                      </li>
                    </ul>
                </li>
                
              </ul>
              
            </div>
          </div>
        </nav>
        <div class="content">
          <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="padding-right:150px;">

            <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="/landing">
              <div class="d-flex align-items-center"><img class="me-2" src="../../../assets/img/risda.png" alt="" width="40" /><span class="font-sans-serif">RISDA</span>
              </div>
            </a>
            <ul class="navbar-nav align-items-center d-none d-lg-block">
              <li class="nav-item">
                {{-- top part --}}
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
              <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                  <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark" />
                  <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label>
                  <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
                </div>
              </li>
              
              {{-- <li class="nav-item dropdown">
                <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification" aria-labelledby="navbarDropdownNotification">
                  <div class="card card-notification shadow-none">
                    <div class="card-header">
                      <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                          <h6 class="card-header-title mb-0">Notifications</h6>
                        </div>
                        <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                      </div>
                    </div>
                    <div class="scrollbar-overlay" style="max-height:19rem">
                      <div class="list-group list-group-flush fw-normal fs--1">
                        <div class="list-group-title border-bottom">NEW</div>
                        <div class="list-group-item">
                          <a class="notification notification-flush notification-unread" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="#" alt="" />

                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                              <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>

                            </div>
                          </a>

                        </div>
                        <div class="list-group-item">
                          <a class="notification notification-flush notification-unread" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-2xl me-3">
                                <div class="avatar-name rounded-circle"><span>AB</span></div>
                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                              <span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>

                            </div>
                          </a>

                        </div>
                        <div class="list-group-title border-bottom">EARLIER</div>
                        <div class="list-group-item">
                          <a class="notification notification-flush" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="#" alt="" />

                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
                              <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>

                            </div>
                          </a>

                        </div>
                        <div class="list-group-item">
                          <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="#" alt="" />

                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
                              <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>

                            </div>
                          </a>

                        </div>
                        <div class="list-group-item">
                          <a class="border-bottom-0 notification notification-flush" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="#" alt="" />

                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
                              <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>

                            </div>
                          </a>

                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-center border-top"><a class="card-link d-block" href="../app/social/notifications.html">View all</a></div>
                  </div>
                </div>

              </li> --}}
              <li style="padding-top:10px;" class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="../../../assets/img/gear.png" alt="" style="height:80%;width:80%;"/>

                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white dark__bg-1000 rounded-2 py-2" style="width: 250px !important;">

                    <div style="Font-family:Poppins;font-size:13px;padding-left:16px;color:#344050;padding-bottom:10px;">
                      <div style="padding-bottom:5px !important;">Hello, <br>{{Auth::user()->name}}<br></div>
                      @if(isset(Auth::user()->peranan->kod_peranan))Peranan : {{Auth::user()->peranan->kod_peranan}} @endif
                    </div>
                    {{-- <a class="dropdown-item" href="#!">Set status</a>
                    <a class="dropdown-item" href="../pages/user/profile.html">Profile &amp; account</a>
                    <a class="dropdown-item" href="#!">Feedback</a> --}}

                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="/ChangePass">Kemaskini Kata Laluan</a> 
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Log Keluar</a>
                    <form id="frm-logout" action="../../logout" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    
                  </div>
                </div>
              </li>
            </ul>
          </nav>
          
          @yield('content')
        </div>
        
      </div>
    </main>
</body>
</html>
<script type="text/javascript">
  $( document ).ready(function() {
    var role = '<?php echo Auth::user()->name; ?>';
    var test = '<?php echo Auth::user(); ?>';

    console.log(test);
    if(role == ""){
      alert("Session Expired Kindly Login");
      window.location.href = "/";
    }
  });

  function generatereport(type,nextPage,userid){
    $('.loader').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "../generatereport",
        type:"POST",
        data:{
          type:type,
          id:userid
        },
        success: function(data) {
          console.log(data);
          $('.loader').hide();
          alert(data);
          $(location).prop('href', nextPage)
          return true;
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $('.loader').hide();
          alert(xhr.status);
          alert(thrownError);
          $(location).prop('href', '/login')
        }
    });
  }

</script>
@yield('script')
