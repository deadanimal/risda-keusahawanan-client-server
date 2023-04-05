@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
      <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/pantauindividu"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;padding-top:3vh;">LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN 
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
                <div style="padding-bottom: 20px;" id="pdfbtn">
                    <a class="btn btn-primary" onclick="ExportPDF()"><span >PDF</span></a>
                </div>
                <table id="laporanpantauind" class="table table-sm table-hover" style="border:none;border-collapse: collapse;">
                    <colgroup>
                        <col span="1" style="width:30%;border:none;">
                        <col span="1" style="width:70%;">
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
                        .table td{
                            border: none;
                        }
                    </style>
                    <thead style="display: none;">
                        <tr>
                            <th>PERKARA</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody id="tblname">
                        <input style="display: none;" id="userid" value="{{$usahawan->usahawanid}}" />
                        @if ($result == '')
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Nama Usahawan</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->namausahawan}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Nama Syarikat</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->syarikat}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Daerah</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->daerah}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Negeri</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->negeri}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Jenis Perniagaan</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->jenisniaga}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Jenis Insentif</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->jenis_insentif}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Tahun Terima Insentif</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->tahun}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" style="padding-top: 20px;">Tarikh Lawatan</td>
                            <td class="text-nowrap" style="padding-top: 20px;">: &nbsp {{$usahawan->tarikh_lawatan}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Masa Lawatan</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->masa_lawatan}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Pegawai Lawatan</td>
                            <td class="text-nowrap" >: &nbsp {{$usahawan->pegawai}}</td>
                        </tr>
                        <tr class="align-middle" style="text-align: left;">
                            <td class="text-nowrap" >Gambar Lawatan</td>
                            <td class="text-nowrap" style="padding-top: 20px;">:
                                <div style="display: none;">
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                    &nbsp;<br>
                                </div>
                                    <img id="gambau" style="height:200px;width:200px;" src="{{$usahawan->gambar_lawatan}}"/>
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="text-nowrap" colspan="2" style="padding-top: 20px;">
                                Tindakan yang perlu dilaksanakan oleh usahawan
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap" colspan="2" style="border: 1px solid black;padding:25px 15px">
                                {{$usahawan->tindakan}}
                            </td>
                            <td></td>
                            
                        </tr>
                        <tr>
                            <td class="text-nowrap" colspan="2" style="padding-top: 20px;">
                                Catatan/Komen Keseluruhan
                            </td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="text-nowrap" colspan="2" style="border: 1px solid black;padding:25px 15px">
                                {{$usahawan->komen}}
                            </td>
                            <td></td>

                        </tr>
                        @else 

                        @endif
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
        var warn = "<?php echo $result; ?>";
        var btn = '';
        if(warn == ''){
            btn = "Blfrtip";
            $('#pdfbtn').show();
            // document.getElementById('pdfbtn').show();
        }else{
            $('#pdfbtn').hide();
            // document.getElementById('pdfbtn').hide();
        }
        
        $('#laporanpantauind').DataTable( {
            searching: false,
            sorting:false,
            paging:false,
            dom: btn,
            exportOptions: {
                stripHtml: false,
            },
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:       '<span  >Copy</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Copy',
                    title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                },
                {
                    extend:    'excelHtml5',
                    text:      '<span   >Excel</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'Excel',
                    title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                },
                {
                    extend:    'csvHtml5',
                    text:      '<span >CSV</span>',
                    className: 'btn btn-primary btn-xs',
                    titleAttr: 'CSV',
                    title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                }
            ],
            "language": {
                "lengthMenu": "_MENU_ rekod setiap paparan",
                "zeroRecords": ""+warn,
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
    })
    
    function gettabledata(type,val){
        $('.loader').show();
        $('#laporanpantauind').dataTable().fnClearTable();
        $('#laporanpantauind').dataTable().fnDestroy();
        var year = document.getElementById("iptYear").value;
        var usahawanid = document.getElementById("userid").value;
        console.log(usahawanid);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/pantauinddtl",
            type:"GET",
            data: {     
                tahun:year,
                usahawanid:usahawanid
            },
            success: function(data) {
                console.log(data);
                var error = '';
                var dom = '';
                if(data == 1){
                    error = 'Tiada data lawatan ditemui';
                }else if(data == 2){
                    error = 'Tiada data insentif ditemui';
                }else{
                    $("#tblname").html(data);
                    dom = 'Blfrtip';
                }
                
                $('#laporanpantauind').DataTable( {
                    searching: false,
                    sorting:false,
                    paging:false,
                    dom: dom,
                    exportOptions: {
                        stripHtml: false,
                    },
                    buttons: [
                        {
                            extend:    'copyHtml5',
                            text:       '<span  >Copy</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'Copy',
                            title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<span   >Excel</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'Excel',
                            title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<span >CSV</span>',
                            className: 'btn btn-primary btn-xs',
                            titleAttr: 'CSV',
                            title: 'LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN '+year
                        }
                    ],
                    "language": {
                        "lengthMenu": "_MENU_ rekod setiap paparan",
                        "zeroRecords": error,
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
            }
        });
    }

    function ExportPDF(){
        var year = document.getElementById("iptYear").value;
        var doc = new jsPDF("p", "mm", "a4")
        doc.text(15, 10, "LAPORAN LAWATAN PEMANTAUAN INDIVIDU BAGI TAHUN"+year);
        doc.autoTable({ html: '#laporanpantauind' })
        var elem = document.getElementById('gambau');
        console.log(elem.getAttribute('src'));
        if(elem.getAttribute('src') != ""){
            var myImage = document.getElementById("gambau").src; 
            doc.addImage(myImage, 'JPEG', 80, 100, 60, 35);
        }
        doc.save('PemantauanLawatanIndividu.pdf')
    
    }
</script>
@endsection