@section('modals')
    @parent
    <div id="createSuggestionForm">
        <form method="POST" action="{{ route('subject-suggestion-store') }}" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="files" />
            <div class="modal fade" id="subjectSuggestionsModal" tabindex="-1" aria-labelledby="subjectSuggestionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content bg-gray-200">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subjectSuggestionsModalLabel">Ik wil een onderwerp insturen (stap <span id="step">1</span> van 4)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body bg-white">
                            <ul class="nav nav-tabs" role="tablist" data-tabbed-form>
                                <li class="nav-item mr-1" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#subject" role="tab" aria-controls="subject" aria-selected="true">Onderwerp</a>
                                </li>
                                <li class="nav-item mx-1" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#importance" role="tab" aria-controls="importance" aria-selected="false" disabled>Belang</a>
                                </li>
                                <li class="nav-item mx-1" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#do" role="tab" aria-controls="do" aria-selected="false" disabled>Meedoen</a>
                                </li>
                                <li class="nav-item mx-1" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#submit" role="tab" aria-controls="submit" aria-selected="false" disabled>Versturen</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="subject" role="tabpanel">
                                    <div class="pt-8 sm:justify-start">
                                        <label for="title" class="form-label">
                                            Hoe noem je het onderzoek? *<br>
                                            <input type="text" name="title" id="title" class="form-control" data-to-summary="title" required value="@if(isset($subjectSuggestion)){{ $subjectSuggestion->title }}@endif">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </label>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        <label for="description">
                                            Wat zou je willen dat de Stadsbron gaat onderzoeken? (max 200 woorden) *<br>
                                            Beschrijf het zo specifiek mogelijk. Vertel het ons ook als je al een idee hebt hoe jouw onderwerp onderzocht kan worden.<br>
                                            <textarea type="text" name="description" id="description" rows="8" class="form-control" data-to-summary="description" required>@if(isset($subjectSuggestion)){{ $subjectSuggestion->description }}@endif</textarea>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </label>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                                        <button type="button" class="btn btn-secondary" data-switch-tab="1">Verder</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="importance" role="tabpanel">
                                    <div class="pt-8 sm:justify-start">
                                        <label for="importance-input">
                                            Waarom vind je het belangrijk dat dit onderzocht wordt? (max 100 woorden) *<br>
                                            <textarea type="text" name="importance" id="importance-input" rows="8" class="form-control" data-to-summary="importance" required>@if(isset($subjectSuggestion)){{ $subjectSuggestion->importance }}@endif</textarea>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </label>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        <button type="button" class="btn btn-secondary" data-switch-tab="0">Terug</button>
                                        <button type="button" class="btn btn-secondary" data-switch-tab="2">Verder</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="do" role="tabpanel">
                                    <div class="pt-8 sm:justify-start">
                                        Heb je al bronnen bij dit onderwerp?<br>
                                        <br>
                                        Zo ja...
                                        <div data-dropzone>
                                            ... sleep of klik hier om jouw documenten te uploaden.
                                        </div>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        Heb je tijd en zin om zelf mee te helpen met het onderzoek?<br>
                                        <label for="skills">
                                            Zo ja, welke vaardigheden heb je of zou je willen opdoen?<br>
                                            <textarea type="text" name="skills" id="skills" rows="8" class="form-control" data-to-summary="skills">@if(isset($subjectSuggestion)){{ $subjectSuggestion->skills }}@endif</textarea>
                                        </label>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        <button type="button" class="btn btn-secondary" data-switch-tab="1">Terug</button>
                                        <button type="button" class="btn btn-secondary" data-switch-tab="3">Verder</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="submit" role="tabpanel">
                                    <div class="pt-8 sm:justify-start">
                                        Je bent er bijna!<br>
                                        Dit zijn de gegevens die je ingevuld hebt. Klopt alles?<br>
                                        <br>
                                        <div class="bg-gray-200 border px-3 py-3 rounded">
                                            <b>Titel:</b><br>
                                            <span data-summary="title"></span><br>
                                            <br>
                                            <b>Beschrijving onderwerp:</b><br>
                                            <span data-summary="description"></span><br>
                                            <br>
                                            <b>Dit moet onderzocht worden omdat:</b><br>
                                            <span data-summary="importance"></span><br>
                                            <br>
                                            <b>Bronnen bij dit onderwerp:</b><br>
                                            <span data-summary="sources"></span>
                                            <br>
                                            <b>Tijd en zin om mee te helpen:</b><br>
                                            <span data-summary="skills"></span>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        Als laatste vragen we je je contactgegevens mee te sturen, zo kunnen we je op de hoogte houden over je onderzoek of contact opnemen als we vragen hebben.<br>
                                        We schermen jouw gegevens af voor onbevoegden en delen ze niet met derden.<br>
                                        Je ontvangt dan een mail van ons om je e-mailadres te bevestigen.<br>
                                        <div class="relative flex pt-8">
                                            <div class="w-100">
                                                <div class="grid grid-cols-1 md:grid-cols-2">
                                                    <label for="firstname" class="pr-2">
                                                        Voornaam *<br>
                                                        <input type="text" name="firstname" id="firstname" class="form-control" required value="@if(isset($subjectSuggestion)){{ $subjectSuggestion->firstname }}@endif">
                                                        <div class="invalid-feedback">
                                                            Dit veld is verplicht.
                                                        </div>
                                                    </label>
                                                    <label for="lastname" class="pl-2">
                                                        Achternaam *<br>
                                                        <input type="text" name="lastname" id="lastname" class="form-control" required value="@if(isset($subjectSuggestion)){{ $subjectSuggestion->lastname }}@endif">
                                                        <div class="invalid-feedback">
                                                            Dit veld is verplicht.
                                                        </div>
                                                    </label>
                                                    <label for="phone" class="pr-2">
                                                        Telefoonnummer *<br>
                                                        <input type="text" name="phone" id="phone" class="form-control" required value="@if(isset($subjectSuggestion)){{ $subjectSuggestion->phone }}@endif">
                                                        <div class="invalid-feedback">
                                                            Dit veld is verplicht.
                                                        </div>
                                                    </label>
                                                    <label for="email" class="pl-2">
                                                        E-mailadres *<br>
                                                        <input type="email" name="email" id="email" class="form-control" required value="@if(isset($subjectSuggestion)){{ $subjectSuggestion->email }}@endif">
                                                        <div class="invalid-feedback">
                                                            Vul een geldig e-mailadres in.
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-8 sm:justify-start">
                                            <label for="agree">
                                                <input type="checkbox" name="agree_to_terms" id="agree" required> Ik ga ermee akkoord dat mijn contactgegevens gebruikt worden om me op de hoogte te houden over mijn onderzoek. Mijn gegevens worden nergens anders dan voor dit doel gebruikt en niet met derden gedeeld. *<br>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="pt-8 sm:justify-start">
                                        <button type="button" class="btn btn-secondary" data-switch-tab="2">Terug</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="display: none;">Stuur je onderwerp in</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () { // jQuery ready
            'use strict'

            let $form = $('#createSuggestionForm').find('form');
            let updateDz = {
                clearing: false,
                map: {},
                update: function () {
                    let $filesField = $form.find('input[type="hidden"][name="files"]');
                    let val = '';
                    for (let key in this.map) {
                        val += (val ? ',' : '') + this.map[key];
                    }
                    $filesField.val(val);

                    let filenames = [];
                    dz.getAcceptedFiles().forEach(function (file) {
                        filenames.push(file.name);
                    });
                    let html = filenames.length ? '<ul><li>' + filenames.join('</li><li>') + '</li></ul>' : '';
                    $form.find('[data-summary="sources"]').html(html);
                },
            };
            let dz = new Dropzone('[data-dropzone]', {
                url: '{{ route('files-store') }}',
                addRemoveLinks : true,
                maxFilesize: 5,
                dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
                dictResponseError: 'Error uploading file!',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function () {
                    this.on('success', function(file, response) {
                        updateDz.map[file.upload.uuid] = response.id;
                        updateDz.update();
                    });
                    this.on('removedfile', function(file) {
                        if (updateDz.clearing) {
                            return;
                        }
                        let url = '{{ route('files-destroy', ['file' => 'file_id']) }}';
                        url = url.replace('file_id', updateDz.map[file.upload.uuid]);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            data: {},
                            type: 'DELETE',
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                delete updateDz.map[file.upload.uuid];
                                updateDz.update();
                            }
                        });
                    });
                },
            });

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
                                $('#subjectSuggestionsModal').modal('hide');
                                $('#subjectSuggestionSubmittedModal').modal('show');

                                $form.find('[data-to-summary]').each(function () {
                                    $(this).removeClass('touched is-valid');
                                    $(this).val('');
                                    $('[data-summary="' + $(this).data('to-summary') + '"]').html('');
                                });
                                $('#subjectSuggestionsModal [role="presentation"]').each(function () {
                                    $(this).trigger('validate', [false]);
                                });
                                $('#subjectSuggestionsModal [role="presentation"]:first').trigger('switch');
                                updateDz.clearing = true;
                                updateDz.map = {};
                                dz.removeAllFiles();
                                updateDz.clearing = false;
                            }
                        },
                    });
                }
            }, false);




            // update step when switching tab
            $('[data-toggle="tab"]').on('shown.bs.tab', function () {
                let currentStep = $(this).parent().index() + 1;
                $('#step').text(currentStep);
            });

            // submit button
            let toggleSubmitButtons = function () {
                let enable = $form[0].checkValidity();
                let $button = $('#subjectSuggestionsModal').find('.modal-footer button');
                $button.toggleClass('disabled', !enable);
                $button.attr('disabled', !enable);
            };
            $form.find('input, select, textarea').on('keyup', function () {
                toggleSubmitButtons();
            });
            $form.find('input[type="radio"], input[type="checkbox"]').on('change', function () {
                toggleSubmitButtons();
            });
            // display submit button on last tab
            $('[data-toggle="tab"]').on('shown.bs.tab', function () {
                let last = $(this).parent().index() === 3;
                let $footer = $form.find('.modal-footer');
                $footer.toggleClass('modal-footer__with-content', last);
                $footer.find('button').toggle(last);
            });

            // fill summary
            $('[data-to-summary]').on('focusout', function () {
                $('[data-summary="' + $(this).data('to-summary') + '"]').html(nl2br($(this).val()));
            });
            @if(isset($subjectSuggestion))
            $('[data-to-summary]').trigger('focusout');
            @endif
        });
    </script>
@endsection

@include('modals.subject_suggestions.after-create')
