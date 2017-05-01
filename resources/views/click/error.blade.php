@extends('layout.message')

@section('content')
    <div class="ui error message">
        <div class="header">Клик не зафиксирован</div>
        @if($click->bad_domain)
            Клик {{ $click->id }} содержит плохой реферрер
        @else
            Клик {{ $click->id }} уже существует в БД
        @endif
    </div>
@endsection