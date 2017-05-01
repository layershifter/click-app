@extends('layout.message')

@section('content')
    <div class="ui success message">
        <div class="header">Клик зафиксирован</div>
    </div>

    <table class="ui table">
        <tr><td>{{ $click->id }}</td></tr>
        <tr><td>{{ $click->ua }}</td></tr>
        <tr><td>{{ $click->ip }}</td></tr>
        <tr><td>{{ $click->ref }}</td></tr>
        <tr><td>{{ $click->param1 }}</td></tr>
        <tr><td>{{ $click->param2 }}</td></tr>
    </table>
@endsection