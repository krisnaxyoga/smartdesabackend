<div class="modal fade" id="tambah-anggota-pindah-modal" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Tambah Anggota Pindah </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmTambahAnggotaPindah" @submit.prevent="addAnggota()">
        <div class="modal-body">                
                <label for="">Penduduk</label>
                <div class="form-group">
                    <select name="anggota_id" required id="" class="form-control">
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit"  class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

    let $tambahAnggotaPindahFrm = $("#frmTambahAnggotaPindah")

    let $idKK;
   
   let $dataKK


    function fillForm() {
        let res = $dataKK
    }

    $('#tambah-anggota-pindah-modal').on('show.bs.modal', function (event) {
        $el = $(event.relatedTarget);
        $idKK = $el.data('id')
        
    });
</script>

@endpush