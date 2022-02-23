@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center" id="contentbody">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT     
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('negeri',this.value)" id="iptNegeri">
                    <option value="">NEGERI</option>
                    @foreach ($ddNegeri as $items)
                        <option value="{{ $items->U_Negeri_ID }}"> 
                            {{ $items->Negeri }} 
                        </option>
                    @endforeach
                </select>
                SETAKAT TAHUN
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('year',this.value)" id="iptYear">
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
            <div style="overflow-x: scroll !important;overflow-y: scroll !important;">
                <table id="laporlawatstaf" class="table table-sm table-bordered table-hover">
                    <colgroup>
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
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
                            <th scope="col" rowspan="3" style="padding-right:2vh;">Bil</th>
                            <th scope="col" rowspan="3">Negeri/Daerah</th>
                            <th scope="col" rowspan="3">Pegawai Pemantau</th>
                            <th scope="col" rowspan="3">Jumlah Keseluruhan Usahawan</th>
                            <th scope="col" >Bulan Semasa</th>
                            <th scope="col" colspan="3">Kumulatif</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th scope="col" >Telah Dilawat</th>
                            <th scope="col" >Telah Dilawat</th>
                            <th scope="col" >Baki</th>
                            <th scope="col" >Peratusan Usahawan Keseluruhan</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th scope="col">Bil Usahawan<div style="display: none;"> Telah Dilawat Bulan Semasa</div> (Org)</th>
                            <th scope="col">Bil Usahawan<div style="display: none;"> Telah Dilawat</div> (Org)</th>
                            <th scope="col">Bil Usahawan<div style="display: none;"> Baki</div> (Org)</th>
                            <th scope="col"><div style="display: none;">Peratusan Usahawan Keseluruhan</div> %</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <?php $num=1; ?>
                        @foreach ($reports as $report)
                        <tr class="align-middle" style="text-align: center;">
                            <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label"><?php echo $num++;?></label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$report->daerah}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$report->pegawai}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab5)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab6)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab7)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab8)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->percent,2)}}</label></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot id="tblfoot">
                        <tr class="align-middle" style="text-align: center;display:none;">
                            <th></th>
                            <th></th>
                            <th class="text-nowrap">Jumlah</th>
                            <th class="text-nowrap">{{number_format($total->satu)}}</th>
                            <th class="text-nowrap">{{number_format($total->dua)}}</th>
                            <th class="text-nowrap">{{number_format($total->tiga)}}</th>
                            <th class="text-nowrap">{{number_format($total->empat)}}</th>
                            <th class="text-nowrap">100</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th class="text-nowrap" colspan="3">Jumlah</th>
                            <th class="text-nowrap">{{number_format($total->satu)}}</th>
                            <th class="text-nowrap">{{number_format($total->dua)}}</th>
                            <th class="text-nowrap">{{number_format($total->tiga)}}</th>
                            <th class="text-nowrap">{{number_format($total->empat)}}</th>
                            <th class="text-nowrap">100</th>
                        </tr>
                    </tfoot>
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
    $('#laporlawatstaf').DataTable( {
        searching: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:       '<span class="bi bi-files">Copy</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'Copy',
                footer: true,
                title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT NEGERI SETAKAT TAHUN '+year
            },
            {
                extend:    'excelHtml5',
                text:      '<span class="bi bi-file-spreadsheet">Excel</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'Excel',
                footer: true,
                title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT NEGERI SETAKAT TAHUN '+year
            },
            {
                extend:    'csvHtml5',
                text:      '<span class="bi bi-filetype-csv">CSV</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'CSV',
                title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT NEGERI SETAKAT TAHUN '+year
            },
            {
                extend:    'pdfHtml5',
                text:      '<span class="bi bi-file-earmark-pdf">PDF</span>',
                className: 'btn btn-primary btn-xs',
                titleAttr: 'PDF',
                footer: true,
                customize: function(doc) {
                    doc.styles.tableHeader.fontSize = 10,
                    doc.styles.tableHeader.fillColor = '#00A651',
                    doc.styles.tableFooter.fontSize = 10,
                    doc.styles.tableFooter.fillColor = '#00A651',
                    // doc.styles.tableFooter.color = 'black',
                    doc.defaultStyle.alignment = 'center',
                    doc.defaultStyle.fontSize = 9
                },
                title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT NEGERI SETAKAT TAHUN '+year
            },
            // {
            //     extend:    'print',
            //     text:      '<span class="bi bi-printer">Print</span>',
            //     className: 'btn btn-primary btn-xs',
            //     titleAttr: 'PDF',
            //     title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT NEGERI SETAKAT TAHUN '+year
            // }
        ],
        "language": {
            "lengthMenu": "_MENU_ rekod setiap paparan",
            "zeroRecords": "Maaf - Tiada data dijumpai",
            "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
            "infoEmpty": "Tiada rekod dijumpai",
            "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
            "sSearch": "Carian :",
            "paginate": {
                "previous": "Sebelum",
                "next": "Seterus"
            }
        }
    });
    $('.loader').hide();
});

