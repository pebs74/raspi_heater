## Raspberry PI Heater Controller

### Requirements

- Raspberry PI with [Raspbian](https://www.raspberrypi.org/downloads/raspbian/).
- [Adafruit_Python_DHT](https://github.com/adafruit/Adafruit_Python_DHT) (included in project).
- [Relay module](https://www.amazon.com/-/es/jbtek-canales-Module-Arduino-Raspberry/dp/B00KTEN3TM/ref=sr_1_6).
- [DHT11](https://www.amazon.com/-/es/hiletgo-temperatura-humedad-Arduino-2560-AVR/dp/B01DKC2GQ0/ref=sr_1_4) or [DHT22](https://www.amazon.com/-/es/AM2302-Digital-temperatura-SHT11-SHT15-para-electr%C3%B3nico-pr%C3%A1ctica/dp/B0795F19W6/ref=sr_1_4?__mk_es_US=%C3%85M%C3%85%C5%BD%C3%95%C3%91&keywords=dht22&qid=1577780099&sr=8-4) temperature and humidity sensor.
- PHP
- HTTP Server (optional for API hooks)

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

### Usage

Run heater script (verbose):

<pre>php /opt/heater/run.php -v</pre>

Recommended crontab setup:

<pre>
# m h  dom mon dow   command

# Heater state to "OFF" on boot
@reboot echo "OFF" > /opt/heater/curr_state

# Monitor mode override file and run heater script on changes
@reboot cd /opt/heater && fswatch --monitor=poll_monitor -0 mode | xargs -0 -I {} bash -c './run.php >> debug.log'

# Turn off raspi onboard leds on boot
@reboot echo none > /sys/class/leds/led0/trigger
@reboot echo none > /sys/class/leds/led1/trigger
@reboot echo 0 > /sys/class/leds/led0/brightness
@reboot echo 0 > /sys/class/leds/led1/brightness

# Disable HDMI on boot
@reboot /usr/bin/tvservice -o

# Run heater script every minute
* * * * * cd /opt/heater && ./run.php >> debug.log
</pre>
 
 
###### (C) pebs74
