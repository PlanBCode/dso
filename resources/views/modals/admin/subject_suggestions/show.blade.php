@section('modals')
    @parent
    <div class="modal fade" id="fromSubjectSuggestionModal" tabindex="-1" aria-labelledby="fromSubjectSuggestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="fromSubjectSuggestionModalLabel">Oorspronkelijk ingestuurde onderwerp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div class="border p-6 shadow-sm">
                        <b>Titel:</b><br>
                        <span>{{ $subject_suggestion->title }}</span><br>
                        <br>
                        <b>Beschrijving onderwerp:</b><br>
                        <span>{{ $subject_suggestion->description }}</span><br>
                        <br>
                        <b>Dit moet onderzocht worden omdat:</b><br>
                        <span>{{ $subject_suggestion->importance }}</span><br>
                        <br>
                        <b>Bronnen bij dit onderwerp:</b><br>
                        <div class="container">
                        @foreach($subject_suggestion->files as $file)
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
                        <br>
                        <b>Voornaam:</b><br>
                        <span>{{ $subject_suggestion->firstname }}</span><br>
                        <br>
                        <b>Achternaam:</b><br>
                        <span>{{ $subject_suggestion->lastname }}</span><br>
                        <br>
                        <b>E-mail:</b><br>
                        <span>{{ $subject_suggestion->email }}</span><br>
                        <br>
                        <b>Helpen:</b><br>
                        <span>{{ $subject_suggestion->skills }}</span><br>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
