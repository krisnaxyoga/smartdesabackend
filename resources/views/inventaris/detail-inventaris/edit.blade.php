@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('aset.show', $id)}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="table-activities">
        <form action="{{route('detail-aset.update', [$id, $data->id])}}" method="POST">
            <div class="row">

                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin-bottom:0px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="box">
                        <div class="box-header">
                            <h3>DATA ASET</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                            {{ csrf_field() }}
                            @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kode Register</label>
                                        <input type="text" name="kode_register" class="form-control" value="{{$data->kode_register}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kondisi</label>
                                        <select name="kondisi">
                                            <option value=""></option>
                                            <option {{($data->kondisi == "B") ? 'selected' : ''}} value="B">Baik</option>
                                            <option {{($data->kondisi == "KB") ? 'selected' : ''}} value="KB">Kurang Baik</option>
                                            <option {{($data->kondisi == "RB") ? 'selected' : ''}} value="RB">Rusak Berat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" rows="5" class="form-control" style="resize:none">{{$data->keterangan != null ? $data->keterangan : '-'}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{route('aset.show', $id)}}" class="text-white btn btn-secondary">
                                <i class="fa fa-chevron-left"></i> Kembali
                            </a>
                            <button name="save" type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $("select").select2({
            placeholder: "Pilih....",
            width: "100%"
        });

    </script>
@endpush
