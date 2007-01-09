Pictureframe
Copyright 2002 - Robert M. Pufky



To Know:
--------
You should install these scripts as the "root" user, or use "sudo".  

To use sudo, verify that it is installed, then prepend "sudo " to 
all the listed commands below.

I should not have to mention that you SHOULD NOT use this to store 
your picture files, and I hold no responsiblity if anything happens 
to them.  You have been warned!!



Installation:
-------------
1) Download, burn, and do a basic installation of Debian.  This iso can be
   downloaded and burnt from any common burning software:

   http://cdimage.debian.org/debian-cd/3.1_r4/i386/iso-cd/debian-31r4-i386-netinst.iso

   During the installation, when prompted to install "standard software", SKIP
   this step.

1) Run the X-windows setup script.  The defaults for X-windows are fine for
   99% of all users.  Pay attention to the video resolution, and pick the one
   that best fits your needs.  Note: it can take a very long time to run 
   depending on your connection!
  
      ./installx
  
2) Confirm that you can start X-windows by running:

      startx

   Then kill X-windows by pressing:
   
      ctrl-alt-backspace

3) If the resolution you picked is not the resolution you want to use,
   you may re-select the correct resolution by re-running the X-windows
   configuration.  The defaults are fine for 99% of all cases.  You should
   go through step 2 again to verify your settings.

      dpkg-reconfigure xserver-xfree86

4) Run the pictureframe installation script

      ./installpic

5) Verify that the X-windows resolution matches the configured resolution
   for the pictureframe.  The default value is 1024x768.  The file is
   located here:

      /etc/pictureframe/config.php

5) Read Usage, Reboot, Upload, and Enjoy!



Usage:
------
a 'picture' user is create on the device.  The password is what you 
had choosen during the installation.  To upload files, you can either
run 'scp' and manually copy over the files, or you can use 'winscp',
which will allow you to drag and drop the files to the pictureframe from
your windows pc.  Winscp can be found here:

      http://winscp.net/eng/download.php

Pictures uploaded to the device will automatically be put into rotation
on the pictureframe.  If you want to remove pictures from the display,
navigate to the 'pictures' folder on the display, and delete accordingly.
These pictures will them be removed after a period of time on the display.



Legal Issues:
-------------
You may use this program for personal use only!  If you want to 
use any of the code provided herein for commerical use (i.e. you will
make money from it) please contact me at: robert.pufky@gmail.com

Chances are I'll just let you use it.
