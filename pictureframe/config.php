<?

// Copyright 2002 - Robert M. Pufky
// If you are not using the installer, be sure to 
// disable the php execution time limit!
//
// Valid options are:
// Boolean (T/F): 
//   true  - yes I want this option
//   false - no I don't want this option
// Vertical Position:
//   north - top of the screen
//   south - bottom of the screen
// Horizontal Position:
//   west - left of the screen
//   east - right of the screen
//   ""   - (blank) center of the screen

//-------------------------------------------------
// Basics -  You should verify/set these!
//-------------------------------------------------
// the screen size to use - your X resolution
$geometry = "1440x960";
// The background color - the matte of your frame
$background = "black";

//-------------------------------------------------
// Speed -  How fast will things change?
//-------------------------------------------------
// Seconds to wait between pictures being displayed
$waittime = "5";
// Minimum time (seconds) between scanning all pics
$throttle = "10";

//-------------------------------------------------
// Text -  Fancypants text options.
//-------------------------------------------------
// The text color to use
$textcolor = "white";
// Show filenames with pictures?
$showtext = true;
// Vertical position
$textpos = "south";
// Horizontal position
$textalign = "west";
// What font size to use?
$textsize = 14;

//-------------------------------------------------
// You shouldn't need to change anything below here
//-------------------------------------------------
// Original image location
$source = "/usr/local/originals";
// Modified image location (seperate directory!)
$destination = "/usr/local/images";
// conversion programs to use
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
