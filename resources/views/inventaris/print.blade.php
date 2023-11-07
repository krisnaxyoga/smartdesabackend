<html>
<head>
    <title>Document</title>
</head>
<style>
    body{
        padding: 3.5%;
    }
    #box{
        width: 25%;
        margin: 25px;
    }
    #box img{
        width: 100%;
        height: 30px;
    }
    #box p{
        text-align: center;
        font-weight: bolder;
    }
    .flex-container {
        display: flex;
        flex-wrap: wrap;
    }
</style>
<body onload="print()">
    <div class="flex-container">
        @foreach($data as $list)
            <div id="box">
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($list->kode_register, 'C39')}}" alt="barcode" />
                <p style="align:center">{{$list->kode_register}}</p>
            </div>
        @endforeach
    </div>
</body>
</html>

