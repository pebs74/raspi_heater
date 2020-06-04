#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

# Heater relay connected to raspi pin 2
gpio -g mode 2 out
gpio -g write 2 1
echo "OFF" > $DIR/curr_state
