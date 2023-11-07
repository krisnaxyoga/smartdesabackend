@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('penduduk.update',[$penduduk->id])}}" method="POST" enctype="multipart/form-data">
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
                                        <img src="{{$penduduk->foto !== null ? $penduduk->foto : asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="file" style="display : none" name="profile" id="profilePict">
                                    <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
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
                                        <select name="dusun_id" id="dusun_id" class="form-control">
                                            @foreach($listDusun as $dusun)
                                                <option  {{$dusun->id == $penduduk->dusun_id ? 'selected' : ''}}  value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nik" value="{{$penduduk->nik}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap <span class="text-danger">*</span> 
                                            <em><small>(Tanpa Gelar)</small></em> 
                                        </label>
                                        <input type="text" class="form-control" name="nama" value="{{$penduduk->nama}}">
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
                                                            <select name="ktp_el" id="" class="form-control">
                                                                <option value="" selected disabled>Pilih KTP-EL</option>
                                                                <option  {{1 == $penduduk->ktp_el ? 'selected' : ''}}  value="1">BELUM</option>
                                                                <option  {{2 == $penduduk->ktp_el ? 'selected' : ''}}  value="2">KTP-EL</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <select name="status_rekam_id" id="" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Rekam</option>
                                                                    @foreach($listKtpStatus as $list)
                                                                        <option  {{$list->id == $penduduk->status_rekam_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
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
                                        <input  requiredtype="text" class="form-control" name="no_kk_sebelumnya"  value="{{$penduduk->no_kk_sebelumnya}}">
                                    </div>
                                </div> --}}
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="">Hubungan Dalam Keluarga</label>
                                        <select name="kk_level" id="kk_level" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listHubungan as $list)
                                                <option  {{$list->id == $penduduk->kk_level ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="sex" id="" class="form-control">
                                            <option value="" selected disabled>Pilih ...</option>
                                            @foreach($listSex as $list)
                                                <option  {{$list->id == $penduduk->sex ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Agama</label>
                                        <select name="agama_id" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listAgama as $list)
                                                <option  {{$list->id == $penduduk->agama_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Suku</label>
                                        <select name="suku_id" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listSuku as $list)
                                                <option {{$list->id == $penduduk->suku_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                                <option value="" selected disabled>Pilih ...</option>
                                                @foreach($listStatus as $list)
                                                <option  {{$list->id == $penduduk->status ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
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
                                        <label for="">Nomor Akta Kelahiran <span class="text-danger">*</span></label>
                                        <input  type="text" class="form-control" name="akta_lahir"  value="{{$penduduk->akta_lahir}}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Tempat Lahir<span class="text-danger">*</span> 
                                        </label>
                                        <input required type="text" class="form-control" name="tempatlahir"  value="{{$penduduk->tempatlahir}}">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tanggal Kelahiran<span class="text-danger">*</span> </label>
                                    <div class="row">
                                        <div class="col-md-4" style="padding-right: 7.5px">
                                            <select name="birth_date" class="form-control">
                                                @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}"{{ $i == date('j', strtotime($penduduk->tanggallahir)) ? ' selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 7.5px; padding-right: 7.5px">
                                            <select name="birth_month" class="form-control">
                                                <option value="1"{{ date('n', strtotime($penduduk->tanggallahir)) == 1 ? ' selected' : '' }}>Januari</option>
                                                <option value="2"{{ date('n', strtotime($penduduk->tanggallahir)) == 2 ? ' selected' : '' }}>Februari</option>
                                                <option value="3"{{ date('n', strtotime($penduduk->tanggallahir)) == 3 ? ' selected' : '' }}>Maret</option>
                                                <option value="4"{{ date('n', strtotime($penduduk->tanggallahir)) == 4 ? ' selected' : '' }}>April</option>
                                                <option value="5"{{ date('n', strtotime($penduduk->tanggallahir)) == 5 ? ' selected' : '' }}>Mei</option>
                                                <option value="6"{{ date('n', strtotime($penduduk->tanggallahir)) == 6 ? ' selected' : '' }}>Juni</option>
                                                <option value="7"{{ date('n', strtotime($penduduk->tanggallahir)) == 7 ? ' selected' : '' }}>Juli</option>
                                                <option value="8"{{ date('n', strtotime($penduduk->tanggallahir)) == 8 ? ' selected' : '' }}>Agustus</option>
                                                <option value="9"{{ date('n', strtotime($penduduk->tanggallahir)) == 9 ? ' selected' : '' }}>September</option>
                                                <option value="10"{{ date('n', strtotime($penduduk->tanggallahir)) == 10 ? ' selected' : '' }}>Oktober</option>
                                                <option value="11"{{ date('n', strtotime($penduduk->tanggallahir)) == 11 ? ' selected' : '' }}>November</option>
                                                <option value="12"{{ date('n', strtotime($penduduk->tanggallahir)) == 12 ? ' selected' : '' }}>Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 7.5px">
                                            <select name="birth_year" class="form-control">
                                                @for ($i = date('Y'); $i >= (date('Y') - 100); $i--)
                                                <option value="{{ $i }}"{{ date('Y', strtotime($penduduk->tanggallahir)) == $i ? ' selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Waktu Kelahiran </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="timepicker" data-target="#timepicker" class="btn btn-default btn-timepicker" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                        <input  type="text" class="form-control timepicker-input" id="timepicker" data-toggle="timepicker" data-target="#timepicker" autocomplete="off" name="waktu_lahir"  value="{{$penduduk->waktu_lahir}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tempat Dilahirkan</label>
                                    <div class="form-group">
                                        <select  name="tempat_dilahirkan_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Tempat Dilahirkan</option>
                                            @foreach($listTempatDilahirkan as $list)
                                                <option  {{$list->id == $penduduk->tempat_dilahirkan_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jenis Kelahiran </label>
                                    <div class="form-group">
                                        <select  name="jenis_kelahiran_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Kelahiran</option>
                                            @foreach($listJenisKelahiran as $list)
                                                <option  {{$list->id == $penduduk->jenis_kelahiran_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Anak Ke</label>
                                    <div class="form-group">
                                        <input type="number"  name="kelahiran_anak_ke" class="form-control"  value="{{$penduduk->kelahiran_anak_ke}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Penolong Kelahiran</label>
                                    <div class="form-group">
                                        <select name="penolong_kelahiran_id"  id="" class="form-control">
                                            <option value="" selected disabled>Pilih Penolong Kelahiran</option>
                                                @foreach($listPenolongKelahiran as $list)
                                                    <option   {{$list->id == $penduduk->penolong_kelahiran_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
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
                                            <input type="number"  name="berat_lahir" class="form-control"  value="{{$penduduk->berat_lahir}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Panjang Lahir
                                        <em><small>(cm)</small>
                                    </label>
                                    <div class="form-group">
                                        <input type="number"   name="panjang_lahir" class="form-control"  value="{{$penduduk->panjang_lahir}}">
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
                               
                                <div class="col-md-4">
                                    <label for="">Pendidikan Dalam KK</label>
                                    <div class="form-group">
                                        <select name="pendidikan_kk_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pendidikan(Dalam KK)</option>
                                            @foreach($listPendidikanKK as $list)
                                                <option  {{$list->id == $penduduk->pendidikan_kk_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pendidikan Yang Ditempuh</label>
                                    <div class="form-group">
                                        <select name="pendidikan_sedang_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pendidikan</option>
                                            @foreach($listPendidikan as $list)
                                                <option  {{$list->id == $penduduk->pendidikan_sedang_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pekerjaan</label>
                                    <div class="form-group">
                                        <select name="pekerjaan_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Pekerjaan</option>
                                            @foreach($listPekerjaan as $list)
                                                <option  {{$list->id == $penduduk->pekerjaan_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Deskripsi Pekerjaan</label>
                                    <div class="form-group">
                                        <textarea name="job_description" id="" class="form-control" style="resize : none;width : 100%">{{$penduduk->job_description}}</textarea>
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
                                        <select name="warganegara_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Warganegara</option>
                                            @foreach($listWarganegara as $list)
                                                <option  {{$list->id == $penduduk->warganegara_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor Paspor</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="dokumen_paspor"  value="{{$penduduk->dokumen_paspor}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Berakhir Paspor</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="tanggal_akhir_paspor"  value="{{$penduduk->tanggal_akhir_paspor}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor KITAS/KITAP</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="dokumen_kitas"  value="{{$penduduk->dokumen_kitas}}">
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
                                        <input type="text" class="form-control" name="ayah_nik"  value="{{$penduduk->ayah_nik}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nama Ayah  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nama_ayah"  value="{{$penduduk->nama_ayah}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">NIK Ibu  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ibu_nik"  value="{{$penduduk->ibu_nik}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nama Ibu  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nama_ibu"  value="{{$penduduk->nama_ibu}}">
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
                                    </div>
                                    <input type="hidden" name="lat" class="address-coordinate"  value="{{count($penduduk->penduduk_map) != 0 ? $penduduk->penduduk_map[0]->lat : '-8.644609'}}">
                                    <input type="hidden" name="lng" class="address-coordinate"  value="{{count($penduduk->penduduk_map) != 0 ? $penduduk->penduduk_map[0]->lng : '115.2046587'}}">
                                    <input type="hidden" name="use_map" id="use_map" value="0">
                                </div>
                                <div class="col-md-8">
                                    <label for="">Nomor Telepon  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="telepon" value="{{$penduduk->telepon}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="">Alamat Sebelumnya </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="alamat_sebelumnya" value="{{$penduduk->alamat_sebelumnya}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Alamat Sekarang  <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="alamat_sekarang" value="{{$penduduk->alamat_sekarang}}">
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
                                        <select name="status_kawin_id" required id="" class="form-control">
                                            <option value="">Pilih Status Warganegara</option>
                                            @foreach($listKawin as $list) 
                                                <option  {{$list->id == $penduduk->status_kawin_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nomor Akta / Buku Nikah</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="akta_perkawinan" value="{{$penduduk->akta_perkawinan}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Perkawinan</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="tanggalperkawinan" value="{{$penduduk->tanggalperkawinan}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Akta Perceraian</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="akta_perceraian" value="{{$penduduk->akta_perceraian}}">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <label for="">Tanggal Perceraian</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="tanggalperceraian" value="{{$penduduk->tanggalperceraian}}">
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
                                        <select name="golongan_darah_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Golongan Darah</option>
                                            @foreach($listGolonganDarah as $list)
                                                <option {{$list->id == $penduduk->golongan_darah_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Cacat</label>
                                    <div class="form-group">
                                        <select name="cacat_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Cacat</option>
                                            @foreach($listCacat as $list)
                                                <option {{$list->id == $penduduk->cacat_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Sakit Menahun</label>
                                    <div class="form-group">
                                        <select name="sakit_menahun_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Sakit Menahun</option>
                                            @foreach($listSakitMenahun as $list)
                                                <option   {{$list->id == $penduduk->sakit_menahun_id ? 'selected' : ''}} value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Akseptor KB</label>
                                    <div class="form-group">
                                        <select name="cara_kb_id" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Cara KB Saat Ini</option>
                                            @foreach($listCaraKB as $list)
                                                <option  {{$list->id == $penduduk->cara_kb_id ? 'selected' : ''}}  value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Status Kehamilan</label>
                                    <div class="form-group">
                                        <select name="hamil" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Kehamilan</option>
                                            <option value="0"  {{0 == $penduduk->hamil ? 'selected' : ''}} >Tidak Hamil</option>
                                            <option value="1"  {{1 == $penduduk->hamil ? 'selected' : ''}} >Hamil</option>
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
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });


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