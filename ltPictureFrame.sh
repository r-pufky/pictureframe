#!/bin/bash
################################################################################
# Author: Chuck Wolber
# E-mail: chuckw@quantumlinux.com
# Title: ltPictureFrame.sh
# Version: 1.5
# License: GPL
# Date: 200305080108
#
# Description: Displays images in a slideshow fashion while avoiding screen 
# blinks that are a result of serially displaying images. Also normalizes the
# images for color and size (640x480).
################################################################################
DISPLAY=:0
IMAGE_DIR=$1
SLEEP_TIME=$2
N=0
XVIEW="/usr/bin/xview"
CONVERT="/usr/bin/convert"
GEOM="800x600"

################################################################################
# Prevent any interruptions.
################################################################################

# Disable console blanking. (For virtual consoles only, but hey, why not...)
/usr/bin/setterm -blank 0
/usr/bin/setterm -powerdown 0
/usr/bin/setterm -powersave off

# Disable X console blanking.
/usr/X11R6/bin/xset s off
/usr/X11R6/bin/xset -dpms

# Schedule a few disk syncs' just to make sure nothing critical is open. In
# the event of a crash or loss of power it is less likely that we'll corrupt
# the filesystem.
/bin/sync
/bin/sync
/bin/sync

################################################################################
# The only interruption that could bite us at this point is apm. Since we're
# on AC power right now (you *ARE* on AC power right???), APM shouldn't give
# us any problems. This also assumes that power management was disabled (as
# much as possible) at the BIOS level.
################################################################################

# Loop forever.
while (( 1 ))
do
    /bin/ls $IMAGE_DIR |
    while read IMAGE
    do
        # Only convert if you have to.
        IMAGE_NAME=`/usr/bin/basename $IMAGE_DIR/$IMAGE .converted`
        if [ ! -f "$IMAGE_DIR/$IMAGE_NAME.converted" ]
	then
          IMAGE_OR="$IMAGE_DIR/$IMAGE"
	  IMAGE_CO="$IMAGE_DIR/$IMAGE.converted"
	  $CONVERT -interlace NONE -geometry $GEOM $IMAGE_OR $IMAGE_CO
	  IMAGE="$IMAGE.converted"
	fi
    
        # Fork the images. But don't display unconverted images.
        if [ `/bin/echo $IMAGE | /bin/grep converted` ]
        then
            $XVIEW -fork -fullscreen -normalize $IMAGE_DIR/$IMAGE 
	    /bin/sleep $SLEEP_TIME
	
            # Only cleanup if this is a background image.
	    if [ $N == 1 ]
	    then
                # Get a list of the xview processes
	        PID_LIST=(`/bin/ps -ef | /bin/grep [x]view | /usr/bin/awk '{print $2}'`)
 
                # Determine how big the array is.
                INDEX=0
                while (( ${PID_LIST[$INDEX]} ))
                do 
                    INDEX=$(($INDEX+1))
                done

                # Increment through the list of PIDS and kill all but the last one.
                X=0
                while (( $X < $(($INDEX-1)) ))
                do
                    PID=${PID_LIST[$X]}
                    X=$(($X+1))
                    RES=1
                    while (( $RES ))
                    do
	                KILL=`/bin/kill -9 $PID 2>&1`
                        RES=0
                    done
                done 
	    else
	        # This is first image loaded. Now we can load more.
	        N=$(( $N + 1 ))
	    fi
        fi
    done
done
