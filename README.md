## Raspberry PI Heater Controller

### Requirements

- Raspberry PI with Raspbian.
- Relay module similar to [this one](https://www.amazon.com/-/es/jbtek-canales-Module-Arduino-Raspberry/dp/B00KTEN3TM/ref=sr_1_6).
- DHT11 or DHT22 temperature and humidity sensor.

### Setup Instructions

Create the following files:

- **token**: Must contain a secret string for API calls (eg: "ABCD1234").
- **debug.log**: Must have write permissions by php user.
- **last_temp_req** and **last_mode_req**: Must have write permissions by http user.
 
Setup desired temperatures (in Celsius):

 - **active_temp**
 - **inactive_temp**
 - **temp_margin**

Setup desired schedule:

 - **schedule.json**
 
Setup connection pins and sensor model in files:

 - **get_temp.sh**: DHT11 and pin 4 by default.
 - **turn_on.sh**: pin 2 by default
 - **turn_off.sh**: pin 2 by default.

Move/Link API hooks to public HTTP Server path (eg: /var/www/html/):

 - **set_temp.php**
 - **set_mode.php**
 
Install path (if different, update API hooks accordingly):

 - **/opt/heater/**

###### (C) pebs74
