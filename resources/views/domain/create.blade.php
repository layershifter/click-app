@extends('layout.app')

@section('content')
    <form class="ui form segment" method="post" action="{{ action('BadDomainController@store') }}">
        <div class="field {{ $errors->has('name') ? 'error' : '' }}">
            <label>Домен</label>

            @if($errors->has('name'))
                <div class="ui pointing below prompt basic label">{{ $errors->get('name')->first() }}</div>
            @endif

            <input type="text" name="name" placeholder="domain.com" required autofocus value="{{ old('name') }}">
        </div>

        <button class="ui large primary button">Добавить</button>
        {{ csrf_field() }}
    </form>
@endsection