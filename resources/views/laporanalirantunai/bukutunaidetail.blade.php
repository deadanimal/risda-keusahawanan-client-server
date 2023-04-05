@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/laporanalirantunai"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center" id="contentbody" style="padding-top:15px;">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">BUKU TUNAI RINGKASAN BULAN
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
                  DAN TAHUN
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:25vh" onchange="gettabledata('year',this.value)" id="iptYear">
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
                <table id="laporanbukutunai" class="table table-style table-sm table-bordered table-hover">
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
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                    </colgroup>
                    <style>
                        .dataTable-dropdown{
                            display: inline;
                            padding-right:10vh;
                        }
                        .dataTable-search{
                            display: inline;
                        }
                        ul {
                            list-style-type: none;
                        }
                        .dataTable-pagination-list{
                            display: inline-flex;
                        }
                        .active{
                            padding-right: 5px;
                        }
                        .dataTable-bottom{
                            padding-top: 3vh;
                        }
                    </style>
                    <thead>
                        <tr class="align-middle" style="text-align: center;">
                            <th scope="col" >TARIKH</th>
                            <th scope="col" >BUTIRAN</th>
                            <th scope="col" >RUJUKAN</th>
                            <th scope="col" >DEBIT</th>
                            <th scope="col" >KREDIT</th>
                            <th scope="col" >JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <?php $count = 1; ?>
                        @foreach ($reports as $report)
                            @if ($loop->first && $report->tab8 == 1)
                                <tr class="align-middle" style="text-align: left;">
                                    <td></td>
                                    <td class="text-nowrap"><label class="form-check-label">A) PENDAPATAN AKTIF</label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 1)
                                <tr class="align-middle" style="text-align: center;">
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab3}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label"><div style="display: none;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>{{$report->nama_jenis}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab5}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab6,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab7,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->total,2)}}</label></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 2 && $count != 3)
                                <?php $count = 2; ?>
                            @endif
                            @if ($report->tab8 == 2 && $count == 2)
                                <?php $count = 3; ?>
                                <tr class="align-middle" style="text-align: left;">
                                    <td></td>
                                    <td class="text-nowrap"><label class="form-check-label">B) PENDAPATAN PASIF</label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 2)
                                <tr class="align-middle" style="text-align: center;">
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab3}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label"><div style="display: none;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>{{$report->nama_jenis}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab5}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab6,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab7,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->total,2)}}</label></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 3 && $count == 3)
                                <tr class="align-middle" style="text-align: center;">
                                    <td></td>
                                    <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">C) JUMLAH ALIRAN MASUK (RM)</label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($total->satu,2)}}</label></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 3 && $count != 4)
                                <?php $count = 3; ?>
                            @endif
                            @if ($report->tab8 == 3 && $count == 3)
                                <?php $count = 4; ?>
                                <tr class="align-middle" style="text-align: left;">
                                    <td></td>
                                    <td class="text-nowrap"><label class="form-check-label"><label class="form-check-label">D) PERBELANJAAN PERNIAGAAN (RM)</label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            @if ($report->tab8 == 3)
                                <tr class="align-middle" style="text-align: center;">
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab3}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label"><div style="display: none;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>{{$report->nama_jenis}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{$report->tab5}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab6,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab7,2)}}</label></td>
                                    <td class="text-nowrap"><label class="form-check-label">{{number_format($report->total,2)}}</label></td>
                                </tr>
                            @endif
                        @endforeach
                        @if($count == 4)
                        <tr class="align-middle" style="text-align: center;">
                            <td></td>
                            <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">G) JUMLAH ALIRAN KELUAR</label></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($total->dua,2)}}</label></td>
                        </tr>
                        @endif
                        <tr class="align-middle" style="text-align: center;">
                            <td></td>
                            <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">JUMLAH BAKI/SIMPANAN</label></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($total->tiga,2)}}</label></td>
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
    $('#laporanbukutunai').DataTable( {
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
                title: 'BUKU TUNAI RINGKASAN BULAN DAN TAHUN '+year
            },
            {
                extend:    'excelHtml5',
                text:      '<span   >Excel</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'Excel',
                title: 'BUKU TUNAI RINGKASAN BULAN DAN TAHUN '+year
            },
            {
                extend:    'csvHtml5',
                text:      '<span >CSV</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'CSV',
                title: 'BUKU TUNAI RINGKASAN BULAN DAN TAHUN '+year
            },
            {
                extend:    'pdfHtml5',
                text:      '<span >PDF</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'PDF',
                title: 'BUKU TUNAI RINGKASAN BULAN DAN TAHUN '+year,
                customize: function(doc) {
                    doc.styles.tableHeader.fillColor = '#00A651'
                    var iColumns = $('#laporanbukutunai thead th').length;
                
                    var rowCount = document.getElementById("laporanbukutunai").rows.length;
                    for (i = 0; i < rowCount; i++) {
                        
                            doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                            doc.content[1].table.body[i][iColumns - 2].alignment = 'right';
                            doc.content[1].table.body[i][iColumns - 3].alignment = 'right';
                            doc.content[1].table.body[i][iColumns - 5].alignment = 'left';

                        
                    };
                },
            },
            // {
            //     extend:    'print',
            //     text:      '<span class="bi bi-printer">Print</span>',
            //     className: 'btn btn-primary btn-xs',
            //     titleAttr: 'PDF',
            //     title: 'BUKU TUNAI RINGKASAN BULAN DAN TAHUN '+year
            // }
        ]
    });
    $('.loader').hide();
});

function gettabledata(type,val){
    $('.loader').show();
    $('#laporanbukutunai').dataTable().fnClearTable();
    $('#laporanbukutunai').dataTable().fnDestroy();
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
        url: "/laporanalirantunaiDetail/apa",
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
                $('#laporanbukutunai').DataTable( {
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
                            title: 'BUKU TUNAI RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<span   >Excel</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'Excel',
                            title: 'BUKU TUNAI RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<span >CSV</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'CSV',
                            title: 'BUKU TUNAI RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<span >PDF</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'PDF',
                            title: 'BUKU TUNAI RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year,
                            customize: function(doc) {
                                doc.styles.tableHeader.fillColor = '#00A651'
                                var iColumns = $('#laporanbukutunai thead th').length;
                
                                var rowCount = document.getElementById("laporanbukutunai").rows.length;
                                for (i = 0; i < rowCount; i++) {
                                    
                                        doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                                        doc.content[1].table.body[i][iColumns - 2].alignment = 'right';
                                        doc.content[1].table.body[i][iColumns - 3].alignment = 'right';
                                        doc.content[1].table.body[i][iColumns - 5].alignment = 'left';

                                    
                                };
                            },
                        },
                        // {
                        //     extend:    'print',
                        //     text:      '<span class="bi bi-printer">Print</span>',
                        //     className: 'btn btn-primary btn-xs',
                        //     titleAttr: 'PDF',
                        //     title: 'BUKU TUNAI RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
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