@extends('layouts.app')

@section('content')
<div class="justify-center pt-8 mx-5 sm:justify-start">
    <h3>{{ config('app.name', 'Laravel') }}</h3>
    <p>Heb je een idee? Een brandende vraag over Amersfoort die je altijd al hebt willen stellen, een onderwerp uit de regio dat nooit eens in de krant opgepikt wordt, of een gerucht dat je altijd nog eens wilde uitzoeken? Stuur hieronder je idee in!</p>
    <p>De Stadsbron gaat jouw onderwerpen onderzoeken. Stuur een onderwerp in of kies welke onderwerpen jij belangrijk vindt. Zo bepaal jij mee waar de Stadsbron de tanden in zet.</p>
    <p>Tot 7 mei kun je ideeën insturen. Daarna kunnen alle Amersfoorters stemmen op het onderwerp dat zij het liefst uitgezocht willen hebben. Het onderwerp dat in de regio het meeste leeft, gaan we onderzoeken. Samen met jou, als je dat wil.</p>
    <p>De Stadsbron Onderzoekt is een nieuwsexperiment: jij bedenkt en bepaalt iedere maand mee wat de Stadsbron gaat uitzoeken. Als meer mensen jouw onderwerp net zo belangrijk vinden, gaat de Stadsbron op onderzoek om het antwoord te vinden.</p>
    <p>Je kunt ook mee helpen onderzoeken: klik dan op ‘Onderzoek mee.’</p>
    <h3>Waarom?</h3>
    <p>Regionale onderzoeksjournalistiek heeft het moeilijk, landelijk gezien. Wij willen daar verandering in brengen door lezers te betrekken bij de keuzes die we maken en de onderwerpen die we onderzoeken. Om zo de journalistiek transparanter te maken en de onafhankelijke berichtgeving over Amersfoort, de regio en haar inwoners te verbeteren.</p>
</div>

<div class="mt-8 bg-white {{ $darkPrefix }}bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-3">
        <a href="{{ route('subject-suggestion-create') }}">
        <div class="p-6">
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
        <div class="p-6 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
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
        <div class="p-6 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
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

    </div>
</div>

<div class="pt-8"></div>

<div class="text-center pt-8 mx-5 sm:justify-start">
    <h3>Onderwerpen:</h3>
</div>

<ul class="nav nav-tabs mx-5" role="tablist">
    <li class="nav-item mr-1" role="presentation">
        <a class="nav-link active" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">Nieuw ingestuurd</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#vote" role="tab" aria-controls="vote" aria-selected="false">In de stemronde</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#actual" role="tab" aria-controls="actual" aria-selected="false">Lopende onderzoeken</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">Archief</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade show active" id="new" role="tabpanel">
        <ul class="list-group mt-3 mx-5 ">
            @forelse($newSubjects as $subject)
                <a href="{{ route('subject-show', ['subject' => $subject->id]) }}" class="list-group-item list-group-item-action d-flex align-items-center mb-3">
                    @if($subject->image)
                        <div>
                            <img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}">
                        </div>
                    @endif
                    <div class="flex-column ml-4">
                        <h5 class="leading-7 font-semibold">{{ $subject->title }}</h5>
                        <p>{!! $subject->short_description !!}</p>
{{--                        <span class="badge badge-info badge-pill"> Natuur- en wetenschap</span>--}}
                    </div>
                </a>
            @empty
                Er zijn nog geen nieuwe onderwerpen
            @endforelse
        </ul>
    </div>
    <div class="tab-pane fade" id="vote" role="tabpanel">
        @if($selectedSubjects->count() > 0)
        <div class="mt-3 mx-5">
            <p>into stemronde</p>
        </div>
        @endif
        <ul class="list-group mt-3 mx-5">
            @forelse($selectedSubjects as $subject)
                <a href="{{ route('subject-show', ['subject' => $subject->id]) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                    <div>
                        <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/don_quixote.jpg" class="rounded w-100a" alt="{{ $subject->title }}">
                    </div>
                    <div class="flex-column ml-4">
                        <h5 class="leading-7 font-semibold">{{ $subject->title }}</h5>
                        <p>{!! $subject->short_description !!}</p>

                    </div>
                </a>
                <div class="mb-3 sm:justify-start">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#voteModal">Stem op dit onderwerp</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#researchModal">Ik wil dit meehelpen onderzoeken</a>
                    <a href="https://planb.coop/betaal/stadsbrononderzoekt" target="_blank" class="btn btn-secondary">Ik wil hier geld voor doneren</a>
                </div>
            @empty
                <p>Binnenkort kun je hier stemmen op de ingestuurde onderwerpen die jij belangrijk vindt. Zo bepaal je mee wat de Stadsbron gaat onderzoeken.</p>
                <p>De eerstvolgende stemronde begint op 8 mei.</p>
                <p>Heb jij een idee wat de Stadsbron écht moet gaan onderzoeken? Je kunt nu al onderwerpen insturen. Klik dan hierboven op ‘Stuur een onderwerp in’.</p>
            @endforelse
        </ul>
    </div>
    <div class="tab-pane fade" id="actual" role="tabpanel">
        <div class="mt-3 mx-5">
            <p>Zodra het eerste onderzoek van start gaat, kun je hier bekijken met welke onderzoeken de Stadsbron Onderzoekt bezig is. Je kunt hier ook zien welke onderzoeken al afgerond zijn en welke producties we daarover gemaakt hebben. Op dit moment zijn die er nog niet.</p>
        </div>
    </div>
    <div class="tab-pane fade" id="archive" role="tabpanel">
        <div class="mt-3 mx-5">
            <p>Binnenkort verschijnen hier de onderwerpen die al eerder ingestuurd zijn. Zo kun je altijd controleren of jouw onderwerp al eerder is langsgekomen in een stemronde.</p>
        </div>
    </div>
</div>
@endsection

@include('modals.vote.create')
