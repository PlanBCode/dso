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
                    @include('subjects.detail', ['subject' => $subject])
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
