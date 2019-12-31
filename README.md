## Raspberry PI Heater Controller
### Setup Instructions



Create the following files:
- **token**: Must contain a secret string for API calls (eg: "ABCD1234").
- **debug.log**: Must have write permissions by php user.
- **last_temp_req** and **last_mode_req**: Must have write permissions by http user.
 
Setup desired temperatures (Celsius) in files:
 - **active_temp**
 - **inactive_temp**
 - **temp_margin**

Setup desired schedule in file:
 - **schedule.json**

Move/Link API hooks to public HTTP Server path (eg: /var/www/html/):
 - **set_temp.php**
 - **set_mode.php**
 
Install path (if different, update API hooks accordingly):
 - **/opt/heater/**

###### (C) pebs74
