@extends('layout.app')

@section('content')
    <div class="ui error message">
        <div class="header">Клик не зафиксирован</div>
        Клик {{ $click->id }} уже существует в БД
    </div>
@endsection