<form method="POST" action="{{ $action }}" name="page">
    @method($method)
    @csrf
    @foreach($fields as $field)
        {!! $field->render() !!}
    @endforeach
</form>
