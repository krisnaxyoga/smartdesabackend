@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

        <div class="col-md-6">

            <form action="{{route('penduduk.update-status-dasar',[$penduduk->id])}}" method="POST">
                @csrf
                <div class="box">
                    <div class="box-header">
                        <h3>Form Edit</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <label for=""><b>Status Dasar</b> </label>
                        <br>
                        @foreach($status_dasar as $sd)
                        <label class="radio-inline">
                            <input type="radio" required name="status_dasar"  value="{{$sd->id}}">&nbsp;&nbsp; {{$sd->nama}}
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        @endforeach
                            {{-- <hr> --}} <br>
                        <div class="form-group">
                            <label for=""><b>Tanggal Peristiwa</b></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button data-toggle="datepicker" data-target="#datepicker" class="btn btn-default btn-datepicker" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                <input type="text" required class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="tgl_peristiwa">
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for=""><b>Catatan</b></label>
                            <textarea name="catatan" required id="" cols="30" rows="3" style="resize : none" class="form-control"></textarea>
                            
                        </div>
                        <small><i>
                            <ul style="padding : 0 15px">
                                <li>Mati / Hilang : terangkan penyebabnya</li>    
                                <li>Pindah : Tuliskan Alamat</li>
                            </ul>    
                        </i></small>
                    </div>
                    <div class="box-footer">
                            <a href="{{route('penduduk.index')}}" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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
    $("select[name=kelas_sosial]").select2({
            placeholder : "Pilih Kelas Sosial...",
            minimumResultsForSearch : -1,
            width : '100%',
            allowClear: true 
        })

</script>
@endpush