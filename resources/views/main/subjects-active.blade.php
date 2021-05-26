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
                <p>{!! $subject->short_description !!}</p>
            </div>
        </a>

        @php
            $prevSubject = array_key_exists(($index-1), $subjects) ? $subjects[$index-1] : null;
            $nextSubject = array_key_exists(($index+1), $subjects) ? $subjects[$index+1] : null;
        @endphp
        @include('modals.subject.show', ['modalPrefix' => 'showNewSubjectModal', 'subject' => $subject, 'previous' => $prevSubject, 'next' => $nextSubject])
    @empty
        <p>
            Zodra het eerste onderzoek van start gaat, kun je hier bekijken met welke onderzoeken de Stadsbron Onderzoekt bezig is. Je kunt hier ook zien welke onderzoeken al afgerond zijn en welke producties we daarover gemaakt hebben. Op dit moment zijn die er nog niet.
        </p>
    @endforelse
</ul>
