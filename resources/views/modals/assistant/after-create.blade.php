@section('modals')
    @parent
    <div class="modal fade" id="researchSubmittedModal" tabindex="-1" aria-labelledby="researchSubmittedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="researchSubmittedModalLabel">Leuk dat je wil meehelpen onderzoeken!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <p>Je bericht is verstuurd! Dankjewel dat je mee wilt helpen.</p>

                    <div class="pt-4 sm:justify-start">
                        <a href="#" data-dismiss="modal">Sluit</a>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
