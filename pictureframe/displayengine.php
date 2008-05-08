#!/usr/bin/php4 -q
<?
// Copyright 2002 - Robert M. Pufky
// Display engine for picture frame

// load configuration
require_once("/etc/pictureframe/config.php");

// Disable screen power management
`$xset -display :0 s off > /dev/null 2>&1;
$xset -display :0 -dpms > /dev/null 2>&1;
$setterm -blank 0 > /dev/null 2>&1;
$setterm -powerdown 0 > /dev/null 2>&1;
$setterm -powersave off > /dev/null 2>&1`;

// write any system information not committed to disk, to the disk
// this will let us just unplug it without worry
`$sync;$sync;$sync`;

// put up the loading images screen and give convertengine some time to process the first picture
`$xview -display localhost:0.0 -fork -fullscreen -normalize "/tmp/loading.png" > /dev/null 2>&1 &`;
sleep(3);

// continue indefinitely
while( true ) {
  loadImages($images,$destination);
 
  // prevent runaway case where there are no pictures
  if( count($images) == 0 ) {
    sleep($throttle);
  } else {
    // render each picture
    foreach( $images as $image ) {
      $image = "$destination/$image";
    
      // load new image to be displayed, and fork the process
      `$xview -display localhost:0.0 -fork -fullscreen -normalize "$image" > /dev/null 2>&1 &`;
      sleep($waittime);
    
      // remove "stale" images (not currently being displayed)
      $pids = explode("\n",`$pgrep [x]view`);
      array_pop($pids);
      reset($pids);

      // remove old pictures, except for the new picture being displayed (has the highest pid)
      for( $i=0; $i < count($pids)-1; $i++ ) {
        exec("$kill -9 " . current($pids) . " > /dev/null 2>&1");
        next($pids);
      }
    }
  }
}
