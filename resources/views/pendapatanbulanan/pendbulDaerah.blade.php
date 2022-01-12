@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center" id="contentbody">
            <h4 class="text" style="display: inline-block;padding-bottom:20px;color:#00A651;">LAPORAN JUMLAH JUALAN / PURATA JUALAN PENERIMA INSENTIF
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:25vh" onchange="gettabledata('jenis',this.value)" id="iptJenisInsentif">
                    <option value="">Jenis Insentif</option>
                      @foreach ($ddInsentif as $items)
                          <option value="{{ $items->id_jenis_insentif }}"> 
                              {{ $items->nama_insentif }} 
                          </option>
                      @endforeach
                </select>
                  MENGIKUT DAERAH/PT SETAKAT 
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('year',this.value)" id="iptYear">
                    <option value="">Tahun</option>
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
              <div class="col-md-6 col-xxl-3 mb-3 pe-md-2">
                <div class="card h-md-100 ecommerce-card-min-width">
                  <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Jumlah Insentif<span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" >
                      {{-- title="" data-bs-original-title="Calculated according to last week's sales" aria-label="Calculated according to last week's sales" --}}
                      <svg class="svg-inline--fa fa-question-circle fa-w-16" data-fa-transform="shrink-1" aria-hidden="true" focusable="false" data-prefix="far" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.9375, 0.9375)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="far fa-question-circle" data-fa-transform="shrink-1"></span> Font Awesome fontawesome.com --></span></h6>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                      <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">RM{{$c_insentif}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xxl-3 mb-3 pe-md-2">
                <div class="card h-md-100 ecommerce-card-min-width">
                  <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Jumlah Jualan<span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top">
                      {{-- title="" data-bs-original-title="Calculated according to last week's sales" aria-label="Calculated according to last week's sales" --}}
                      <svg class="svg-inline--fa fa-question-circle fa-w-16" data-fa-transform="shrink-1" aria-hidden="true" focusable="false" data-prefix="far" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.9375, 0.9375)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="far fa-question-circle" data-fa-transform="shrink-1"></span> Font Awesome fontawesome.com --></span></h6>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                      <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">RM{{$c_jualan}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div style="overflow-x: scroll !important;overflow-y: scroll !important;">
                    <div style="padding-bottom: 20px;">
                        <a class="btn btn-primary" onclick="ExportExcel()">Export Excel</a>
                        <a class="btn btn-primary" onclick="ExportPDF()">Export PDF</a>
                    </div>
                    <table id="pendbuldaerah" class="table table-sm table-bordered table-hover">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 10%;">
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
                                <th scope="col" style="padding-right:2vh;">Negeri</th>
                                <th scope="col">PT</th>
                                <th scope="col">Jenis Insentif</th>
                                <th scope="col">Tahun Terima Insentif</th>
                                <th scope="col">Bil Penerima Insentif</th>
                                <th scope="col">Jumlah Insentif (RM)</th>
                                <th scope="col">Jumlah Jualan (RM)</th>
                                <th scope="col">Purata Jualan (RM)</th>
                            </tr>
                        </thead>
                        <tbody id="tblname">
                            @foreach ($reports as $report)
                            <tr class="align-middle" style="text-align: center;">
                                <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">{{$report->negeri}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->daerah}}</label></td>
                                <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">{{$report->jenis}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->tab3}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->tab4}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->tab5}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->tab6}}</label></td>
                                <td class="text-nowrap"><label class="form-check-label">{{$report->tab7}}</label></td>
                            </tr>
                            @endforeach
                            <tr class="align-middle" style="text-align: center;">
                                <td colspan="4" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">JUMLAH</label></td>
                                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">{{$c_penerima}}</label></td>
                                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">{{$c_insentif}}</label></td>
                                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">{{$c_jualan}}</label></td>
                                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">{{$c_puratajual}}</label></td>
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
        // var table = $('#pendbuldaerah').DataTable({
        //     "paging":   true,
        //     "bFilter": true,
        // });
    });

    function gettabledata(type,val){
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
          url: "/pendbulDaerah/apa",
          type:"GET",
          data: {     
              tahun:year,
              id_jenis_insentif:jenis
          },
          success: function(data) {
  
            $("#tblname").html(data);
          }
      });
    }
    function ExportExcel(){
        if(document.getElementById("iptJenisInsentif").value == ""){
            var jenis = "nun";
        }else{
            var jenis = document.getElementById("iptJenisInsentif").value;
        }
        
        if(document.getElementById("iptYear").value == ""){
            var year = "nun";
        }else{
            var year = document.getElementById("iptYear").value;
        }
    
        window.location.href = "/export2/"+year+"/"+jenis;
    }

    function ExportPDF(){
        var doc = new jsPDF("p", "mm", "a4")
        doc.autoTable({ html: '#pendbuldaerah' })
        doc.save('PendapatanBulananDaerah.pdf')
    }
      
</script>
@endsection