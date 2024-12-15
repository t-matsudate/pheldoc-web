<x-default-layout
  title="{{$name . ' - PhelDocs'}}"
  scripts=""
>
  <main id="search">
    <p>{{ count($functions) }}&nbsp;functions&nbsp;found.</p>
    <ul>
      @foreach ($functions as $function)
      <li id="{{ $function->id }}"><a href="{{ route('function.show', ['namespace' => $function->phelNamespace->namespace, 'name' => $function->name ]) }}">{{ $function->phelNamespace->namespace }}/{{ $function->name }}</a></li>
      @endforeach
    </ul>
  </main>
</x-default-layout>
