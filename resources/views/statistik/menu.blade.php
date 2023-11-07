<?php

$menus = [
    ['agama','Agama'],
    ['pekerjaan','Pekerjaan'],
    ['status_penduduk','Status Penduduk'],
    ['warganegara','Kewarganegaraan'],
    ['suku','Suku'],
    ['ktp','Kepemilikan Wajib KTP'],
    ['status_kawin','Status Perkawinan'],
    ['golongan_darah','Golongan Darah'],
    ['pendidikan_kk','Pendidikan dalam KK'],
    ['pendidikan','Pendidikan sedang Ditempuh'],
    ['cacat','Penyandang Cacat'],
    ['umur','Umur']
];

$indicator = isset($_GET['indicator']) ? $_GET['indicator'] : 'pekerjaan';

?>

<h6><i class="fa fa-male"></i> KEPENDUDUKAN</h6>
    <div class="list-group box">
        @foreach($menus as $m)
        <a href="{{route('statistik.penduduk')}}?indicator={{$m[0]}}" class="list-group-item {{ ($m[0]==$indicator) ? 'primary text-white' : '' }}">
        <span class="float-right"><i class="fa fa-chevron-right"></i></span>
        {{$m[1]}}
        </a>
        @endforeach
    </div>
</div>