@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
{{-- <a href="{{route('bantuan.index')}}" class="btn btn-rounded btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>  --}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">


      
        <div class="row">
       
        </div>
        <div class="row">
                
                <div class="col-md-12">
                    <form action="{{route('bantuan.peserta.store',[$data->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 style="display : inline;padding : .25rem .5rem">Tambah Peserta {{$data->nama}}</h3>
                                </div>
                                <div class="pull-right">
                                {{-- <a style="display : inline;padding : .25rem .5rem;color : #fff" href="{{route('bantuan.tambah-peserta',[$data->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Peserta</a>  --}}
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
                                        <td>{{$data->ndesc !== null ?: '-'}}</td>
                                    </tr>
                                     </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <hr>
                            <h6>Daftar Peserta Program</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK / Nama Penduduk</label>
                                        <select required  class="form-control" name="peserta_id">
                                            <option value=""></option>
                                        {{-- @foreach($pendudukList as $peserta)
                                            <option value="{{$peserta->id}}">Nama : {{$peserta->nama}} [{{$peserta->nik}}] - {{$peserta->dusun->dusun}}</option>
                                        @endforeach --}}
                                        </select>
                                        <input type="hidden" name="peserta">
                                    </div>
                                    <div class="form-group detail-penduduk" style="display : none">
                                        <label for="">Alamat Keluarga</label>
                                        <input type="text" class="form-control" readonly name="alamat_keluarga">
                                    </div>
                                    <div class="form-group detail-penduduk" style="display : none">
                                        <label for="">Tempat Tanggal Lahir (Umur) KK</label>
                                        <input type="text" class="form-control" readonly name="ttl">
                                    </div>
                                    <div class="form-group detail-penduduk" style="display : none">
                                        <label for="">Pendidikan KK</label>
                                        <input type="text" class="form-control" readonly name="pendidikan_kk">
                                    </div>
                                    <div class="form-group detail-penduduk" style="display : none">
                                        <label for="">Warganegara / Agama KK</label>
                                        <input type="text" class="form-control" readonly name="agama">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nomor Kartu Peserta</label>
                                        <input type="text" class="form-control" name="no_id_kartu" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Foto Kartu Peserta</label>
                                        <input type="file" style="display : none" name="profile" id="kartuPict">
                                        <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                                        <img src="#" alt="" class="dummy-avatar" id="dummy">
                                        
                                        <small>Kosongkan jika tidak ingin mengunggah gambar</small>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for=""><b>Identitas Kartu Peserta</b></label>
                                    <div class="form-group">
                                        <label for="">NIK</label>
                                        <input type="text" class="form-control" name="kartu_nik" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" name="kartu_nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="kartu_tempat_lahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Lahir</label>
                                        <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                                <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="kartu_tanggal_lahir" required>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control" name="kartu_alamat" required>
                                    </div>
                                </div>
                            </div>
                           
                                <br>
                        </div>
                        <div class="box-footer">
                                <a href="{{ url('bantuan') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                {{-- <button name="savenew" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sa÷ve &amp; New</button> --}}
                            </div>
                    </div>
                    </form>
                   

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

    let data = {};

    $('select[name=peserta_id]').select2({
        minimumInputLength: 1,
        placeholder : "Pilih Penduduk...",
        width : "100%",                
        ajax: {
            url: '{{route("api.pendudukNonBantuan",[$data->id])}}',
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public'
                }

            // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: (data) => {
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                  results: data
                }
              }
        },
        escapeMarkup: (markup) => markup, // let our custom formatter work
        templateSelection: (data) => {
            if (typeof data.nama !== "undefined")
            return "Nama : " + data.nama + " ["+ data.nik + "]" + " - " + data.dusun.dusun
            
            return data.text
        },
        templateResult: (data) => {
            if (data.loading) {
                return data.text
            }

            return "Nama : " + data.nama + " ["+ data.nik + "]" + " - " + data.dusun.dusun
        },
    }).on('change',function(){
        data = $(this).select2('data')[0]
        $("[name=peserta][type=hidden]").val(data.id);
        $(".detail-penduduk").show();
        $(".detail-penduduk [name=alamat_keluarga]").val(data.dusun.dusun)

        $(".detail-penduduk [name=ttl]").val(data.tempatlahir + " " + data.tanggal_lahir_format + " (" + data.umur + " Tahun)")
        $(".detail-penduduk [name=pendidikan_kk]").val(data.pendidikan_k_k.nama)
        $(".detail-penduduk [name=agama]").val(data.kewarganegaraan.nama + " / " + data.agama.nama)
    });

    
    $("button[name=browseImg]").click(function(){
        $("#kartuPict").trigger('click')
    })

    $("#kartuPict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('dummy');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    })

</script>
@endpush