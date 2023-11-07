@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('aset.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="table-activities">
        <form action="{{route('aset.update', $inventaris->id)}}" method="POST">
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
                                        <label>Kategori Aset</label>
                                        <select required class="form-control" name="kategori_aset">
                                            <option value="{{$inventaris->kategori_id}}">{{$inventaris->kategori->nama_kategori}}</option>
                                        </select>
                                        <input type="hidden" value='{{ $inventaris->kategori->golongan.".".$inventaris->kategori->bidang.".".$inventaris->kategori->kelompok.".".$inventaris->kategori->sub_kelompok.".".$inventaris->kategori->sub_sub_kelompok }}' name="no_regist">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama_inventaris" class="form-control" value="{{$inventaris->nama_inventaris}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input type="text" name="kode_barang" class="form-control" value="{{$inventaris->kode_barang}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Bidang</label>
                                        <select onchange="selectBidang()" name="bidang" class="form-control" id="bidang">
                                            <option value=""></option>
                                            @foreach ($bidang as $item)
                                                <option value="{{$item->kode_bidang}}" {{($inventaris->bidang_id == $item->id ) ? 'selected' : ''}}>{{$item->nama_bidang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tahun Perolehan</label>
                                        <input type="number" name="tahun_perolehan" value="{{$inventaris->tahun_perolehan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Harga Perolehan</label>
                                        <input type="text" name="harga_perolehan" value="{{$inventaris->harga_perolehan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Sumber Dana</label>
                                        <select name="sumber_dana" class="form-control">
                                            <option value=""></option>
                                            @foreach ($sumber as $item)
                                                <option value="{{$item->id}}" {{($inventaris->sumber_inventaris_id == $item->id ) ? 'selected' : ''}}>{{$item->nama_sumber_inventaris}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-4">
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stock" class="form-control">
                                    </div>
                                </div> -->

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Unit Aset</label>
                                        <select name="unit_inventaris" class="form-control">
                                            <option value=""></option>
                                            @foreach ($unit as $item)
                                                <option value="{{$item->id}}" {{($inventaris->unit_id == $item->id ) ? 'selected' : ''}}>{{$item->nama_unit}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input type="text" name="merk" value="{{$inventaris->merk != null ? $inventaris->merk : ''}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Bahan</label>
                                        <input type="text" name="bahan" value="{{$inventaris->bahan != null ? $inventaris->bahan : ''}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>No. Sertifikat</label>
                                        <input type="text" name="no_sertifikat" value="{{$inventaris->no_sertifikat != null ? $inventaris->no_sertifikat : ''}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kondisi</label>
                                        <select name="kondisi" class="form-control">
                                            <option value=""></option>
                                            <option value="B">Baik</option>
                                            <option value="KB">Kurang Baik</option>
                                            <option value="RB">Rusak Berat</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea type="text" rows="5" name="keterangan" class="form-control" style="resize:none">{{$inventaris->keterangan != null ? $inventaris->keterangan : ''}}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="box-footer">
                            <a href="{{route('aset.index')}}" class="text-white btn btn-secondary">
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

        $('select[name=kondisi]').select2({
            placeholder: "Pilih....",
            width: "100%"
        });

        var desa = {!! json_encode($desa) !!};
        var d = new Date();
        var tahun = d.getFullYear();

        function selectBidang() {
            bidang = document.getElementById('bidang').value;
            $("[name=kode_barang]").val(desa + "." + bidang + "." + tahun);
        }



        $('select[name=kategori_aset]').select2({
            minimumInputLength: 1,
            placeholder : "Pilih Kategori...",
            width : "100%",
            ajax: {
                url: '{{route("api.kategori-aset")}}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: (data) => {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                    results: data
                    }
                }
            },
            escapeMarkup: (markup) => markup, // let our custom formatter work
            templateSelection: (data) => {
                if (typeof data.nama_kategori !== "undefined")
                return "Kode Reg : " + data.golongan + "." + data.bidang + "." + data.kelompok + "." + data.sub_kelompok + "." + data.sub_sub_kelompok + "- " + data.nama_kategori

                return data.text
            },
            templateResult: (data) => {
                if (data.loading) {
                    return data.text
                }

                return "Kode Reg : " + data.golongan + "." + data.bidang + "." + data.kelompok + "." + data.sub_kelompok + "." + data.sub_sub_kelompok + "- " + data.nama_kategori
            },
        }).on('change',function(){
            data = $(this).select2('data')[0]
            $("[name=no_regist]").val(data.golongan + "." + data.bidang + "." + data.kelompok + "." + data.sub_kelompok + "." + data.sub_sub_kelompok);
            $("[name=nama_inventaris]").val(data.nama_kategori)
        });



    </script>
@endpush
