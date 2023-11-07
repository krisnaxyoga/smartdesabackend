@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('bantuan.index')}}" class="btn btn-rounded btn-default"><i class="fa fa-arrow-left"></i> Kembali</a> 
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
                                <h3 style="display : inline;padding : .25rem .5rem">Detail {{$data->nama}}</h3>
                                </div>
                                <div class="pull-right">
                                <a style="display : inline;padding : .25rem .5rem;color : #fff" href="{{route('bantuan.tambah-peserta',[$data->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Peserta</a> 
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
                                        <td style="width : 150px">Nama Program</td>
                                        <td>{{$data->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width : 150px">Sasaran Peserta</td>
                                        <td>{{$data->analisisRefSubjek->subjek}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width : 150px">Masa Berlaku</td>
                                        <td>{{date('d M Y',strtotime($data->sdate))}} - {{date('d M Y',strtotime($data->edate))}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width : 150px">Keterangan</td>
                                        <td>{{$data->ndesc ?: '-'}}</td>
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
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Aksi</th>
                                        <th rowspan="2">No. KK</th>
                                        <th rowspan="2">No. Kartu Peserta</th>
                                        <th rowspan="2">Kepala Keluarga</th>
                                        <th rowspan="2">Alamat</th>
                                        <th colspan="5" class="text-center">Identitas di Kartu Peserta</th>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->peserta as $key => $peserta)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn  btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-sm"> <i class="fa fa-gear"></i> Action <span class="caret"></span></span></button>
                                                <ul class="dropdown-menu">
                                                        <li><a href="{{route('bantuan.peserta.edit',[$data->id,$peserta->id])}}">Edit Peserta</a></li>
                                                        <li><a href="#" class="text-danger delete-peserta" data-peserta="{{$peserta->id}}">Hapus Peserta</a></li>

                                                </ul>
                                            </div>
                                        
                                        </td>
                                        <td>
                                            {{$peserta->data_peserta->keluarga != null ? $peserta->data_peserta->keluarga->no_kk : '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->no_id_kartu ?: '-'}}
                                        </td>
                                        <td>
                                            {{ $peserta->data_peserta->keluarga != null ? $peserta->data_peserta->keluarga->kepalaKeluarga != null ? $peserta->data_peserta->keluarga->kepalaKeluarga->nama : '-' : '-'}}
                                        </td>
                                        <td>
                                            {{ $peserta->data_peserta->keluarga != null ? $peserta->data_peserta->keluarga->kepalaKeluarga != null ? $peserta->data_peserta->keluarga->kepalaKeluarga->alamat : '-' : '-'}}                                         
                                        </td>
                                        <td>
                                            {{$peserta->kartu_nik ?: '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->kartu_nama ?: '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->kartu_tempat_lahir ?: '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->kartu_tanggal_lahir ?: '-'}}
                                        </td>
                                        <td>
                                            {{$peserta->kartu_alamat ?: '-'}}
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
    $(".delete-peserta").on('click',function(e) {
        $pesertaId = $(this).data('peserta');

        if(confirm("Apakah anda ingin menghapus data peserta ini?")) {
            $.ajax({
                url : "{{url('bantuan/peserta/'.$data->id)}}/"+$pesertaId,
                method : "POST",
                data : {
                    '_token' : "{{csrf_token()}}",
                    '_method' : "DELETE"
                },
                success : function(){
                    location.reload();
                }
            })
        }
    })
</script>
@endpush