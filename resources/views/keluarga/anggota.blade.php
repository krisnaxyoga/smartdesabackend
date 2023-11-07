@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a data-toggle="modal" style="color : #fff" data-target="#tambah-anggota-keluarga-modal" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Anggota</a>
            <a href="{{route('keluarga.show',$keluarga->id)}}" class="btn btn-rounded btn-warning"><i class="fa fa-book"></i> Kartu Keluarga</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">

        <form autocomplete="off" action="{{route('penduduk.store')}}" method="POST">
            @csrf
        <div class="row">
       
        </div>
        <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="box">
                        <div class="box-header blue">
                            <h3>{{$keluarga->no_kk}}</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                           
                           <table class="table table-bordered table-striped">
                           <tbody>
                            <tr>
                                <td style="width:200px;">Nomor Kartu Keluarga</td>
                                <td>{{$keluarga->no_kk}}</td>
                            </tr>
                            <tr>
                                <td>Kepala Keluarga</td>
                                <td>{{$keluarga->kepalaKeluarga ? $keluarga->kepalaKeluarga->nama : '-'}}</td>
                            </tr>
                            <tr>
                                <td>Dusun</td>
                                <td>{{$keluarga->dusun ? $keluarga->dusun->dusun : '-'}}</td>
                            </tr>
                            </tbody>
                           </table>

                           <table class="table table-hovered table-bordered table-striped">
                           <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Hubungan</th>
                            </tr>
                           </thead>
                           <tbody>
                               @if(count($keluarga->penduduk) == 0) 
                                    <tr>
                                        <td class="text-center" colspan=7>Tidak ada data.</td>
                                    </tr>
                               @endif
                               @foreach($keluarga->penduduk as $penduduk)
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn  btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-sm"> <i class="fa fa-gear"></i> Action <span class="caret"></span></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/penduduk/{{ $penduduk->id }}/edit">Edit Penduduk</a></li>
                                            <li><a data-toggle="modal" data-target="#pecah-kk-modal" data-id="{{$penduduk->id}}">Pecah KK</a></li>
                                            <li><a data-toggle="modal" data-target="#edit-kk-modal" data-id="{{$penduduk->id}}">Edit Hubungan</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{$penduduk->nik}}</td>
                                <td>{{$penduduk->nama}}</td>
                                <td>{{$penduduk->konversiTgl($penduduk->tanggallahir)}}</td>
                                <td>{{$penduduk->sex == 2 ? 'PEREMPUAN' : 'LAKI - LAKI'}}</td>
                                <td>{{$penduduk->hubungan->nama}}</td>
                            </tr>

                            @endforeach
                            </tbody>
                           </table>
                            
                            
                        </div>
                    
                    </div>
                   

                </div>
            </div>
        </form>
    </div>
</div>
@include('modals.pecah-kk-modal')
@include('modals.edit-kk-modal')
@include('modals.tambah-anggota-keluarga-modal')
@endsection
@push('scripts')
<script type="text/javascript">
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });
</script>
@endpush