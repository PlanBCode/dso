@section('modals')
    @parent
    <div class="modal fade" id="voteModalSubmittedModal" tabindex="-1" aria-labelledby="voteModalSubmittedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalSubmittedModalLabel">Sla mijn keuze op en verstuur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">

                    <div class="pt-8 sm:justify-start">
                        <h3>Dankjewel voor je stem!</h3>
                        <p data-vote-overwrite style="display: none;">Je hebt al eerder een stem uitgebracht. Omdat je één keer per stemronde een onderwerp kunt kiezen, telt alleen je meest recente stem. Je vorige stem is hiermee dus komen te vervallen.</p>
                        <p data-vote-new>Over twee weken weten we welk onderwerp de meeste stemmen heeft gekregen en welk onderwerp dus onderzocht gaat worden door de Stadsbron. We houden je op de hoogte wanneer het zover is! Je krijgt dan automatisch een mailtje.</p>
                    </div>

                    <div class="pt-4 sm:justify-start">
                        <a href="{{ route('main') }}" class="btn btn-primary">Terug naar het overzicht</a>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
