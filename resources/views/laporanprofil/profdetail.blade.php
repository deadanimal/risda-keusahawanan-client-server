@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
      <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/laporanprofil"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div style="padding-bottom: 20px;float:right;">
            <a class="btn btn-primary" onclick="ExportPDF()"><span >Cetak PDF</span></a>
        </div>
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;padding-top:3vh;">Laporan Profil Usahawan</h3>
        </div>
        <style>
            .col-lg-5{
                display: inline-block;padding-top: 20px;
            }
            .col-lg-12{
                padding-top: 20px;
            }
        </style>
        <table id="usahawan" style="width: 100%;">
        <colgroup>
            <col span="1" style="width: 17%;">
            <col span="1" style="width: 28%;">
            <col span="1" style="width: 17%;">
            <col span="1" style="width: 28%;">
        </colgroup>
            <tr>
                <td><label class="form-label">Negeri</label></td>
                <td><label class="form-label">: {{$user->negeri}}</label></td>
                <td><label class="form-label">Pusat Tanggungjawab</label></td>
                <td><label class="form-label">: {{$user->PusatTang}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Nama Pemohon</label></td>
                <td><label class="form-label">: {{$user->namausahawan}}</label></td>
                <td><label class="form-label">No Kad Pengenalan</label></td>
                <td><label class="form-label">: {{$user->nokadpengenalan}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Umur</label></td>
                <td><label class="form-label">: {{$user->umur}}</label></td>
                <td><label class="form-label">Jantina</label></td>
                <td><label class="form-label">: {{$user->jantina}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Taraf Pendidikan</label></td>
                <td><label class="form-label">: {{$user->taraf_pendidikan}}</label></td>
                <td><label class="form-label">Taraf Pendidikan Tertinggi</label></td>
                <td><label class="form-label">: {{$user->taraf_pendidikan_tinggi}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">No.Telefon</label></td>
                <td><label class="form-label">: {{$user->notelefon}}</label></td>
                <td><label class="form-label">No.HP</label></td>
                <td><label class="form-label">: {{$user->nohp}}</label></td>
            </tr>
            <tr>
                <td rowspan="3"><label class="form-label">Alamat</label></td>
                <td rowspan="3"><label class="form-label">: @if($user->alamat1 != ""){{$user->alamat1}}, <br>&nbsp;@endif @if($user->alamat2 != ""){{$user->alamat2}}, <br>&nbsp;@endif {{$user->alamat3}}</label></td>
                <td><label class="form-label">Poskod</label></td>
                <td><label class="form-label">: {{$user->poskod}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Daerah</label></td>
                <td><label class="form-label">: {{$user->daerah}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Negeri</label></td>
                <td><label class="form-label">: {{$user->negeri}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">DUN</label></td>
                <td><label class="form-label">: {{$user->dun}}</label></td>
                <td><label class="form-label">Parlimen</label></td>
                <td><label class="form-label">: {{$user->parlimen}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">No SIC/ No T/S Pekebun Kecil</label></td>
                <td><label class="form-label">: {{$user->PKnoTS}}</label></td>
                <td><label class="form-label">No K/P (Pekebun Kecil)</label></td>
                <td><label class="form-label">: {{$user->PKnoKP}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Kategori Pemohon</label></td>
                <td><label class="form-label">: {{$user->status_daftar_usahawan}}</label></td>
                <td><label class="form-label">Jenis Perniagaan</label></td>
                <td><label class="form-label">: {{$user->JenisPerniagaan}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Kluster Projek</label></td>
                <td><label class="form-label">: {{$user->KlusterPerniagaan}}</label></td>
                <td><label class="form-label">Sub Kluster (Produk / Perkhidmatan)</label></td>
                <td><label class="form-label">: {{$user->SubKlusterPerniagaan}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Medium Pemasaran (Media Sosial)</label></td>
                <td><label class="form-label">:<?php echo $user->MediumPemasaran; ?></label></td>
                <td><label class="form-label">Alamat Medium Pemasaran (Media Sosial)</label></td>
                <td> <label class="form-label">:<?php echo $user->AlamatMediumPemasaran; ?></label></td>
            </tr>
            <tr>
                <td><label class="form-label">Jenis Bantuan (Program Tahun Semasa)</label></td>
                <td><label class="form-label">: {{$user->jnsbantuansemasa}}</label></td>
                <td><label class="form-label">Kelulusan Bantuan Tahun Semasa (RM)</label></td>
                <td><label class="form-label">: {{$user->kelulusanbantuansemasa}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Tahun Terima Bantuan Tahun Semasa</label></td>
                <td><label class="form-label">: {{$user->thnbantuansemasa}}</label></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top: 2vh; text-align:center;"><label class="form-label">JUMLAH JUALAN BULANAN  (RM)  - TAHUN <?php echo date("Y"); ?></label></td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width: 100%;">
                    <tr>
                        <td>Jan</td>
                        <td>Feb</td>
                        <td>Mac</td>
                        <td>Apr</td>
                        <td>Mei</td>
                        <td>Jun</td>
                        <td>Jul</td>
                        <td>Aug</td>
                        <td>Sep</td>
                        <td>Okt</td>
                        <td>Nov</td>
                        <td>Dis<br></td>
                    </tr>
                    <tr>
                        <td>{{$user->aliran1}}</td>
                        <td>{{$user->aliran2}}</td>
                        <td>{{$user->aliran3}}</td>
                        <td>{{$user->aliran4}}</td>
                        <td>{{$user->aliran5}}</td>
                        <td>{{$user->aliran6}}</td>
                        <td>{{$user->aliran7}}</td>
                        <td>{{$user->aliran8}}</td>
                        <td>{{$user->aliran9}}</td>
                        <td>{{$user->aliran10}}</td>
                        <td>{{$user->aliran11}}</td>
                        <td>{{$user->aliran12}}<br></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">Jumlah Jualan (RM)</label></td>
                <td><label class="form-label">: {{$user->jumaliran}}</label></td>
                <td><label class="form-label">Purata Jualan Bulanan (RM)</label></td>
                <td><label class="form-label">: {{$user->purataaliran}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Pencapaian Sasaran RM 2500/BLN</label></td>
                <td><label class="form-label">: {{$user->capaisasaran}}</label></td>
                <td><label class="form-label">Kategori Usahawan</label></td>
                <td><label class="form-label">: {{$user->KateUsahawan}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">Nama Syarikat</label></td>
                <td><label class="form-label">: {{$user->namasyarikat}}</label></td>
                <td><label class="form-label">Jenis Milikan Syarikat</label></td>
                <td><label class="form-label">: {{$user->jenismilikan}}</label></td>
            </tr>
            <tr>
                <td><label class="form-label">No. Daftar Syarikat (SSM)</label></td>
                <td><label class="form-label">: {{$user->nodaftarssm}}</label></td>
                <td><label class="form-label">Alamat Syarikat/Perniagaan</label></td>
                <td><label class="form-label">: {{$user->alamatsyarikat}}</label></td>
            </tr>
            <tr>
                <td colspan="4">
                    <label class="form-label" style="padding-right: 5vh;">Koordinat Premis Perniagaan - </label>
                    <label class="form-label">Latitud</label> : <label class="form-label" style="padding-right: 2vh;">{{$user->latitud}}</label>
                    <label class="form-label">Longitud</label> : <label class="form-label">{{$user->logitud}}</label>                
                </td>
            </tr>
            <tr>
                <td><label class="form-label">E-Mail</label></td>
                <td><label class="form-label">: {{$user->emailsyarikat}}</label></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><label class="form-label">Lain - Lain Bantuan RISDA Tahun Sebelum</label></td>
            </tr>
            <tr>
                <td colspan="4" style="padding:2vh 0vh">
                    <table style="width: 100%;" class="form-label">
                        <tr>
                            <th>Jenis Bantuan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>
                            <th>Kelulusan Bantuan (RM) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </th>
                            <th>Tahun Terima <br></th>
                        </tr>
                        @if ($insentif2 != '')
                        @foreach ($insentif2 as $insentif2s)
                        <tr>
                            <td>{{$insentif2s->namainsen}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                            <td>{{number_format($insentif2s->nilai_insentif)}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
                            <td>{{$insentif2s->tahun_terima_insentif}}<br></td>   
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </td>
            </tr>
            <tr>
                <td><label class="form-label">No Sijil HALAL JAKIM</label></td>
                <td><label class="form-label">: {{$user->nodaftarpersijilanhalal}}</label></td>
            </tr>
        </table>
        
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    
    $('.loader').hide();
})

function ExportPDF(){
    // var doc = new jsPDF("p", "mm", "a4")
    // doc.text(15, 10, "LAPORAN PROFIL USAHAWAN");
    // doc.autoTable({ 
    //     html: '#usahawan' 
    // })
    // doc.save('LaporanProfilUsahawan.pdf')

    var quotes = document.getElementById('usahawan');
        //! MAKE YOUR PDF
        var pdf = new jsPDF('p', 'pt', 'a4');
        html2canvas(quotes, {
            onrendered: function (canvas) {
                for (var i = 0; i <= quotes.clientHeight / 1100; i++) {
                    //! This is all just html2canvas stuff
                    var srcImg = canvas;
                    var sX = 0;
                    var sY = 1100 * i; // start 1100 pixels down for every new page
                    var sWidth = 1210;
                    var sHeight = 1100;
                    var dX = 0;
                    var dY = 0;
                    var dWidth = 1210;
                    var dHeight = 1100;

                    window.onePageCanvas = document.createElement("canvas");
                    onePageCanvas.setAttribute('width', 1210);
                    onePageCanvas.setAttribute('height', 1100);
                    var ctx = onePageCanvas.getContext('2d');
                    // details on this usage of this function: 
                    // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Using_images#Slicing
                    ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                    // document.body.appendChild(canvas);
                    var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);

                    var width = onePageCanvas.width;
                    var height = onePageCanvas.clientHeight;

                    //! If we're on anything other than the first page,
                    // add another page
                    if (i > 0) {
                        pdf.addPage(612, 791); //8.5" x 11" in pts (in*72)
                    }
                    //! now we declare that we're working on that page
                    pdf.setPage(i + 1);
                    //! now we add content to that page!
                    pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .45), (height * .75));

                }

                pdf.save('LaporanProfilUsahawan.pdf');
            }
        })

}

</script>
@endsection