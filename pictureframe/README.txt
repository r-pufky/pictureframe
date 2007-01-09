Pictureframe
Copyright 2002-2006 - Robert M. Pufky



Electronic Picture Frame:
-------------------------
These scripts will turn a Linux machine into a handy-dandy picture
frame that will rotate through images.  It has the option to 
change the background matte color to match whatever you put it
into, as well as displaying the filename in any position over the
picture.  Uploading pictures to this device is as simple as drag
and drop.

The first thing you should do is print off a copy of these
instructions.  That will make installation much easier (though it
really isn't that hard - I'm just a paper-instruction type of guy).

The second thing you should do is know NOT to STORE your pictures
on this device.  No, really, I am being serious.  The nature of
this device leads it to suffer more than a normal computer would,
and storing anything on it for backup purposes would be, frankly,
dumb.  You HAVE been warned!!

Instructions to disassemble your laptop and mount it in a frame
(or "memory box" as they are usually deeper and work better) are
NOT provided in these instructions.  Simply because I don't want
people e-mailing me "omgz I followed your instructions and now
I am stuck with a disassembled laptop that is borked!!"  I might
provide some picture references at a later date - you can Google
for these types of images and find a solution that best fits 
your needs - I am just providing you with the tools to complete a
frame, you're the one deciding to take apart your laptop.



Installation:
-------------
1) Download and burn a Debian net-installation disk.  This can be
   downloaded from:

   http://cdimage.debian.org/debian-cd/3.1_r4/i386/iso-cd/debian-31r4-i386-netinst.iso

2) Boot computer with Debian net-installation disk.

3) When the boot menu appears enter the following command and press
   enter (we could run a 2.4 kernel, but why?!):

      linux26

   During the installation, select the defaults (according to your
   taste and hardware).  After rebooting, continue through the
   installation but watch for these screens:

      "Apt Configuration"
         - Choose "http" method
         - On server selection screen, press "page up"
           - When you see "enter information manually", press enter
             - Enter the following server:

               mirror.cob.rit.edu

           - go through the rest of the Apt Configuration per your
             needs
      
      "Debian Software Selection"
        - Do not highlight any items
        - Just click next

4) Copy and extract the pictureframe tarball (the archive you
   are reading this out of) to your system.  The easiest way
   to do this is to login to the box as the "root" user and
   issue the following commands:

      cd /root
      wget http://www.crazymonkies.com/pictureframe.tar.gz
      tar zxvf pictureframe.tar.gz
      cd pictureframe

5) Once extracted, run the X-windows setup script.  Read the
   warnings!  Pay attention to the video resolution, and pick the
   one that best fits your needs.  Remember to read the 
   installation dialog prompts and choose accordingly.
  
      ./installx
  
6) Confirm that X-windows is working correctly for you by running
   the following command:

      startx

   You should see a grey screen pop up, with a little "X" that you
   can move around with your mouse.  That means everything is
   great!  You can stop the X-windows server and move onto the
   next step.  To kill the server press the following key
   combination:

      ctrl-alt-backspace

   If you don't see this grey screen, the most common problem is
   that the X-server cannot find your ps2 mouse.  Don't worry!
   You can reconfigure X-windows easily by typing the following
   command:

      dpkg-reconfigure xserver-xfree86

   During the configuration process, read the prompts carefully.
   If you don't understand what something is, it is safe to
   accept the default.  What we are looking for is the "mouse"
   section.  In there, be sure to select this option:

      /dev/psaux

   Re-test your settings by starting this step over again!

7) Verify video resolution is set to what your hardware can
   handle.  You will get the best images (the oooo-aaahhh's from
   onlookers) if your resolution is set to the native resolution
   of your laptop.  This is typicaly 1024x768, but has changed 
   in recent years.  Don't worry!  you pictures will
   automatically be resized to fit within whatever size you
   choose.  Run the following command to change video settings
   (you will also go through other settings as well):

      dpkg-reconfigure xserver-xfree86

   After it is finished test you installation by repeating step 6.

8) Whew!  Hard part is over (it really wasn't that hard was it?)
   Now we just need to install the actual pictureframe files so
   we can turn your laptop into a shiny new electronic picture
   frame.  This can be done by running the following command
   (and remember - read the installation carefully, you might
   have to enter information):

      ./installpic

9) Now's the fun part.  Fire up your favorite editor, and check-
   out the configuration file.  You'll want to make sure that
   the resolution is set to what your X-windows Server is running
   - beyond that, there's a whole bunch of VERY cool options just
   waiting for someone to tweak.  Anyways, you can edit the file
   by editing /etc/pictureframe/config.php, or just run the
   following command if you don't know how:

      nano /etc/pictureframe/config.php

10) Installation complete!  Pat yourself on the back, and have a
    Beer.  Then check out "How To Use The Picture Frame"



How To Use The Picture Frame:
-----------------------------
So a few things happened when you installed the pictureframe.
First, a user was created, and you created a password for that
user.  The username is:

      picture

The password, is of course, whatever you entered during the
installation.

So how to upload files to this baby and get it running?  Easy.
If you are using a Windows-based PC, you will want to download
and install "winscp".  This software allows you to copy over
files to your display very easily and very securely.  I've
provided a handy-dandy link to the software right here:

      http://winscp.net/eng/download.php

When you are connecting to the display via winscp, you will
need to know the username and password, and the display's IP
address.  If you are still logged into the display, you can
check it by typing in the following command:

      ifconfig

Which will return a whole bunch of numbers.  You want the
"inet addr" field, and will probably look something like
"192.168.0.4".  You can also check you router, etc.  MAC
users can use "Fetch", as well as "scp" (linux users can
use this one as well); though I am not going to go over this
usage in this document.

Once you've connected to the machine, double click on the
"pictures" folder, and drag and drop your photos into
there.  That's it.  Seriously.  The display will
automatically detect changes in the directory, and will
start processing those new files immediately.

Deleting files from this folder will also remove them from
being displayed on the display.  Please note that the more
pictures you have, the longer the time will be between
refreshes!  If you want instant gratification, you can
always reboot the display.



Legal Issues:
-------------
You may use this program for personal use only!  If you want to 
use any of the code provided herein for commerical use (i.e. you will
make money from it) please contact me at: robert.pufky@gmail.com
Chances are I'll just let you use it, just ask!  If you ask after
you've already done it, I won't be too happy about it



Revision Information:
---------------------
1.01 - Updated code, created installers for Debian.  Initial public
       release 
1.00 - Initial code / personal release (non-public)

* The next release will support Ubuntu installations!