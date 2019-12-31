# Heater switch connected to raspi pin 2
gpio -g mode 2 out
gpio -g write 2 0
echo "ON" > ./curr_state
