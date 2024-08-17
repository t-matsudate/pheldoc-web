<!DOCTYPE html>
<html>
  <head>
    <title>{{ $name }} - PhelDocs</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="styleshhet" href="{{ mix('css/app.css') }}" />
  </head>
  <body>
    <main id="search">
      <p>{{ count($functions) }}&nbsp;functions&nbsp;found.</p>
      <ul>
        @foreach ($functions as $function)
        <li id="{{ $function->id }}"><a href="{{ route('function.show', ['namespace' => $function->phelNamespace->namespace, 'name' => $function->name ]) }}">{{ $function->phelNamespace->namespace }}/{{ $function->name }}</a></li>
        @endforeach
      </ul>
    </main>
  </body>
</html>
