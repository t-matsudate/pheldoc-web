{pkgs}: {
  deps = [
    pkgs.php82Extensions.pdo_sqlite
    pkgs.sqlite
    pkgs.docker-compose
    pkgs.docker
  ];
}
