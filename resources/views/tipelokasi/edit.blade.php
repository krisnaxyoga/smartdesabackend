@extends('layouts.app')

@section('title')
Tambah Tipe Lokasi
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-xs-12">
        @if ($errors->any())
          <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">&times;</a>
            <ul style="margin-bottom:0px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (session()->has('success'))
          <div class="alert alert-success">
            <a class="close" data-dismiss="alert">&times;</a>
            {{ session()->get('success') }}
          </div>
        @endif
        @if (session()->has('error'))
          <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">&times;</a>
            {{ session()->get('error') }}
          </div>
        @endif
        <div class="box">
          <div class="box-header"><h3>Tambah Tipe Lokasi</h3></div>
          <div class="box-divider m-0"></div>
          <form class="form-horizontal" action="/peta/tipelokasi/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group row">
                <label class="col-form-label col-3">Nama Tipe Lokasi</label>
                <div class="col-9">
                  <input type="text" name="name" required class="form-control" value="{{ old('name') ?: $data->name }}" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-3" for="enabled">Aktif</label>
                <div class="col-9">
                  <label class="ui-switch ui-switch-lg">
                    <input type="checkbox" name="enabled" id="enabled" {{ (old('enabled') ?: $data->enabled) == 1 ? 'checked' : '' }} value="1">
                    <i></i>
                  </label>
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <label class="col-form-label col-3">Simbol</label>
                <div class="col-9">
                  <img src="{{ (!$isCustomIcon ? '/images/markers/' : '') . ($data->icon ?: '/images/Dummy.jpg') }}" height="33" id="icon" />
                  <input type="hidden" name="preset_icon" v-model="selectedIcon" />
                  <input type="file" style="display: none" name="icon" accept="image/*" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-3"></label>
                <div class="col-9">
                  <label class="ui-check ui-check-md mr-3 mt-2">
                    <input type="radio" v-model="type" value="1">
                    <i class="dark-white" style="margin-right: 24px"></i>
                    <span>Pilih</span>
                  </label>
                  <label class="ui-check ui-check-md mt-2">
                    <input type="radio" v-model="type" value="2">
                    <i class="dark-white" style="margin-right: 24px"></i>
                    <span>Upload</span>
                  </label>
                  <div class="box p-1" style="overflow-y: scroll; height: 360px" v-show="type == 1">
                    <div class="row" style="margin-left: -2px; margin-right: -2px">
                      <div
                        v-for="(icon, index) in icons"
                        class="col-sm-2 col-xs-4"
                        @click="selectIcon(icon)"
                        style="padding-left: 2px; padding-right: 2px; padding-bottom: 4px; cursor: pointer">
                        <div :class="['box', 'm-1', 'p-1', 'text-center', {'indigo lt': icon == selectedIcon}]">
                          <img :src="'/images/markers/' + icon" height="33" />
                          <p class="mt-2 mb-0 text-ellipsis">@{{ icon }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box" v-show="type == 2">
                    <div class="box-body">
                      <p><button class="btn btn-primary" id="btn-browse" type="button"><i class="fa fa-folder-open"></i> Browse...</button></p>
                      <p class="mb-0">Pastikan simbol berukuran persegi, misal 32x32 atau 64x64 piksel. Maksimum ukuran file adalah 1 MB (Megabytes).</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-rounded btn-success"><i class="fa fa-save"></i> Simpan</button>
              <a href="/peta/tipelokasi" class="btn btn-rounded btn-default">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  let mapPage = new Vue({
    el: "#content-main",
    data: {
      type: {{ ($isCustomIcon ? 2 : 1) }},
      selectedIcon: "{{ old('preset_icon') ?: ($isCustomIcon ? '' : $data->icon) }}",
      icons: {!! $icons !!}
    },
    methods: {
      selectIcon(icon) {
        console.log(icon)

        if (icon == this.selectedIcon) {
          this.selectedIcon = ''
          document.getElementById('icon').src = '/images/Dummy.jpg'

          return false
        }

        this.selectedIcon = icon
        document.getElementById('icon').src = '/images/markers/' + this.selectedIcon
      }
    },
    mounted() {
      let $photoInput = $('[name="icon"]'),
        $photo = document.getElementById('icon'),
        reader = new FileReader()

      $(this.$el).on('click', '#btn-browse', function () {
        $photoInput.trigger('click')
      })

      $photoInput.on('change', (event) => {
        reader.onload = () => {
          this.selectedIcon = ''
          $photo.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0])
      })
    }
  })
</script>
@endpush