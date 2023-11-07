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
                    <form method="POST" action="{{ url('surat/cetak/'.$jenis_surat->id) }}">
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
                                                <option value=""></option>
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
                                            <label>Nomor Surat Kadus <em>(bila ada)</em></label>
                                            <input type="text" class="form-control" name="no_surat_pengantar" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Surat Referensi Kadus <em>(bila ada)</em></label>
                                            <div class="input-group">
                                                <input type="text" name="tanggal_verifikasi" class="form-control datepicker-form">
                                                <div class="input-group-addon">
                                                    <span><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input type="text" class="form-control" name="nomor_surat">
                                            <small><i>Terakhir : {{$jenis_surat->getLastNumber($jenis_surat->id)}}</i></small>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Surat</label>
                                            <div class="input-group">
                                                <input type="text"   name="tanggal_cetak" class="form-control datepicker-form" value="{{date('Y-m-d')}}">
                                                <div class="input-group-addon">
                                                    <span><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="" class="form-control"></textarea>
                                        </div> --}}
                                        @if(in_array(1,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Keperluan</label>
                                            <textarea name="keperluan" id="" class="form-control"></textarea>
                                        </div>
                                        @endif
                                        @if(in_array(9,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Alasan Pindah</label>
                                            <textarea name="keperluan" id="" class="form-control"></textarea>
                                        </div>
                                        @endif
                                        @if(in_array(5,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Jenis Usaha</label>
                                            <input type="text" class="form-control" name="jenis_usaha">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Usaha</label>
                                            <input type="text" class="form-control" name="nama_usaha">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Usaha</label>
                                            <input type="text" class="form-control" name="alamat_usaha">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Dusun</label>
                                                <input type="text" class="form-control" name="nama_dusun">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Desa</label>
                                                <input type="text" class="form-control" name="nama_desa">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kecamatan</label>
                                                <input type="text" class="form-control" name="nama_kecamatan">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Kabupaten</label>
                                                <input type="text" class="form-control" name="nama_kabupaten">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Provinsi</label>
                                                <input type="text" class="form-control" name="nama_provinsi">
                                            </div>
                                        </div>
                                        <br>
                                        @endif
                                        @if(in_array(6,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Nama Pasangan</label>
                                            <input type="text" class="form-control" name="nama_pasangan">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Perkawinan</label>
                                            <input type="text" class="form-control" name="tahun_kawin">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi Perkawinan</label>
                                            <input type="text" class="form-control" name="lokasi_kawin">
                                        </div>
                                        @endif
                                        @if(in_array(3,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Jenis Acara</label>
                                            <input type="text" class="form-control" name="jenis_acara">
                                        </div>
                                        @endif
                                        @if(in_array(7,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Status Pernyataan</label>
                                            <input type="text" class="form-control" name="pernyataan_status">
                                        </div>
                                        @endif
                                        @if(in_array(10, $jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Tahun Menetap</label>
                                            <input type="number" value="{{ date('Y') }}" class="form-control" name="tahun_menetap">
                                        </div>
                                        @endif
                                        @if(in_array(2,$jenis_surat->tipe))

                                        <div class="form-group">
                                            <label>Berlaku Dari - Sampai</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text"   name="berlaku_dari" class="form-control datepicker-form">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-form" name="berlaku_sampai">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(in_array(9,$jenis_surat->tipe))
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No KK</label>
                                                    <input type="text" name="no_kk" v-if="penduduk != null" v-model="penduduk.keluarga == null ? penduduk.no_kk_sebelumya : penduduk.keluarga.no_kk" class="form-control ">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal KK</label>
                                                    <div class="input-group">
                                                        <input type="text"   name="tanggal_kk" class="form-control datetimepicker-form">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <label for=""><strong>Informasi Pindah</strong></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <input type="text" class="form-control" name="pindah_prov">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <input type="text" class="form-control" name="pindah_kab">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <input type="text" class="form-control" name="pindah_kec">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Desa</label>
                                                    <input type="text" class="form-control" name="pindah_desa">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Pindah</label>
                                                    <div class="input-group">
                                                        <input type="text"   name="tanggal_pindah" class="form-control datetimepicker-form">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(in_array(4,$jenis_surat->tipe))

                                        <div class="form-group">
                                            <label>Berlaku Dari - Sampai</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text"   name="berlaku_dari" class="form-control datetimepicker-form">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datetimepicker-form" name="berlaku_sampai">
                                                        <div class="input-group-addon">
                                                            <span><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(in_array(11,$jenis_surat->tipe))
                                        <div class="form-group">
                                            <label>Tanggal Meninggal</label>
                                            <div class="input-group">                                            
                                                <input type="text" name="tanggal_meninggal" class="form-control datetimepicker-form">
                                                <div class="input-group-addon">
                                                    <span><i class="fa fa-calendar"></i></span>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi Meninggal</label>
                                            <input type="text" name="lokasi_meninggal" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Penyebab Meninggal</label>
                                            <input type="text" name="penyebab_meninggal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pelapor</label>
                                            <input type="text" name="nama_pelapor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>NIK Pelapor</label>
                                            <input type="text" name="nik_pelapor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Hubungan dengan yang Meninggal</label>
                                            <input type="text" name="hubungan_pelapor" class="form-control">
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label>Tanda Tangan</label>
                                            <select required v-model="staff" @change="changeStaff()" class="form-control" name="staff_id">
                                                @foreach($staff as $item)
                                                    <option value="{{$item->id}}">{{$item->pamong_nama}} ({{ $item->jabatan }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>Sebagai</label>
                                            <select required v-model="jabatan" class="form-control" name="staff_sebagai_id">
                                                @foreach($staff as $item)
                                                    <option value="{{$item->id}}">{{ $item->jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                    </div>
                    @if(in_array(9,$jenis_surat->tipe))
                    <div class="box-divider m-0"></div>
                    <div class="box-header">
                        <h3>Anggota Pindah</h3>
                    </div>
                    <div class="box-divider m-0"></div>

                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Status</th>
                                    <th>Pendidikan</th>
                                    <th>KTP</th>
                                    <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="anggota.length == 0">
                                    <td colspan="8" class="text-center">Tidak ada anggota</td>
                                </tr>
                                <tr v-for="(item,i) in anggota">
                                    <td><a href="#" class="btn btn-danger" @click="deleteAnggota(i)"><i class="fa fa-times"></i></a></td>
                                    <td>@{{item.nama}}</td>
                                    <td>@{{item.sex == 0 ? 'P' : 'L'}}</td>
                                    <td>@{{item.umur}} Tahun</td>
                                    <td>@{{item.status_kawin.nama}}</td>
                                    <td>@{{item.pendidikan_k_k.nama}}</td>
                                    <td>@{{item.nik}}</td>
                                    <td><input type="text" class="form-control" :name="'ket['+i+']'">
                                        <input type="hidden" :name="'anggota_id['+i+']'" :value='item.id'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <a href="#" @click='tambahAnggota()' class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Anggota</a>
                        </div>

                    </div>
                    @endif
                    <div class="box-footer">
                        <a href="{{ url('surat/cetak') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        {{-- <button name="savenew" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sa÷ve &amp; New</button> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>
        @include('modals.tambah_anggota_surat_pindah')

    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let vm = new Vue({
        el : "#app",
        data : function(){
            return {
                penduduk : null,
                anggota : [],
                anggota_dummy : null,
                staff : {{$staff[0]->id}},
                jabatan : {{$staff[0]->id}},
            }
        },
        methods : {
            changeStaff() {
                this.jabatan = this.staff
            },
            tambahAnggota() {
                $("#tambah-anggota-pindah-modal").modal('show')
            },
            deleteAnggota(i) {
                console.log("HEHE")
                this.anggota.splice(i,1);
            },
            addAnggota(){
                this.anggota.push(this.anggota_dummy);
                $('#tambah-anggota-pindah-modal select[name=anggota_id]').select2('destroy');
                this.initAnggotaSelect2();

                $("#tambah-anggota-pindah-modal").modal('hide')

            },
            initAnggotaSelect2(){
                $('#tambah-anggota-pindah-modal select[name=anggota_id]').select2({
                    minimumInputLength: 3,
                    placeholder : "Pilih Penduduk...",
                    width : "100%",
                    ajax: {
                        url: '{{route("api.penduduk")}}?desa_id={{auth()->user()->desa_id}}&except=',
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
                    // $self.penduduk = $(this).select2('data')[0]
                    $self.anggota_dummy = $(this).select2('data')[0]
                    console.log($(this).select2('data')[0])
                })
            }
        },
        mounted() {
            $self = this;
            this.initAnggotaSelect2();

            $(".datepicker-form").datepicker({
                autoclose : true,
                format : 'yyyy-mm-dd'
            });
            $(".datetimepicker-form").datepicker({
                autoclose : true,
                format : 'yyyy-mm-dd'
            });

            $('select[name=penduduk_id]').select2({
                minimumInputLength: 3,
                placeholder : "Pilih Penduduk...",
                width : "100%",
                ajax: {
                    url: '{{route("api.penduduk")}}?desa_id={{auth()->user()->desa_id}}',
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
                @if(in_array(9,$jenis_surat->tipe))

                @endif
                console.log($self.penduduk)
            });
        }
    })
    // let $penduduk;

</script>
@endpush