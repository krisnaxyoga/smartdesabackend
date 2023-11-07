@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('action')
<a  data-toggle="modal" style="color : #fff" data-toggle="modal" data-target="#tambah-tindak-modal" class="btn btn-rounded btn-primary"><i class="fa fa-plus"></i> Tambah Tindak Lanjut</a>
 @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row align-items-stretch">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header primary">
                        <h3>{{$pengaduan->title}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="content">
                            <p class="pb-2">{!! $pengaduan->content !!}</p>
                            <h6>Informasi Pendukung</h6>
                            <div class="table-responsive">
                                <table class="table table-striped b-t">
                                    <tbody>
                                        <tr>
                                            <td style="width : 150px"><b>No. Pengaduan</b></td>
                                            <td style="width : 10px" >:</td>
                                            <td>{{ $pengaduan->no_pengaduan }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Disposisi</b></td>
                                            <td>:</td>
                                            <td>{{$pengaduan->disposisi}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Laporan</b></td>
                                            <td>:</td>
                                            <td>{{ date('d/m/Y, H:i:s',strtotime($pengaduan->created_at)) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kategori Pengaduan</b></td>
                                            <td>:</td>
                                            <td>{{$pengaduan->category->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>:</td>
                                            <td>
                                                @if ($pengaduan->status == "PUBLISH")
                                                    <div class="badge  blue"><p class="m-1 text-white">{{$pengaduan->status}}</p></div>
                                                @elseif ($pengaduan->status == "ON PROGRESS")
                                                    <div class="badge  orange"><p class="m-1 text-white">{{$pengaduan->status}}</p></div>
                                                @elseif ($pengaduan->status == "DONE")
                                                    <div class="badge  success"><p class="m-1 text-white">{{$pengaduan->status}}</p></div>
                                                @elseif ($pengaduan->status == "NOSHOW")
                                                    <div class=" badge  dark"><p class="m-1 text-white">{{$pengaduan->status}}</p></div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelapor</b></td>
                                            <td>:</td>
                                            <td>{{$pengaduan->pelapor->nama}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Informasi Tambahan</b></td>
                                            <td>:</td>
                                            <td><img src="https://s3-ap-southeast-1.amazonaws.com/smartdesa/{{$pengaduan->photo}}" width="35%"  alt=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header accent">
                        <h3>Lokasi Pengaduan</h3>
                    </div>
                    <div class="box-body">
                        <div id="pengaduanMap" style="height : 250px; width : 100%"></div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header indigo">
                        <h3>Tindak Lanjut Pengaduan</h3>
                    </div>
                    <div class="box-body">
                        <div class="padding" style="background-color: #F9F9F9">
                            <ul class="timeline timeline-center">
                                <li class="tl-header">
                                    <div class="btn white" data-toggle-class="timeline-center" data-target=".timeline">Tindak Lanjut</div>
                                </li>
                                @foreach ($list_tindakan as $key => $value)

                                            @if($value->user_type != "PENDUDUK")
                                                <li class="tl-item">
                                                    <div class="tl-wrap b-primary">
                                                        <span class="tl-date text-muted">{{ date('d/m/Y H:i:s',strtotime($value->created_at)) }}</span>
                                                        <div class="tl-content box-color text-color w-xl w-auto-xs">
                                                            <span class="arrow b-white left pull-top"></span>
                                                            <div class="box-header font-bold">{{$value->comment_by}} - {{$value->comment_jabatan}}</div>
                                                            <div class="box-divider"></div>
                                                            <div class="box-body">
                                                                <p class="text-dark">{{$value->content}}</p>
                                                                @if($value->photo != null)
                                                                <p>
                                                                    <span class="d-inline-block b-a w-196">
                                                                        <img src="https://s3-ap-southeast-1.amazonaws.com/smartdesa/{{$value->photo}}" alt="." width="100%">
                                                                        </span>
                                                                </p>
                                                                @endif
                                                                <div class="sl-footer">
                                                                    <form action="{{ route('comment.destroy', $value->id) }}" method="post">
                                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                                        <button class="no-border pl-0 ml-0 text-dark" style="background: none;">
                                                                            <i class="fa fa-fw fa-trash text-dark"></i> Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="tl-item tl-left">
                                                    <div class="tl-wrap b-info">
                                                        <span class="tl-date text-muted">{{ date('d/m/Y H:i:s',strtotime($value->created_at)) }}</span>
                                                        <div class="tl-content box-color info block">
                                                            <span class="arrow b-info left pull-top hidden-left"></span>
                                                            <span class="arrow b-info right pull-top visible-left"></span>
                                                            <div class="box-header font-bold">{{$value->comment_by}}</div>
                                                            <div class="box-divider"></div>
                                                            <div class="box-body">
                                                                <p class="text-white">{{$value->content}}</p>
                                                                @if($value->photo != null)
                                                                <p>
                                                                    <span class="d-inline-block b-a w-196">
                                                                        <img src="https://s3-ap-southeast-1.amazonaws.com/smartdesa/{{$value->photo}}" alt="." width="100%">
                                                                    </span>
                                                                </p>
                                                                @endif
                                                                <div class="sl-footer">
                                                                    <form action="{{ route('comment.destroy', $value->id) }}" method="post">
                                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                                        <button class="no-border pl-0 ml-0 text-white" style="background: none;">
                                                                            <i class="fa fa-fw fa-trash text-white"></i> Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.tambah-tindak-modal')
@endsection @push('scripts')
<script>
    let map, marker;

    function initMap() {
        let latitude = {{ $pengaduan->lat ? : -8.64460 }}
        let longitude = {{ $pengaduan->lng ? : 115.2046587 }}
        center = {
            lat: latitude,
            lng: longitude
        };

        map = new google.maps.Map(document.getElementById('pengaduanMap'), {
            center: center,
            zoom: 16,
            scrollwheel: false
        });

        marker = new google.maps.Marker({
            map: map,
            position: center
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
</script>

@endpush
