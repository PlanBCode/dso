@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Stuur je onderwerp in</h3>
    <p>Heb je een idee? Een brandende vraag over Amersfoort die je altijd al hebt willen stellen, een onderwerp uit de regio dat nooit eens in de krant opgepikt wordt, of een gerucht dat je altijd nog eens wilde uitzoeken? Stuur dan hier je idee in.</p>
    <p>Als meer Amersfoorters je onderwerp net zo belangrijk vinden, gaan de journalisten van de Stadsbron jouw onderzoeksvraag tot de bodem uitzoeken.</p>
    <p>We zijn benieuwd welk idee je voor ons in petto hebt. Hieronder staan een aantal hulpvragen om de kans zo groot mogelijk te maken dat jouw onderwerp onderzocht gaat worden. Zo kun je controleren of je onderwerp past bij de Stadsbron.</p>
    <ul class="bullet-list">
        <li><span class="font-semibold text-lg">Heeft het onderwerp te maken met (de regio) Amersfoort?</span><br>
            De Stadsbron is een platform voor lokale journalistiek, het moet dus in of rond Amersfoort spelen.
        </li>
        <li><span class="font-semibold text-lg">Heeft het onderwerp onderzoek nodig?</span><br>
            We zijn op zoek naar onderwerpen die écht uitzoekwerk vereisen. Vragen die dus niet zomaar op Google te vinden zijn.
        </li>
        <li><span class="font-semibold text-lg">Is het onderwerp te onderzoeken?</span><br>
            Om een onderwerp te kunnen onderzoeken, moeten er wel bronnen beschikbaar zijn: cijfers, documenten of mensen die we kunnen interviewen. Zijn die er niet, dan wordt het onderwerp lastig te onderzoeken.</li>
        <li><span class="font-semibold text-lg">Is het onderwerp ook interessant voor anderen?</span><br>
            Zijn er meer mensen voor wie je onderwerp interessant of relevant kan zijn?
        </li>
        <li><span class="font-semibold text-lg">Is het een nieuw onderwerp?</span><br>
            Wordt er nog niet veel over bericht in lokale media?
        </li>
    </ul>
    <p>Wil je graag een onderwerp insturen maar is het zo vertrouwelijk dat je het liever niet op de site publiceren? Stuur dan een mailtje naar <a href="mailto:onderzoek@destadsbron.nl ">onderzoek@destadsbron.nl</a>. </p>
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('home') }}" class="btn btn-primary">Eerst andere onderwerpen bekijken</a>
</div>
<div class="pt-8 sm:justify-start">
    <button href="{{ route('home') }}" class="btn btn-primary" data-toggle="modal" data-target="#subjectSuggestionsModal">Ik wil een onderwerp insturen</button>
</div>
@endsection

@include('modals.subject_suggestions.create')
