<div class="mt-3 mx-5 mb-5">
    <p>
        Welk onderwerp wil jij graag uitgezocht zien door een onderzoeksjournalist? Breng je stem uit op één van de
        onderstaande onderwerpen en bepaal mee welk onderwerp de Stadsbron gaat onderzoeken. Deze onderwerpen en vragen zijn
        vorige maand ingestuurd door inwoners van Amersfoort. 
    </p>

    <p>
        Heb je zelf ook een vraag die je altijd al hebt willen stellen, een onderwerp uit de regio dat nooit in de krant
        opgepikt wordt, of een gerucht dat je nog eens wilde uitzoeken?
        <a href="{{ route('subject-suggestion-create') }}" class="text-gray-700 underline">Stuur hier je vraag in!</a>
    </p>
</div>

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
            @if($votingRoundInProgress)
            <div class="col-6 align-self-center">
                <div class="float-right">
                    <button class="btn btn-primary disabled" data-dismiss="modal" data-toggle="modal" data-target="#voteModal" onclick="return false;" disabled>Verstuur</button>
                    <button class="btn btn-primary" style="display: none;" data-dismiss="modal" data-toggle="modal" data-target="#voteModalSubmittedModal" onclick="return false;">Keuze is verstuurd</button>
                </div>
            </div>
            @else
            <div class="col-6 align-self-center">

            </div>
            @endif
        </div>
    </div>
    @php
        if ($votingRoundInProgress) {
            $subjects = $votingRound->subjects->all();
        } else {
            $subjects = $votingRound->getSubjectsSortedByVoteCount();
            $votes = $votingRound->getVotes();
        }
    @endphp
    @forelse($subjects as $index => $subject)
        <li class="container list-group-item list-group-item-action hover-underline hover-pointer d-flex sm:no-max-width mx-sm-1 mx-md-auto mb-3 pb-0">
            <div class="row">
            <div class="col-12 col-lg-3 order-2 order-lg-1">
                <div data-toggle="modal" data-target="#showVotingSubjectModal{{ $subject->id }}">@if($subject->image)<img src="{{ asset($subject->image) }}" class="rounded w-100a mb-3" alt="{{ $subject->title }}">@endif</div>
                <div style="z-index: 10;">
                    @if($votingRoundInProgress)
                    <label><input type="radio" name="vote" value="{{ $subject->id }}" data-vote-title="{{ $subject->title }}"> Dit onderwerp heeft mijn stem</label>
                    <label><input type="checkbox" name="help[]" value="{{ $subject->id }}" data-help-title="{{ $subject->title }}"> Ik wil meehelpen onderzoeken</label>
                    @else
                    {{ $votes[$subject->id] }} stemmen
                    @endif
                </div>
            </div>

            <div class="col-12 col-lg-9 order-1 order-lg-2" data-toggle="modal" data-target="#showVotingSubjectModal{{ $subject->id }}">
                <h5 class="leading-7 font-semibold">{{ $subject->title }}</h5>
                <p>{!! nl2br($subject->short_description) !!}</p>
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
        <p>Heb jij een idee wat de Stadsbron écht moet gaan onderzoeken? Je kunt nu al onderwerpen insturen. Klik dan hierboven op ‘Stuur een onderwerp in’.</p>
    @endforelse
    @if($votingRoundInProgress)
    <div class="align-self-end mb-3">
        <button class="btn btn-primary disabled" data-dismiss="modal" data-toggle="modal" data-target="#voteModal" onclick="return false;" disabled>Verstuur</button>
        <button class="btn btn-primary" style="display: none;" data-dismiss="modal" data-toggle="modal" data-target="#voteModalSubmittedModal" onclick="return false;">Keuze is verstuurd</button>
    </div>
    @endif
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
                                let $modal = $('#voteModalSubmittedModal');
                                $('#voteModal').modal('hide');
                                $modal.modal('show');
                                $('button[data-toggle="modal"][data-target="#voteModal"]').hide();
                                $('button[data-toggle="modal"][data-target="#voteModalSubmittedModal"]').show();

                                let $bodyText = $modal.find('[data-body-text]');
                                for (let i in response.lines) {
                                    let lineData = response.lines[i];

                                    let $el = $('<p></p>');
                                    if (lineData['type'] === 'header') {
                                        $el = $('<h3></h3>');
                                    } else if (lineData['type'] === 'warning') {
                                        $el = $('<p></p>').addClass('font-warning');
                                    }
                                    $el.text(lineData['text']);
                                    $bodyText.append($el);
                                }
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
