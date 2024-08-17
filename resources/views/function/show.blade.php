<!DOCTYPE html>
<html>
  <head>
    <title>{{ $function->phelNamespace->namespace }}/{{ $function->name }}- PhelDocs</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
  </head>
  <body>
    <main id="function_show">
      <h2>{{ $function->phelNamespace->namespace }}/{{ $function->name }}</h2>
      <p>{{ $function->symbol_type }}</p>
      <p id="description">{{ $function->description }}</p>
      @php
      $examples = $function->usageExamples()->get();
      @endphp
      <p>{{ count($examples) }}&nbsp;examples.</p>
      <ul id="examples">
        @foreach ($examples as $example)
        <li id="{{ $example->id }}">
          <p>{{ $example->user->name }}</p>
          <pre><code class="hljs language-phel">{{ $example->example }}</code></pre>
        </li>
        @endforeach
      </ul>
    </main>
    <!-- TODO: Writes a script that parses markdown into HTML via remark/highlight.js. -->
  </body>
</html>
