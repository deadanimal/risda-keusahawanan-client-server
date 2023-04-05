@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/penyatauntungrugi"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center" id="contentbody" style="padding-top:15px;">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">PENYATA UNTUNG RUGI BAGI BULAN
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:25vh" onchange="gettabledata('month',this.value)" id="iptBulan">
                    <option value="">Bulan</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                  <br>DAN TAHUN
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
            </h4>
            <div style="overflow-x: auto !important;overflow-y: auto !important;">
                <table id="pnldetail" class="table table-style table-sm table-bordered table-hover">
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
                        <col span="1" style="width:55%;">
                        <col span="1" style="width:15%;">
                        <col span="1" style="width:15%;">
                        <col span="1" style="width:15%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th></th>
                            <th>RM</th>
                            <th>RM</th>
                            <th>RM</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <tr class="align-middle" style="text-align: left;">
                            <td>HASIL JUALAN / PEROLEHAN (SALES)</td>
                            <td class="text-nowrap"></td> 
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>

                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Jualan/ Perolehan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum1,2)}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Deposit Jualan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum2,2)}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Pulangan Jualan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum3,2)}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Jualan Bersih</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum4,2)}}</td>
                        </tr>
                        <tr>
                            <td style="padding-top: 20px;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">KOS LANGSUNG / KOS JUALAN (COGS)</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Stok Awal</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum5,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Deposit Belian </td>
                            <td class="text-nowrap">{{number_format($val->jum6,2)}}</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Belian</td>
                            <td class="text-nowrap">{{number_format($val->jum7,2)}}</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Belian Bersih</td>
                            <td class="text-nowrap">{{number_format($val->jum8,2)}}</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Pulangan Belian</td>
                            <td class="text-nowrap">{{number_format($val->jum9,2)}}</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Kos Belian</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum10,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Kos Barang Sedia Dijual</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum11,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Stok Akhir</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum12,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Kos Jualan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum13,2)}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">UNTUNG / RUGI KASAR</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum14,2)}}</td>
                        </tr>
                        <tr>
                            <td style="padding-top: 20px;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">PERBELANJAAN PENTADBIRAN DAN OPERASI (OPEX)</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Kos Pengeposan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum15,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Kos Alat Tulis</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum16,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Bayaran Sewa</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum17,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Upah/ Gaji Pekerja</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum18,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Upah/ Gaji Sendiri</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum19,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">KWSP/ SOCSO</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum20,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Bayaran Bil (Utiliti)</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum21,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Petrol/ Tol/ Parking</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum22,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Penyelenggaraan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum23,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Belian Aset</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum24,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Bayaran Komisen</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum25,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Cukai/ Zakat</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum26,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Bayaran Lain</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum27,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">JUMLAH PERBELANJAAN PENTADBIRAN DAN OPERASI</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum28,2)}}</td>
                        </tr>
                        <tr>
                            <td style="padding-top: 20px;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">HASIL - HASIL LAIN</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Hasil Komisen</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum29,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Hasil Dividen</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum30,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Hasil Sewaan</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum31,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">Hasil Lain</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum32,2)}}</td>
                            <td class="text-nowrap"></td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">JUMLAH HASIL -HASIL LAIN</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum33,2)}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap">UNTUNG / RUGI BERSIH</td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap">{{number_format($val->jum34,2)}}</td>
                        </tr>
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
        $('#pnldetail').DataTable( {
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
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN DAN TAHUN '+year
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span   >Excel</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Excel',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN DAN TAHUN '+year
                },
                {
                    extend:    'csvHtml5',
                    text:      '<span >CSV</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'CSV',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN DAN TAHUN '+year
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<span >PDF</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'PDF',
                    title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN DAN TAHUN '+year,
                    customize: function(doc) {
                        doc.styles.tableHeader.fillColor = '#00A651',
                        doc.defaultStyle.alignment = 'center',
                        doc.content[1].table.widths = [ '55%', '15%', '15%', '15%']
                        var iColumns = $('#pnldetail thead th').length;
    
                        var rowCount = document.getElementById("pnldetail").rows.length;
                        for (i = 0; i < rowCount; i++) {
                            
                                doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                                doc.content[1].table.body[i][iColumns - 2].alignment = 'right';
                                doc.content[1].table.body[i][iColumns - 3].alignment = 'right';
                                doc.content[1].table.body[i][iColumns - 4].alignment = 'left';

                            
                        };
                    }
                },
                // {
                //     extend:    'print',
                //     text:      '<span class="bi bi-printer">Print</span>',
                //     className: 'btn btn-primary btn-xs',
                //     titleAttr: 'PDF',
                //     title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN DAN TAHUN '+year
                // }
            ]
        });
        $('.loader').hide();
    });

    function gettabledata(type,val){
        $('.loader').show();
        $('#pnldetail').dataTable().fnClearTable();
        $('#pnldetail').dataTable().fnDestroy();
        var sel = document.getElementById("iptBulan");
        if(sel.selectedIndex == 0){
            var jenistext = '';
        }else{
            var jenistext= sel.options[sel.selectedIndex].text;
        }

        if (type == 'month'){
            var bulan = val;
            var year = document.getElementById("iptYear").value;
        }else if(type == 'year'){
            var bulan = document.getElementById("iptBulan").value;
            var year = val;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/penyatauntungrugiDetail/apa",
            type:"GET",
            data: {     
                tahun:year,
                bulan:bulan
            },
            success: function(data) {
                console.log(data);
                $("#tblname").html(data);
                // $("#tblfoot").html(data[1]);
                if(data[0] != null){
                    $('#pnldetail').DataTable( {
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
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<span   >Excel</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Excel',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<span >CSV</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'CSV',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<span >PDF</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'PDF',
                                title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN '+jenistext+' DAN TAHUN '+year,
                                customize: function(doc) {
                                    doc.styles.tableHeader.fillColor = '#00A651',
                                    // doc.defaultStyle.alignment = 'center',
                                    doc.content[1].table.widths = [ '55%', '15%', '15%', '15%']
                                    var iColumns = $('#pnldetail thead th').length;
                
                                    var rowCount = document.getElementById("pnldetail").rows.length;
                                    for (i = 0; i < rowCount; i++) {
                                        
                                            doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                                            doc.content[1].table.body[i][iColumns - 2].alignment = 'right';
                                            doc.content[1].table.body[i][iColumns - 3].alignment = 'right';
                                            doc.content[1].table.body[i][iColumns - 4].alignment = 'left';

                                        
                                    };
                                }
                            },
                            // {
                            //     extend:    'print',
                            //     text:      '<span class="bi bi-printer">Print</span>',
                            //     className: 'btn btn-primary btn-xs',
                            //     titleAttr: 'PDF',
                            //     title: 'LAPORAN PENYATA UNTUNG RUGI BAGI BULAN '+jenistext+' DAN TAHUN '+year
                            // }
                        ]
                    });
                }
                $('.loader').hide();
            }
        });
    }
</script>
@endsection