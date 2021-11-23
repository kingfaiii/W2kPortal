<form method="POST" action="{{ $route }}">
    @csrf
    <div class="modal fade" id="{{ $idtarget }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">{{ $modalHeaderTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="{{ $modalValueInput }}" name="addactivitybtn" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>
</form>
