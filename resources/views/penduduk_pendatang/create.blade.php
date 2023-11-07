@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="bg-detail">
        <form action="{{route('penduduk-pendatang.store')}}" method="POST" enctype="multipart/form-data">
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
                                <img src="http://127.0.0.1:8000/images/Dummy.jpg" alt="" class="dummy-avatar" id="dummy">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input name="photo" type="file" style="display : none" value="" id="profilePict">
                            <button name="browseImg" value="" type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3>Foto KTP</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="preview-img">
                                <img src="/images/dummy-landscape.png" width="100%" class="dummy-avatar" id="photoKtp">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input name="photo_ktp" type="file" style="display : none" value="" id="ktpPict">
                            <button name="browseKtp" value="" type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
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
                                        <input name="nama" value="{{old('nama')}}" placeholder="Nama" type="text" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Golongan Darah</label>
                                        <select name="golongan_darah_id" required value="{{old('golongan_darah_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Golongan Darah</option>
                                            @foreach($listGolonganDarah as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Keluarga</label>
                                        <select name="status_keluarga_id" required value="{{old('status_keluarga_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Status Keluarga</option>
                                            @foreach($listHubungan as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Perkawinan</label>
                                        <select name="status_kawin_id" required value="{{old('status_kawin_id')}}" id="" class="form-control">
                                            <option value="">Pilih Status Perkawinan</option>
                                            @foreach($listKawin as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">NIK <span class="text-danger">*</span></label>
                                        <input name="nik" value="{{old('nik')}}" type="text" required class="form-control" placeholder="NIK">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Agama</label>
                                        <select name="agama_id" required value="{{old('agama_id')}}" id="" class="form-control">
                                                <option value="" selected disabled>Pilih Agama</option>
                                                @foreach($listAgama as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No HP</label>
                                        <input type="text" name="no_hp" value="{{old('no_hp')}}" placeholder="No. HP" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No. KK</label>
                                        <input type="text" class="form-control" name="no_kk" value="{{old('no_kk')}}" placeholder="No. KK">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="sex_id" required value="{{old('sex_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            @foreach($listSex as $list)
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
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
                                        <input type="text" name="tempat_lahir" value="{{old('tempat_lahir')}}" required class="form-control" placeholder="Tempat Lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button  data-toggle="datepicker"  data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            <input name="tanggal_lahir" value="{{old('tanggal_lahir')}}" placeholder="Tanggal Lahir" type="text" class="form-control" id="datepicker" required autocomplete="off">
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
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
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
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
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
                                                <option value="{{$list->id}}">{{$list->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Kecamatan Asal</label>
                                        <input type="text" readonly class="form-control" name="kecamatan" value="{{old('kecamatan')}}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alamat Asal <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="alamat_asal" value="{{old('alamat_asal')}}" >
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Kabupaten Asal</label>
                                        <input type="text" readonly class="form-control" name="kabupaten" value="{{old('kabupaten')}}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <label>Desa Asal</label>
                                        <select required  class="form-control" name="desa_asal">
                                            <option value=""></option>
                                        </select>
                                        <input type="hidden" name="desa_asal_id">
                                    </div>
                                    <div class="form-group detail-asal">
                                        <label for="">Provinsi Asal</label>
                                        <input type="text" readonly class="form-control" name="provinsi" value="{{old('provinsi')}}" >
                                        <!-- <select required  class="form-control" name="provinsi">
                                            <option value=""></option>
                                        </select> -->
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
                                        <input type="text" placeholder="Alasan Domisili" required class="form-control" name="alasan_domisili" value="{{old('alasan_domisili')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Tempat Tinggal</label>
                                        <select name="jenis_tempat_tinggal_id"  id="" class="form-control">
                                        <option value="" selected disabled>Pilih Jenis Tempat Tinggal</option>
                                            @foreach($listTempatTinggal as $tempat)
                                                <option value="{{$tempat->id}}">{{$tempat->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alamat Tinggal <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" placeholder="Alamat Tinggal" name="alamat_tinggal" value="{{old('alamat_tinggal')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Surat Yang Dibawa <span class="text-danger">*</span></label>
                                        <input type="text" name="surat"  value="{{old('surat')}}" required class="form-control" placeholder="Contoh KTP" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dusun Tinggal</label>
                                        <select name="dusun_tinggal_id"  id="" class="form-control">
                                            <option value="" selected disabled>Pilih Dusun Tinggal</option>
                                            @foreach($listDusun as $dusun)
                                                <option value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Verifikasi <span class="text-danger">*</span></label>
                                        <div class="my-auto">
                                            <label class="md-check checkbox-inline mr-4">
                                                <input type="radio" name="status_verifikasi" value="tidak" checked> <i class="blue"></i> Tidak</label>
                                            <label class="md-check checkbox-inline mb-2">
                                                <input type="radio" name="status_verifikasi" value="ya"> <i class="blue"></i> Ya</label>
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
                                        <input name="no_surat_desa" value="{{old('no_surat_desa')}}" type="text" required class="form-control" placeholder="No. Surat Desa/Kelurahan">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tangada Tangan/ Atas Nama</label>
                                        <select name="staff_id" value="{{old('warga_negara_id')}}" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Staff Desa</option>
                                            @foreach($listStaff as $list)
                                                <option value="{{$list->id}}">{{$list->pamong_nama}} ( {{$list->jabatan}} )</option>
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
                                            <input type="text" class="form-control datepicker-input" id="tanggal_melapor" required autocomplete="off" name="tanggal_melapor" placeholder="Tanggal Melapor">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Berlaku STLD <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button  data-toggle="datepicker"  data-target="#tanggal_melapor" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            <input type="text" class="form-control datepicker-input" id="tanggal_melapor" required autocomplete="off" name="masa_berlaku" placeholder="Masa Berlaku">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header primary">
                            <h3>Anggota Keluarga Yang Ikut</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th valign="center">Data Umum</th>
                                                    <th valign="center">Data Tambahan</th>
                                                    <th valign="center">Keterangan</th>
                                                    <th valign="center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="index !== 0" v-for="(detail, index) in details">
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="">NIK</label>
                                                            <input id="nik_detail"  type="text" class="form-control" name='nik_detail[]' v-model="detail.nik_detail" placeholder="NIK">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nama</label>
                                                            <input type="text"  class="form-control" name="nama_detail[]" v-model="detail.nama_detail" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jenis Kelamin</label>
                                                            <select v-if="detail.sex_detail === ''" name="sex_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                                @foreach($listSex as $sex)
                                                                    <option value="{{$sex->id}}">{{$sex->nama}}</option>
                                                                @endforeach
                                                            </select>

                                                            <select v-else name="sex_detail[]" v-model="detail.sex_detail"  class="form-control">
                                                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                                                @foreach($listSex as $sex)
                                                                    <option value="{{$sex->id}}" v-bind:selected="detail.sex_detail">{{$sex->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tanggal Lahir</label>
                                                            <input type="text"  name="umur_detail[]" class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" v-if="detail.umur_detail === ''">
                                                            <input type="text"  name="umur_detail[]" v-model="detail.umur_detail" class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" v-else>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <div class="form-group">
                                                            <label for="">Status Perkawinan</label>
                                                            <select  v-if="detail.status_kawin_detail === ''" name="status_kawin_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Perkawinan</option>
                                                                @foreach($listKawin as $kawin)
                                                                    <option value="{{$kawin->id}}" v-bind:selected="detail.status_kawin_detail">{{$kawin->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select  v-else name="status_kawin_detail[]"  v-model="detail.status_kawin_detail" class="form-control">
                                                                <option value="" disabled>Pilih Status Perkawinan</option>
                                                                @foreach($listKawin as $kawin)
                                                                    <option value="{{$kawin->id}}" v-bind:selected="detail.status_kawin_detail">{{$kawin->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="">Pendidikan</label>
                                                           <select v-if="detail.pendidikan_detail === ''"  name="pendidikan_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Pendidikan</option>
                                                                @foreach($listPendidikanKK as $pendidikan)
                                                                    <option value="{{$pendidikan->id}}">{{$pendidikan->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                           <select v-else name="pendidikan_detail[]" v-model="detail.pendidikan_detail" class="form-control">
                                                                <option value="" disabled>Pilih Pendidikan</option>
                                                                @foreach($listPendidikanKK as $pendidikan)
                                                                    <option value="{{$pendidikan->id}}"  v-bind:selected="detail.pendidikan_detail">{{$pendidikan->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="">Status Keluarga</label>
                                                           <select  v-if="detail.status_keluarga_detail === ''" name="status_keluarga_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Keluarga</option>
                                                                @foreach($listHubungan as $list)
                                                                    <option value="{{$list->id}}">{{$list->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select v-else name="status_keluarga_detail[]" v-model="detail.status_keluarga_detail" class="form-control">
                                                                <option value="" disabled>Pilih Status Keluarga</option>
                                                                @foreach($listHubungan as $list)
                                                                    <option value="{{$list->id}}" v-bind:selected="detail.status_keluarga_detail">{{$list->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <input type="text"  class="form-control" name='ket_detail[]' v-model="detail.ket_detail">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" @click="deleteDetail(index)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-plus"></i> Tambah Anggota
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#searchDuktang">Cari NIK</a>
                                                <a class="dropdown-item" href="#" @click="addDetail">Tambah Data Baru</a>
                                            </div>
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


<!-- modal -->
        <div id="searchDuktang" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cari NIK</h5></div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <select class="form-control" name="nik_penduduk" id="nik_penduduk" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Batal</button>
                        <button type="button" @click="addAnggotaByModal" class="btn primary p-x-md" data-dismiss="modal">Tambahkan</button>
                    </div>
                </div>
            </div>
        </div>
<!-- end modal -->



    </div>
</div>

@endsection
@push('scripts')

<script>
 new Vue({
        el: '#bg-detail',
        data: {
            details: [{
                nik_detail: '',
                nama_detail: '',
                sex_detail: '',
                umur_detail: '',
                status_kawin_detail: '',
                pendidikan_detail: '',
                status_keluarga_detail: '',
                ket_detail: ''
            }],
            function () {
                return{
                    anggota: null
                }
            }
        },
        methods: {
            addDetail : function () {
                this.details.push({
                    nik_detail: '',
                    nama_detail: '',
                    sex_detail: '',
                    umur_detail: '',
                    status_kawin_detail: '',
                    pendidikan_detail: '',
                    status_keluarga_detail: '',
                    ket_detail: ''
                });
            },
            deleteDetail: function (index) {
                this.details.splice(index,1);
                // if(index===0)
                // this.addDetail();
            },
            addAnggotaByModal: function () {
                this.details.push({
                    nik_detail: this.anggota.nik,
                    nama_detail: this.anggota.nama,
                    sex_detail: this.anggota.sex,
                    umur_detail: this.anggota.tanggallahir,
                    status_kawin_detail: this.anggota.status_kawin_id,
                    pendidikan_detail: this.anggota.pendidikan_kk_id,
                    status_keluarga_detail: this.anggota.kk_level,
                    ket_detail: ''
                });
            }
        },
        mounted() {
            $self = this;
            $(".datepicker-input").datepicker({
                autoclose : true,
                format: 'yyyy-mm-dd'
            });
            $("#nik_penduduk").select2({
                placeholder : "Pilih NIK...",
                width : "100%",
                ajax: {
                    url: '{{route("api.anggotaDuktang")}}?desa_id={{auth()->user()->desa_id}}&except=',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'select2'
                        }
                        return query;
                    },
                    processResults: (data) => {
                        return {
                            results: data
                        }
                    }
                },
                escapeMarkup: (markup) => markup, // let our custom formatter work
                    templateSelection: (data) => {
                                        if (typeof data.nik !== "undefined")
                                        return data.nik + " ["+ data.nama + "]"

                                        return data.text
                    },
                    templateResult: (data) => {
                                        if (data.loading) {
                                            return "Memuat Data ..."
                                        }

                                        return data.nik + " ["+ data.nama + "]"
                    },
            }).on('change',function(){
                $self.anggota = $(this).select2('data')[0]
            });
        },
        beforeUpdate () {
            $("#nik_penduduk").select2("destroy");
        },
        updated () {
            $(".datepicker-input").datepicker({
                autoclose : true,
                format: 'yyyy-mm-dd'
            });
            $("#nik_penduduk").select2({
                placeholder : "Pilih NIK...",
                width : "100%",
                ajax: {
                    url: '{{route("api.anggotaDuktang")}}?desa_id={{auth()->user()->desa_id}}&except=',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'select2'
                        }
                        return query;
                    },
                    processResults: (data) => {
                        return {
                            results: data
                        }
                    }
                },
                escapeMarkup: (markup) => markup, // let our custom formatter work
                    templateSelection: (data) => {
                                        if (typeof data.nik !== "undefined")
                                        return data.nik + " ["+ data.nama + "]"

                                        return data.text
                    },
                    templateResult: (data) => {
                                        if (data.loading) {
                                            return "Memuat Data ..."
                                        }

                                        return data.nik + " ["+ data.nama + "]"
                    },
            }).on('change',function(){
                $self.anggota = $(this).select2('data')[0]
            });
        }
 })

</script>
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
