<!DOCTYPE html>
<html>
  <head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite([ 'resources/scss/app.scss' ])
  </head>
  <body>
    {{ $slot }}
    @vite($scripts)
  </body>
</html>
