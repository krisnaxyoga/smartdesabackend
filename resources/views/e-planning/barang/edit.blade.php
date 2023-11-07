@extends('layouts.app') 

@section('title') 
    {{$page_title}} 
@endsection 

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('barang.update',$category->id)}}" method="POST">
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
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>Form Edit Barang</h3>
                        </div>
                        
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Barang <span class="text-danger">*</span></label>
                                <input name="name" required="" type="text" class="form-control m-input" placeholder="Barang" value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label>Kode Barang <span class="text-danger">*</span></label>
                                <input name="kode_barang" required="" type="text" class="form-control m-input" placeholder="Kode Barang" value="{{$category->kode_barang}}">
                            </div>
                            <div class="form-group">
                                <label>Harga <span class="text-danger">*</span></label>
                                <input name="harga" required="" type="text" class="form-control m-input" placeholder="Harga" value="{{$category->harga}}">
                            </div>
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                    <select name="kategori_barang_id" class="form-control">
                                            @foreach($kategori_barang_id as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('barang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript">
</script>
@endpush
