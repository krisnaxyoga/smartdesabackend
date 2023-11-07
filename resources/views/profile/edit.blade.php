@extends('layouts.app')

@section('title')
Profile
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <form method="POST" class="form-horizontal" action="/profile">
                        @csrf
                        <div class="box-body">
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
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-form-label col-3">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input name="name" required type="text" class="form-control m-input" placeholder="Name" value="{{ old('name') ?: $data->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3">Username </label>
                                    <div class="col">
                                        <input name="username" readonly disabled type="text" class="form-control m-input" placeholder="Username" value="{{ old('username') ?: $data->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3">Kata Sandi </label>
                                    <div class="col">
                                        <input name="password" type="password" class="form-control m-input" placeholder="Password" />
                                        <small class="helper-text text-muted">Kosongkan bila tidak ingin mengubah kata sandi.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button name="save" type="submit" class="btn btn-rounded btn-success"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-rounded btn-default">Batal</a>
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