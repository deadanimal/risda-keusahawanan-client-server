<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <style type="text/css">
        h4 {
            font-family: "Calibri", sans-serif;
            /* font-size: 11.1px; */
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
            text-align: center
        }

        table,
        td,
        th {
            /* border: 1px solid black; */
            font-family: "Calibri", sans-serif;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            /* font-size: 13px; */
            color: white
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px
        }

        body {
            padding: 0px !important;
        }

        p,
        h2,
        h3 {
            color: white !important;
            font-family: "Calibri", sans-serif;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <div style="position: absolute; left:-90px; top:-90px; z-index:0">
        <img src="image/KATALOG_REDS.pptx-removebg-preview.png" alt="" height="130px">
    </div>

    <div style="position: absolute; left:0px; top:-40px; color:white">
        <h2>
            @if ($usahawan->syarikat != null)

                @if ($usahawan->syarikat->namasyarikat != null)
                    {{ $usahawan->syarikat->namasyarikat }}
                @endif

            @endif
        </h2>
    </div>


    <div style="position: absolute; left:470px; top:-30px">
        <img src="image/KATALOG_REDS.pptx__1_-removebg-preview.png" alt="" height="40px">
    </div>

    <div style="position: absolute; left:530px; top:-40px;">
        <h2 style="color:black !important; font-weight: bold;">
            @if ($usahawan->syarikat != null)
                @if ($usahawan->syarikat->notelefon != null)
                    {{ $usahawan->syarikat->notelefon }}
                @endif
            @endif
        </h2>
    </div>

    <div style="
    position: absolute;
    left:0px;
    top:20px;
    z-index:-1;
    width:300px;
    padding: 30px;
    width: 700px;
    background-image:url(image/KATALOG_REDS.pptx__2_-removebg-preview.png);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-size: 100% 100%;
    ">
        <P style="text-transform: uppercase">ALAMAT :

            @if ($usahawan->perniagaan != null)

                @if ($usahawan->perniagaan->alamat1 != null)
                    {{ $usahawan->perniagaan->alamat1 }},
                @endif
                @if ($usahawan->perniagaan->alamat2 != null)
                    {{ $usahawan->perniagaan->alamat2 }},
                @endif
                @if ($usahawan->perniagaan->alamat3 != null)
                    {{ $usahawan->perniagaan->alamat3 }},
                @endif
                @if ($usahawan->perniagaan->poskod != null)
                    {{ $usahawan->perniagaan->poskod }},
                @endif

                @if ($usahawan->perniagaan->Negeri != null)
                    @if ($usahawan->perniagaan->Negeri->Negeri != null)
                        {{ $usahawan->perniagaan->Negeri->Negeri }}
                    @endif
                @endif



            @endif
        </P>


        <P>GPS LANGITUD/ LONGITUD :
            {{-- @if ($katalog->latitud != null)
                {{ $katalog->latitud }}
            @endif
            /
            @if ($katalog->logitud != null)
                {{ $katalog->logitud }}
            @endif --}}


            @if ($usahawan->perniagaan != null)
                @if ($usahawan->perniagaan->latitud)
                    {{ $usahawan->perniagaan->latitud }}
                @endif
                /
                @if ($usahawan->perniagaan->logitud)
                    {{ $usahawan->perniagaan->logitud }}
                @endif
            @endif
        </P>

        <P>PEMASARAN : </P>

        <p>&nbsp;&nbsp; FACEBOOK :

            @if ($usahawan->perniagaan != null)
                @if ($usahawan->perniagaan->facebook)
                    {{ $usahawan->perniagaan->facebook }}
                @endif
            @endif
        </p>
        <p>&nbsp;&nbsp; INSTAGRAM :
            @if ($usahawan->perniagaan != null)
                @if ($usahawan->perniagaan->instagram)
                    {{ $usahawan->perniagaan->instagram }}
                @endif
            @endif
        </p>
        <p>&nbsp;&nbsp; TWITTER :
            @if ($usahawan->perniagaan != null)
                @if ($usahawan->perniagaan->twitter)
                    {{ $usahawan->perniagaan->twitter }}
                @endif
            @endif
        </p>
        <p>&nbsp;&nbsp; LAMAN WEB :
            @if ($usahawan->perniagaan != null)
                @if ($usahawan->perniagaan->lamanweb)
                    {{ $usahawan->perniagaan->lamanweb }}
                @endif
            @endif
        </p>
        <br>

        <p style="text-decoration: underline; font-weight:bold">{{ $katalog->nama_produk }}</p>
        <table>
            <tr>
                <td style="width: 150px">KANDUNGAN</td>
                <td>:
                    @if ($katalog->kandungan_produk != null)
                        {{ $katalog->kandungan_produk }}
                    @endif

                </td>
            </tr>
            <tr>
                <td>BERAT (NET)</td>

                <td>:
                    @if ($katalog->berat_produk != null)
                        {{ $katalog->berat_produk }} kg
                    @endif

                </td>
            </tr>

            <tr>
                <td>HARGA JUALAN</td>

                <td>: RM
                    @if ($katalog->harga_produk != null)
                        {{ $katalog->harga_produk }}
                    @endif

                </td>
            </tr>
        </table>

    </div>



    <div style="position: absolute; left:750px; top:40px">
        <img src="image/KATALOG_REDS.pptx__3_-removebg-preview.png" alt="" height="320px">
    </div>

    @if ($katalog->gambar_url != null)
        {{-- {{ $katalog->harga_produk }} --}}

        <div style="
        position: absolute;
        left:770px;
        top:35px;
        width:250px;
        height: 300px;
        background-image:url({{ $katalog->gambar_url }});
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-size: 100% 100%;
        text-align:center
        ">
            {{-- <img src="{{$katalog->gambar_url}}" alt="" height="200px"> --}}
        </div>
    @endif


    <div style="
    position: absolute;
    left:790px;
    top:300px;
    z-index:2;
    width:200px;
    padding: 10px;
    background-image:url(image/KATALOG_REDS.pptx__2_-removebg-preview.png);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-size: 100% 100%;
    text-align:center
    ">
        <p>
            <i>
                @if ($katalog->nama_produk != null)
                    {{ $katalog->nama_produk }}
                @endif

            </i>
        </p>

    </div>







</body>
