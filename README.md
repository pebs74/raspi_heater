## Raspberry PI Heater Controller

### Requirements

- Raspberry PI with [Raspbian](https://www.raspberrypi.org/downloads/raspbian/).
- [Relay module](https://www.amazon.com/-/es/jbtek-canales-Module-Arduino-Raspberry/dp/B00KTEN3TM/ref=sr_1_6).
- [DHT11](https://www.amazon.com/-/es/hiletgo-temperatura-humedad-Arduino-2560-AVR/dp/B01DKC2GQ0/ref=sr_1_4) or [DHT22](https://www.amazon.com/-/es/AM2302-Digital-temperatura-SHT11-SHT15-para-electr%C3%B3nico-pr%C3%A1ctica/dp/B0795F19W6/ref=sr_1_4?__mk_es_US=%C3%85M%C3%85%C5%BD%C3%95%C3%91&keywords=dht22&qid=1577780099&sr=8-4) temperature and humidity sensor.

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
