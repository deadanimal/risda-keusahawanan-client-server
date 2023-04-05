@extends('dashboard')
@section('content')
<div class="row g-0" style="padding-bottom:30px;">
    <div class="col-lg-12 pe-lg-2 mb-3">
      <div class="card h-lg-100 overflow-hidden">
        <div class="card-header bg-light">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="mb-0">Statistik Dashboard</h6>
            </div>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:40vh;margin-left:20px;" onchange="gettabledata('jenis',this.value)" id="iptJenisInsentif">
                <option value="">Jenis Insentif</option>
                @foreach ($ddInsentif as $items)
                    <option value="{{ $items->id_jenis_insentif }}" {{ ( $items->id_jenis_insentif == $getjenisinsentif) ? 'selected' : '' }}>
                        {{ $items->nama_insentif }} 
                    </option>
                @endforeach
            </select>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('year',this.value)" id="iptYear">
                <option selected="true" disabled="disabled" value="">Tahun</option>
                <?php
                $currtahun = date("Y");
                $fromtahun = date("Y") - 10;
                for ($tahun = $currtahun; $tahun >= $fromtahun; $tahun--) {
                    $selected = (isset($gettahun) && $gettahun == $tahun) ? 'selected' : '';
                    echo "<option value=$tahun $selected>$tahun</option>";
                }
                ?>
            </select>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="display: inline-block;width:20vh" onchange="gettabledata('Negeri',this.value)" id="iptNegeri">
                <option value="">Negeri</option>
                @foreach ($ddNegeri as $items)
                    @if($items->U_Negeri_ID != 14 && $items->U_Negeri_ID != 15 && $items->U_Negeri_ID != 16){
                        <option value="{{ $items->U_Negeri_ID }}" {{ ( $items->U_Negeri_ID == $getNegeri) ? 'selected' : '' }}>
                            {{ $items->Negeri }} 
                        </option>
                    }
                    @endif
                @endforeach
            </select>
          </div>
          <div style="padding-top: 10px;">
            <a class="btn btn-primary" onclick="ExportPDF()">Export PDF</a>
          </div>
        </div>
      </div>
    </div>