function gettabledata(type,val){
    $('#laporlawatstaf').dataTable().fnClearTable();
    $('#laporlawatstaf').dataTable().fnDestroy();
    var sel = document.getElementById("iptNegeri");
    if(sel.selectedIndex == 0){
        var jenistext = '';
    }else{
        var jenistext= sel.options[sel.selectedIndex].text;
    }

    if (type == 'negeri'){
      var negeri = val;
      var year = document.getElementById("iptYear").value;
    }else if(type == 'year'){
      var negeri = document.getElementById("iptNegeri").value;
      var year = val;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/pantaustafnegeri/apa",
        type:"GET",
        data: {     
            tahun:year,
            negeri:negeri
        },
        success: function(data) {
            
            $("#tblname").html(data[0]);
            $("#tblfoot").html(data[1]);
            if(data[0] != null){
                $('#laporlawatstaf').DataTable( {
                    searching: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend:    'copyHtml5',
                            text:       '<span class="bi bi-files">Copy</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'Copy',
                            footer: true,
                            title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT '+jenistext+' SETAKAT TAHUN '+year
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<span class="bi bi-file-spreadsheet">Excel</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'Excel',
                            footer: true,
                            title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT '+jenistext+' SETAKAT TAHUN '+year
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<span class="bi bi-filetype-csv">CSV</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'CSV',
                            title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT '+jenistext+' SETAKAT TAHUN '+year
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<span class="bi bi-file-earmark-pdf">PDF</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'PDF',
                            footer: true,
                            customize: function(doc) {
                                doc.styles.tableHeader.fontSize = 10,
                                doc.styles.tableHeader.fillColor = '#00A651',
                                doc.styles.tableFooter.fontSize = 10,
                                doc.styles.tableFooter.fillColor = '#00A651',
                                // doc.styles.tableFooter.color = 'black',
                                doc.defaultStyle.alignment = 'center',
                                doc.defaultStyle.fontSize = 9
                            },
                            title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT '+jenistext+' SETAKAT TAHUN '+year
                        },
                        // {
                        //     extend:    'print',
                        //     text:      '<span class="bi bi-printer">Print</span>',
                        //     className: 'btn btn-primary btn-xs',
                        //     titleAttr: 'PDF',
                        //     title: 'LAPORAN LAWATAN PEMANTAUAN OLEH STAF MENGIKUT '+jenistext+' SETAKAT TAHUN '+year
                        // }
                    ],
                    "language": {
                        "lengthMenu": "_MENU_ rekod setiap paparan",
                        "zeroRecords": "Maaf - Tiada data dijumpai",
                        "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
                        "infoEmpty": "Tiada rekod dijumpai",
                        "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
                        "sSearch": "Carian :",
                        "paginate": {
                            "previous": "Sebelum",
                            "next": "Seterus"
                        }
                    }
                });
            }
        }
    });
}
</script>
@endsection