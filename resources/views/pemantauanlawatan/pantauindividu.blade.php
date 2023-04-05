@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6" style="overflow-x: auto !important;overflow-y: auto !important;">
        <div class="row align-items-center">
            <div id="displaysatu" >
                <h3 class="text" style="padding-bottom:20px;color:#00A651;">Pemantauan Lawatan Individu</h3>
                <style>
                    .sorting {
                        background-image : none !important;
                    }
                </style>
                <table id="LPItbl">
                    <colgroup>
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 15%;">
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
                        <tr class="align-middle">
                            <th scope="col">Nama</th>
                            <th scope="col">No kad Pengenalan</th>
                            <th scope="col">Negeri</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="align-middle">
                            <td class="text-nowrap"><label class="form-check-label">{{$user->namausahawan}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$user->nokadpengenalan}}</label></td>
                            <td class="text-nowrap"><label class="form-check-label">{{$user->negeri}}</label></td>
                            <td class="text-nowrap"><button class="btn btn-falcon-default btn-sm me-1 mb-1" type="button" onclick="window.location.href='/pantauindividudetail/{{$user->usahawanid}}'">
                                <span class="me-1" data-fa-transform="shrink-3"></span>Laporan Lawatan
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
        $('#LPItbl').DataTable( {
            searching: true,
            sorting:false,
            paging:true,
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
    })
    
    </script>
@endsection