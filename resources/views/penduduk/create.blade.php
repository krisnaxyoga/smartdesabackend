@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('penduduk.store')}}" method="POST">
            @csrf
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
                                    <img src="{{asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy">
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="file" style="display : none" name="profile" value="{{old('profile')}}" id="profilePict">
                                <button name="browseImg" value="{{old('browseImg')}}"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                            </div>
                        </div>
                </div>
                <div class="col-md-9">
                    <div class="box">
                        {{-- <div class="box-header blue">
                            <h3>Form Biodata Penduduk</h3>
                        </div> --}}
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dusun</label>
                                        <select name="dusun_id"  id="dusun_id" class="form-control">
                                            @foreach($listDusun as $dusun)
                                                <option value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">NIK <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="nik" value="{{old('nik')}}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap <span class="text-danger">*</span> 
                                            <em><small>(Tanpa Gelar)</small></em> 
                                        </label>
                                        <input type="text" required class="form-control" name="nama" value="{{old('nama')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Status Kepemilikan KTP <span class="text-danger">*</span></label>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Wajib KTP</th>
                                                    <th>KTP Elektronik</th>
                                                    <th>Status Rekam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="">
                                                            <select required name="ktp_el" value="{{old('ktp_el')}}" id="" class="form-control">
                                                                <option value="" selected disabled>Pilih KTP-EL</option>
                                                                <option value="1">BELUM</option>
                                                                <option value="2">KTP-EL</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <select required name="status_rekam_id" value="{{old('status_rekam_id')}}" id="" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Rekam</option>
                                                                    @foreach($listKtpStatus as $list)
                                                                        <option value="{{$list->id}}">{{$list->nama}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nomor KK Sebelumnya <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required name="no_kk_sebelumnya" value="{{old('no_kk_sebelumnya')}}" >
                                    </div>
                                </div> --}}
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="">Hubungan Dalam Keluarga</label>
                                        <select name="kk_level" value="{{old('kk_level')}}" id="kk_level" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listHubungan as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="sex" value="{{old('sex')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih ...</option>
                                            @foreach($listSex as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Agama</label>
                                        <select name="agama_id" value="{{old('agama_id')}}" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listAgama as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Suku</label>
                                        <select name="suku_id" value="{{old('suku_id')}}" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listSuku as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" value="{{old('status')}}" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listStatus as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Data Kelahiran</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Nomor Akta Kelahiran</label>
                                        <input type="text" class="form-control" name="akta_lahir" value="{{old('akta_lahir')}}" >
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Tempat Lahir<span class="text-danger">*</span> 
                                        </label>
                                        <input type="text" required class="form-control" name="tempatlahir" value="{{old('tempatlahir')}}">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tanggal Kelahiran</label>
                                    <div class="row">
                                        <div class="col-md-4" style="padding-right: 7.5px">
                                            <select required name="birth_date" value="{{old('birth_date')}}" class="form-control">
                                                @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 7.5px; padding-right: 7.5px">
                                            <select required name="birth_month" value="{{old('birth_month')}}" class="form-control">
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 7.5px">
                                            <select required name="birth_year" value="{{old('birth_year')}}" class="form-control">
                                                @for ($i = date('Y'); $i >= (date('Y') - 100); $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Waktu Kelahiran</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="timepicker" data-target="#timepicker" class="btn btn-default btn-timepicker" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                        <input type="text"  class="form-control timepicker-input" id="timepicker" data-toggle="timepicker" data-target="#timepicker" autocomplete="off" name="waktu_lahir" value="{{old('waktu_lahir')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tempat Dilahirkan</label>
                                    <div class="form-group">
                                        <select  name="tempat_dilahirkan_id" value="{{old('tempat_dilahirkan_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Tempat Dilahirkan</option>
                                            @foreach($listTempatDilahirkan as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jenis Kelahiran</label>
                                    <div class="form-group">
                                        <select  name="jenis_kelahiran_id" value="{{old('jenis_kelahiran_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Kelahiran</option>
                                            @foreach($listJenisKelahiran as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Anak Ke</label>
                                    <div class="form-group">
                                        <input type="number"  name="kelahiran_anak_ke" value="{{old('kelahiran_anak_ke')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Penolong Kelahiran</label>
                                    <div class="form-group">
                                        <select  name="penolong_kelahiran_id" value="{{old('penolong_kelahiran_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Penolong Kelahiran</option>
                                                @foreach($listPenolongKelahiran as $list)
                                                    <option value="{{$list->id}}">{{$list->nama}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Berat Lahir
                                        <em><small>(Kg)</small></em>
                                    </label>
                                    <div class="form-group">
                                            <input type="number"  name="berat_lahir" value="{{old('berat_lahir')}}" min="0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Panjang Lahir
                                        <em><small>(cm)</small></em>
                                    </label>
                                    <div class="form-group">
                                        <input type="number"  name="panjang_lahir" value="{{old('panjang_lahir')}}" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Pendidikan dan Pekerjaan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-8">
                                    <label for="">Pendidikan Dalam KK<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select required name="pendidikan_kk_id" value="{{old('pendidikan_kk_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pendidikan(Dalam KK)</option>
                                            @foreach($listPendidikanKK as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pendidikan Yang Ditempuh<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select required name="pendidikan_sedang_id" value="{{old('pendidikan_sedang_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pendidikan</option>
                                            @foreach($listPendidikan as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pekerjaan<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select required name="pekerjaan_id" value="{{old('pekerjaan_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pekerjaan</option>
                                            @foreach($listPekerjaan as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Deskripsi Pekerjaan</label>
                                    <div class="form-group">
                                        <textarea name="job_description" value="{{old('job_description')}}" id=""  class="form-control" style="resize : none;width : 100%"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Data Kewarganegaraan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="">Status Warga Negara</label>
                                    <div class="form-group">
                                        <select name="warganegara_id" value="{{old('warganegara_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Warganegara</option>
                                            @foreach($listWarganegara as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor Paspor</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="dokumen_paspor" value="{{old('dokumen_paspor')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Berakhir Paspor</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input"" name="tanggal_akhir_paspor" value="{{old('tanggal_akhir_paspor')}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor KITAS/KITAP</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="dokumen_kitas" value="{{old('dokumen_kitas')}}">
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Data Orang Tua</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="">NIK Ayah  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" required class="form-control" name="ayah_nik" value="{{old('ayah_nik')}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nama Ayah  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" required class="form-control" name="nama_ayah" value="{{old('nama_ayah')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">NIK Ibu  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" required class="form-control" name="ibu_nik" value="{{old('ibu_nik')}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nama Ibu  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" required class="form-control" name="nama_ibu" value="{{old('nama_ibu')}}">
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Alamat</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="">Lokasi Tempat Tinggal</label>
                                    <div class="form-group">
                                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#pendudukMapModal"><i class="fa fa-map-marker"></i> Cari Lokasi Tempat Tinggal</button>
                                        <input type="hidden" name="lat" value="{{old('lat')}}" class="address-coordinate">
                                        <input type="hidden" name="use_map" id="use_map" value="0">
                                        <input type="hidden" name="lng" value="{{old('lng')}}" class="address-coordinate">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor Telepon  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text"  class="form-control" name="telepon" value="{{old('telepon')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Alamat Sebelumnya </label>
                                    <div class="form-group">
                                        <input type="text"  class="form-control" name="alamat_sebelumnya" value="{{old('alamat_sebelumnya')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Alamat Sekarang  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" required class="form-control" name="alamat_sekarang" value="{{old('alamat_sekarang')}}">
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            
                            
                        </div>
                    
                    </div>
                     <div class="box">
                        <div class="box-header blue">
                            <h3>Status Perkawinan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="">Status Perkawinan</label>
                                    <div class="form-group">
                                        <select name="status_kawin_id" value="{{old('status_kawin_id')}}" id="" class="form-control">
                                            <option value="">Pilih Status Warganegara</option>
                                            @foreach($listKawin as $list) 
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nomor Akta / Buku Nikah</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="akta_perkawinan" value="{{old('akta_perkawinan')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Perkawinan</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input"" name="tanggalperkawinan" value="{{old('tanggalperkawinan')}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Akta Perceraian</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="akta_perceraian" value="{{old('akta_perceraian')}}">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <label for="">Tanggal Perceraian</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input"" name="tanggalperceraian" value="{{old('tanggalperceraian')}}">
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    <div class="box">
                        <div class="box-header blue">
                            <h3>Data Kesehatan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">                          
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="">Golongan Darah</label>
                                    <div class="form-group">
                                        <select name="golongan_darah_id" value="{{old('golongan_darah_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Golongan Darah</option>
                                            @foreach($listGolonganDarah as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Cacat</label>
                                    <div class="form-group">
                                        <select name="cacat_id" value="{{old('cacat_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Cacat</option>
                                            @foreach($listCacat as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Sakit Menahun</label>
                                    <div class="form-group">
                                        <select name="sakit_menahun_id" value="{{old('sakit_menahun_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Sakit Menahun</option>
                                            @foreach($listSakitMenahun as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Akseptor KB</label>
                                    <div class="form-group">
                                        <select name="cara_kb_id" value="{{old('cara_kb_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Cara KB Saat Ini</option>
                                            @foreach($listCaraKB as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Status Kehamilan</label>
                                    <div class="form-group">
                                        <select name="hamil" value="{{old('hamil')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Kehamilan</option>
                                            <option value="0">Tidak Hamil</option>
                                            <option value="1">Hamil</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    <a  href="{{route('penduduk.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>

                </div>
            </div>
        </form>
    </div>
</div>
@include('modals.penduduk-map-modal')
@endsection
@push('scripts')
<script type="text/javascript">

    $("button[name=browseImg]").click(function(){
        $("#profilePict").trigger('click')
    })

    $("#profilePict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('dummy');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    });
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    }); 
</script>
@endpush