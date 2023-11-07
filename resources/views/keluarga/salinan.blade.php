@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="/keluarga" class="btn btn-rounded btn-default"><i class="fa fa-arrow-left"></i> Kembali</a> 
<a  data-toggle="modal" style="color : #fff" data-target="#tambah-anggota-keluarga-modal"  data-toggle="modal" data-target="#tambah-anggota-keluarga" class="btn btn-rounded btn-primary"><i class="fa fa-plus"></i> Tambah Anggota</a> 
{{-- <a href="{{url('/')}}/keluarga/{{$keluarga->id}}/print" class="btn btn-rounded btn-success"><i class="fa fa-print"></i> Cetak</a> 
<a href="{{url('/')}}/keluarga/{{$keluarga->id}}/unduh" class="btn btn-sm btn-secondary"><i class="fa fa-download"></i> Unduh</a>  --}}
<a href="{{url('/')}}/keluarga/{{$keluarga->id}}/anggota" class="btn btn-rounded btn-warning"><i class="fa fa-users"></i> Daftar Anggota Keluarga</a> 
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">

        <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="box">
                       
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h3 style="text-transform : uppercase">Salinan Kartu Keluarga</h3>
                                    <p><b>No. {{$keluarga->no_kk}}</b></p>
                                </div>
                                <div class="col-md-5">

                                    <table class="table no-border">
                                    <tbody>
                                     <tr>
                                         <td>Nama Kepala Keluarga</td>
                                         <td>: {{$keluarga->kepalaKeluarga ? $keluarga->kepalaKeluarga->nama : '-'}}</td>
                                     </tr>
                                     <tr>
                                         <td>Alamat</td>
                                         <td>: {{$keluarga->kepalaKeluarga ? $keluarga->kepalaKeluarga->alamat_sekarang : '-'}}</td>
                                     </tr>
                                     <tr>
                                         <td>RT/RW</td>
                                         <td>: - / -</td>
                                     </tr>
                                     <tr>
                                         <td>Kode Pos</td>
                                         <td>: {{$desa->kode_pos}}</td>
                                     </tr>
                                     </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-5">

                                    <table class="table no-border">
                                    <tbody>
                                     <tr>
                                         <td>Desa/Kelurahan</td>
                                         <td style="text-transform: uppercase">: {{$desa->nama_desa}}</td>
                                     </tr>
                                     <tr>
                                        <td>Kecamatan</td>
                                        <td style="text-transform: uppercase">: {{$desa->nama_kecamatan}}</td>
                                    </tr>
                                     <tr>
                                        <td>Kabupaten</td>
                                        <td style="text-transform: uppercase">: {{$desa->nama_kabupaten}}</td>
                                    </tr>
                                     <tr>
                                        <td>Provinsi</td>
                                        <td style="text-transform: uppercase"> : {{$desa->nama_propinsi}}</td>
                                    </tr>
                                     </tbody>
                                    </table>
                                </div>
                            </div>

                           <table class="table table-hovered table-bordered table-striped">
                           <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Pendidikan</th>
                                <th>Jenis Pekerjaan</th>
                            </tr>
                           </thead>
                           <tbody>
                               @foreach($keluarga->penduduk as $key => $penduduk)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$penduduk->nama}}</td>
                                <td>{{$penduduk->nik}}</td>
                                <td>{{$penduduk->sex == 2 ? 'PEREMPUAN' : 'LAKI - LAKI'}}</td>
                                <td style="text-transform : uppercase">{{$penduduk->tempatlahir}}</td>
                                <td>{{date('d-m-Y',strtotime($penduduk->tanggallahir))}}</td>
                                <td>{{($penduduk->agama ? $penduduk->agama->nama : "-")}}</td>
                                <td>{{($penduduk->pendidikanKK ? $penduduk->pendidikanKK->nama : "-")}}</td>
                                <td>{{($penduduk->pekerjaan ? $penduduk->pekerjaan->nama : "-")}}</td>
                            </tr>

                            @endforeach
                            </tbody>
                           </table>

                           <table class="table table-hovered table-bordered table-striped">
                                <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Status Perkawinan</th>
                                     <th>Status Hubungan Dalam Keluarga</th>
                                     <th>Kewarganegaraan</th>
                                     <th>No. Paspor</th>
                                     <th>No. KITAS / KITAP</th>
                                     <th>Ayah</th>
                                     <th>Ibu</th>
                                     <th>Golongan Darah</th>
                                 </tr>
                                </thead>
                                <tbody>
                                    @foreach($keluarga->penduduk as $key => $penduduk)
                                 <tr>
                                     <td>{{$key + 1}}</td>
                                     <td>{{$penduduk->status_kawin ? $penduduk->status_kawin->nama : "-"}}</td>
                                     <td>{{$penduduk->hubungan ? $penduduk->hubungan->nama : "-"}}</td>
                                     <td>{{$penduduk->kewarganegaraan ? $penduduk->kewarganegaraan->nama : "-"}}</td>
                                     <td>{{$penduduk->dokumen_paspor}}</td>
                                     <td>{{$penduduk->dokumen_kitas}}</td>
                                     <td>{{($penduduk->nama_ayah)}}</td>
                                     <td>{{($penduduk->nama_ibu)}}</td>
                                     <td>{{($penduduk->golonganDarah ? $penduduk->golonganDarah->nama : "-")}}</td>
                                 </tr>
     
                                 @endforeach
                                 </tbody>
                                </table>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <br>
                                    KEPALA KELUARGA 
                                    <br><br><br><br><br>

                                    {{$keluarga->kepalaKeluarga ? $keluarga->kepalaKeluarga->nama : "-"}}
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-4 text-center">
                                    {{$desa->nama_kecamatan}}, {{$keluarga->konversiTgl(date('Y-m-d'))}} <br>
                                    KEPALA DESA <span style="text-transform : uppercase">{{$desa->nama_desa}}</span> 
                                    <br><br><br><br><br>


                                    {{$kades->pamong_nama}}
                                </div>
                            </div>
                            <br><br>
                        </div>
                    
                    </div>
                   

                </div>
            </div>
    </div>
</div>
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