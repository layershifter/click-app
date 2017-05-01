@extends('layout.app')

@section('content')
    <a class="ui large primary button" href="{{ action('BadDomainController@create') }}">Добавить</a>

    @if($domains->count() > 0)
        <table class="ui celled table">
            <thead>
            <th class="collapsing">ID</th>
            <th>Домен</th>
            </thead>

            <tbody>
            @foreach($domains as $domain)
                <tr>
                    <td>{{ $domain->id }}</td>
                    <td>{{ $domain->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="ui info message">
            Еще ничего нет
        </div>
    @endif
@endsection