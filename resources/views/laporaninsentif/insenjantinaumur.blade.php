@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center" id="contentbody">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">LAPORAN ANALISA PENERIMA INSENTIF
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:25vh" onchange="gettabledata('jenis',this.value)" id="iptJenisInsentif">
                    <option value="">Jenis Insentif</option>
                      @foreach ($ddInsentif as $items)
                          <option value="{{ $items->id_jenis_insentif }}"> 
                              {{ $items->nama_insentif }} 
                          </option>
                      @endforeach
                </select>
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
                  MENGIKUT JANTINA DAN UMUR 
            </h4>
            <div style="overflow-x: auto !important;overflow-y: auto !important;">
                <table id="laporaninsentifjantina" class="table table-sm table-bordered table-hover">
                    <colgroup>
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
                        <col span="1" style="width:10%;">
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
                            <th scope="col" rowspan="3" style="padding-right:2vh;">Umur</th>
                            <th scope="col" rowspan="3">Jenis Insentif</th>
                            <th scope="col" rowspan="3">Tahun</th>
                            <th scope="col" rowspan="1" colspan="6">Jantina</th>
                            <th scope="col" rowspan="2" colspan="2">Jumlah</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th scope="col" colspan="2">Lelaki</th>
                            <th scope="col" colspan="2">Perempuan</th>
                            <th scope="col" colspan="2">Lain-Lain</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th scope="col" >&nbsp; &nbsp; &nbsp;BIL &nbsp; &nbsp; &nbsp;<div style="display: none;">LELAKI</div></th>
                            <th scope="col" >%</th>
                            <th scope="col" >&nbsp; &nbsp; &nbsp;BIL &nbsp; &nbsp; &nbsp;<div style="display: none;">PEREMPUAN</div></th>
                            <th scope="col" >%</th>
                            <th scope="col" >&nbsp; &nbsp; &nbsp;BIL &nbsp; &nbsp; &nbsp;<div style="display: none;">LAIN-LAIN</div></th>
                            <th scope="col" >%</th>
                            <th scope="col" >&nbsp; &nbsp; &nbsp;BIL &nbsp; &nbsp; &nbsp;<div style="display: none;">JUMLAH</div></th>
                            <th scope="col" >%</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        @foreach ($reports as $report)
                        <tr class="align-middle" style="text-align: center;">
                            <td class="text-nowrap"><label class="form-check-label">{{$report->tab1}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$report->jenis}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$report->tab3}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab4)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->percent1,2)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab5)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->percent2,2)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->tab6)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->percent3,2)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->jumbil)}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{number_format($report->jumpercent,2)}}</label></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot id="tblfoot">
                        <tr class="align-middle" style="text-align: center;display:none;">
                            <th></th>
                            <th></th>
                            <th class="text-nowrap">Jumlah</th>
                            <th class="text-nowrap">{{number_format($jumlah->satu)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->dua,2)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->tiga)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->empat,2)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->lima)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->enam,2)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->tujuh)}}</th>
                            <th class="text-nowrap">{{number_format($jumlah->lapan,2)}}</th>
                        </tr>
                        <tr class="align-middle" style="text-align: center;">
                            <th class="text-nowrap" colspan="3"><label class="form-check-label">Jumlah</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->satu)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->dua,2)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->tiga)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->empat,2)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->lima)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->enam,2)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->tujuh)}}</label></th>
                            <th class="text-nowrap"><label class="form-check-label">{{number_format($jumlah->lapan,2)}}</label></th>
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
        $('#laporaninsentifjantina').DataTable( {
            searching: true,
            dom: 'Blfrtip',
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:       '<span>Copy</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Copy',
                    title: 'LAPORAN ANALISA PENERIMA INSENTIF BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR',
                    footer: true,
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span>Excel</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Excel',
                    title: 'LAPORAN ANALISA PENERIMA INSENTIF BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR',
                    footer: true,
                },
                {
                    extend:    'csvHtml5',
                    text:      '<span>CSV</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'CSV',
                    title: 'LAPORAN ANALISA PENERIMA INSENTIF BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<span>PDF</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'PDF',
                    title: 'LAPORAN ANALISA PENERIMA INSENTIF BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR',
                    footer: true,
                    customize: function(doc) {
                        doc.styles.tableHeader.fontSize = 9,
                        doc.styles.tableHeader.fillColor = '#00A651',
                        doc.styles.tableFooter.fontSize = 9,
                        doc.styles.tableFooter.fillColor = '#00A651',
                        // doc.styles.tableFooter.color = 'black',
                        doc.defaultStyle.alignment = 'center',
                        doc.defaultStyle.fontSize = 9;
                    }
                }
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
        $('.loader').hide();
    });

    function gettabledata(type,val){
        $('.loader').show();
        $('#laporaninsentifjantina').dataTable().fnClearTable();
        $('#laporaninsentifjantina').dataTable().fnDestroy();
        var sel = document.getElementById("iptJenisInsentif");
        if(sel.selectedIndex == 0){
            var jenistext = '';
        }else{
            var jenistext= sel.options[sel.selectedIndex].text;
        }

        if (type == 'year'){
        var year = val;
        var jenis = document.getElementById("iptJenisInsentif").value;
        }else if(type == 'jenis'){
        var year = document.getElementById("iptYear").value;
        var jenis = val;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/insenjantinaumur/apa",
            type:"GET",
            data: {     
                tahun:year,
                id_jenis_insentif:jenis
            },
            success: function(data) {

                $("#tblname").html(data[0]);
                $("#tblfoot").html(data[1]);
                if(data[0] != null){
                    $('#laporaninsentifjantina').DataTable( {
                        searching: true,
                        dom: 'Blfrtip',
                        buttons: [
                            {
                                extend:    'copyHtml5',
                                text:       '<span  >Copy</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Copy',
                                footer: true,
                                title: 'LAPORAN ANALISA PENERIMA INSENTIF '+jenistext+' BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR'
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<span   >Excel</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Excel',
                                footer: true,
                                title: 'LAPORAN ANALISA PENERIMA INSENTIF '+jenistext+' BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR'
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<span >CSV</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'CSV',
                                title: 'LAPORAN ANALISA PENERIMA INSENTIF '+jenistext+' BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR'
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<span >PDF</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'PDF',
                                title: 'LAPORAN ANALISA PENERIMA INSENTIF '+jenistext+' BAGI TAHUN '+year+' MENGIKUT JANTINA DAN UMUR',
                                footer: true,
                                customize: function(doc) {
                                    doc.styles.tableHeader.fontSize = 9,
                                    doc.styles.tableHeader.fillColor = '#00A651',
                                    doc.styles.tableFooter.fontSize = 9,
                                    doc.styles.tableFooter.fillColor = '#00A651',
                                    // doc.styles.tableFooter.color = 'black',
                                    doc.defaultStyle.alignment = 'center',
                                    doc.defaultStyle.fontSize = 9;
                                }
                            },
                            // {
                            //     extend:    'print',
                            //     text:      '<span class="bi bi-printer">Print</span>',
                            //     className: 'btn btn-primary btn-xs',
                            //     titleAttr: 'PDF',
                            //     title: 'LAPORAN ANALISA PENERIMA INSENTIF '+jenistext+' MENGIKUT JANTINA DAN UMUR SETAKAT '+year
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