#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

temp_humid=`$DIR/get_temp.sh`
temp_humid_arr=(${temp_humid//;/ })
temp=${temp_humid_arr[0]}
humid=${temp_humid_arr[1]}
curr_state=`cat $DIR/curr_state`

if [ $curr_state == "ON" ];
then
    state=80;
    switch='ON';
else
    state=0;
    switch='OFF';
fi

log=`date +"%Y-%m-%d %H:%M"`'\t\t'$temp' ºC\t\t'$humid' %\t\t'$switch

echo -e $log

