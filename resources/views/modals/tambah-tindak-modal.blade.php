<div class="modal fade" id="tambah-tindak-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tindak Lanjut </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmTambahTindak">
        <div class="modal-body">
                <label for="">Komentar</label>
                <div class="form-group">
                    <textarea class="form-control" name="content" rows="3" placeholder="Tambah tindak lanjut pengaduan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

let $tambahData = $("#frmTambahTindak")

let $idKK;

$tambahData.on('submit',function(e){
    e.preventDefault();
    e.stopPropagation();

    let self = $(this)
    $.ajax({
        url : "{{url('/')}}/pengaduan/"+{{$pengaduan->id}}+"/comment",
        method : 'POST',
        data : {
            _token : "{{csrf_token()}}",
            content : self.find("[name=content]").val(),
        }
    }).then(function(res){
        if(res.error === false)
            window.location.reload()
    });
});
</script>

@endpush
