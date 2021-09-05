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
                <span>{!! nl2br($subject->description) !!}</span><br>
                <br>
                <b>Dit moet onderzocht worden omdat:</b><br>
                <span>{!! nl2br($subject->importance) !!}</span><br>
                <br>
                <b>Bronnen bij dit onderwerp:</b><br>
                <div class="container">
                    @foreach($subject->suggestion->files as $file)
                        <div class="row">
                            <div class="col-1">
                                @if($file->isImage())
                                    <img src="{{ asset($file->file_path) }}" style="width: inherit;">
                                @else
                                    <div class="border p-2 border-primary">{{ $file->getExtension() }}</div>
                                @endif
                            </div>
                            <div>
                                {{ $file->name }}<br>
                                <a href="{{ asset($file->file_path) }}" download>download</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </li>
</div>
