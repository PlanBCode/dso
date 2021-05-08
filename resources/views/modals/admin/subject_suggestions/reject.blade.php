@section('modals')
    @parent
    <div class="modal fade" id="rejectSubjectSuggestionModal" tabindex="-1" aria-labelledby="rejectSubjectSuggestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectSubjectSuggestionModalLabel">Keur ingestuurde onderwerp af</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div class="sm:justify-start">
                        Opties om te kunnen gebruiken in de mail naar de indiener.<br>
<pre>
- Heeft het onderwerp te maken met (de regio) Amersfoort?
   De Stadsbron is een platform voor lokale journalistiek, het moet dus in of rond Amersfoort spelen.

- Heeft het onderwerp onderzoek nodig?
  We zijn op zoek naar onderwerpen die écht uitzoekwerk vereisen. Vragen die dus niet zomaar op
  Google te vinden zijn.

- Is het onderwerp te onderzoeken?
  Om een onderwerp te kunnen onderzoeken, moeten er wel bronnen beschikbaar zijn: cijfers,
  documenten of mensen die we kunnen interviewen. Zijn die er niet, dan wordt het onderwerp lastig
  te onderzoeken.

- Is het onderwerp ook interessant voor anderen?
  Zijn er meer mensen voor wie je onderwerp interessant of relevant kan zijn?
</pre>

                    </div>
                    <p>De mail naar de indiener:</p>
                    <form method="POST" action="{{ route('admin-subject-reject', ['subject' => $subject]) }}" class="needs-validation" novalidate>
                        <div class="border p-6 shadow-sm">
                            @csrf
                            <div class="sm:justify-start">
                                <label for="subject">
                                    Onderwerp *<br>
                                    <input type="text" name="subject" id="subject" class="form-control" required value="Je onderwerp voldoet nog niet aan alle criteria">
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="message">
                                    Bericht *<br>
                                    <textarea name="message" id="message" class="form-control un-ltd-max-width" rows="16">Je ontvangt dit bericht omdat je een onderwerp ingestuurd hebt bij de Stadsbron Onderzoekt.
Helaas kunnen we je onderwerp (nog) niet publiceren omdat het niet past bij de Stadsbron. Soms is het met een paar aanpassingen alsnog geschikt. Hieronder staan een aantal tips op een rij.

Op de website hebben we een aantal vragen opgeschreven waarmee je kunt controleren of je onderwerp geschikt is voor de Stadsbron. Op dit moment voldoet je onderwerp nog niet aan alle criteria:

Wat je zou kunnen doen om het onderwerp passender bij de Stadsbron te maken: ...

Klik hier [link-to-recreate-subject] om je aangepaste onderwerp opnieuw in te sturen. Of natuurlijk een geheel nieuw onderwerp!

Vriendelijke groet,
de Stadsbron</textarea>
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="pt-8 sm:justify-start">
                            <button type="submit" class="btn btn-primary">Keur af en verstuur mail</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
