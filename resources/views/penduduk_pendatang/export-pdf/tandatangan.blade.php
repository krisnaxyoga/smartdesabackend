@extends('layouts.app')
@section('title')
{{$page_title}}
@endsection
@section('content')
<style>
    .table-detail td {
        padding : 6px
    }
</style>
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('penduduk-pendatang.export', $duktang->id)}}" method="POST">
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
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>Form Cetak Surat Keterangan Tanda Lapor Diri (STLD)</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <table class="table-detail">
                                    <tbody><tr>
                                        <td width="200">Nomor Surat Desa</td>
                                        <td>:</td>
                                        <th>{{$duktang->no_surat_desa}}</th>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <th>{{$duktang->nik}}</th>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <th>{{$duktang->nama}}</th>
                                    </tr>
                                    <tr>
                                        <td>Tanda Tangan</td>
                                        <td>:</td>
                                        <th>{{$duktang->staff ? $duktang->staff->pamong_nama." ( ".$duktang->staff->jabatan." )" : ''}}</th>
                                    </tr>
                                    <tr>
                                        <td>Masa Berlaku STLD</td>
                                        <td>:</td>
                                        <th>{{date('d-m-Y', strtotime($duktang->masa_berlaku))}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group">
                                <label>Edit Masa Berlaku STLD</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button  data-toggle="datepicker"  data-target="#masa_berlaku" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                    <input type="text" value="{{$duktang->masa_berlaku}}" class="form-control masa_berlaku " id="masa_berlaku" required autocomplete="off" name="masa_berlaku" placeholder="Masa Berlaku">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('penduduk-pendatang.show', $duktang->id)}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript">
  $(".masa_berlaku").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
    });
</script>
@endpush
