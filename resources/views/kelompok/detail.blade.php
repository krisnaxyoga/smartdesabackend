@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('kelompok.index')}}" class="btn btn-rounded btn-default"><i class="fa fa-arrow-left"></i> Kembali</a> 
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">


      
        <div class="row">
       
        </div>
        <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 style="display : inline;padding : .25rem .5rem">Detail Kelompok {{$data->nama}}</h3>
                                </div>
                                <div class="pull-right">
                                <a style="display : inline;padding : .25rem .5rem;color : #fff" href="{{route('kelompok.tambah-anggota',[$data->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Anggota</a> 
                            </div>
                            &nbsp;
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body"> 
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                    <tbody>
                                    
                                     <tr>
                                         <td style="width : 150px">Nama Kelompok</td>
                                         <td>{{$data->nama}}</td>
                                    </tr>
                                 
                                    <tr>
                                        <td style="width : 150px">Keterangan</td>
                                        <td>{{$data->keterangan !== null ? $data->keterangan : '-'}}</td>
                                    </tr>
                                     </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <hr>
                            <h6>Daftar Peserta Program</h6>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>NIK</th>
                                        <th>No. Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th>Alamat</th>
                                        <th>Umur (Tahun)</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->anggota as $key => $peserta)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn  btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-sm"> <i class="fa fa-gear"></i> Action <span class="caret"></span></span></button>
                                                <ul class="dropdown-menu">
                                                        <li><a href="{{route('kelompok.anggota.edit',[$data->id,$peserta->id])}}">Edit Anggota</a></li>
                                                        <li><a href="#" class="text-danger delete-anggota" data-id="{{$peserta->penduduk_id}}" data-nama="{{$peserta->penduduk->nama}}">Hapus Anggota</a></li>

                                                </ul>
                                            </div>
                                        
                                        </td>
                                        <td>
                                            <a href="{{route('penduduk.show',[$peserta->penduduk_id])}}" class="link">{{$peserta->penduduk->nik ? $peserta->penduduk->nik : '-'}}</a>
                                            
                                        </td>
                                        <td>
                                            {{$peserta->no_anggota ? $peserta->no_anggota : '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->penduduk->nama ? $peserta->penduduk->nama : '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->penduduk->alamat_sekarang ? $peserta->penduduk->alamat_sekarang : '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->penduduk->umur}}
                                        </td>
                                        <td>
                                            {{$peserta->penduduk->sex == 1 ? "Laki Laki" : "Perempuan"}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                                <br>
                        </div>
                    
                    </div>
                   

                </div>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });

    $(".delete-anggota").on('click',function(){
        $nama = $(this).attr('data-nama');
        $id = $(this).attr('data-id');
        
        if(confirm("Apakah anda yakin ingin menghapus "+$nama+" dari {{$data->nama}} ? ")) {
            window.location = "{{url('kelompok/'.$data->id.'/anggota/')}}/"+$id+"/remove";
        }   
    })
</script>
@endpush