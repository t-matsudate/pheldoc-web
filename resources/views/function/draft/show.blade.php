<x-default-layout
  title="{{ $draft->phelNamespace }}/{{ $draft->name }} (draft) - PhelDocs"
  scripts="resources/ts/Document.ts resources/ts/Highlight.ts"
>
  <main id="function_draft_show">
    <h2>{{ $draft->phelNamespace }}/{{ $draft->name }}&nbsp;(draft)</h2>
    <p>{{ $draft->symbol_type }}</p>
    <div id="description" style="pre { max-width: 100%; white-space: break-spaces; }">{{ $draft->description }}</div>
    <p><a href="{{ route('function.draft.edit', ['id' => $draft->id]) }}">Edit this draft</a></p>
  </main>
</x-default-layout>