</div>
            <div id="wholepage">
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-12 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <canvas id="canvas" height="700px" style="padding:20px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <canvas id="canvas2" height="700px" width="600" style="padding:20px;"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="table-responsive scrollbar">
                                <table class="table table-dashboard mb-0 table-borderless fs--1 border-200">
                                    <thead class="bg-light">
                                        <tr class="text-900 align-middle" style="text-align: center;">
                                            <th>Jantina</th>
                                            <th>Bilangan</th>
                                            <th>Peratusan %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jantinas as $key => $jantinaval)
                                        <tr class="align-middle" style="text-align: center;">
                                            @if($jantinaval == 1)
                                                <td>Lelaki</td>
                                            @endif
                                            @if($jantinaval == 2)
                                                <td>Perempuan</td>
                                            @endif
                                            @if($jantinaval == 3)
                                                <td>Lain Lain</td>
                                            @endif
                                            <td>{{$jantinanums[$key]}}</td>
                                            <td>{{number_format(($jantinanums[$key] / $total1) * 100 , 2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-12 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <canvas id="canvas3" height="700px" style="padding:20px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <canvas id="canvas4" height="700px" width="600" style="padding:20px;"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="table-responsive scrollbar">
                                <table class="table table-dashboard mb-0 table-borderless fs--1 border-200">
                                    <thead class="bg-light">
                                        <tr class="text-900 align-middle" style="text-align: center;">
                                            <th>Status Pekebun</th>
                                            <th>Bilangan</th>
                                            <th>Peratusan %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statdafusahs as $key => $statdafusahval)
                                        <tr class="align-middle" style="text-align: center;">
                                            @if($statdafusahval == "KP01")
                                                <td>PEKEBUN KECIL</td>
                                            @endif
                                            @if($statdafusahval == "KP02")
                                                <td>SUAMI PEKEBUN KECIL</td>
                                            @endif
                                            @if($statdafusahval == "KP03")
                                                <td>ISTERI PEKEBUN KECIL</td>
                                            @endif
                                            @if($statdafusahval == "KP04")
                                                <td>ANAK PEKEBUN KECIL</td>
                                            @endif
                                            @if($statdafusahval == "")
                                                <td>TIADA STATUS</td>
                                            @endif
                                            <td>{{$statdafusahnums[$key]}}</td>
                                            <td>@if($total2 != 0){{number_format(($statdafusahnums[$key] / $total2) * 100 , 2)}} @endif</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <canvas id="canvas5" height="700px" width="600" style="padding:20px;"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="table-responsive scrollbar">
                                <table class="table table-dashboard mb-0 table-borderless fs--1 border-200">
                                    <thead class="bg-light">
                                        <tr class="text-900 align-middle" style="text-align: center;">
                                            <th>Kategori Usahawan</th>
                                            <th>Bilangan</th>
                                            <th>Peratusan %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kateusahawans as $key => $kateuasahval)
                                        <tr class="align-middle" style="text-align: center;">
                                            <td>{{$kateuasahval}}</td>
                                            <td>{{$kateusahawannums[$key]}}</td>
                                            <td>{{number_format(($kateusahawannums[$key] / $total3) * 100 , 2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0" style="padding-bottom:30px;padding-top:30px;">
                    <div class="col-lg-12 pe-lg-2 mb-3">
                        <div class="card h-lg-100 overflow-hidden">
                        <canvas id="canvas6" height="700px" style="padding:20px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('script')
<script>
    
    // window.onload = function() {
    //     createchart();
    // }

    function ExportPDF(){
        var page = document.getElementById("wholepage");
        html2canvas(document.getElementById("wholepage"), {
            onrendered: function(canvas) {
                // var img = canvas.toDataURL(); //image data of canvas
                var pdf = new jsPDF('l', 'pt', 'a4');
                // pdf.text(50, 30, );
                var rep = "RISDA eKeusahawanan Statistic Report \n Jenis Insentif -" + document.getElementById("iptJenisInsentif").value + "     Tahun -" + document.getElementById("iptYear").value + "     Negeri -" + document.getElementById("iptNegeri").value;
                console.log(rep);
                pdf.setFontSize(9);
                pdf.text(50, 30, rep);

                for (var i = 0; i <= page.clientHeight/775; i++) {
                    //! This is all just html2canvas stuff
                    var srcImg  = canvas;
                    var sX      = 0;
                    var sY      = 775*i; // start 980 pixels down for every new page
                    var sWidth  = 1330;
                    var sHeight = 770;
                    var dX      = 0;
                    var dY      = 0;
                    var dWidth  = 1330;
                    var dHeight = 770;

                    window.onePageCanvas = document.createElement("canvas");
                    onePageCanvas.setAttribute('width', 1330);
                    onePageCanvas.setAttribute('height', 770);
                    var ctx = onePageCanvas.getContext('2d');
                    // details on this usage of this function: 
                    // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Using_images#Slicing
                    ctx.drawImage(srcImg,sX,sY,sWidth,sHeight,dX,dY,dWidth,dHeight);

                    // document.body.appendChild(canvas);
                    var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);

                    var width         = onePageCanvas.width;
                    var height        = onePageCanvas.clientHeight;

                    //! If we're on anything other than the first page,
                    // add another page
                    if (i > 0) {
                        pdf.addPage(841.89, 595.28); //8.5" x 11" in pts (in*72)
                    }
                    //! now we declare that we're working on that page
                    pdf.setPage(i+1);
                    //! now we add content to that page!
                    pdf.addImage(canvasDataURL, 'PNG', 30, 60, (width*.55), (height));

                }
                // doc.addImage(img, 10, 10);
                pdf.save('RisdaStatistic.pdf');
            }
        });
        
        
        // var doc = new jsPDF("p", "mm", "a4")
        // var elementHandler = {
        // '#ignorePDF': function (element, renderer) {
        //     return true;
        // }
        // };
        // var source = document.getElementById('statpdf');
        // doc.fromHTML(
        //     source,
        //     15,
        //     15,
        //     {
        //     'width': 180,'elementHandlers': elementHandler
        //     }
        // )
        // doc.save('Statistic.pdf')

    }
    
    $( document ).ready(function() {
        createchart();
        $('.loader').hide();
    });

    function gettabledata(type,val){
        $('.loader').show();
        var year = document.getElementById("iptYear").value;
        var jenis = document.getElementById("iptJenisInsentif").value;
        var negeri = document.getElementById("iptNegeri").value;
        location.href = "/dash/apa?tahun="+year+"&id_jenis_insentif="+jenis+"&negeri="+negeri+"";
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     url: "/dash/apa",
        //     type:"GET",
        //     data: {     
        //         tahun:year,
        //         id_jenis_insentif:jenis,
        //         negeri:negeri
        //     },
        //     success: function(data) {
        //         // alert('Rendering mungkin mengambil masa yang lama. Sila tunggu Sebentar.');
        //         // document.open();
        //         // document.write(data);
        //         // document.close();
        //         // createchart();
                
        //     }
        // });
    }

    function createchart(){
        var daerah = <?php echo $daerah; ?>;
        var insentif = <?php echo $insentif; ?>;
        var countinsentif = <?php echo $countinsentif; ?>;
        var jumdaerah = [];
        var juminsen = [];
        var countinsent = [];
        console.log('daerah',daerah);
        var jantina = <?php echo $jantina; ?>;
        var numjantina = <?php echo $jantinanum; ?>;
        var jumjantina = [];
        var jumnumjantina = [];

        var jnsperniagaan = <?php echo $jnsperniagaan; ?>;
        var numjnsperniagaan = <?php echo $jnsperniagaannum; ?>;
        var jumjnsperniagaan = [];
        var jumnumjnsperniagaan = [];

        var statdafusah = <?php echo $statdafusah; ?>;
        var numstatdafusah = <?php echo $statdafusahnum; ?>;
        var jumstatdafusah = [];
        var jumnumstatdafusah = [];

        var kateusahawan = <?php echo $kateusahawan; ?>;
        var numkateusahawan = <?php echo $kateusahawannum; ?>;
        var jumkateusahawan = [];
        var jumnumkateusahawan = [];

        var umurgrp = <?php echo $umurgrp; ?>;
        var numumurgrp = <?php echo $umurgrpnum; ?>;
        var jumumurgrp = [];
        var jumnumumurgrp = [];

        for (var key in daerah) {
            if (Object.prototype.hasOwnProperty.call(daerah, key)) {
                jumdaerah.push(daerah[key]);
            }
        }
        for (var key in insentif) {
            if (Object.prototype.hasOwnProperty.call(insentif, key)) {
                juminsen.push(insentif[key]);
            }
        }
        for (var key in countinsentif) {
            if (Object.prototype.hasOwnProperty.call(countinsentif, key)) {
                countinsent.push(""+countinsentif[key]+" orang");
            }
        }

        for (var key in jantina) {
            if (Object.prototype.hasOwnProperty.call(jantina, key)) {
                if(jantina[key] == 1){
                    jumjantina.push("Lelaki");
                }
                if(jantina[key] == 2){
                    jumjantina.push("Perempuan");
                }
                if(jantina[key] == 3){
                    jumjantina.push("Lain-Lain");
                }
            }
        }
        for (var key in numjantina) {
            if (Object.prototype.hasOwnProperty.call(numjantina, key)) {
                jumnumjantina.push(numjantina[key]);
            }
        }

        for (var key in jnsperniagaan) {
            if (Object.prototype.hasOwnProperty.call(jnsperniagaan, key)) {
                if(jnsperniagaan[key] == "A"){
                    jumjnsperniagaan.push("PENGELUARAN PRODUK MAKANAN");
                }
                if(jnsperniagaan[key] == "B"){
                    jumjnsperniagaan.push("PENGELUARAN PRODUK BUKAN MAKANAN");
                }
                if(jnsperniagaan[key] == "C"){
                    jumjnsperniagaan.push("PENGELUARAN PRODUK PERTANIAN	");
                }
                if(jnsperniagaan[key] == "D"){
                    jumjnsperniagaan.push("PERKHIDMATAN PEMASARAN");
                }
                if(jnsperniagaan[key] == "E"){
                    jumjnsperniagaan.push("PERKHIDMATAN BUKAN PEMASARAN	");
                }
            }
        }
        for (var key in numjnsperniagaan) {
            if (Object.prototype.hasOwnProperty.call(numjnsperniagaan, key)) {
                jumnumjnsperniagaan.push(numjnsperniagaan[key]);
            }
        }

        for (var key in statdafusah) {
            if (Object.prototype.hasOwnProperty.call(statdafusah, key)) {
                if(statdafusah[key] == "KP01"){
                    jumstatdafusah.push("PEKEBUN KECIL");
                }
                if(statdafusah[key] == "KP02"){
                    jumstatdafusah.push("SUAMI PEKEBUN KECIL");
                }
                if(statdafusah[key] == "KP03"){
                    jumstatdafusah.push("ISTERI PEKEBUN KECIL");
                }
                if(statdafusah[key] == "KP04"){
                    jumstatdafusah.push("ANAK PEKEBUN KECIL");
                }
                if(statdafusah[key] == ""){
                    jumstatdafusah.push("TIADA STATUS");
                }
            }
        }
        for (var key in numstatdafusah) {
            if (Object.prototype.hasOwnProperty.call(numstatdafusah, key)) {
                jumnumstatdafusah.push(numstatdafusah[key]);
            }
        }

        for (var key in kateusahawan) {
            if (Object.prototype.hasOwnProperty.call(kateusahawan, key)) {
                jumkateusahawan.push(kateusahawan[key]);
            }
        }
        for (var key in numkateusahawan) {
            if (Object.prototype.hasOwnProperty.call(numkateusahawan, key)) {
                jumnumkateusahawan.push(numkateusahawan[key]);
            }
        }
        
        for (var key in umurgrp) {
            if (Object.prototype.hasOwnProperty.call(umurgrp, key)) {
                if(umurgrp[key] == 1){
                    jumumurgrp.push("BAWAH 20");
                }
                if(umurgrp[key] == 2){
                    jumumurgrp.push("21 - 30");
                }
                if(umurgrp[key] == 3){
                    jumumurgrp.push("31 - 40");
                }
                if(umurgrp[key] == 4){
                    jumumurgrp.push("41 - 50");
                }
                if(umurgrp[key] == 5){
                    jumumurgrp.push("51 - 60");
                }
                if(umurgrp[key] == 6){
                    jumumurgrp.push("61 - 70");
                }
                if(umurgrp[key] == 7){
                    jumumurgrp.push("71 ke atas");
                }
                if(umurgrp[key] == 8){
                    jumumurgrp.push("Tidak diketahui");
                }
            }
        }
        for (var key in numumurgrp) {
            if (Object.prototype.hasOwnProperty.call(numumurgrp, key)) {
                jumnumumurgrp.push(numumurgrp[key]);
            }
        }
    
    console.log(juminsen);

    if(document.getElementById("iptNegeri").value != ''){
        var datas = [
            {
                label: 'Count',
                backgroundColor: ["#027A6A", "#507315", "#443166", "#678731", "#6226C9", "#5F9107","#A978FF","#A6CF61"], 
                data: juminsen
            }
        ];

        var barChartData = {
            labels: jumdaerah,
            datasets: datas
        };
    }

        var datas2 = [
            {
                label: 'Count',
                backgroundColor: ["#6CA8E0", "#2BBDB8", "#456CBA", "#417DAB", "#CCEBEB", "#41CFE8","#87BAE6","#C1C2C7"], 
                data: jumnumjantina
            }
        ];

        var barChartData2 = {
            labels: jumjantina,
            datasets: datas2
        };

        var datas3 = [
            {
                label: 'Count',
                backgroundColor: ["#5B9CCF", "#042C4A", "#4A2894", "#2B10DE", "#262A69", "#33228F","#081C52","#363ED1"], 
                data: jumnumjnsperniagaan
            }
        ];

        var barChartData3 = {
            labels: jumjnsperniagaan,
            datasets: datas3
        };

        var datas4 = [
            {
                label: 'Count',
                backgroundColor: ["#027A6A", "#507315", "#443166", "#678731", "#6226C9", "#5F9107","#A978FF","#A6CF61"], 
                data: jumnumstatdafusah
            }
        ];

        var barChartData4 = {
            labels: jumstatdafusah,
            datasets: datas4
        };

        var datas5 = [
            {
                label: 'Count',
                backgroundColor: ["#027A6A", "#507315", "#443166", "#678731", "#6226C9", "#5F9107","#A978FF","#A6CF61"], 
                data: jumnumkateusahawan
            }
        ];

        var barChartData5 = {
            labels: jumkateusahawan,
            datasets: datas5
        };

        var datas6 = [
            {
                label: 'Count',
                backgroundColor: ["#5B9CCF", "#042C4A", "#4A2894", "#2B10DE", "#262A69", "#33228F","#081C52","#363ED1"], 
                data: jumnumumurgrp
            }
        ];

        var barChartData6 = {
            labels: jumumurgrp,
            datasets: datas6
        };

        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                maintainAspectRatio: false,
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Daerah'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMin: 0
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) { 
                            const sum = juminsen.reduce((partial_sum, a) => partial_sum + a, 0);
                            var multistringText = [tooltipItems.yLabel];
                            var val = (tooltipItems.yLabel/sum *100).toFixed(2);
                            val = "" + val + " %";
                            multistringText[0] = "RM "+tooltipItems.yLabel;
                            multistringText.push(countinsent[tooltipItems.index]);
                            multistringText.push(val);
                            return multistringText;
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        });
        var ctx = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'pie',
            data: barChartData2,
            options: {
                maintainAspectRatio: false,
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Jantina Bilangan'
                }
            }
        });
        var ctx = document.getElementById("canvas3").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData3,
            options: {
                maintainAspectRatio: false,
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Jenis Perniagaan'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMin: 0
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) { 
                            const sum = jumnumjnsperniagaan.reduce((partial_sum, a) => partial_sum + a, 0);
                            var multistringText = [tooltipItems.yLabel];
                            var val = (tooltipItems.yLabel/sum *100).toFixed(2);
                            val = "" + val + "%";
                            multistringText.push(val);
                            return multistringText;
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        });
        var ctx = document.getElementById("canvas4").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'pie',
            data: barChartData4,
            options: {
                maintainAspectRatio: false,
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Status Pekebun Kecil'
                }
            }
        });
        var ctx = document.getElementById("canvas5").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'pie',
            data: barChartData5,
            options: {
                maintainAspectRatio: false,
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Kategori Usahawan'
                }
            }
        });
        var ctx = document.getElementById("canvas6").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'horizontalBar',
            data: barChartData6,
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                indexAxis: 'y',
                scales: {
                    xAxes: [{
                        ticks: {
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }],
                    yAxes: [
                        {
                            reverse: true, // will reverse the scale
                        }
                    ]
                },
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Mengikut Umur'
                }
            }
        });
    };

</script>
@endsection