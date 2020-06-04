#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

# temp/humid sensor model DHT11 connected on raspi pin 4
python $DIR/Adafruit_Python_DHT/examples/AdafruitDHT.py 22 4
