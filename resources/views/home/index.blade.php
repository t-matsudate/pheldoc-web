<x-default-layout
  title="PhelDocs"
  scripts=""
>
  <main id="home_index">
    <p>
      PhelDocs is the documentation hub with usage examples for Phel.<br>
      This aims to maintain and to extend own contents by the community.
    </p>
    <form id="search" action="{{ route('search.index') }}" method="get">
      <label for="search_for">Some API name which you wish to search for.</label>
      <input type="text" id="search_for" name="search_for" placeholder="defn, defmacro, declare etc..." />
      <button type="submit">Search</button>
    </form>
  </main>
</x-default-layout>
