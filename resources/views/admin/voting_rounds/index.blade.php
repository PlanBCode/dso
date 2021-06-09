@extends('layouts.app')

@section('content')

    <div class="pt-8">
        <a href="{{ route('admin-voting-round-create') }}" class="btn btn-primary">Nieuwe stemronde</a>
    </div>

    <div class="pt-8">
        <table id="admin-voting-rounds" class="table mb-0">
            <thead>
            <tr>
                <th>Start</th>
                <th>Eind</th>
                <th>Progressie staat</th>
                <th>Lopend</th>
                <th>Onderwerpen</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($voting_rounds as $key => $voting_round)

                <tr>
                    <td><a href="{{ route('admin-voting-round-show', ['voting_round' => $voting_round]) }}">{{ $voting_round->begin->format('Y-m-d') }}</a></td>
                    <td><a href="{{ route('admin-voting-round-show', ['voting_round' => $voting_round]) }}">{{ $voting_round->end->format('Y-m-d') }}</a></td>
                    <td><a href="{{ route('admin-voting-round-show', ['voting_round' => $voting_round]) }}">{{ $voting_round->getProgressState() }}</a></td>
                    <td><a href="{{ route('admin-voting-round-show', ['voting_round' => $voting_round]) }}">@if($voting_round->in_progress)Ja @else Nee @endif</a></td>
                    <td><a href="{{ route('admin-voting-round-show', ['voting_round' => $voting_round]) }}">{{ $voting_round->subjects->count() }}</a></td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>

    <div class="pt-8">
        <a href="{{ route('admin-voting-round-create') }}" class="btn btn-primary">Nieuwe stemronde</a>
    </div>

@endsection

@section('scripts')

    @parent

    <script>
        $(document).ready(function () {
            $('#admin-voting-rounds').DataTable({
                dom: 'Bfrtip',
                ordering: false,
                paging: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
            });
        });
    </script>

@endsection
