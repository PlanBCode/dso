@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-12 pt-8 pl-0">
                            <b>Start:</b><br>
                            <span>{{ $voting_round->begin->format('Y-m-d') }}</span><br>
                        </div>
                        <div class="col-12 pt-8 pl-0">
                            <b>Eind:</b><br>
                            <span>{{ $voting_round->end->format('Y-m-d') }}</span><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-12 pt-8 pl-0">
                            <b>Progressie staat:</b><br>
                            <span>{{ $voting_round->getProgressState() }}</span><br>
                        </div>
                        <div class="col-12 pt-8 pl-0">
                            <b>Lopend:</b><br>
                            <span>@if($voting_round->in_progress)Ja @else Nee @endif</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($voting_round->getProgressState() !== 'completed')
        @include('modals.admin.voting_rounds.edit', ['voting_round' => $voting_round])
        <div class="pt-8 sm:justify-start">
            <button class="btn btn-primary" data-toggle="modal" data-target="#editVotingRoundModal">Bewerken</button>
        </div>
    @endif

    @if($voting_round->getProgressState() === \App\Models\VotingRound::PROGRESS_STATE_NOT_STARTED)

        <div class="pt-8 sm:justify-start">
            <a href="{{ route('admin-voting-round-destroy', ['voting_round' => $voting_round]) }}" class="btn btn-danger">Verwijderen</a>
        </div>

    @else

        <div class="pt-8 sm:justify-start">
            <a href="{{ route('admin-voting-round-index') }}" class="btn btn-secondary">Terug naar het overzicht</a>
        </div>

        <div class="pt-8">
            <table id="admin-subjects" class="table">
                <thead>
                <tr>
                    <th>Afbeelding</th>
                    <th>Titel</th>
                    <th>Stemmen</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $subjects = $voting_round->subjects->all();
                @endphp

                @foreach ($subjects as $subject)

                    <tr>
                        <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">@if($subject->image)<img src="{{ asset($subject->image) }}" class="rounded w-50a" alt="{{ $subject->title }}">@endif</a></td>
                        <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">{{ $subject->title }}</a></td>
                        <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">{{ $votes[$subject->id] ?? 0 }}</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>

    @endif

    <div class="pt-8 sm:justify-start">
        <a href="{{ route('admin-voting-round-index') }}" class="btn btn-secondary">Terug naar het overzicht</a>
    </div>

@endsection

@section('scripts')

    @parent

    <script>
        $(document).ready(function () {
            $('#admin-subjects').DataTable({
                dom: 'Bfrtip',
                paging: false,
                @if($voting_round->getProgressState() === 'completed')order: [[2, 'desc']],@endif
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
            });
        });
    </script>

@endsection
