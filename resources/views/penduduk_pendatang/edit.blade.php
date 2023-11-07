@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="bg-detail">
        <form action="{{route('penduduk-pendatang.update',[$duktang->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="referrer" value="{{ request()->server('HTTP_REFERER') }}" />
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-header">
                            <h3>Form Foto</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="preview-img">
                                <img src="{{ $duktang->photo !== null && $duktang->photo != ''  ? 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/'.$duktang->photo : asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input name="photo" type="file" style="display : none" id="profilePict">
                            <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3>Foto KTP</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="preview-img">
                                <img src="{{$duktang->photo_ktp !== null && $duktang->photo_ktp != ''  ? 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/'.$duktang->photo_ktp : asset('images/dummy-landscape.png')}}" width="100%" class="dummy-avatar" id="photoKtp">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input name="photo_ktp" type="file" style="display : none"  id="ktpPict">
                            <button name="browseKtp"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                <div class="box">
                        <div class="box-header primary">
                            <h3>Form Penduduk Pendatang</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap <span class="text-danger">*</span>
                                            <em><small>(Tanpa Gelar)</small></em>
                                        </label>
                                        <input name="nama" value="{{$duktang->nama}}" placeholder="Nama" type="text" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Golongan Darah</label>
                                        <select name="golongan_darah_id" value="{{old('golongan_darah_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Golongan Darah</option>
                                            @foreach($listGolonganDarah as $list)
                                                <option {{$list->id == $duktang->golongan_darah_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Keluarga</label>
                                        <select name="status_keluarga_id" value="{{old('status_keluarga_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Keluarga</option>
                                            @foreach($listHubungan as $list)
                                                <option {{$list->id == $duktang->status_keluarga_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Perkawinan</label>
                                        <select name="status_kawin_id" value="{{old('status_kawin_id')}}" id="" class="form-control">
                                            <option value="">Pilih Status Perkawinan</option>
                                            @foreach($listKawin as $list)
                                                <option {{$list->id == $duktang->status_kawin_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">NIK <span class="text-danger">*</span></label>
                                        <input name="nik" value="{{$duktang->nik}}" type="text" required class="form-control" placeholder="NIK">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Agama</label>
                                        <select name="agama_id" value="{{old('agama_id')}}" id="" class="form-control">
                                                <option value="" selected disabled>Pilih Agama</option>
                                                @foreach($listAgama as $list)
                                                <option {{$list->id == $duktang->agama_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No HP</label>
                                        <input type="text" name="no_hp" value="{{$duktang->no_hp}}" placeholder="No. HP" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No. KK</label>
                                        <input type="text" class="form-control" name="no_kk" value="{{$duktang->no_kk}}" placeholder="No. KK">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="sex_id" value="{{old('sex_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            @foreach($listSex as $list)
                                                <option {{$list->id == $duktang->sex_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="{{$duktang->email}}" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header primary">
                            <h3>Data Kelahiran</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" value="{{$duktang->tempat_lahir}}" required class="form-control" placeholder="Tempat Lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button  data-toggle="datepicker"  data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            <input name="tanggal_lahir" value="{{$duktang->tanggal_lahir}}" placeholder="Tanggal Lahir" type="text" class="form-control datepicker-input" id="datepicker" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header primary">
                            <h3>Pendidikan dan Pekerjaan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pendidikan <span class="text-danger">*</span></label>
                                        <select required name="pendidikan_id" value="{{old('pendidikan_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pendidikan</option>
                                            @foreach($listPendidikanKK as $list)
                                                <option {{$list->id == $duktang->pendidikan_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pekerjaan <span class="text-danger">*</span></label>
                                        <select required name="pekerjaan_id" value="{{old('pekerjaan_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pekerjaan</option>
                                            @foreach($listPekerjaan as $list)
                                                <option {{$list->id == $duktang->pekerjaan_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header primary">
                            <h3>Data Alamat Asal dan Kewarganegaraan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Status Warga Negara</label>
                                        <select name="warga_negara_id" value="{{old('warga_negara_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Warganegara</option>
                                            @foreach($listWarganegara as $list)
                                                <option {{$list->id == $duktang->warga_negara_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Kecamatan Asal</label>
                                        <input type="text" readonly class="form-control" name="kecamatan" value="{{$asal->district}}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alamat Asal <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="alamat_asal" value="{{$duktang->alamat_asal}}" >
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Kabupaten Asal</label>
                                        <input type="text" readonly class="form-control" name="kabupaten" value="{{$asal->regency}}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <label>Desa Asal</label>
                                        <select required  class="form-control" name="desa_asal">
                                            <option value="{{$duktang->desa_asal_id}}">{{$duktang->desa_asal->name}}</option>
                                        </select>
                                        <input type="hidden" name="desa_asal_id" value="{{$duktang->desa_asal_id}}">
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Provinsi Asal</label>
                                        <input type="text" readonly class="form-control" name="provinsi" value="{{$asal->province}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header primary">
                            <h3>Data Alamat Tinggal</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alasan Domisili <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Alasan Domisili" required class="form-control" name="alasan_domisili" value="{{$duktang->alasan_domisili}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Tempat Tinggal</label>
                                        <select name="jenis_tempat_tinggal_id"  id="" class="form-control">
                                        <option value="" selected disabled>Pilih Jenis Tempat Tinggal</option>
                                            @foreach($listTempatTinggal as $tempat)
                                                <option {{$tempat->id == $duktang->jenis_tempat_tinggal_id ? 'selected' : ''}} value="{{$tempat->id}}">{{$tempat->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alamat Tinggal <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" placeholder="Alamat Tinggal" name="alamat_tinggal" value="{{$duktang->alamat_tinggal}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Surat Yang Dibawa <span class="text-danger">*</span></label>
                                        <input type="text" name="surat"  value="{{$duktang->surat}}" required class="form-control" placeholder="Contoh KTP" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dusun Tinggal</label>
                                        <select name="dusun_tinggal_id"  id="" class="form-control">
                                            <option value="" selected disabled>Pilih Dusun Tinggal</option>
                                            @foreach($listDusun as $dusun)
                                                <option {{$dusun->id == $duktang->dusun_tinggal_id ? 'selected' : ''}} value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Verifikasi <span class="text-danger">*</span></label>
                                        <div class="my-auto">
                                            <label class="md-check checkbox-inline mr-4">
                                                <input type="radio" name="status_verifikasi" value="tidak" {{$duktang->status_verifikasi == 'tidak' ? 'checked' : ''}}> <i class="blue"></i> Tidak</label>
                                            <label class="md-check checkbox-inline mb-2">
                                                <input type="radio" name="status_verifikasi" value="ya" {{$duktang->status_verifikasi == 'ya' ? 'checked' : ''}}> <i class="blue"></i> Ya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header primary">
                            <h3>Informasi STLD</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No. Surat Desa/Kelurahan <span class="text-danger">*</span></label>
                                        <input name="no_surat_desa" value="{{$duktang->no_surat_desa}}" type="text" required class="form-control" placeholder="No. Surat Desa/Kelurahan">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tangada Tangan/ Atas Nama</label>
                                        <select name="staff_id" value="{{old('warga_negara_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Staff Desa</option>
                                            @foreach($listStaff as $list)
                                                <option {{$list->id == $duktang->staff_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->pamong_nama}} ( {{$list->jabatan}} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Melapor <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button  data-toggle="datepicker"  data-target="#tanggal_melapor" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            <input type="text" value="{{$duktang->tanggal_melapor}}" class="form-control datepicker-input" id="tanggal_melapor" required autocomplete="off" name="tanggal_melapor" placeholder="Tanggal Melapor">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Berlaku STLD <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button  data-toggle="datepicker"  data-target="#masa_berlaku" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            <input type="text" value="{{$duktang->masa_berlaku}}" class="form-control masa_berlaku " id="masa_berlaku" required autocomplete="off" name="masa_berlaku" placeholder="Masa Berlaku">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <a  href="{{route('penduduk-pendatang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')

<script type="text/javascript">

    $("button[name=browseImg]").click(function(){
        $("#profilePict").trigger('click')
    });

    $("#profilePict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('dummy');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    });

    $("button[name=browseKtp]").click(function(){
        $("#ktpPict").trigger('click')
    });

    $("#ktpPict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('photoKtp');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    });
    $("#datepicker").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
    });
    $("#tanggal_melapor").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
    });
    $(".masa_berlaku").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
    });

    $('select[name=desa_asal]').select2({
        minimumInputLength: 1,
        placeholder : "Pilih Desa Asal...",
        width : "100%",
        ajax: {
            url: '{{route("api.villageDuktang")}}',
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
            if (typeof data.name !== "undefined")
            return data.name

            return data.text
        },
        templateResult: (data) => {
            if (data.loading) {
                return data.text
            }

            return data.name
        },
    }).on('change',function(){
        data = $(this).select2('data')[0]
        $("[name=desa_asal_id][type=hidden]").val(data.id);
        $(".detail-asal [name=kecamatan]").val(data.district)
        $(".detail-asal [name=kabupaten]").val(data.regency)
        $(".detail-asal [name=provinsi]").val(data.province)

    });

    $("#status_keluarga_detail").select2({
        placeholder : "Pilih",
        width : '100%'
    })
</script>
@endpush
