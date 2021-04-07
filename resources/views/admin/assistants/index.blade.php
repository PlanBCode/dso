@extends('layouts.app')

@section('content')

    <div class="pt-8">
        <table id="admin-assistants" class="table">
            <thead>
            <tr>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($assistants as $key => $assistant)
                <tr>
                    <td><a href="{{ route('admin-assistant-show', ['assistant' => $assistant]) }}">{{ $assistant->email }}</a></td>
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
            $('#admin-assistants').DataTable({
                dom: 'Bfrtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
            });
        });
    </script>
@endsection
