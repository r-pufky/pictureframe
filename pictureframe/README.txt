Pictureframe
Copyright 2002 - Robert M. Pufky

To Know:
--------
You should install these scripts as the "root" user, or use "sudo".  To use sudo, verify that it is installed, then prepend "sudo " to all the listed commands below

Installation
------------
1) Run the install script from the pictureframe directory
  "./install"
2) Create a custom user account to upload pictures with
  "adduser <username>"
3) Create a symlink from new user account to /usr/local/originals, for ease of use
  "ln -sf /usr/local/originals /home/<username>/pictures"
4) Verify that /etc/pictureframe/config.php settings are correct
  - you should only have to verify the resolution matches your X server resolution
5) Reboot, upload, and enjoy!


I should not have to mention that you SHOULD NOT use this to store your picture files, and I hold no responsiblity if anything happens to them.  You have been warned!!
