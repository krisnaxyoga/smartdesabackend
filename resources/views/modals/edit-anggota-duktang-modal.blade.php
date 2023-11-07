<div class="modal fade" id="edit-anggota-duktang-modal" tabindex="-1" role="dialog" aria-labelledby="anggotaDuktang" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="anggotaDuktang">Edit Anggota Keluarga Penduduk Pendatang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="frmEditAnggotaDuktang">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nik" placeholder="NIK">
                            </div>
                            <div class="form-group">
                                <label for="">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="sex_id" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    @foreach($listSex as $sex)
                                    <option value="{{$sex->id}}">{{$sex->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input name="tanggallahir" placeholder="yyyy-mm-dd" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status Perkawinan</label>
                                <select name="status_kawin_id" class="form-control">
                                    <option value="" selected disabled>Pilih Status Perkawinan</option>
                                    @foreach($listKawin as $kawin)
                                    <option value="{{$kawin->id}}">{{$kawin->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pendidikan</label>
                                <select name="pendidikan_id" class="form-control">
                                    <option value="" selected disabled>Pilih Pendidikan</option>
                                    @foreach($listPendidikanKK as $pendidikan)
                                    <option value="{{$pendidikan->id}}">{{$pendidikan->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Status Keluarga</label>
                                <select name="status_keluarga_id" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Status Keluarga</option>
                                    @foreach($listHubungan as $list)
                                    <option value="{{$list->id}}">{{$list->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text"  class="form-control" name='keterangan'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>

    let $editDuktang = $("#frmEditAnggotaDuktang")

    let $idDuktang;

    let $dataAnggotaDuktang;

    function fillForm(res) {
        console.log(res);
        $("[name=nik]").val(res.nik).trigger('change');
        $("[name=nama]").val(res.nama).trigger('change');
        $("[name=sex_id]").val(res.sex_id).trigger('change');
        $("[name=tanggallahir]").val(res.tanggallahir).trigger('change');
        $("[name=status_kawin_id]").val(res.status_kawin_id).trigger('change');
        $("[name=pendidikan_id]").val(res.pendidikan_id).trigger('change');
        $("[name=status_keluarga_id]").val(res.status_keluarga_id).trigger('change');
        $("[name=keterangan]").val(res.keterangan).trigger('change');

    }

    $('#edit-anggota-duktang-modal').on('show.bs.modal', function(event) {
        $el = $(event.relatedTarget);
        $idDuktang = $el.data('id')
        $.ajax({
            url: "{{url('/')}}/anggota-duktang/" + $idDuktang + "/edit",
            method: "GET",
        }).then(function(res) {
            $dataAnggotaDuktang = res;
            $("[name=nik]").val(res.nik).trigger('change');
            $("[name=nama]").val(res.nama).trigger('change');
            $("[name=sex_id]").val(res.sex_id).trigger('change');
            $("[name=tanggallahir]").val(res.tanggallahir).trigger('change');
            $("[name=status_kawin_id]").val(res.status_kawin_id).trigger('change');
            $("[name=pendidikan_id]").val(res.pendidikan_id).trigger('change');
            $("[name=status_keluarga_id]").val(res.status_keluarga_id).trigger('change');
            $("[name=keterangan]").val(res.keterangan).trigger('change');
        });
    });

    $editDuktang.on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        let self = $(this)
        $.ajax({
            url: "{{url('/')}}/anggota-duktang/" + $idDuktang,
            method: 'PUT',
            data: {
                _token: "{{csrf_token()}}",
                nik: self.find("[name=nik]").val(),
                nama: self.find("[name=nama]").val(),
                sex_id: self.find("[name=sex_id]").val(),
                tanggallahir: self.find("[name=tanggallahir]").val(),
                status_kawin_id: self.find("[name=status_kawin_id]").val(),
                pendidikan_id: self.find("[name=pendidikan_id]").val(),
                status_keluarga_id: self.find("[name=status_keluarga_id]").val(),
                keterangan: self.find("[name=keterangan]").val()
            }
        }).then(function(res) {
            $('#edit-anggota-duktang-modal').modal('hide');
            if (typeof res.message !== 'undefined') {
                notie.alert({
                    text: res.message,
                    type: 'success'
                })
                $("#datatable").DataTable().ajax.reload();

            }
            $("#datatable").DataTable().ajax.reload();
        })
    });
</script>

@endpush
