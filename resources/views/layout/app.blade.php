<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Click</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css"/>
</head>
<body>
<div class="ui container">
    <div class="ui fluid inverted menu">
        <a class="item" href="{{ action('ClickController@index') }}">Клики</a>
        <a class="item" href="{{ action('BadDomainController@index') }}">Домены</a>
    </div>

    @yield('content')
</div>
</body>
</html>
