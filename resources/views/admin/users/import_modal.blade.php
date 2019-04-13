<div class="modal fade" tabindex="-1" role="dialog" id="user_import_modal" data-backdrop="static"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="material-icons">info</i>&nbsp;Import user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    <div class="form-group">
                        <input type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile" aria-describedby="fileHelp"
                        accept=".csv">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="material-icons">cloud_upload</i>&nbsp;Import</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
