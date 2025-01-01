{ pkgs ? import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/20.09.tar.gz") {} }:

pkgs.mkShell {
  buildInputs = [
    pkgs.php81
    pkgs.composer
    pkgs.nodejs
    pkgs.yarn
  ];

  shellHook = ''
    echo "Welcome to your Laravel development environment!"
  '';
}
