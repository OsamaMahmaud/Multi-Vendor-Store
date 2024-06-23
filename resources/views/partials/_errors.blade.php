@if ($errors->any())
    <div class="alert alert-danger">
        <h1>ErrorOccured!</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
