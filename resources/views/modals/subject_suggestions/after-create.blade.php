@section('modals')
    @parent
    <div class="modal fade" id="subjectSuggestionSubmittedModal" tabindex="-1" aria-labelledby="subjectSuggestionSubmittedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectSuggestionSubmittedModalLabel">Ik wil een onderwerp insturen (verstuurd!)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <p class="font-warning">Let op: je hebt een e-mail van ons ontvangen om je mailadres te bevestigen. Alleen dan ontvangen we je aanmelding.</p>
                    <p>Zodra je op de link klikt, ontvangen we jouw ingestuurde onderwerp.</p>
                    <p>De redactie gaat je onderwerp lezen om te kijken of het past bij de Stadsbron: of het lokaal is, onderzoek nodig heeft, nieuw en voor meerdere mensen interessant is en te onderzoeken lijkt. Als dat zo is, verschijnt het op de website. Daarna heb je twee weken de tijd om te stemmen.</p>

                    <p class="pt-8">Heb je nu al zin om aan de slag te gaan?</p>

                    <div class="sm:justify-start">
                        <a href="#" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#researchModal">Onderzoek mee</a>
                    </div>
                    <div class="pt-4 sm:justify-start">
                        <a href="https://planb.coop/betaal/stadsbrononderzoekt" target="_blank" class="btn btn-primary">Doneer aan de Stadsbron Onderzoekt</a>
                    </div>
                    <div class="pt-4 sm:justify-start">
                        <a href="#" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#subjectSuggestionsModal">Stuur nog een onderwerp in</a>
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
