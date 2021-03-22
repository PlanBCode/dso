@extends('layouts.app')

@section('content')
<div class="justify-center pt-8 mx-5 sm:justify-start">
    <h3>De Stadsbron Onderzoekt</h3>
    <p>De Stadsbron gaat jouw onderwerpen onderzoeken. Stuur een onderwerp in of kies welke onderwerpen jij belangrijk vindt. Zo bepaal jij mee waar de Stadsbron de tanden in zet.</p>
    <p>Heb je een idee? Een brandende vraag over Amersfoort die je altijd al hebt willen stellen, een onderwerp uit de regio dat nooit eens in de krant opgepikt wordt, of een gerucht dat je altijd nog eens wilde uitzoeken? Stuur hieronder je idee in!</p>
    <p>Tot 1 mei kun je ideeën insturen. Daarna kunnen alle Amersfoorters stemmen op het onderwerp dat zij het liefst uitgezocht willen hebben. Het onderwerp dat in de regio het meeste leeft, gaan we onderzoeken. Samen met jou, als je dat wil.</p>
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
        <a class="nav-link active" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">nieuw</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#vote" role="tab" aria-controls="vote" aria-selected="false">in de stem ronde</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#actual" role="tab" aria-controls="actual" aria-selected="false">actueel</a>
    </li>
    <li class="nav-item mx-1" role="presentation">
        <a class="nav-link" data-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">archief</a>
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
        <div class="mt-3 mx-5">
            <p>Welk onderwerp moeten we volgens jou écht onderzoeken? Stem hieronder op één van de ingestuurde onderwerpen en bepaal mee waar de Stadsbron de tanden in zet. Je kunt één keer stemmen.</p>
            <p>Het onderwerp dat het meeste leeft in de stad, gaan we tot de bodem uitzoeken.</p>
            <p>Je kunt stemmen vanaf 1 mei. Dan weten we welk onderwerp onderzocht wordt en bijt één van onze journalisten zich erin vast.</p>
        </div>
        <ul class="list-group mt-3 mx-5 ">
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
                Er zijn nog geen onderwerpen waar je op kunt stemmen
            @endforelse
        </ul>
    </div>
    <div class="tab-pane fade" id="actual" role="tabpanel">
        <div class="mt-3 mx-5">
            <p>Hier komen de actuele onderwerpen, onderwerpen waar nu aan gewerkt wordt of onderwerpen die net afrond zijn</p>
        </div>
    </div>
    <div class="tab-pane fade" id="archive" role="tabpanel">
        <div class="mt-3 mx-5">
            <p>Hier komen de afgeronde onderwerpen.</p>
        </div>
    </div>
</div>
@endsection

@include('modals.vote.create')
