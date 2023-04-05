@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">LAPORAN PENYATA UNTUNG RUGI
                BAGI TAHUN
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('year',this.value)" id="iptYear">
                  {{-- <option value="">Tahun</option> --}}
                  <?php
                  $curryear = date("Y");
                  $fromyear = date("Y") - 10;
                  for ($year = $curryear; $year >= $fromyear; $year--) {
                      $selected = (isset($getYear) && $getYear == $year) ? 'selected' : '';
                      echo "<option value=$year $selected>$year</option>";
                  }
                  ?>
                </select>
            </h3>
            <div style="overflow-x: auto !important;overflow-y: auto !important;">
                <table id="pnlbulk" class="table table-style table-sm table-bordered table-hover">
                    <style>
                        table.table-style td { 
                            line-height: 1.45rem;
                            font-size: .8333333333rem;
                            font-weight: 500;
                            letter-spacing: .02em;
                            margin-bottom: 0.5rem;
                         }
                    </style>
                    <colgroup>
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 25%;">
                        <col span="1" style="width: 25%;">
                    </colgroup>
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">PERKARA/BULAN</th>
                            <th scope="col">JANUARI</th>
                            <th scope="col">FEBRUARI</th>
                            <th scope="col">MAC</th>
                            <th scope="col">APRIL</th>
                            <th scope="col">MEI</th>
                            <th scope="col">JUN</th>
                            <th scope="col">JULAI</th>
                            <th scope="col">OGOS</th>
                            <th scope="col">SEPTEMBER</th>
                            <th scope="col">OKTOBER</th>
                            <th scope="col">NOVEMBER</th>
                            <th scope="col">DISEMBER</th>
                            <th scope="col">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <tr class="align-middle">
                            <td class="text-nowrap">HASIL JUALAN</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Hasil->jumlah,2)}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="text-nowrap">KOS JUALAN</td>
                            <td class="text-nowrap">{{number_format($Kos->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kos->jumlah,2)}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="text-nowrap">UNTUNG/RUGI KASAR</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Kasar->jumlah,2)}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="text-nowrap">PERBELANJAAN PENTADBIRAN & OPERASI</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Perbelanjaan->jumlah,2)}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="text-nowrap">HASIL-HASIL LAIN</td>
                            <td class="text-nowrap">{{number_format($Lain->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Lain->jumlah,2)}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="text-nowrap">UNTUNG/RUGI BERSIH</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul1,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul2,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul3,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul4,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul5,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul6,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul7,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul8,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul9,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul10,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul11,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->bul12,2)}}</td>
                            <td class="text-nowrap">{{number_format($Bersih->jumlah,2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="overflow-x: auto !important;overflow-y: auto !important;padding-top: 5vh;">
                <table id="pnlind" class="table-style">
                    <style>
                        table.table-style td { 
                            line-height: 1.45rem;
                            font-size: .8333333333rem;
                            font-weight: 500;
                            letter-spacing: .02em;
                            margin-bottom: 0.5rem;
                         }
                    </style>
                    <colgroup>
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 25%;">
                        <col span="1" style="width: 25%;">
                    </colgroup>
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">Nama</th>
                            <th scope="col">Negeri</th>
                            <th scope="col">Pusat Tanggungjawab</th>
                            <th scope="col">Penyata Untung Rugi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="align-middle">
                            <td class="text-nowrap textlbl">{{$user->namausahawan}}</td>
                            @if(isset($user->negeri))
                                <td class="text-nowrap textlbl">{{$user->negeri->Negeri}}</td>
                            @else 
                                <td class="text-nowrap textlbl"></td>
                            @endif
                            @if(isset($user->PT))
                                <td class="text-nowrap textlbl">{{$user->PT->keterangan}}</td>
                            @else 
                                <td class="text-nowrap textlbl"></td>
                            @endif
                            <td class="text-nowrap" style="text-align: center;">
                                <button class="btn btn-primary btn-sm me-1 mb-1" type="button" onclick="generatereport(14,'/penyatauntungrugiDetail',{{$user->id}});return false;">
                                Penyata Untung Rugi
                            </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
        var today = new Date();
        var year = today.getFullYear();
        var table = $('#pnlbulk').DataTable({
            "paging":   false,
            "searching": false,
            "sorting":false,
            dom: 'Blfrtip',
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:       '<span  >Copy</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Copy',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span   >Excel</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Excel',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                },
                {
                    extend:    'csvHtml5',
                    text:      '<span >CSV</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'CSV',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<span >PDF</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'PDF',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year,
                    orientation:'landscape',
                    customize: function(doc) {
                        doc.styles.tableHeader.fillColor = '#00A651',
                        doc.defaultStyle.fontSize = 9;
                    }
                },
                // {
                //     extend:    'print',
                //     text:      '<span class="bi bi-printer">Print</span>',
                //     className: 'btn btn-primary btn-xs',
                //     titleAttr: 'PDF',
                //     title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                // }
            ],
            "language": {
                "lengthMenu": "_MENU_ rekod setiap paparan",
                "zeroRecords": "Maaf - Tiada data dijumpai",
                "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
                "infoEmpty": "Tiada rekod dijumpai",
                "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
                "sSearch": "Saringan :",
                "paginate": {
                    "previous": "Sebelum",
                    "next": "Seterusnya"
                }
            }
        });
        var table = $('#pnlind').DataTable({
            "paging":   true,
            "bFilter": true,
            "language": {
                "lengthMenu": "_MENU_ rekod setiap paparan",
                "zeroRecords": "Maaf - Tiada data dijumpai",
                "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
                "infoEmpty": "Tiada rekod dijumpai",
                "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
                "sSearch": "Saringan :",
                "paginate": {
                    "previous": "Sebelum",
                    "next": "Seterusnya"
                }
            }
        });
        
        
        $('.loader').hide();
    });

    function gettabledata(type,val){
        $('.loader').show();
        $('#pnlbulk').dataTable().fnClearTable();
        $('#pnlbulk').dataTable().fnDestroy();
        
        var year = document.getElementById("iptYear").value;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/penyatauntungrugi/apa",
            type:"GET",
            data: {     
                tahun:year
            },
            success: function(data) {
                console.log(data);
                $("#tblname").html(data);
                // $("#tblfoot").html(data[1]);
                if(data[0] != null){
                    $('#pnlbulk').DataTable( {
                        searching: false,
                        sorting:false,
                        paging:false,
                        dom: 'Blfrtip',
                        buttons: [
                            {
                                extend:    'copyHtml5',
                                text:       '<span  >Copy</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Copy',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<span   >Excel</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Excel',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<span >CSV</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'CSV',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<span >PDF</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'PDF',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year,
                                orientation:'landscape',
                                customize: function(doc) {
                                    doc.styles.tableHeader.fillColor = '#00A651',
                                    doc.defaultStyle.fontSize = 9;
                                }
                            },
                            // {
                            //     extend:    'print',
                            //     text:      '<span class="bi bi-printer">Print</span>',
                            //     className: 'btn btn-primary btn-xs',
                            //     titleAttr: 'PDF',
                            //     title: 'LAPORAN PENYATA UNTUNG RUGI BAGI TAHUN '+year
                            // }
                        ],
                        "language": {
                            "lengthMenu": "_MENU_ rekod setiap paparan",
                            "zeroRecords": "Maaf - Tiada data dijumpai",
                            "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
                            "infoEmpty": "Tiada rekod dijumpai",
                            "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
                            "sSearch": "Saringan :",
                            "paginate": {
                                "previous": "Sebelum",
                                "next": "Seterusnya"
                            }
                        }
                    });
                }
                $('.loader').hide();
            }
        });
    }
</script>
@endsection