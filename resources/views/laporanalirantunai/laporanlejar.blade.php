@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">Laporan Lejar</h3>
            <div style="overflow-x: auto !important;overflow-y: auto !important;">
                {{-- <div style="padding-bottom:10px;">
                    <a class="btn btn-primary" onclick="ExportExcel()">Export Excel</a>
                    <a class="btn btn-primary" onclick="ExportPDF()">Export PDF</a>
                </div> --}}
                <table id="insentiftbl">
                    <colgroup>
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 25%;">
                        <col span="1" style="width: 25%;">
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
                        .textlbl{
                            font-weight: 500 !important;
                            font-size: .8333333333rem;
                            letter-spacing: .02em;
                        }
                    </style>
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">Nama</th>
                            <th scope="col">Negeri</th>
                            <th scope="col">Pusat Tanggungjawab</th>
                            <th scope="col">Laporan Lejar</th>
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
                                <button class="btn btn-primary btn-sm me-1 mb-1" type="button" onclick="generatereport(12,'/laporanlejarDetail',{{$user->id}});return false;">
                                Laporan Lejar
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
        var table = $('#insentiftbl').DataTable({
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
</script>
@endsection