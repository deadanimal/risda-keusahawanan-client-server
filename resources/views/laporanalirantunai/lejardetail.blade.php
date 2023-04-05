@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/laporanlejar"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center" id="contentbody" style="padding-top:15px;">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">LEJAR RINGKASAN BULAN
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
                <table id="laporanlejar" class="table table-style table-sm table-bordered table-hover">
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
                    <thead>
                        <tr class="align-middle" style="text-align: left;">
                            <th>Date</th>
                            <th class="text-nowrap">BUTIRAN</th>
                            <th class="text-nowrap">JUMLAH (RM)</th>
                            <th>Date</th>
                            <th class="text-nowrap">BUTIRAN</th>
                            <th class="text-nowrap">JUMLAH (RM)</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <tr>
                            <td style="text-align: left">DR</td>
                            <td></td>
                            <td colspan="2" style="text-align: center">TUNAI A/C</td>
                            <td style="display: none;"></td>
                            <td></td>
                            <td style="text-align: right">CR</td>
                        </tr>
                        @foreach ($reports1 as $report1)
                            @if ($report1->tab4 == 2 && !$loop->last)
                            <tr>
                                <td class="text-nowrap">{{$report1->tab5}}</td>
                                <td>{{$report1->tab6}}</td>
                                <td>@if($report1->tab7 != null) {{number_format($report1->tab7,2)}} @endif</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            @if ($report1->tab4 == 1 && !$loop->last)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$report1->tab5}}</td>
                                <td>{{$report1->tab6}}</td>
                                <td>@if($report1->tab7 != null) {{number_format($report1->tab7,2)}} @endif</td>
                            </tr>
                            @endif
                            @if ($loop->last)
                                @if ($report1->tab4 == 2)
                                <tr>
                                    <td class="text-nowrap">{{$report1->tab5}}</td>
                                    <td>{{$report1->tab6}}</td>
                                    <td>@if($report1->tab7 != null) {{number_format($report1->tab7,2)}} @endif</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endif
                                @if ($report1->tab4 == 1)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$report1->tab5}}</td>
                                    <td>{{$report1->tab6}}</td>
                                    <td>@if($report1->tab7 != null) {{number_format($report1->tab7,2)}} @endif</td>
                                </tr>
                                @endif
                                @if ($val->satu == 1)
                                <tr>
                                    <td></td>
                                    <td>BAKI H/B</td>
                                    <td>@if($val->dua != null) {{number_format($val->dua,2)}} @endif</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endif
                                @if ($val->satu == 2)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>BAKI H/B</td>
                                    <td>@if($val->dua != null) {{number_format($val->dua,2)}} @endif</td>
                                </tr>
                                @endif
                                <tr>
                                    <td></td>
                                    <td>Jumlah</td>
                                    <td>@if($jumlah != null) {{number_format($jumlah,2)}} @endif</td>
                                    <td></td>
                                    <td>Jumlah</td>
                                    <td>@if($jumlah != null) {{number_format($jumlah,2)}} @endif</td>
                                </tr>
                                @if ($val->satu == 1)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Baki B/B</td>
                                    <td>@if($val->dua != null) {{number_format($val->dua,2)}} @endif</td>
                                </tr>
                                @endif
                                @if ($val->satu == 2)
                                <tr>
                                    <td></td>
                                    <td>Baki B/B</td>
                                    <td>@if($val->dua != null) {{number_format($val->dua,2)}} @endif</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($reports2 as $key => $report2)
                            <?php
                            $prevRow = new \stdClass();
                            $prevRow->tab3 = 0;
                            if (isset($reports2[$key - 1])) {
                                $prevRow = $reports2[$key - 1];
                            }else{
                                $prevRow->tab3 = 0;
                            }
                            ?>
                            @if ($report2->tab3 != $prevRow->tab3)
                                <tr>
                                    <td style="padding-top: 30px;border:none !important;"> &nbsp;</td>
                                    <td style="border:none !important;"></td>
                                    <td style="border:none !important;"></td>
                                    <td style="border:none !important;"></td>
                                    <td style="border:none !important;"></td>
                                    <td style="border:none !important;"></td>
                                </tr>
                                <tr style="text-align: center">
                                    <td style="text-align: left;">DR</td>
                                    <td></td>
                                    <td colspan="2" class="text-nowrap">{{$report2->tab6}} A/C</td>
                                    <td style="display: none;"></td>
                                    <td></td>
                                    <td style="text-align: right;">CR</td>
                                </tr>
                                @if ($report2->tab4 == 1)
                                <tr>
                                    <td class="text-nowrap">{{$report2->tab5}}</td>
                                    <td>{{$report2->tab6}}</td>
                                    <td>@if($report2->tab7 != null) {{number_format($report2->tab7,2)}} @endif</td>
                                    <td class="text-nowrap"></td>
                                    <td>{{$report2->tab8}}</td>
                                    <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                </tr>
                                @endif
                                @if ($report2->tab4 == 2)
                                <tr>
                                    <td class="text-nowrap"></td>
                                    <td>{{$report2->tab8}}</td>
                                    <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                    <td class="text-nowrap">{{$report2->tab5}}</td>
                                    <td>{{$report2->tab6}}</td>
                                    <td>@if($report2->tab7 != null) {{number_format($report2->tab7,2)}} @endif</td>
                                </tr>
                                @endif
                                
                            @else
                                @if ($report2->tab4 == 1)
                                <tr>
                                    <td class="text-nowrap">{{$report2->tab5}}</td>
                                    <td>{{$report2->tab6}}</td>
                                    <td>@if($report2->tab7 != null) {{number_format($report2->tab7,2)}} @endif</td>
                                    <td class="text-nowrap"></td>
                                    <td>{{$report2->tab8}}</td>
                                    <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                </tr>
                                @endif
                                @if ($report2->tab4 == 2)
                                <tr>
                                    <td class="text-nowrap"></td>
                                    <td>{{$report2->tab8}}</td>
                                    <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                    <td class="text-nowrap">{{$report2->tab5}}</td>
                                    <td>{{$report2->tab6}}</td>
                                    <td>@if($report2->tab7 != null) {{number_format($report2->tab7,2)}} @endif</td>
                                </tr>
                                @endif
                            @endif
                            @if ($report2->tab8 == "BAKI H/B" && ($report2->tab4 == 1))
                            <tr>
                                <td></td>
                                <td>Jumlah</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                <td></td>
                                <td>Jumlah</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Baki B/B</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            @if ($report2->tab8 == "BAKI H/B" && ($report2->tab4 == 2))
                            <tr>
                                <td></td>
                                <td>Jumlah</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                                <td></td>
                                <td>Jumlah</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Baki B/B</td>
                                <td>@if($report2->tab9 != null) {{number_format($report2->tab9,2)}} @endif</td>
                            </tr>
                            @endif
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
        $('#laporanlejar').DataTable( {
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
                    title: 'LEJAR RINGKASAN BULAN DAN TAHUN '+year
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span   >Excel</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Excel',
                    title: 'LEJAR RINGKASAN BULAN DAN TAHUN '+year
                },
                {
                    extend:    'csvHtml5',
                    text:      '<span >CSV</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'CSV',
                    title: 'LEJAR RINGKASAN BULAN DAN TAHUN '+year
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<span >PDF</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'PDF',
                    title: 'LEJAR RINGKASAN BULAN DAN TAHUN '+year,
                    customize: function(doc) {
                        doc.styles.tableHeader.fillColor = '#00A651',
                        doc.defaultStyle.alignment = 'left'
                        doc.content[1].table.widths = [ '15%', '20%', '20%', '15%', '20%', '10%']
                        var iColumns = $('#laporanlejar thead th').length;
                
                        var rowCount = document.getElementById("laporanlejar").rows.length;
                        for (i = 0; i < rowCount; i++) {
                            
                                doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                                doc.content[1].table.body[i][iColumns - 4].alignment = 'right';

                        };
                    }
                },
                // {
                //     extend:    'print',
                //     text:      '<span class="bi bi-printer">Print</span>',
                //     className: 'btn btn-primary btn-xs',
                //     titleAttr: 'PDF',
                //     title: 'LEJAR RINGKASAN BULAN DAN TAHUN '+year
                // }
            ]
        });
        $('.loader').hide();
        document.getElementById("laporanlejar").style.width = "100%";
    });

    function gettabledata(type,val){
        $('.loader').show();
        $('#laporanlejar').dataTable().fnClearTable();
        $('#laporanlejar').dataTable().fnDestroy();

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
            url: "/laporanlejarDetail/apa",
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
                    $('#laporanlejar').DataTable( {
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
                                title: 'LEJAR RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'excelHtml5',
                                text:      '<span   >Excel</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'Excel',
                                title: 'LEJAR RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<span >CSV</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'CSV',
                                title: 'LEJAR RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
                            },
                            {
                                extend:    'pdfHtml5',
                                text:      '<span >PDF</span>',
                                className: 'btn btn-primary btn-xs',
                                titleAttr: 'PDF',
                                title: 'LEJAR RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year,
                                customize: function(doc) {
                                    doc.styles.tableHeader.fillColor = '#00A651',
                                    doc.defaultStyle.alignment = 'left'
                                    doc.content[1].table.widths = [ '15%', '20%', '20%', '15%', '20%', '10%']
                                    var iColumns = $('#laporanlejar thead th').length;
                            
                                    var rowCount = document.getElementById("laporanlejar").rows.length;
                                    for (i = 0; i < rowCount; i++) {
                                        
                                            doc.content[1].table.body[i][iColumns - 1].alignment = 'right';
                                            doc.content[1].table.body[i][iColumns - 4].alignment = 'right';

                                    };
                                }
                            },
                            // {
                            //     extend:    'print',
                            //     text:      '<span class="bi bi-printer">Print</span>',
                            //     className: 'btn btn-primary btn-xs',
                            //     titleAttr: 'PDF',
                            //     title: 'LEJAR RINGKASAN BULAN '+jenistext+' DAN TAHUN '+year
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
