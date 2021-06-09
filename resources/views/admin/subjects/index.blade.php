@extends('layouts.app')

@section('content')

    <div class="pt-8">
        <table id="admin-subjects" class="table">
            <thead>
            <tr>
                <th>Afbeelding</th>
                <th>Titel</th>
                <th>Status</th>
                <th>Geclaimed door</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $key => $subject)
                <tr>
                    <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">@if($subject->image)<img src="{{ asset($subject->image) }}" class="rounded w-50a" alt="{{ $subject->title }}">@endif</a></td>
                    <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">{{ $subject->title }}</a></td>
                    <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">{{ $subject->state }}</a></td>
                    <td><a href="{{ route('admin-subject-show', ['subject' => $subject]) }}">@if($subject->lock_user_id){{ \App\Models\User::find($subject->lock_user_id)->name }}@endif</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('#admin-subjects').DataTable({
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
