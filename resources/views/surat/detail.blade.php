@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<style>
    .table-detail td {
        padding : 10px
    }
</style>
<div class="content-main" id="content-main">
    <div class="padding" id="app">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Detail Surat</h3>
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
                                <table class="table-detail">
                                    <tr>
                                        <td width="200">Nomor Surat</td>
                                        <td>:</td>
                                        <th>{{$data->nomor_surat}}</th>
                                    </tr>
                                    <tr>
                                        <td>Pemohon</td>
                                        <td>:</td>
                                        <th>{{$data->penduduk->nama}}</th>
                                    </tr>
                                    <tr>
                                        <td>Keperluan</td>
                                        <td>:</td>
                                        <th>{{$data->keperluan ?: '-'}}</th>
                                    </tr>
                                    <tr>
                                        <td>Nomor Surat Pengantar</td>
                                        <td>:</td>
                                        <th>{{$data->no_surat_pengantar ?: '-'}}</th>
                                    </tr>
                                    @if(in_array(2,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Berlaku Selama</td>
                                        <td>:</td>
                                        <th>{{$data->penduduk->konversiTgl($data->berlaku_dari)}} - {{$data->penduduk->konversiTgl($data->berlaku_sampai)}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(4,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Berlaku Selama</td>
                                        <td>:</td>
                                        <th>{{$data->penduduk->konversiTgl($data->berlaku_dari)}} - {{$data->penduduk->konversiTgl($data->berlaku_sampai)}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(3,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Jenis Acara</td>
                                        <td>:</td>
                                        <th>{{$data->jenis_acara}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(5,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Jenis Usaha</td>
                                        <td>:</td>
                                        <th>{{$data->jenis_usaha}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(5,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Alamat Usaha</td>
                                        <td>:</td>
                                        <th>{{$data->alamat_usaha}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(5,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Nama Usaha</td>
                                        <td>:</td>
                                        <th>{{$data->nama_usaha}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(7,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Status Pernyataan</td>
                                        <td>:</td>
                                        <th>{{$data->pernyataan_status}} </th>
                                    </tr>
                                    @endif
                                    @if(in_array(6,$data->jenisSurat->tipe) && $data->status == "GENERATED")
                                    <tr>
                                        <td>Nama Pasangan</td>
                                        <td>:</td>
                                        <th>{{$data->nama_pasangan}} </th>
                                    </tr>
                                    <tr>
                                        <td>Tahun Perkawinan</td>
                                        <td>:</td>
                                        <th>{{$data->tahun_kawin}} </th>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Perkawinan</td>
                                        <td>:</td>
                                        <th>{{$data->lokasi_kawin}} </th>
                                    </tr>

                                    @endif
                                    @if($data->status == "GENERATED")
                                    <tr>
                                        <td>Tanggal Dicetak</td>
                                        <td>:</td>
                                        <th>{{$data->penduduk->konversiTgl($data->tanggal_cetak)}} </th>
                                    </tr>
                                    <tr>
                                        <td>Staff</td>
                                        <td>:</td>
                                        <th>{{$data->staff->pamong_nama}} sebagai {{$data->staff->jabatan}} </th>
                                    </tr>
                                    @endif
                                    @if($data->is_mobile)
                                    <tr>
                                        <td>Tanggal Pengajuan</td>
                                        <td>:</td>
                                        <th>{{$data->tanggal_pengajuan ? $data->penduduk->konversiTgl($data->tanggal_pengajuan) : "-"}} </th>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Verifikasi</td>
                                        <td>:</td>
                                        <th>{{$data->tanggal_verifikasi ? $data->penduduk->konversiTgl($data->tanggal_verifikasi) : "-"}} </th>
                                    </tr>
                                    
                                    @endif

                                    <tr>
                                        <td>Tanggal Cetak</td>
                                        <td>:</td>
                                        <th>{{$data->tanggal_cetak ? $data->penduduk->konversiTgl($data->tanggal_cetak) : "-"}} </th>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        @php 
                                            switch ($data->status) {
                                                case 'GENERATED':
                                                    $color = "success";
                                                    break;
                                                case 'ACCEPTED':
                                                    $color = "primary";
                                                    break;
                                                case 'REQUESTED':
                                                    $color = "warning";
                                                    break;
                                                case 'REJECTED':
                                                    $color = "danger";
                                                    break;
                                                
                                                default:
                                                    $color = "info";
                                                    break;
                                            }
                                        @endphp
                                        <th> <span class="badge {{$color}}">{{$data->status}}</span> </th>
                                    </tr>
                                    
                                </table>
                                
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        @if($data->status == "ACCEPTED")
                        <a href="{{ route('surat.permohonan.cetak',[$data->id]) }}"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
                        @elseif($data->status == "GENERATED")
                        <a href="{{ route('render.surat',[$data->jenis_surat_id,$data->id]) }}"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
                        @endif                        
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

@endpush