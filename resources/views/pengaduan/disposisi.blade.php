@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('pengaduan.disposisi', $pendaduan->id)}}" method="POST">
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
                            <h3>Form Disposisi</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Disposisi </label>
                                <select name="target_disposisi" class="form-control select-2" required>
                                    <option></option>
                                    <optgroup label="Staff Desa">
                                        @foreach($data_staff_desa as $staff)
                                            <option value="{{$staff->jabatan}}">{{$staff->nama." ( ".$staff->jabatan." )"}}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kadus">
                                        @foreach($data_kadus as $kadus)
                                            <option value="{{$kadus->dusun}}">{{$kadus->name." ( Kepala ".$kadus->dusun." )"}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>

                            </div>



                            <div class="form-group">
                                <label>Komen Tindakan</label>
                                <textarea class="form-control" name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('pengaduan.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
 $("select[name=target_disposisi]").select2({
        placeholder : "Pilih Disposisi...",
        width : '100%'
    })
</script>
@endpush
