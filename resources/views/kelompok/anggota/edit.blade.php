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
                
                <div class="col-md-6">
                    <form action="{{route('kelompok.anggota.update',[$data->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 style="display : inline;padding : .25rem .5rem">Edit Anggota Kelompok {{$data->nama}}</h3>
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
                                        <td style="width : 150px">Nama Anggota</td>
                                        <td>{{$data->penduduk->nama}}</td>
                                    </tr>
                                     </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                   
                                   
                                    <div class="form-group">
                                        <label for="">Nomor Anggota</label>
                                        <input type="text" class="form-control" name="no_anggota" required value="{{$data->no_anggota}}">
                                    </div>

                                </div>
                                
                            </div>
                           
                        </div>
                        <div class="box-footer">
                                <a href="{{ url('kelompok/'.$data->kelompok_id) }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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

    $('select[name=penduduk_id]').select2({
        minimumInputLength: 1,
        placeholder : "Pilih Penduduk...",
        width : "100%",                
        ajax: {
            url: '{{route("api.penduduk-kelompok",[$data->id])}}',
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
            return "Nama : " + data.nama + " ["+ data.nik + "]" 
            
            return data.text
        },
        templateResult: (data) => {
            if (data.loading) {
                return data.text
            }

            return "Nama : " + data.nama + " ["+ data.nik + "]" 
        },
    }).on('change',function(){
        data = $(this).select2('data')[0]
        
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