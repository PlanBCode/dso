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
            Heb jij ook een vraag over Amersfoort en omstreken? Wij zijn op zoek naar jouw vragen. De Stadsbron gaat namelijk de onderwerpen onderzoeken waar jij je over verwondert.<br>
<br>
            Stuur je vraag in door te klikken op 'Stuur een onderwerp in'.<br>
<br>
            Je kunt op dit moment ook stemmen op het onderwerp dat jij het belangrijkst vindt. Die vraag gaat de Stadsbron onderzoeken. Stem je mee? Klik dan op 'in de stemronde'.
        </p>
    @endforelse
</ul>
