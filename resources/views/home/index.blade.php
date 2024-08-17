<!DOCTYPE html>
<html>
  <head>
    <title>PhelDocs</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
  </head>
  <body>
    <main id="home_index">
      <p>
        PhelDocs the documentation hub with usage examples for Phel.<br>
        This aims to maintain and to extend own contents by the community.
      </p>
      <form id="search" action="{{ route('search.index') }}" method="get">
        <label for="search_for">Some API name which you wish to search for.</label>
        <input type="text" id="search_for" name="search_for" placeholder="defn, defmacro, declare etc..." />
        <button type="submit">Search</button>
      </form>
    </main>
  </body>
</html>
