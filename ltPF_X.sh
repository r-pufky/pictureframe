#!/bin/bash
################################################################################
# Author: Chuck Wolber
# E-mail: chuckw@quantumlinux.com
# Title: ltPF_X.sh
# Version: 1.1
# License: GPL
# Date: 200307230102
#
# Description: Manages X initialization and ensures that ltPictureFrame.sh
# is always started *AFTER* X is started.
################################################################################
IMAGE_PATH='/usr/local/images'
SLIDE_DELAY=5

#export PATH=/usr/X11R6/bin
#/usr/bin/X11/startx &
export PATH=/usr/bin/X11
/usr/bin/X11/xinit /usr/bin/X11/unclutter -idle .5 -root &

export DISPLAY=localhost:0.0
/usr/local/bin/ltPictureFrame.sh $IMAGE_PATH $SLIDE_DELAY &
