@if(!$votingRound)
    <div class="mt-3 mx-5">
        <p>Hier zie je de vragen die afgelopen maand ingestuurd zijn.</p>
        <p>
            Naar welk onderwerp ben jij het meest nieuwsgierig? Je kunt stemmen op het onderwerp waar jij het
            meest benieuwd naar bent. Wat wil jij het liefst onderzocht zien? Je kunt op één van de onderwerpen
            stemmen.
        </p>
        <p>
            Of met welk onderwerp wil jij zelf meehelpen? Bijvoorbeeld omdat je meer over het onderwerp weet,
            omdat je mee wil onderzoeken of omdat je mensen kent die meer over het onderwerp weten. Dat kun je
            aangeven door bij het betreffende onderwerp op ‘ik onderzoek mee’ te klikken. Dat kan bij zoveel
            onderwerpen als je wil.
        </p>
        <p>Na twee weken maken we de balans op welke onderwerpen we – samen met jou – gaan uitpluizen.</p>
    </div>
@else
<form method="POST" action="{{ route('vote-store') }}" name="vote-form" class="needs-validation" novalidate>
@csrf
<ul class="list-group mt-3 mx-sm-0 mx-md-5">
    @include('modals.vote.create', ['voting_round' => $votingRound])
    <div class="container mb-3 pr-0">
        <div class="row">
            <div class="col-6 align-self-center">
                Uitgebrachte stemmen: {{ $votingRound->votes->count() }}
            </div>
            <div class="col-6 align-self-center">
                <div class="float-right">
                    <button class="btn btn-primary disabled" data-dismiss="modal" data-toggle="modal" data-target="#voteModal" onclick="return false;" disabled>Sla mijn keuze op en verstuur</button>
                </div>
            </div>
        </div>
    </div>
    @php
        $subjects = $votingRound->subjects->all();
    @endphp
    @forelse($subjects as $index => $subject)
        <li class="container list-group-item list-group-item-action hover-underline hover-pointer d-flex sm:no-max-width mx-sm-1 mx-md-auto mb-3 pb-0">
            <div class="row">
            <div class="col-12 col-lg-3 order-2 order-lg-1">
                <div data-toggle="modal" data-target="#showVotingSubjectModal{{ $subject->id }}"><img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}"></div>
                <div class="mt-3" style="z-index: 10;">
                    <label><input type="radio" name="vote" value="{{ $subject->id }}" data-vote-title="{{ $subject->title }}"> Dit onderwerp heeft mijn stem</label>
                    <label><input type="checkbox" name="help[]" value="{{ $subject->id }}" data-help-title="{{ $subject->title }}"> Ik wil meehelpen onderzoeken</label>
                </div>
            </div>

            <div class="col-12 col-lg-9 order-1 order-lg-2" data-toggle="modal" data-target="#showVotingSubjectModal{{ $subject->id }}">
                <h5 class="leading-7 font-semibold">{{ $subject->title }}</h5>
                <p>{!! $subject->short_description !!}</p>
            </div>
            </div>
        </li>

        @php
            $prevSubject = array_key_exists(($index-1), $subjects) ? $subjects[$index-1] : null;
            $nextSubject = array_key_exists(($index+1), $subjects) ? $subjects[$index+1] : null;
        @endphp
        @include('modals.subject.show', ['modalPrefix' => 'showVotingSubjectModal', 'subject' => $subject, 'previous' => $prevSubject, 'next' => $nextSubject])
    @empty
        <p>Binnenkort kun je hier stemmen op de ingestuurde onderwerpen die jij belangrijk vindt. Zo bepaal je mee wat de Stadsbron gaat onderzoeken.</p>
        <p>De eerstvolgende stemronde begint op 8 mei.</p>
        <p>Heb jij een idee wat de Stadsbron écht moet gaan onderzoeken? Je kunt nu al onderwerpen insturen. Klik dan hierboven op ‘Stuur een onderwerp in’.</p>
    @endforelse
    <div class="align-self-end mb-3">
        <button class="btn btn-primary disabled" data-dismiss="modal" data-toggle="modal" data-target="#voteModal" onclick="return false;" disabled>Sla mijn keuze op en verstuur</button>
    </div>
</ul>
</form>
@endif

@section('scripts')
    @parent
    <script>
        $(function () { // jQuery ready
            'use strict'

            let $form = $('[name=vote-form]');
            let hasVote = false;

            $form.find('input[data-vote-title]').on('change', function () {
                $('[data-target="#voteModal"]').attr('disabled', false).removeClass('disabled');
                $('[data-display-vote-title]').text($form.find('[data-vote-title]:checked').data('vote-title'));
                hasVote = true;
                $('[data-vote-section]').show();
            });

            $form.find('[data-help-title]').on('change', function () {
                $('[data-target="#voteModal"]').attr('disabled', false).removeClass('disabled');
                let titles = '';
                $form.find('[data-help-title]:checked').each(function () {
                    titles += '<strong>'+$(this).data('help-title')+'</strong><br>';
                });
                $('[data-help-section]').toggle(titles !== '');
                $('[data-display-help-titles]').html(titles);

                if (!hasVote && titles === '') {
                    $('[data-target="#voteModal"]').attr('disabled', true).addClass('disabled');
                }
            });

            $form[0].addEventListener('submit', function (event) {
                event.preventDefault()
                event.stopPropagation()
                if (this.checkValidity()) {
                    let data = $(this).serialize();

                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response) {
                                $('#voteModal').modal('hide');
                                $('#voteModalSubmittedModal').modal('show');
                                if (response.overwrite) {
                                    $('[data-vote-overwrite]').show();
                                    $('[data-vote-new]').hide();
                                }

                                $('[data-display-vote-title]').html('');
                                $('[data-display-help-titles]').html('');

                                $form.find('input, select, textarea').each(function () {
                                    if ($(this).attr('name') !== 'email') {
                                        $(this).removeClass('touched is-valid');
                                        if (
                                            ($(this).attr('type') === 'radio' || $(this).attr('type') === 'checkbox')
                                            && $(this).is(':checked')
                                        ) {
                                            $(this).prop('checked', false).removeAttr('checked');
                                        } else {
                                            $(this).val('');
                                        }
                                    }
                                });
                            }
                        },
                    });
                }
            }, false);

            // submit button
            let toggleSubmitButtons = function () {
                let enable = $form[0].checkValidity();
                let $button = $form.find('.modal-footer button');
                $button.toggleClass('disabled', !enable);
                $button.attr('disabled', !enable);
            };
            $form.find('input, select, textarea').on('keyup', function () {
                toggleSubmitButtons();
            });
            $form.find('input[type="radio"], input[type="checkbox"]').on('change', function () {
                toggleSubmitButtons();
            });
        });
    </script>
@endsection

@include('modals.vote.after-create')
