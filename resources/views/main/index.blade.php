@extends('layouts.app')

@section('content')
@include('modals.generic.about')
<div class="mt-8 bg-white {{ $darkPrefix }}bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-5">
        <a href="#" class="bg-transparent" data-toggle="modal" data-target="#aboutModal">
            <div class="p-6 h-100">
                <div class="flex items-center">
                    <div class="text-lg leading-7 font-semibold">Over dit project</div>
                </div>

                <div class="">
                    <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                        Wil je meer weten over de Stadsbron Onderzoekt?
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('subject-suggestion-create') }}">
        <div class="p-6 h-100 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Stuur een onderwerp in</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Waar word jij warm van?
                </div>
            </div>
        </div>
        </a>

        <a href="#" class="bg-transparent" data-toggle="modal" data-target="#researchModal">
        <div class="p-6 h-100 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Onderzoek mee</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Waarvoor stroop jij jouw mouwen op?
                </div>
            </div>
        </div>
        </a>

        <a href="https://planb.coop/betaal/stadsbrononderzoekt" target="_blank" class="bg-transparent">
        <div class="p-6 h-100 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Maak het mogelijk met een donatie</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Wat wil je ondersteunen?
                </div>
            </div>
        </div>
        </a>

        <a href="#" class="bg-transparent" data-to-tab="2">
        <div class="p-6 h-100 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Stem!</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Wil je stemmen op een onderwerp?
                </div>
            </div>
        </div>
        </a>

    </div>
</div>

<div class="pt-8"></div>
<a id="subjects"></a>
<div class="text-center pt-8 mx-5 sm:justify-start">
    <h3>Onderwerpen:</h3>
</div>

<ul class="nav nav-tabs mx-5" role="tablist">
    <li class="nav-item mr-1" role="presentation">
        <a class="nav-link{{ $votingRoundInProgress ? '' : ' active' }}" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="{{ $votingRoundInProgress ? 'false' : 'true' }}">Nieuw ingestuurd</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link{{ $votingRoundInProgress ? ' active' : '' }}" data-toggle="tab" href="#vote" role="tab" aria-controls="vote" aria-selected="{{ $votingRoundInProgress ? 'true' : 'false' }}">In de stemronde</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#actual" role="tab" aria-controls="actual" aria-selected="false">Lopende onderzoeken</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">Archief</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade{{ $votingRoundInProgress ? '' : ' show active' }}" id="new" role="tabpanel">
        @include('main.subjects-new', ['subjects' => $newSubjects->all()])
    </div>
    <div class="tab-pane fade{{ $votingRoundInProgress ? ' show active' : '' }}" id="vote" role="tabpanel">
        @include('main.subjects-voting-round', ['votingRound' => $votingRound, 'votingRoundInProgress' => $votingRoundInProgress])
    </div>
    <div class="tab-pane fade" id="actual" role="tabpanel">
        @include('main.subjects-active', ['subjects' => $activeSubjects->all()])
    </div>
    <div class="tab-pane fade" id="archive" role="tabpanel">
        @include('main.subjects-archived', ['subjects' => $archivedSubjects->all()])
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () { // jQuery ready
            'use strict'

            let toTab = function (index) {
                $('[role="tablist"] [role="presentation"]:nth-child('+index+') [role="tab"]').tab('show');

                $('html, body').animate({
                    scrollTop: $('#subjects').offset().top
                }, 1000);
            };

            $('[data-to-tab]').on('click', function(e) {
                e.preventDefault();
                toTab($(this).data('to-tab'));
            });

            const urlParams = new URLSearchParams(window.location.search);
            let tab = urlParams.get('tab');
            if (tab) {
                toTab(tab);
            }
        });
    </script>
@endsection
