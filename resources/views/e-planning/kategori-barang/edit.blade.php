@extends('layouts.app') 

@section('title') 
    {{$page_title}} 
@endsection 

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('kategori-barang.update',$category->id)}}" method="POST">
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
                            <h3>Form Edit Kategori Barang</h3>
                        </div>
                        
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Kategori Barang <span class="text-danger">*</span></label>
                                <input name="name" required="" type="text" class="form-control m-input" placeholder="Kategori" value="{{$category->name}}">
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('kategori-barang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
