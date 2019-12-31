## Raspberry PI Heater Controller
### Setup Instructions

Install path: /opt/heater/

Create the following files:

- **token**
 
Must contain a secret string for API calls (eg: "ABCD1234").

- **debug.log**
 
Must have write permissions by php user.

- **last_temp_req** and **last_mode_req**
 
Must have write permissions by http user.

Move API hooks to public HTTP Server path (eg: /var/www/html/):

 - set_temp.php
 - set_mode.php


###### (C) pebs74
