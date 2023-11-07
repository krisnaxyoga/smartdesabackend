@extends('layouts.app')
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">

        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3>Setting</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <form action="{{ url('setting/store') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="margin-bottom:0px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                            {{ Session::get('success') }}
                            </div>
                            
                        @endif
                        <div class="box-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Merchant Code <span class="required"> * </span></label>
                                    <input name="merchant_code" disabled type="text" class="form-control m-input" placeholder="Merchant Code" value="{{ old('merchant_code') ?: $data->merchant_code }}">
                                </div>

                                <div class="form-group">
                                    <label>Name <span class="required"> * </span></label>
                                    <input name="name" required type="text" class="form-control m-input" placeholder="Name" value="{{ old('name') ?: $data->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Legal Name <span class="required"> * </span></label>
                                    <input name="legal_name" required type="text" class="form-control m-input" placeholder="Legal Name" value="{{ old('legal_name') ?: $data->legal_name }}">
                                </div>

                                <div class="form-group">
                                    <label>Person In Contact <span class="required"> * </span></label>
                                    <input name="pic" required type="text" class="form-control m-input" placeholder="Pic" value="{{ old('pic') ?: $data->pic }}">
                                </div>

                                <div class="form-group">
                                    <label>Address <span class="required"> * </span></label>
                                    <input name="address" required type="text" class="form-control m-input" placeholder="Address" value="{{ old('address') ?: $data->address }}">
                                </div>

                                <div class="form-group">
                                    <label>Phone <span class="required"> * </span></label>
                                    <input name="phone" required type="text" class="form-control m-input" placeholder="Phone" value="{{ old('phone') ?: $data->phone }}">
                                </div>

                                <div class="form-group">
                                    <label>E-mail <span class="required"> * </span></label>
                                    <input name="email" required type="text" class="form-control m-input" placeholder="E-mail" value="{{ old('email') ?: $data->email }}">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">
                                        Logo <span class="required"> * </span>
                                    </label><br>
                                    <img src="{{ $data->logo }}" class="mt-2" width="200" />
                                    <input class="form-control" type="file" name="logo" />
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <span>Active</span>
                                    </div>
                                    <div class="col-lg-11">
                                        <label class="ui-switch ui-switch-md green mt-1 mr-2">
                                            <input type="checkbox" name="active" {{ (old('active') ?: $data->active) == 1 ? 'checked' : '' }} value="1">
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            <a href="#" class="btn btn-default" onclick="window.history.back();">Cancel</a>
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
    $(document).on('click', '#upload-button', function () {
        let target = $(this).data('target')

        $('input[name=' + target + ']').trigger('click');
    })

    $(document).on('change', '[name=logo]', function () {
        let filename = $(this).val().split('\\').pop();
        $('#photo-filename').val(filename);
    })
</script>
@endsection