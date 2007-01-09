<?
// Copyright 2002 - Robert M. Pufky
// If you are not using the installer, be sure to 
// disable the php execution time limit!


//-------------------------------------------------
// Basics -  You should verify/set these!
//-------------------------------------------------
// the geometry to use (should be your X resolution)
$geometry = "1024x768";
// The background color (this should be the matte color of your frame)
$background = "black";

//-------------------------------------------------
// Speed -  How fast will things change?
//-------------------------------------------------
// Seconds to wait between pictures being displayed
$waittime = "5";
// How long to wait after finishing conversion to check for new pictures
$throttle = "10";

//-------------------------------------------------
// Text -  Fancypants text options.
//-------------------------------------------------
// The text color to use
$textcolor = "white";
// Show filenames with pictures?      (true OR false)
//   Note: if this is turned off (false), options below do not apply
$showtext = true;
// Where to vertically position text
//   "north" = top, "south" = bottom
$textpos = "south";
// Where to align text
//   "west = left, "east" = right, "" = center
$textalign = "west";
// What font size to use?
$textsize = 14;

//-------------------------------------------------
// You shouldn't need to change anything below here
//-------------------------------------------------
// location of your original images
$source = "/usr/local/originals";
// location of the modified images (seperate directory please!)
$destination = "/usr/local/images";
// conversion program to use
$convert = "/usr/bin/convert";
$composite = "/usr/bin/composite";

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
