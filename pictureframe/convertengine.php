#!/usr/bin/php4 -q
<?
// Copyright 2002 - Robert M. Pufky
// Conversion engine for picture frame

// load configuration settings
require_once("/etc/pictureframe/config.php");

// stay running indefinity in the background
while( true ) {
  // (re)load the originals, and clean cache if neccessary
  loadImages($images,$source);
  cleanCache($images);

  // go through each image and convert if necessary
  foreach( $images as $image ) {
    // figure out the destination name
    $modified = $destination . "/" . $image;
    // if the image has not been converted (and is not blank)
    if( !file_exists("$modified") ) {
      // assemble the full path to the files
      $original = $source . "/" . $image;
      // resize the image
      `$convert -interlace NONE -geometry $geometry "$original" "$modified"`;
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
