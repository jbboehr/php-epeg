{ php, stdenv, autoreconfHook, fetchurl, epeg, pkgconfig,
  phpEpegVersion ? null,
  phpEpegSrc ? null,
  phpEpegSha256 ? null
}:

let
  orDefault = x: y: (if (!isNull x) then x else y);
  buildPecl = import <nixpkgs/pkgs/build-support/build-pecl.nix> {
    inherit php stdenv autoreconfHook fetchurl;
  };
in

buildPecl rec {
  pname = "epeg";
  name = "epeg-${version}";
  version = orDefault phpEpegVersion "9d4b0722a03cf5b4ea76813733badcfb17c1a0a9";
  src = orDefault phpEpegSrc (fetchurl {
    url = "https://github.com/jbboehr/php-epeg/archive/${version}.tar.gz";
    sha256 = orDefault phpEpegSha256 "11hajfnqksq7bs1mzq03s6rsa8j1ja7rnyvrlxrl53kvblbrc9yw";
  });

  makeFlags = ["phpincludedir=$(out)/include/php/ext/epeg"];
  buildInputs = [ epeg ];
  nativeBuildInputs = [ pkgconfig ];


  doCheck = true;
  checkTarget = "test";
  checkFlagsArray = ["REPORT_EXIT_STATUS=1" "NO_INTERACTION=1" "TEST_PHP_DETAILED=1"];
}

