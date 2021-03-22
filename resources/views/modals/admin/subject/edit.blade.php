@section('modals')
    @parent
    <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubjectModalLabel">Onderwerp bewerken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div id="editSubjectForm">
                        <form action="{{ route('admin-subject-update', ['subject' => $subject]) }}" method="POST" class="needs-validation" novalidate>
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="image" />
                            <div class="sm:justify-start">
                                <label for="title" class="form-label">
                                    Title *<br>
                                    <input type="text" name="title" id="title" class="form-control" data-to-summary="title" required value="{{ $subject->title }}">
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="short_description">
                                    Korte omschrijving (max 50 woorden) *<br>
                                    <textarea type="text" name="short_description" id="short_description" rows="8" class="form-control" data-to-summary="short_description" required>{{ $subject->short_description }}</textarea>
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            <div class="pt-8 sm:justify-start">
                                <label for="description">
                                    Omschrijving (max 200 woorden) *<br>
                                    <textarea type="text" name="description" id="description" rows="8" class="form-control" data-to-summary="description" required>{{ $subject->description }}</textarea>
                                    <div class="invalid-feedback">
                                        Dit veld is verplicht.
                                    </div>
                                </label>
                            </div>
                            @if(!$subject->image)
                            <div class="pt-8 sm:justify-start">
                                Afbeelding
                                <div data-dropzone>
                                    ... sleep of klik hier om de afbeelding te uploaden.
                                </div>
                            </div>
                            @endif

                            <div class="pt-8 sm:justify-start">
                                <button type="submit" class="btn btn-primary">Opslaan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection

@if(!$subject->image)
@section('scripts')
    @parent
    <script>
        $(function () { // jQuery ready
            'use strict'

            let $form = $('#editSubjectForm').find('form');
            let updateDz = {
                map: {},
                update: function () {
                    let $imageField = $form.find('input[type="hidden"][name="image"]');
                    let val = '';
                    for (let key in this.map) {
                        val += (val ? ',' : '') + this.map[key];
                    }
                    $imageField.val(val);
                },
            };
            let dz = new Dropzone('[data-dropzone]', {
                url: '{{ route('files-store') }}',
                addRemoveLinks : true,
                maxFiles: 1,
                dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
                dictResponseError: 'Error uploading file!',
                acceptedFiles: 'image/*',
                files: [
                    '{{ asset($subject->image) }}'
                ],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function () {
                    this.on('success', function(file, response) {
                        updateDz.map[file.upload.uuid] = response.id;
                        updateDz.update();
                    });
                    this.on('removedfile', function(file) {
                        let url = '{{ route('files-destroy', ['file' => 'file_id']) }}';
                        let file_id = updateDz.map[file.upload.uuid];
                        if (typeof file_id !== 'undefined') {
                            url = url.replace('file_id', file_id);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                data: {},
                                type: 'DELETE',
                                cache: false,
                                dataType: 'json',
                                success: function (data) {
                                    delete updateDz.map[file.upload.uuid];
                                    updateDz.update();
                                }
                            });
                        }
                    });
                    this.on('error', function(file, message) {
                        alert(message);
                        this.removeFile(file);
                    });
                },
            });
        });
    </script>
@endsection
@endif
