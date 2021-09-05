<div class="mt-3 mx-5 mb-5">
    <p>Deze onderwerpen zijn al eerder ingestuurd door inwoners van Amersfoort en omstreken.</p>

    <p>
        Zie je een onderwerp waarvan je denkt: dat móét onderzocht worden? Je kunt een eerder ingestuurd onderwerp tot
        twee keer opnieuw laten meedoen aan een stemronde. Stuur een onderwerp dus gerust nog een keer in!
    </p>
</div>
<ul class="list-group mt-3 mx-5 ">
    @forelse($subjects as $index => $subject)
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center mb-3" data-toggle="modal" data-target="#showNewSubjectModal{{ $subject->id }}">
            @if($subject->image)
                <div>
                    <img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}">
                </div>
            @endif
            <div class="flex-column ml-4">
                <h5 class="leading-7 font-semibold">{{ $subject->title }}</h5>
                <p>{!! nl2br($subject->short_description) !!}</p>
            </div>
        </a>

        @php
            $prevSubject = array_key_exists(($index-1), $subjects) ? $subjects[$index-1] : null;
            $nextSubject = array_key_exists(($index+1), $subjects) ? $subjects[$index+1] : null;
        @endphp
        @include('modals.subject.show', ['modalPrefix' => 'showNewSubjectModal', 'subject' => $subject, 'previous' => $prevSubject, 'next' => $nextSubject])
    @empty
        <p>
            Binnenkort verschijnen hier de onderwerpen die al eerder ingestuurd zijn. Zo kun je altijd controleren of jouw onderwerp al eerder is langsgekomen in een stemronde.
        </p>
    @endforelse
</ul>
