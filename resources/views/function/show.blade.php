<x-default-layout
  title="{{ $function->phelNamespace }}/{{ $function->name }} - PhelDocs"
  scripts="resources/ts/Document.ts resources/ts/UsageExample.tsx resources/ts/Highlight.ts"
>
  <main id="function_show">
    <h2>{{ $function->phelNamespace->namespace }}/{{ $function->name }}</h2>
    <p>{{ $function->symbol_type }}</p>
    <div id="description" style="pre { max-width: 100%; white-space: break-spaces; }">{{ $function->description }}</div>
    @php
    $examples = $function->usageExamples()->get();
    @endphp
    <p id="examples_count">{{ count($examples) }}&nbsp;examples.</p>
    <ul id="examples">
      @foreach ($examples as $example)
      <li id="{{ $example->id }}">
        <p>{{ $example->user->name }}</p>
        <pre style="max-width: 100%; overflow-x: scroll;"><code class="hljs language-phel">{{ $example->example }}</code></pre>
      </li>
      @endforeach
    </ul>
  </main>
  <div
    id="root"
    data-post-to="{{ route('function.example.store') }}"
    data-csrf-token="{{ csrf_token() }}"
  >
  </div>
</x-default-layout>
