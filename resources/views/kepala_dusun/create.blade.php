@extends('layouts.app')

@section('title', $page_title)

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Form Kepala Dusun</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form method="POST" action="{{ url('kepala-dusun') }}">
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
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="name" required type="text" class="form-control m-input" placeholder="Nama" value="{{ old('name') }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" required type="text" class="form-control m-input" placeholder="Username" value="{{ old('username') }}">
                                </div> --}}
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input name="phone" type="tel" class="form-control m-input" placeholder="Nomor Telepon" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <label>Dusun</label>
                                    <select name="dusun_id" id="" required class="form-control">
                                        @foreach($dusun as $item)
                                            <option value="{{$item->id}}">{{$item->dusun}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>PIN</label>
                                    <input name="pin" required type="password" class="form-control m-input" placeholder="Pin">
                                </div> --}}
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('kepala-dusun') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        {{-- <button name="savenew" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sa÷ve &amp; New</button> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection