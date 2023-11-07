@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="app">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form method="POST" action="{{ route('surat.update',[$surat->id]) }}">
                        @method("PUT")
                        <div class="box-header">
                        <h3>Form Cetak Surat</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                            {{ csrf_field() }}
                            <div class="form-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul style="margin-bottom:0px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Penduduk</label>
                                            <select required  class="form-control" name="penduduk_id">
                                                <option value="{{$surat->penduduk_id}}">{{$surat->penduduk->nama}}</option>                                    
                                            </select>
                                        </div>
                                    
                                        <div class="row" v-if="penduduk !== null">
                                            <div class="col-md-4">                                
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text"  class="form-control"  id="" readonly v-model="penduduk.tempatlahir">
                                                </div>
                                            </div>    
                                            <div class="col-md-5">                                
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="text"  class="form-control"  id="" readonly v-model="penduduk.tanggal_lahir_format">
                                                </div>
                                            </div>    
                                            <div class="col-md-3">                                
                                                <div class="form-group">
                                                    <label>Umur</label>
                                                    <div class="input-group">
                                                        
                                                        <input type="text" readonly="readonly" v-model="penduduk.umur" class="form-control">
                                                        <div class="input-group-addon">
                                                            <span>Tahun</span>
                                                        </div> 
                                                    </div>
                                                    
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group" v-if="penduduk !== null">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" readonly v-model="penduduk.alamat_sekarang">
                                        </div>
                                        <div class="row" v-if="penduduk !== null">
                                            <div class="col-md-4">                                
                                                <div class="form-group">
                                                    <label>Pendidikan</label>
                                                    <input type="text"  class="form-control"  id="" readonly v-model="penduduk.pendidikan_k_k.nama">
                                                </div>
                                            </div>    
                                            <div class="col-md-5">                                
                                                <div class="form-group">
                                                    <label>Kewarganegaraan</label>
                                                    <input type="text"  class="form-control"  id="" readonly v-model="penduduk.kewarganegaraan.nama">
                                                </div>
                                            </div>    
                                            <div class="col-md-3">                                
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <input type="text"  class="form-control"  id="" readonly v-model="penduduk.agama.nama">                                            
                                                </div>
                                            </div>    
                                        </div>
                                    
                                        <div class="box-divider m-0 mb-2"></div>
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input type="text" class="form-control" name="nomor_surat">
                                            <small><i>Terakhir : {{$surat->jenisSurat->getLastNumber($surat->jenisSurat->id)}}</i></small>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Surat Pengantar <em>(bila ada)</em></label>
                                            <input type="text" class="form-control" name="no_surat_pengantar">
                                        </div>

                                        <div class="form-group">
                                            <label>Keperluan</label>
                                            <textarea name="keperluan" id="" class="form-control">{{$surat->keperluan}}</textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="" class="form-control"></textarea>
                                        </div> --}}
                                        @if(in_array(2,$surat->jenisSurat->tipe))

                                        <div class="form-group">
                                            <label>Berlaku Dari - Sampai</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">                                            
                                                        <input type="text"   name="berlaku_dari" class="form-control datepicker">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">                                            
                                                        <input type="text" class="form-control datepicker" name="berlaku_sampai">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label>Tanggal Surat</label>
                                            <div class="input-group">                                            
                                                <input type="text"   name="tanggal_cetak" class="form-control datepicker" value="{{date('Y-m-d')}}">
                                                <div class="input-group-addon">
                                                    <span><i class="fa fa-calendar"></i></span>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Staff Desa</label>
                                            <select required v-model="staff" @change="changeStaff()" class="form-control" name="staff_id">
                                                @foreach($staff as $item)
                                                    <option value="{{$item->id}}">{{$item->pamong_nama}} ({{ $item->jabatan }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sebagai</label>
                                            <select required v-model="jabatan" class="form-control" name="staff_sebagai_id">
                                                @foreach($staff as $item)
                                                    <option value="{{$item->id}}">{{ $item->jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('surat/cetak') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        {{-- <button name="savenew" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sa÷ve &amp; New</button> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let vm = new Vue({
        el : "#app",
        data : function(){
            return {
                penduduk : @json($penduduk),
                staff : {{$staff[0]->id}},
                jabatan : {{$staff[0]->id}},
            }
        },
        methods : {
            changeStaff() {
                this.jabatan = this.staff
            }
        },
        mounted() {
            $(".datepicker").datepicker({
                autoclose : true,
                format : 'yyyy-mm-dd'
            });
            $self = this;
            $('select[name=penduduk_id]').select2({
                minimumInputLength: 3,
                placeholder : "Pilih Penduduk...",
                width : "100%",                
                ajax: {
                    url: '{{route("api.penduduk")}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'select2'
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
                        return "Memuat Data ..."
                    }

                    return "Nama : " + data.nama + " ["+ data.nik + "]" + " - " + data.dusun.dusun
                },
            }).on('change',function(){
                $self.penduduk = $(this).select2('data')[0]
                console.log($self.penduduk)
            });
        }
    })
    // let $penduduk;
    
</script>
@endpush