{
  pkgs ? import <nixpkgs> {},
  php ? pkgs.php,

  phpEpegVersion ? null,
  phpEpegSrc ? ./.,
  phpEpegSha256 ? null
}:

pkgs.callPackage ./derivation.nix {
  inherit php phpEpegVersion phpEpegSrc phpEpegSha256;
}

