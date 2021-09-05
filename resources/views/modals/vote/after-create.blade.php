@section('modals')
    @parent
    <div class="modal fade" id="voteModalSubmittedModal" tabindex="-1" aria-labelledby="voteModalSubmittedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalSubmittedModalLabel">Verstuur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">

                    <span data-body-text>
                    </span>

                    <div class="pt-4 sm:justify-start">
                        <a href="{{ route('home') }}" class="btn btn-primary">Terug naar het overzicht</a>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
