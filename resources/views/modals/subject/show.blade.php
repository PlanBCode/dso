@section('modals')
    @parent
    <div class="modal fade" id="{{ $modalPrefix }}{{ $subject->id }}" tabindex="-1" aria-labelledby="from{{ $modalPrefix }}Label{{ $subject->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="from{{ $modalPrefix }}Label{{ $subject->id }}">Onderwerp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div class="border p-6 shadow-sm">
                        <li class="d-flex">
                            <div class="row">
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                    <div data-toggle="modal" data-target="#{{ $modalPrefix }}{{ $subject->id }}"><img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}"></div>
                                </div>

                                <div class="col-12 col-lg-9">
                                    <b>Titel:</b><br>
                                    <span>{{ $subject->title }}</span><br>
                                    <br>
                                    <b>Beschrijving onderwerp:</b><br>
                                    <span>{!! $subject->description !!}</span><br>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="mt-3">
                    @if($previous)
                        <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#{{ $modalPrefix }}{{ $previous->id }}">Naar het vorige onderwerp</button>
                    @else
                        <button class="btn btn-primary disabled">Naar het vorige onderwerp</button>
                    @endif
                    @if($next)
                        <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#{{ $modalPrefix }}{{ $next->id }}">Naar het volgende onderwerp</button>
                    @else
                        <button class="btn btn-primary disabled">Naar het volgende onderwerp</button>
                    @endif
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
