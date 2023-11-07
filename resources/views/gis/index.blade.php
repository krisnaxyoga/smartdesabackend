<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>Peta Desa | {{ $villageData->nama_desa }}</title>
    <meta name="description" content="Peta Desa {{ $villageData->nama_desa }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/theme/assets/images/logo.svg">
    <meta name="apple-mobile-web-app-title" content="Peta Desa | {{ $villageData->nama_desa }}">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/theme/assets/images/logo.svg">

    <!-- build:css ../theme/assets/css/app.min.css -->
    <link rel="stylesheet" href="/theme/libs/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/theme/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/theme/assets/css/theme/success.css" type="text/css" />
    <link rel="stylesheet" href="/theme/assets/css/app.css" type="text/css" />
    <link rel="stylesheet" href="/theme/assets/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="/css/checkbox.css" type="text/css" />
    <!-- endbuild -->
    <style>
      #content-main,
      #citizen-map {
        width: 100%;
        height: 100%;
      }

      .nav-tabs {
        overflow-y: hidden;
        flex-wrap: nowrap;
      }

      .list-group.form .box-body {
        padding: 0;
      }

      .list-group.form .list-item {
        padding: 0.5rem;
        padding-top: calc(0.5rem + 2px);
        cursor: pointer;
        font-size: 13px;
      }

      .list-group.form .list-item .list-body {
        line-height: 32px;
      }

      .list-group.form a.list-item .fa {
        -moz-transition: all 100ms linear;
        -webkit-transition: all 100ms linear;
        transition: all 100ms linear;
      }

      .list-group.form a.list-item[aria-expanded="true"] .fa {
        -ms-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
      }

      .list-group.form .list-item .list-icon {
        line-height: 32px;
      }

      .list-group.form .list-item .list-icon i {
        margin-right: 0px
      }

      .list-group.form .form-group {
        margin: 0;
      }

      label span {
        font-size: 13px;
      }
    </style>
  </head>
  <body class="fixed-aside fixed-content">
    @if (request()->get('header') !== 'false')
    <header class="app-header box-shadow-y">
      <div class="navbar navbar-expand-lg indigo dark d-flex">
        <a href="#" class="navbar-brand">
          <strong>{{ $villageData->nama_desa }}</strong>
        </a>
	      <ul class="nav flex-row ml-auto">
          @if (auth()->user() == null)
          <li class="d-flex align-items-center mr-3">
            <a href="/gis/logout" class="d-flex align-items-center" style="font-size: 14px"><strong>Logout</strong></a>
          </li>
          @else
          <li class="d-flex align-items-center mr-3">
            <a href="/" class="d-flex align-items-center" style="font-size: 14px"><strong>Kembali</strong></a>
          </li>
          @endif
          <li class="d-flex align-items-center filter-menu hidden">
            <a href="#" class="d-flex align-items-center">
              <span style="font-size: 24px"><i class="fa fa-bars"></i></span>
            </a>
          </li>
	      </ul>
      </div>
    </header>
    @endif
    <div class="app" id="app">
      <div id="content" class="app-content box-shadow-2 box-radius-2" role="main">
        <div class="content-main" id="content-main">
          <div id="citizen-map"></div>
          <div id="search-template" style="display: none">
            <div class="box" style="margin: 0 10px; width: calc(100% - 20px); height: 100%; max-height: calc(100% - 48px); overflow: hidden">
              <div class="b-b nav-active-bg box-header" style="padding-bottom: 0">
                <ul class="nav nav-tabs">
                  @if (request()->type == 'village' || empty(request()->type))
                  <li class="nav-item">
                    <a class="nav-link ml-0" href="#" data-toggle="tab" data-target="#tab-peta-desa">Peta Desa</a>
                  </li>
                  @endif
                  @if (request()->type == 'social' || empty(request()->type))
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-peta-sosial">Peta Sosial</a>
                  </li>
                  @endif
                  @if (request()->type == 'family' || empty(request()->type))
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-peta-keluarga">Keluarga</a>
                  </li>
                  @endif
                  @if (request()->type == 'citizen' || empty(request()->type))
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-citizen">Penduduk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-statistics">Statistik</a>
                  </li>
                  @endif
                  @if (request()->type !== 'citizen' || empty(request()->type))
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-dusun">Dusun</a>
                  </li>
                  @endif
                </ul>
              </div>
              <div class="tab-content" style="overflow-y: auto; height: calc(100% - 52px); max-height: 100%">
                @if (request()->type == 'village' || empty(request()->type))
                <div class="tab-pane" id="tab-peta-desa">
                  <form class="list-group form" id="legend-form">
                    <div class="box-body" id="accordion">
                      <a href="#location-collapse" data-toggle="collapse" class="list-item mb-0 collapsed">
                        <div class="list-body"><span>Bangunan</span></div>
                        <div class="list-icon"><i class="fa fa-chevron-right"></i></div>
                      </a>
                      <div class="collapse" id="location-collapse" data-parent="#accordion">
                        <label v-for="(item, index) in types.locations" class="list-item mb-0" :for="'location-' + item.id">
                          <div class="list-body">
                            <input class="inp-cbx" :id="'location-' + item.id" name="tipe_lokasi_id[]" data-type="location" :value="item.id" type="checkbox" style="display: none">
                            <div class="cbx">
                              <span>
                                <svg width="12px" height="10px" viewBox="0 0 12 10">
                                  <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                              </span>
                              <span>@{{ item.name }}</span>
                            </div>
                          </div>
                          <div>
                            <img :src="'/images/markers/' + item.icon" height="32" />
                          </div>
                        </label>
                      </div>
                      <a href="#area-collapse" data-toggle="collapse" class="list-item mb-0 collapsed">
                        <div class="list-body"><span>Wilayah</span></div>
                        <div class="list-icon"><i class="fa fa-chevron-right"></i></div>
                      </a>
                      <div class="collapse" id="area-collapse" data-parent="#accordion">
                        <label v-for="(item, index) in types.areas" class="list-item mb-0" :for="'area-' + item.id">
                          <div class="list-body">
                            <input class="inp-cbx" :id="'area-' + item.id" data-type="area" name="tipe_area_id[]" :value="item.id" type="checkbox" style="display: none">
                            <div class="cbx">
                              <span>
                                <svg width="12px" height="10px" viewBox="0 0 12 10">
                                  <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                              </span>
                              <span>@{{ item.name }}</span>
                            </div>
                          </div>
                          <div>
                            <span class="w-32 circle avatar" :style="'background-color: #' + item.color"></span>
                          </div>
                        </label>
                      </div>
                      <a href="#line-collapse" data-toggle="collapse" class="list-item mb-0 collapsed">
                        <div class="list-body"><span>Garis</span></div>
                        <div class="list-icon"><i class="fa fa-chevron-right"></i></div>
                      </a>
                      <div class="collapse" id="line-collapse" data-parent="#accordion">
                        <label v-for="(item, index) in types.lines" class="list-item mb-0" :for="'line-' + item.id">
                          <div class="list-body">
                            <input class="inp-cbx" :id="'line-' + item.id" data-type="line" name="tipe_garis_id[]" :value="item.id" type="checkbox" style="display: none">
                            <div class="cbx">
                              <span>
                                <svg width="12px" height="10px" viewBox="0 0 12 10">
                                  <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                              </span>
                              <span>@{{ item.name }}</span>
                            </div>
                          </div>
                          <div>
                            <span class="w-32 circle avatar" :style="'background-color: #' + item.color"></span>
                          </div>
                        </label>
                      </div>
                    </div>
                  </form>
                </div>
                @endif
                @if (request()->type == 'social' || empty(request()->type))
                <div class="tab-pane" id="tab-peta-sosial">
                  <form class="list-group form" id="group-form">
                    <div class="box-body">
                      <label v-for="(group, index) in types.groups" class="list-item mb-0" :for="'group-' + group.id">
                        <div class="list-body">
                          <input class="inp-cbx" :id="'group-' + group.id" name="group[]" :value="group.id" checked type="checkbox" style="display: none">
                          <div class="cbx">
                            <span>
                              <svg width="12px" height="10px" viewBox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                              </svg>
                            </span>
                            <span>@{{ group.nama }}</span>
                          </div>
                        </div>
                      </label>
                    </div>
                  </form>
                </div>
                @endif
                @if (request()->type == 'family' || empty(request()->type))
                <div class="tab-pane" id="tab-peta-keluarga">
                    <form class="form" id="search-family">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label">Kelas Sosial</label>
                                <select name="social_class" class="form-control">
                                <option value="0">Semua Kelas Sosial</option>
                                @foreach ($social_class as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Dusun</label>
                                <select name="region" class="form-control">
                                <option value="0">Semua Dusun</option>
                                @foreach ($regions as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->dusun }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">No. KK</label>
                                <input type="text" name="no_kk" maxlength="20" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Anggota Keluarga</label>
                                <input type="text" name="anggota" maxlength="20" class="form-control" />
                            </div>
                            <hr />
                            <div class="text-right">
                                <button type="submit" :disabled="searching" class="btn btn-primary"><i :class="['fa', {'fa-search': !searching}, {'fa-spin fa-spinner': searching}]"></i>&nbsp;&nbsp;CARI DATA</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                @if (request()->type == 'citizen' || empty(request()->type))
                <div class="tab-pane" id="tab-citizen">
                  <form class="form" id="search-form">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="control-label">Status Penduduk</label>
                        <select name="status" class="form-control">
                          <option value="0">Semua Status</option>
                          @foreach ($statuses as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Jenis Kelamin</label>
                        <select name="sex" class="form-control">
                          <option value="0">Semua Jenis Kelamin</option>
                          @foreach ($sexes as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Dusun</label>
                        <select name="region" class="form-control">
                          <option value="0">Semua Dusun</option>
                          @foreach ($regions as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->dusun }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Nama Penduduk</label>
                        <input type="text" name="name" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label class="control-label">NIK</label>
                        <input type="text" name="nik" maxlength="20" class="form-control" />
                      </div>
                      <hr />
                      <div class="text-right">
                        <button type="submit" :disabled="searching" class="btn btn-primary"><i :class="['fa', {'fa-search': !searching}, {'fa-spin fa-spinner': searching}]"></i>&nbsp;&nbsp;CARI DATA</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="tab-statistics">
                  <div class="box-body">
                    <select v-model="indicator" id="indicator" class="form-control mb-3" v-on:change="loadStatistics()">
                      <option value="">Pilih indikator statistik</option>
                      <option v-for="(row, index) in indicators" :key="index" :value="row['name']">@{{ row['label'] }}</option>
                    </select>
                    <table width="100%" class="table table-bordered" id="statistics-table" style="display: none">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Keterangan</th>
                          <th class="text-center" colspan="2">Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td>JUMLAH</td>
                          <td class="text-right subtotal-count">2</td>
                          <td class="text-right subtotal-percent">100,0%</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>BELUM MENGISI</td>
                          <td class="text-right empty-count">0</td>
                          <td class="text-right empty-percent">0,0%</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>TOTAL</td>
                          <td class="text-right total-count">2</td>
                          <td class="text-right total-percent">100,0%</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                @endif
                @if (request()->type !== 'citizen' || empty(request()->type))
                <div class="tab-pane" id="tab-dusun">
                  <form class="list-group form" id="region-form">
                    <div class="box-body">
                      <label v-for="(region, index) in regionareas" class="list-item mb-0" :for="'region-' + region.id">
                        <div class="list-body">
                          <input class="inp-cbx dusun-check" :id="'region-' + region.id" name="region[]" :value="region.id" data-type="dusun" type="checkbox" style="display: none">
                          <div class="cbx">
                            <span>
                              <svg width="12px" height="10px" viewBox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                              </svg>
                            </span>
                            <span>@{{ region.dusun }}</span>
                          </div>
                        </div>
                      </label>
                    </div>
                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- build:js scripts/app.min.js -->
    <!-- jQuery -->
    <script src="/theme/libs/jquery/dist/jquery.min.js"></script>
    <script src="/theme/libs/vue.min.js"></script>
    <!-- Bootstrap -->
    <script src="/theme/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/theme/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- core -->
    <script src="/theme/libs/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript">
      let map = null,
        searchControl = document.createElement('div'),
        vm = new Vue({
          data: {
            init: false,
            searching: false,
            type: "{{ request()->type }}",
            header: $('.app-header').length > 0,
            indicator: "agama",
            search: {
              desaId: "{{ $villageData->id }}",
              show: false,
              status: 0,
              sex: 0,
              region: 0,
              name: null,
              nik: null
            },
            search_family: {
              show: false,
              social_class: 0,
              region: 0,
              no_kk: null,
              anggota: null,
              desaId: "{{ $villageData->id }}",
            },
            types: {
              groups: {!! isset($groupTypes) ? $groupTypes : '[]' !!},
              lines: {!! isset($lineTypes) ? $lineTypes : '[]' !!},
              locations: {!! isset($locationTypes) ? $locationTypes : '[]' !!},
              areas: {!! isset($areaTypes) ? $areaTypes : '[]' !!}
            },
            regions: {!! isset($regions) ? $regions : '[]' !!},
            regionareas: {!! isset($regionareas) ? $regionareas : '[]' !!},
            indicators: {!! isset($indicators) ? $indicators : '[]' !!},
            citizens: [],
            familys: [],
            members:[],
            areas: [],
            dusuns: [],
            lines: [],
            locations: [],
            statistics: [],
            groups: [],
            citizenMarkers: [],
            familyMarkers: [],
            desaId: "{{ $villageData->id }}",
            infoWindow: null,
            detailWindow: null
          },
          methods: {
            citizenInfo(index) {
              let citizen = this.citizens[index],
                marker = this.citizenMarkers[index],
                content = '<table width="320px"> \
                  <tr> \
                    <td width="25%" valign="top" style="padding-right: 15px"> \
                      <img src="' + (citizen.foto == null || citizen.foto == '' ? '/images/Dummy.jpg' : citizen.foto) + '" width="100%" /> \
                    </td> \
                    <td> \
                      <table class="table table-bordered"> \
                        <tr> \
                          <td style="font-weight: bold">Nama</td> \
                          <td>' + citizen.nama + '</td> \
                        </tr> \
                        <tr> \
                          <td style="font-weight: bold">NIK</td> \
                          <td>' + citizen.nik.slice(0, -6) + 'XXXXXX' + '</td> \
                        </tr> \
                        <tr> \
                          <td style="font-weight: bold">Alamat</td> \
                          <td>' + (citizen.alamat_sekarang ? citizen.alamat_sekarang : '-') + '</td> \
                        </tr> \
                        <tr> \
                          <td style="font-weight: bold">Dusun</td> \
                          <td>' + citizen.dusun + '</td> \
                        </tr> \
                      </table> \
                    </td> \
                  </tr> \
                </table>'

              this.detailWindow.close()
              this.detailWindow.setContent(content)
              this.detailWindow.open(map, marker)
            },
            familyInfo(index) {
              let family = this.familys[index],
                marker = this.familyMarkers[index],
                str = JSON.stringify(family.penduduk),
                person = JSON.parse(str),
                content = '<table width="600px"> \
                <tr> \
                    <td> \
                        <table class="table table-bordered" width="600px"> \
                            <tr> \
                                <td style="font-weight: bold" width="120px">No. KK</td> \
                                <td>' + family.no_kk.slice(0, -6) + 'XXXXXX' + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Kepala Keluarga</td> \
                                <td>' + family.kepala_keluarga + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Dusun</td> \
                                <td>' + family.nama_dusun + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Alamat</td> \
                                <td>' + (family.alamat_sekarang ? family.alamat_sekarang : '-') + '</td> \
                            </tr> \
                        </table> \
                    </td> \
                </tr> \
                <tr> \
                    <td> \
                        <table class="table table-bordered" width="600px"> \
                            <tr> \
                                <td colspan=5 style="text-align:center;font-weight: bold">Anggota Keluarga</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">No</td> \
                                <td style="font-weight: bold">NIK</td> \
                                <td style="font-weight: bold">Nama</td> \
                                <td style="font-weight: bold">Jenis Kelamin</td> \
                                <td style="font-weight: bold">Tanggal Lahir</td> \
                            </tr> \
                            '
                            let i = 0
                                person.forEach(function(item){
                                    // console.log(item.nama + " " + item.sex + " " + item.tanggallahir);
                                    content += '<tr> \
                                            <td>'+ (++i) +'</td> \
                                            <td>'+ (item.nik) +'</td> \
                                            <td>'+ (item.nama) +'</td> \
                                            <td>'+ (item.jenis_kelamin.nama) +'</td> \
                                            <td>'+ (item.tanggal_lahir_format) +'</td> \
                                        </tr> \
                                    '
                                })
                    content += '</table> \
                    </td> \
                </tr> \
                </table>'



              this.detailWindow.close()
              this.detailWindow.setContent(content)
              this.detailWindow.open(map, marker)
            },
            familyInfo(index) {
              let family = this.familys[index],
                marker = this.familyMarkers[index],
                str = JSON.stringify(family.penduduk),
                person = JSON.parse(str),
                content = '<table width="600px"> \
                <tr> \
                    <td> \
                        <table class="table table-bordered" width="600px"> \
                            <tr> \
                                <td style="font-weight: bold" width="120px">No. KK</td> \
                                <td>' + family.no_kk.slice(0, -6) + 'XXXXXX' + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Kepala Keluarga</td> \
                                <td>' + family.kepala_keluarga + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Dusun</td> \
                                <td>' + family.nama_dusun + '</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">Alamat</td> \
                                <td>' + (family.alamat_sekarang ? family.alamat_sekarang : '-') + '</td> \
                            </tr> \
                        </table> \
                    </td> \
                </tr> \
                <tr> \
                    <td> \
                        <table class="table table-bordered" width="600px"> \
                            <tr> \
                                <td colspan=5 style="text-align:center;font-weight: bold">Anggota Keluarga</td> \
                            </tr> \
                            <tr> \
                                <td style="font-weight: bold">No</td> \
                                <td style="font-weight: bold">NIK</td> \
                                <td style="font-weight: bold">Nama</td> \
                                <td style="font-weight: bold">Jenis Kelamin</td> \
                                <td style="font-weight: bold">Tanggal Lahir</td> \
                            </tr> \
                            '
                            let i = 0
                                person.forEach(function(item){
                                    // console.log(item.nama + " " + item.sex + " " + item.tanggallahir);
                                    content += '<tr> \
                                            <td>'+ (++i) +'</td> \
                                            <td>'+ (item.nik) +'</td> \
                                            <td>'+ (item.nama) +'</td> \
                                            <td>'+ (item.jenis_kelamin.nama) +'</td> \
                                            <td>'+ (item.tanggal_lahir_format) +'</td> \
                                        </tr> \
                                    '
                                })
                    content += '</table> \
                    </td> \
                </tr> \
                </table>'



              this.infoWindow.close()
              this.infoWindow.setContent(content)
              this.infoWindow.open(map, marker)
            },
            locationInfo(index) {
              let location = this.locations[index],
                marker = location.object,
                content = '<table width="320px"> \
                  <tr> \
                    <td valign="top" class="text-center"> \
                      <img src="' + (location.photo == null || location.photo == '' ? '/images/dummy-landscape.png' : location.photo) + '" width="50%" style="margin-bottom: 8px" /> \
                    </td> \
                  </tr> \
                  <tr> \
                    <td valign="top"> \
                      <h5 class="text-center">' + location.name + '</h5> \
                      ' + (location.description == null ? '' : '<div>' + location.description + '</div>') + ' \
                    </td> \
                  </tr> \
                </table>'

              this.detailWindow.close()
              this.detailWindow.setContent(content)
              this.detailWindow.open(map, marker)
            },
            groupInfo(index) {
              let group = this.groups[index],
                marker = group.object,
                content = '<h6>Penerima Program</h6> \
                  <br />\
                  <p valign="top">\
                    <strong>Program</strong><br />\
                    ' + group.nama + '\
                  </p>\
                  <p valign="top">\
                    <strong>Peserta</strong><br />\
                    ' + group.penduduk.nama + '\
                  </p>'
                  // \
                  // <p valign="top">\
                  //   <strong>Kategori</strong><br />\
                  //   ' + group.kategori.kelompok + '\
                  // </p>\
                  // <p valign="top">\
                  //   <strong>Anggota</strong><br />\
                  //   ' + group.jml_anggota + ' orang\
                  // </p>\
                  // <p valign="top">\
                  //   <strong>Keterangan</strong><br />\
                  //   ' + group.keterangan + '\
                  // </p>'

              this.detailWindow.close()
              this.detailWindow.setContent(content)
              this.detailWindow.open(map, marker)
            },
            control(controlDiv, icon, callback) {
              // Set CSS for the control border.
              var controlUI = document.createElement('div')
              controlUI.style.backgroundColor = '#fff'
              controlUI.style.border = '2px solid #fff'
              controlUI.style.borderRadius = '3px'
              controlUI.style.boxShadow = '0 2px 4px rgba(0,0,0,.1)'
              controlUI.style.cursor = 'pointer'
              controlUI.style.margin = '10px'
              controlUI.style.textAlign = 'center'
              controlUI.style.width = '40px'
              controlDiv.appendChild(controlUI)

              // Set CSS for the control interior.
              var controlText = document.createElement('i')
              controlText.className = "fa " + icon
              controlText.style.fontSize = "18px"
              controlText.style.lineHeight = '36px'
              controlText.style.color = '#666666'
              controlUI.appendChild(controlText)

              // Setup the click event listeners.
              if (typeof callback === 'function') {
                controlUI.addEventListener('click', callback)
              }
            },
            loadCitizens($event) {
              let self = this

              // Set searching flag to true.
              self.searching = true

              $.ajax({
                url: '{{ env("BASE_URL") }}/peta/filter',
                data: self.search
              })
              .then((response) => {
                self.citizenMarkers.forEach((item, index) => {
                  item.setMap(null)
                })
                self.citizenMarkers = []
                self.citizens = response

                response.forEach((item, index) => {
                  let marker = new google.maps.Marker({
                    position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                    icon: '/images/markers/male-2.png',
                    title: item.nama,
                    map
                  })

                  marker.addListener('click', () => {
                    console.log(self)
                    self.citizenInfo(index)
                  })

                  self.citizenMarkers.push(marker)
                })

                $('#search-modal').modal('hide')
              }, function (xhr) {
                // Show errors if present.
              })
              .always(() => {
                // Set searching flag to false.
                self.searching = false
              })
            },
            loadAreas() {
              let $categoryInput = $('input[name="tipe_area_id[]"]:checked'),
                $regionInput = $('input[name="region[]"]'),
                regions = $regionInput.serialize(),
                categories = $categoryInput.serialize()

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/area',
                data: 'type=json' + ($regionInput.length > 0 ? '&' + (regions !== '' ? regions : 'region[]') : '&region') + ($categoryInput.length > 0 ? '&' + (categories !== '' ? categories : 'tipe_area_id[]') : '&tipe_area_id') + `&desa_id=${this.desaId}`
              })
              .then((response) => {
                response.forEach((item, index) => {
                  let object = new google.maps.Polygon({
                    path: item.coordinates,
                    strokeColor: item.tipe_area !== null ? '#' + item.tipe_area.color : '#000',
                    fillColor: item.tipe_area !== null ? '#' + item.tipe_area.color : '#000',
                    fillOpacity: 0.35
                  })

                  object.setMap(map)
                  object.addListener('mouseover', (e) => {
                    let bounds = new google.maps.LatLngBounds();

                    item.coordinates.forEach((coordinate) => {
                      bounds.extend(coordinate)
                    })

                    this.infoWindow.close()
                    this.infoWindow.setContent(item.name)
                    this.infoWindow.setPosition(bounds.getCenter())
                    this.infoWindow.open(map)
                  })
                  object.addListener('mouseout', () => {
                    this.infoWindow.close()
                  })

                  response[index]['object'] = object
                })

                this.removeMarkers(this.areas)
                this.areas = response
              })
            },
            loadDusun() {
              let $regionInput = $('input[name="region[]"]'),
                regions = $regionInput.serialize()

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/wilayah',
                data: 'type=json' + ($regionInput.length > 0 ? '&' + (regions !== '' ? regions : 'region[]') : '&region') + '&' + `&desa_id=${this.desaId}`
              })
              .then((response) => {
                response.forEach((item, index) => {

                  loc = JSON.parse(item.coordinate);
                  let object = new google.maps.Polygon({
                    path: loc,
                    strokeColor: '#32a89d',
                    fillColor: '#32a89d',
                    fillOpacity: 0.35
                  })

                  object.setMap(map)
                  object.addListener('mouseover', (e) => {
                    let bounds = new google.maps.LatLngBounds();

                    loc.forEach((coordinate) => {
                      bounds.extend(coordinate)
                    })

                    this.infoWindow.close()
                    this.infoWindow.setContent(item.dusun)
                    this.infoWindow.setPosition(bounds.getCenter())
                    this.infoWindow.open(map)
                  })
                  object.addListener('mouseout', () => {
                    this.infoWindow.close()
                  })

                  response[index]['object'] = object
                })

                this.removeMarkers(this.dusuns)
                this.dusuns = response
              })
            },
            loadLines() {
              let $categoryInput = $('input[name="tipe_garis_id[]"]:checked'),
                categories = $categoryInput.serialize()

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/typology',
                data: 'type=json' + ($categoryInput.length > 0 ? '&' + (categories !== '' ? categories : 'tipe_garis_id[]') : '&tipe_garis_id') + `&desa_id=${this.desaId}`
              })
              .then((response) => {
                response.forEach((item, index) => {
                  let object = new google.maps.Polyline({
                    path: item.coordinates,
                    strokeColor: item.tipe_garis !== null ? '#' + item.tipe_garis.color : '#000',
                  })

                  object.setMap(map)
                  object.addListener('mouseover', (e) => {
                    this.infoWindow.close()
                    this.infoWindow.setContent(item.name)
                    this.infoWindow.setPosition(e.latLng)
                    this.infoWindow.open(map)
                  })
                  object.addListener('mouseout', () => {
                    this.infoWindow.close()
                  })

                  response[index]['object'] = object
                })

                this.removeMarkers(this.lines)
                this.lines = response
              })
            },
            loadLocations() {
              let $categoryInput = $('input[name="tipe_lokasi_id[]"]:checked'),
                $regionInput = $('input[name="region[]"]'),
                regions = $regionInput.serialize(),
                categories = $categoryInput.serialize()

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/lokasi',
                data: 'type=json' + ($regionInput.length > 0 ? '&' + (regions !== '' ? regions : 'region[]') : '&region') + ($categoryInput.length > 0 ? '&' + (categories !== '' ? categories : 'tipe_lokasi_id[]') : '&tipe_lokasi_id') + `&desa_id=${this.desaId}`
              })
              .then((response) => {
                response.forEach((item, index) => {
                  let object = new google.maps.Marker({
                    position: {lat: item.lat, lng: item.lng},
                    animation: google.maps.Animation.DROP
                  })

                  if (item.tipe_lokasi.icon !== null) {
                    let iconPath = item.tipe_lokasi.icon

                    if (!item.tipe_lokasi.icon.includes('https://')) {
                      iconPath = '/images/markers/' + item.tipe_lokasi.icon
                    }

                    object.setIcon({
                      url: iconPath,
                      scaledSize: new google.maps.Size(32, 37)
                    })
                  }

                  object.setMap(map)
                  object.addListener('click', () => {
                    this.locationInfo(index)
                  })

                  response[index]['object'] = object
                })

                this.removeMarkers(this.locations)
                this.locations = response
              })
            },
            loadCommunityGroups() {
              let $input = $('input[name="group[]"]')
                categories = $input.serialize()

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/bantuan',
                data: 'type=json' + ($input.length > 0 ? '&' + (categories !== '' ? categories : 'group[]') : '&group') + `&desa_id=${this.desaId}`
              })
              .then((response) => {
                response.forEach((item, index) => {
                  let object = new google.maps.Marker({
                    position: {
                      lat: parseFloat(item.penduduk.penduduk_map[0].lat),
                      lng: parseFloat(item.penduduk.penduduk_map[0].lng)
                    },
                    animation: google.maps.Animation.DROP,
                    icon: {
                      url: '/images/markers/group-2.png',
                      scaledSize: new google.maps.Size(32, 37)
                    }
                  })

                  object.setMap(map)
                  object.addListener('click', () => {
                    this.groupInfo(index)
                  })

                  response[index]['object'] = object
                })

                this.removeMarkers(this.groups)
                this.groups = response
              })
            },
            loadStatistics() {
              const indicator = $('#indicator').val()
              const table = $('#statistics-table')

              $.ajax({
                url: '{{ env("BASE_URL") }}/api/statistik',
                data: { indicator, desa_id: this.desaId }
              })
              .then((response) => {
                const tbody = table.find('tbody')
                const tfoot = table.find('tfoot')
                const { empty, lists, subtotal, total } = response.items

                table.show()

                // Empty.
                tbody.empty()

                // Add data.
                lists.forEach((row, index) => {
                  tbody.append(`
                    <tr>
                      <td>${index + 1}</td>
                      <td>${row.group}</td>
                      <td class="text-right">${row.total.count}</td>
                      <td class="text-right">${row.total.percent}%</td>
                    </tr>
                  `);
                });

                tfoot.find('.empty-count').text(empty.count)
                tfoot.find('.empty-percent').text(empty.percent + "%")
                tfoot.find('.subtotal-count').text(subtotal.count)
                tfoot.find('.subtotal-percent').text(subtotal.percent + "%")
                tfoot.find('.total-count').text(total.count)
                tfoot.find('.total-percent').text("100,0%")
              })
            },
            loadFamilys() {
                let self = this

              // Set searching flag to true.
              self.searching = true

              $.ajax({
                url: '{{ env("BASE_URL") }}/peta/family',
                data: self.search_family
              })
              .then((response) => {
                self.familyMarkers.forEach((item, index) => {
                  item.setMap(null)
                })
                self.familyMarkers = []
                self.familys = response

                response.forEach((item, index) => {
                  let marker = new google.maps.Marker({
                    position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                    icon: '/images/markers/house.png',
                    title: item.nama,
                    map
                  })
                  marker.addListener('click', () => {
                    self.familyInfo(index)
                  })

                  self.familyMarkers.push(marker)
                })

                $('#search-modal').modal('hide')
                }, function (xhr) {
                    // Show errors if present.
                })
                .always(() => {
                    // Set searching flag to false.
                    self.searching = false
                })
            },
            removeMarkers(list) {
              list.forEach((item, index) => {
                item.object.setMap(null)
              })
            },
            hideSearch($event) {
              let current = searchControl.style.display,
                $relatedTarget = $($event.target)

              if (!$relatedTarget.hasClass('fa')) {
                $relatedTarget = $relatedTarget.find('.fa')
              }

              $relatedTarget
                .addClass((current == 'none' ? 'fa-times' : 'fa-bars'))
                .removeClass((current == 'none' ? 'fa-bars' : 'fa-times'))

              searchControl.style.display = (current == 'none' ? 'block' : 'none')
            },
            isURL(str) {
              var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
              '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name and extension
              '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
              '(\\:\\d+)?'+ // port
              '(\\/[-a-z\\d%@_.~+&:]*)*'+ // path
              '(\\?[;&a-z\\d%@_.,~+&:=-]*)?'+ // query string
              '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

              return pattern.test(str)
            }
          },
          mounted() {
            let self = this,
                $self = $(this.$el)

            map = new google.maps.Map(document.getElementById('citizen-map'), {
              mapTypeId: google.maps.MapTypeId.SATELLITE,
              center: { lat: {{ $villageData->lat }}, lng: {{$villageData->lng}} },
              zoom: 15,
              styles: [
                {
                  featureType: "poi",
                  stylers: [
                    { visibility: "off" }
                  ]
                }
              ]
            })

            // Create the DIV to hold the control and call the rightControl()
            // constructor passing in this DIV.
            let searchTemplate = $(this.$el).find('#search-template').html()
            $('#search-template').remove()

            searchControl.innerHTML = searchTemplate
            searchControl.style.zIndex = 100000
            searchControl.style.maxWidth = '420px'
            searchControl.style.width = '100%'
            searchControl.style.height = 'calc(100% - 42px)'
            searchControl.style.boxSizing = 'border-box'

            // Search villagers.
            $(searchControl).find('#search-form').on('submit', function (e) {
              e.preventDefault()
              let values = $(this).serializeArray()

              values.forEach((item, index) => {
                self.search[item.name] = item.value
              })

              self.loadCitizens()
            })

            //Search Family
            $(searchControl).find('#search-family').on('submit', function (a) {
              a.preventDefault()
              let values = $(this).serializeArray()

              values.forEach((item, index) => {
                self.search_family[item.name] = item.value
              })

              self.loadFamilys()
            })

            // Filter legends.
            $(searchControl).find('#legend-form input[type="checkbox"]').on('change', function (e) {
              let type = $(this).data('type')

              console.log(type)

              if (type == 'location')
                self.loadLocations()
              else if (type == 'area')
                self.loadAreas()
              else if (type == 'dusun')
                self.loadDusun()
              else if (type == 'line')
                self.loadLines()
            })

            $(searchControl).find('.dusun-check').on('change', function (e) {
              self.loadDusun()
            })

            $(searchControl).find('#region-form input[type="checkbox"]').on('change', function (e) {
              self.loadLocations()
              self.loadAreas()
              self.loadLines()
            })

            $(searchControl).find('#group-form input[type="checkbox"]').on('change', function (e) {
              self.loadCommunityGroups()
            })

            $(searchControl).find('#tab-statistics #indicator').on('change', function (e) {
              self.loadStatistics()
            })

            map.controls[google.maps.ControlPosition.LEFT_TOP].push(searchControl)

            if (window.innerWidth <= 414) {
              // Mobile.
              searchControl.style.display = 'none'
              map.setOptions({
                disableDefaultUI: true,
                mapTypeControl: true,
                fullScreenControl: false
              })
            } else {
              // Desktop.
              $('.filter-menu').remove()
            }

            if (this.header) {
              $('.filter-menu').removeClass('hidden')
            } else {
              let filterButton = document.createElement('div')

              this.control(filterButton, 'fa-bars', this.hideSearch)

              map.controls[google.maps.ControlPosition.TOP_RIGHT].push(filterButton)
            }

            // Init info window.
            this.infoWindow = new google.maps.InfoWindow({ minWidth: 320 })
            this.detailWindow = new google.maps.InfoWindow({ maxWidth: 320 })

            // Load legends.
            google.maps.event.addListenerOnce(map, 'tilesloaded', () => {
                @if (request()->type == 'social' || empty(request()->type))
                    this.loadCommunityGroups()
                @endif
                @if (request()->type == 'village' || empty(request()->type))
                    this.loadLocations()
                    this.loadAreas()
                    this.loadLines()
                @endif

            });
          }
        })

      function initMap() {
        vm.$mount('#content-main')
      }

      $('.filter-menu').on('click', vm.hideSearch)
      $('#search-template .nav-tabs .nav-link').eq(0).addClass('active')
      $('#search-template .tab-content .tab-pane').eq(0).addClass('active')
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
  </body>
</html>