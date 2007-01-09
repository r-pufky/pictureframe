<?
// Copyright 2002 - Robert M. Pufky
// If you are not using the installer, be sure to 
// disable the php execution time limit!

// the geometry to use (should be your X resolution)
$geometry = "1024x768";
// location of your original images
$source = "/usr/local/originals";
// location of the modified images (seperate directory please!)
$destination = "/usr/local/images";
// Seconds to wait between pictures being displayed
$waittime = "5";
// How long to wait after finishing conversation to check for new pictures
$throttle = "10";

//-------------------------------------------------
// You shouldn't need to change anything below here
//-------------------------------------------------
// conversion program to use
$convert = "/usr/bin/convert";

// Locations of binaries, as we are not operating in a shell
$setterm = "/usr/bin/setterm";
$xview = "/usr/bin/xview";
$pgrep = "/usr/bin/pgrep";
$xset = "/usr/bin/X11/xset";
$sync = "/bin/sync";
$kill = "/bin/kill";
$ls = "/bin/ls";
$rm = "/bin/rm";

// loads images from a source directory
Function loadImages(&$images,$source) {
  global $ls;
  // load pictures from source dir, removing blank cell at end
  $images = explode("\n",`$ls $source`);
  array_pop($images);
  reset($images);
}
