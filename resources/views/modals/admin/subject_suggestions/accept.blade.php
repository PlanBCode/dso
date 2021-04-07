@section('modals')
    @parent
    <div class="modal fade" id="acceptSubjectSuggestionModal" tabindex="-1" aria-labelledby="acceptSubjectSuggestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptSubjectSuggestionModalLabel">Keur ingestuurde onderwerp goed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <p>De mail naar de indiener:</p>
                    <form action="{{ route('admin-subject-accept', ['subject' => $subject]) }}" method="POST" class="needs-validation" novalidate>
                        <div class="border p-6 shadow-sm">
                            @csrf
                            <div class="sm:justify-start">
                                <label for="subject">
                                    Onderwerp *<br>
                                    <input type="text" name="subject" id="subject" class="form-control" required value="Je onderwerp is goedgekeurd">
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="message">
                                    Bericht *<br>
                                    <textarea name="message" id="message" class="form-control un-ltd-max-width" rows="12">Je ontvangt dit bericht omdat je een onderwerp ingestuurd hebt bij de Stadsbron Onderzoekt.
Je onderwerp is nu gepubliceerd en is voor iedereen te lezen.

Bekijk je ingestuurde onderwerp hier [link-to-projects]

Binnenkort kunnen mensen gaan stemmen op je onderwerp. We sturen je een mailtje wanneer het zover is.

Vriendelijke groet,
De Stadsbron</textarea>
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="pt-8 sm:justify-start">
                            <button type="submit" class="btn btn-primary">Keur goed en verstuur mail</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
