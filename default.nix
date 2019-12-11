{
  pkgs ? import <nixpkgs> {},
  php ? pkgs.php,
  buildPecl ? pkgs.callPackage <nixpkgs/pkgs/build-support/build-pecl.nix> {
    inherit php;
  },

  phpEpegVersion ? null,
  phpEpegSrc ? ./.,
  phpEpegSha256 ? null
}:

pkgs.callPackage ./derivation.nix {
  inherit php buildPecl phpEpegVersion phpEpegSrc phpEpegSha256;
}

