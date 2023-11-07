<html>
<head>
    <title>Document</title>
</head>
<style>
    body{
        padding: 2.5%;
    }
    #box{
        width: 25%
    }
    #box img{
        width: 100%;
    }
    #box p{
        text-align: center;
        font-weight: bolder;
    }
</style>
<body onload="print()">
    <div id="box">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data->kode_inventaris, 'C39')}}" alt="barcode" />
        <p style="align:center">{{$data->kode_register}}</p>
    </div>
</body>
</html>

