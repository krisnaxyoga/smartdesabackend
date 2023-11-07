<div class="modal fade" id="import-penduduk-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Import Penduduk </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('import') }}" method="POST" id="importPenduduk" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">1. Unduh template Excel yang perlu diisi. Berkas telah disesuaikan dengan kolom yang diperlukan untuk data penduduk</label>
                    <a href="{{route('import-template')}}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Unduh Template File</a>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">2. Isi template Excel yang telah di unduh sesuai dengan data penduduk. </label>
                    <label for=""  class="text-danger"><b>PENTING : JANGAN</b> mengubah nama maupun posisi kolom yang tertera pada template yang disediakan </label>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">3. Unggah file excel yang telah berisi data penduduk sesuai template </label>
                    <input type="file" required class="form-control" name="excel_file">
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

</script>

@endpush