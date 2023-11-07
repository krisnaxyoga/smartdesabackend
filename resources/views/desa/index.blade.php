@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<style>
    .logo-container {
        width: 128px;
        height: 128px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.25);
        border-radius: 4px;
        padding: 4px;
        cursor: pointer;
        transition: all 200ms;
    }

    .logo-container-ld {
        width: 300px;
        height: 150px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.25);
        border-radius: 4px;
        padding: 4px;
        cursor: pointer;
        transition: all 200ms;
    }

    .logo-container-ld > img {
        width: 100%;
        height: 100%;
    }

    .logo-container > img {
        width: 100%;
        height: 100%;
    }

    .logo-container-ld > p {
        width: 100%;
        position: absolute;
        bottom: -100%;
        left: 0;
        text-align: center;
        padding: 8px 0;
        margin: 0;
        color: #fff;
        background: rgba(0, 0, 0, 0.75);
        transition: all 200ms;
    }

    .logo-container-ld:hover {
        border: 1px solid rgba(0, 0, 0, 0.75);
    }

    .logo-container-ld:hover > p {
        bottom: 0;
    }

    .logo-container > p {
        width: 100%;
        position: absolute;
        bottom: -100%;
        left: 0;
        text-align: center;
        padding: 8px 0;
        margin: 0;
        color: #fff;
        background: rgba(0, 0, 0, 0.75);
        transition: all 200ms;
    }

    .logo-container:hover {
        border: 1px solid rgba(0, 0, 0, 0.75);
    }

    .logo-container:hover > p {
        bottom: 0;
    }
