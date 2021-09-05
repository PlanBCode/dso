<div class="border p-6 shadow-sm">
    <li class="d-flex">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                <img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}">
            </div>

            <div class="col-12 col-lg-9">
                <b>Titel:</b><br>
                <span>{{ $subject->title }}</span><br>
                <br>
                <b>Beschrijving onderwerp:</b><br>
                <span>{!! $subject->description !!}</span><br>
                <br>
                <b>Dit moet onderzocht worden omdat:</b><br>
                <span>{!! $subject->importance !!}</span><br>
            </div>
        </div>
    </li>
</div>
