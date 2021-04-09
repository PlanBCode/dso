@section('modals')
    @parent
    <div class="modal fade" id="researchModal" tabindex="-1" aria-labelledby="researchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="researchModalLabel">Leuk dat je wil meehelpen onderzoeken!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div id="createAssistantForm">
                        <form action="{{ route('assistant-store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div>
                                Heb je al een idee hoe je wil meehelpen als de Stadsbron een onderwerp gaat onderzoeken? *<br>
                                Bijvoorbeeld omdat je het leuk vindt om in archieven te speuren, beleidsstukken of jaarverslagen uit te pluizen, interviews wil uittikken of een laatste spellingscheck wil doen. Of omdat je infographics maakt of fotografeert. Of iets totaal anders natuurlijk. Laat het hieronder weten.<br>
                                <label for="assist-yes-know_what_to_do">
                                    <input type="radio" name="know_what_to_do" id="assist-yes-know_what_to_do" value="1" required> Ja
                                    <label for="what_to_do">namelijk:<br><textarea name="what_to_do" id="what_to_do" class="form-control"></textarea></label>
                                </label><br>
                                <label for="assist-no-know_what_to_do">
                                    <input type="radio" name="know_what_to_do" id="assist-no-know_what_to_do" value="0" required> Nog niet,<br>maar jullie mogen contact met me opnemen wanneer een onderzoek van start gaat waar ik aan kan meehelpen.
                                    <div class="invalid-feedback">
                                        Kies of je al weet hoe je wilt helpen.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                Laat hier je e-mailadres achter. Dan kunnen we contact met je opnemen als het onderzoek van start gaat. Deze informatie delen we niet met derden en verschijnt niet op de website.
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="assist-email">
                                    E-mailadres *<br>
                                    <input type="email" name="email" id="assist-email" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Dit veld moet een valide e-mailadres zijn.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="assist-agree">
                                    <input type="checkbox" name="agree_to_terms" id="assist-agree" required> Ik ga ermee akkoord dat mijn contactgegevens gebruikt worden om me op de hoogte te houden over de Stadsbron Onderzoekt. Mijn gegevens worden nergens anders dan voor dit doel gebruikt en niet met derden gedeeld. *<br>
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <button type="submit" class="btn btn-primary">Verzenden</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () { // jQuery ready
            'use strict'

            let $form = $('#createAssistantForm').find('form');

            $form[0].addEventListener('submit', function (event) {
                event.preventDefault()
                event.stopPropagation()
                if (this.checkValidity()) {
                    let data = {};
                    $form.find('input, select, textarea').each(function () {
                        data[$(this).attr('name')] = $(this).val();
                    });

                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response) {
                                $('#researchModal').modal('hide');
                                $('#researchSubmittedModal').modal('show');

                                $('#researchSubmittedModal [role="presentation"]').each(function () {
                                    $(this).trigger('validate', [false]);
                                });
                            }
                        },
                    });
                }
            }, false);
        });
    </script>
@endsection