</style>
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{ route('desa.update') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lat" value="{{ old('lat') ?: $data->lat }}" />
            <input type="hidden" name="lng" value="{{ old('lng') ?: $data->lng }}" />
            @if(session()->has('success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div>{{ session('success') }}</div>
            </div>
            @endif
            <div class="box">
                <div class="box-header"><h4 class="box-title">Informasi Desa</h4></div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Nama Desa <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_desa" value="{{ old('nama_desa') ?: $data->nama_desa }}" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Alamat Email <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="email_desa" value="{{ old('email_desa') ?: $data->email_desa }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Nomor Telepon <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="telepon" value="{{ old('telepon') ?: $data->telepon }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Situs Web <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="website" value="{{ old('website') ?: $data->website }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Alamat Kantor <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="alamat_kantor" class="form-control" required rows="8">{{ old('alamat_kantor') ?: $data->alamat_kantor }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Kode Pos</label>
                                <div class="col-lg-9">
                                    <input type="text" name="kode_pos" value="{{ old('kode_pos') ?: $data->kode_pos }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">nama_kecamatan</label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_kecamatan" value="{{ old('nama_kecamatan') ?: $data->nama_kecamatan }}" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">nama_kabupaten</label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_kabupaten" value="{{ old('nama_kabupaten') ?: $data->nama_kabupaten }}" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">nama_propinsi</label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_propinsi" value="{{ old('nama_propinsi') ?: $data->nama_propinsi }}" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3">Gambar Logo(klik untuk ganti)</label>
                                <input type="file" style="display: none" name="logo" accept="image/*" />
                                <div class="col-lg-3">
                                    <div class="logo-container">
                                        <img src="{{ $data->logo ?: '/images/dummy-landscape.png' }}" id="logo">
                                        <p>Ganti Gambar</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Gambar Logo Landscape Putih (klik untuk ganti)</label>
                                        <input type="file" style="display: none" name="logo_landscape_white" accept="image/*" />
                                        <div class="logo-container-ld" width="auto" height="100">
                                            <img src="{{ $data->logo_landscape_white ?: '/images/dummy-landscape.png' }}" id="logo_landscape_white" class="img-rounded" alt="Cinque Terre">
                                            <p>Ganti Gambar</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Gambar Logo Landscape Hitam (klik untuk ganti)</label>
                                        <input type="file" style="display: none" name="logo_landscape_black" accept="image/*" />
                                        <div class="logo-container-ld" width="auto" height="100">
                                            <img src="{{ $data->logo_landscape_black ?: '/images/dummy-landscape.png' }}" id="logo_landscape_black" class="img-rounded" alt="Cinque Terre">
                                            <p>Ganti Gambar</p>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label class="col-form-label pt-0">Lokasi</label>
                                <div id="map" style="width: 100%; height: 280px"></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">kode_desa</label>
                        <div class="col-lg-9">
                            <input type="text" name="kode_desa" value="{{ old('kode_desa') ?: $data->kode_desa }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nama_kepala_desa</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_kepala_desa" value="{{ old('nama_kepala_desa') ?: $data->nama_kepala_desa }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nip_kepala_desa</label>
                        <div class="col-lg-9">
                            <input type="text" name="nip_kepala_desa" value="{{ old('nip_kepala_desa') ?: $data->nip_kepala_desa }}" required class="form-control">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nama_kecamatan</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_kecamatan" value="{{ old('nama_kecamatan') ?: $data->nama_kecamatan }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">kode_kecamatan</label>
                        <div class="col-lg-9">
                            <input type="text" name="kode_kecamatan" value="{{ old('kode_kecamatan') ?: $data->kode_kecamatan }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nama_kepala_camat</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_kepala_camat" value="{{ old('nama_kepala_camat') ?: $data->nama_kepala_camat }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nip_kepala_camat</label>
                        <div class="col-lg-9">
                            <input type="text" name="nip_kepala_camat" value="{{ old('nip_kepala_camat') ?: $data->nip_kepala_camat }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nama_kabupaten</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_kabupaten" value="{{ old('nama_kabupaten') ?: $data->nama_kabupaten }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">kode_kabupaten</label>
                        <div class="col-lg-9">
                            <input type="text" name="kode_kabupaten" value="{{ old('kode_kabupaten') ?: $data->kode_kabupaten }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">nama_propinsi</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_propinsi" value="{{ old('nama_propinsi') ?: $data->nama_propinsi }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">kode_propinsi</label>
                        <div class="col-lg-9">
                            <input type="text" name="kode_propinsi" value="{{ old('kode_propinsi') ?: $data->kode_propinsi }}" required class="form-control">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">zoom</label>
                        <div class="col-lg-9">
                            <input type="text" name="zoom" value="{{ old('zoom') ?: $data->zoom }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">map_tipe</label>
                        <div class="col-lg-9">
                            <input type="text" name="map_tipe" value="{{ old('map_tipe') ?: $data->map_tipe }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">path</label>
                        <div class="col-lg-9">
                            <input type="text" name="path" value="{{ old('path') ?: $data->path }}" required class="form-control">
                        </div>
                    </div> --}}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check mr-2"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    let $logoInput = $('[name="logo"]'),
        $logo = document.getElementById('logo'),
        reader = new FileReader();

    let $logoInputLandscapeW = $('[name="logo_landscape_white"]'),
        $logoWhite = document.getElementById('logo_landscape_white'),
        readerWhite = new FileReader();

    let $logoInputLandscapeB = $('[name="logo_landscape_black"]'),
        $logoBlack = document.getElementById('logo_landscape_black'),
        readerBlack = new FileReader();

    let mapContainer = document.getElementById('map'),
        lat = {{ old('lat') ?: $data->lat }},
        lng = {{ old('lng') ?: $data->lng }},
        map, marker;

    function initMap() {
        // Init map.
        map = new google.maps.Map(mapContainer, {
            center: {lat, lng},
            zoom: 15
        })

        marker = new google.maps.Marker({
            position: {lat, lng},
            map
        })

        google.maps.event.addListener(map, 'center_changed', function () {
            let coordinate = this.getCenter()

            marker.setPosition(coordinate) // set marker position to map center
            $('[name="lat"]').val(coordinate.lat())
            $('[name="lng"]').val(coordinate.lng())
        });
    }

    $(document).ready(function() {
        $('#logo').on('click', function () {
            $logoInput.trigger('click')
        })

        $logoInput.on('change', function (event) {
            reader.onload = function(){
                $logo.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0])
        })
    })

    $(document).ready(function() {
        $('#logo_landscape_white').on('click', function () {
            $logoInputLandscapeW.trigger('click')
        })

        $logoInputLandscapeW.on('change', function (event) {
            readerWhite.onload = function(){
                $logoWhite.src = readerWhite.result;
            }
            readerWhite.readAsDataURL(event.target.files[0])
        })
    })

    $(document).ready(function() {
        $('#logo_landscape_black').on('click', function () {
            $logoInputLandscapeB.trigger('click')
        })

        $logoInputLandscapeB.on('change', function (event) {
            readerBlack.onload = function(){
                $logoBlack.src = readerBlack.result;
            }
            readerBlack.readAsDataURL(event.target.files[0])
        })
    })


</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=drawing" async defer></script>
@endpush
