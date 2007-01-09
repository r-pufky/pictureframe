#!/usr/bin/php4 -q
<?
// Copyright 2002 - Robert M. Pufky
// Conversion engine for picture frame

// load configuration settings
require_once("/etc/pictureframe/config.php");

// stay running indefinity in the background
while( true ) {
  // grab config.php datestamp and refresh background image
  $timestamp = filemtime("/etc/pictureframe/config.php");
  // re-render the loading screen in case of config.php changes
  `$convert xc:$background -resize $geometry! -fill $textcolor -pointsize 20 -font helvetica -gravity center -draw "text 0,0 'Loading images...'" /tmp/loading.png > /dev/null 2>&1`;
  
  // (re)load the originals, and clean cache of original pictures removed
  loadImages($images,$source);
  cleanCache($images);

  // go through each image and convert if necessary
  foreach( $images as $image ) {
    // figure out the destination name
    $modified = $destination . "/" . $image;
    // if the image has not been converted or the converted image needs updating due to new config.php
    if( !file_exists("$modified") || (file_exists("$modified") && (filemtime("$modified") < $timestamp)) ) {
      // assemble the full path to the files
      $original = $source . "/" . $image;

      // resize the image
      `$convert -interlace NONE -geometry $geometry "$original" "-" | $composite -gravity center "-" -compose Over /tmp/loading.png "$modified" > /dev/null 2>&1`;
      
      // if fancypants options are turned on, re-process and insert text
      if( $showtext ) {
        `$convert "$modified" -font helvetica -pointsize $textsize -fill $textcolor -gravity $textpos$textalign -annotate 0 '$image' "$modified" > /dev/null 2>&1`;
      }
    }
  }
  // wait before refreshing the pictures again
  sleep($throttle);
}

// clears non-existent pictures from cache
Function cleanCache(&$images) {
  global $destination;
  global $rm;
  // load the currently cached images
  loadImages($cache,$destination);
  $items = array_diff($cache,$images);

  // remove the pictures that were removed from the originals
  foreach( $items as $item ) {
    `$rm -f '$destination/$item'`;
  }
}
