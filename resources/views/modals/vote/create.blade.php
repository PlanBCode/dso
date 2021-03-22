@section('modals')
    @parent
    <div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalLabel">Bevestig hieronder je stem.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <form action="{{ route('subject-suggestion-store') }}" method="POST" class="needs-validation">
                        <input type="hidden" name="files" />
                        @csrf
                        <div class="sm:justify-start">
                            Deze informatie delen we niet met derden en verschijnt niet op de website.
                            <label for="email">
                                E-mailadres<br>
                                <input type="text" name="email">
                                <div class="invalid-feedback">
                                    Field is required.
                                </div>
                            </label>
                        </div>
                        <div class="pt-8 sm:justify-start">
                            Wil je op de hoogte gehouden worden van het onderzoek?
                            <label for="agree">
                                <input type="checkbox" name="agree" id="agree" required> Ja, hou me op de hoogte<br>
                            </label>
                        </div>
                        <div class="pt-8 sm:justify-start">
                            <label for="agree">
                                <input type="checkbox" name="agree" id="agree" required> Ik ga ermee akkoord dat mijn contactgegevens gebruikt worden om me op de hoogte te houden over de Stadsbron Onderzoekt. Mijn gegevens worden nergens anders dan voor dit doel gebruikt en niet met derden gedeeld. *<br>
                            </label>
                        </div>
                        <div class="pt-8 sm:justify-start">
                            <a href="https://planb.coop/betaal/stadsbrononderzoekt" target="_blank" type="button" class="btn btn-secondary">Stem!</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
