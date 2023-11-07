@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection


@section('content')
<style>
.btn:not([disabled]):hover, .btn:not([disabled]):focus, .btn:not([disabled]).active {
    box-shadow: inset 0 -15rem 0px rgba(158, 158, 158, 0.2);
}
</style>

<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row row-eq-height">
            @foreach($data as $item)
                <div class="col-lg-3 mb-4">
                    <a href="{{route('surat.cetak',[$item->id])}}" class="p-4 btn white d-block align-items-center" style="white-space : normal;height : 100%">
                        
                        <span class="text-center">
                            <i class="fa fa-4x  fa-file-text"></i>
                            <br>
                            <br>                        
                            <p class="text-sm mb-1 ">{{$item->kode_surat}}</p>
                            <b class="text-sm mb-1 d-block">{{$item->judul}}</b>
                        </span>
                        
                    </a>
                </div>
            @endforeach
        </div>
        
        {{-- <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box table-bordered" >
                <thead>
                    <tr>
                        <th width="100">Aksi</th>
                        <th width="100">Kode</th>
                        <th>Jenis Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>
                                <a href="{{route('surat.cetak',[$item->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Buat Surat</a>
                            </td>
                            <td class="text-center">
                                {{$item->kode_surat}}
                            </td>
                            <td>
                                {{$item->judul}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
			</table>
        </div> --}}
    </div>
</div>
@endsection
