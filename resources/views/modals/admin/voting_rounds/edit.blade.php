@section('modals')
    @parent
    <div class="modal fade" id="editVotingRoundModal" tabindex="-1" aria-labelledby="editVotingRoundModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVotingRoundModalLabel">Stemronde bewerken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div id="editSubjectForm">
                        {!! $form->render() !!}
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
