import sys
sys.path.append('../')
import time
import requests
#from urllib.request import urlopen, Request
import json
import RPi.GPIO as gpio

import paho.mqtt.client as mqtt
import paho.mqtt.publish as publish

gpio.setwarnings(False)
gpio.setmode(gpio.BOARD)
gpio.setup(7, gpio.OUT, initial=gpio.LOW)

#-----------------------------------------MQTT--------------------------------------------------------#
#ID del canal en Thingspeak
ID = "1577876"                                   #ID respectivo al canal en thingspeak
apikey = "35GDXUSGH2W745QO"                      #Key para conectar con el canal de thingspeak
host = "mqtt.thingspeak.com"                     #Servidor donde se encuentra alojada la base de datos
transport_mqtt="tcp"                             #Protocolo de transporte
port_mqtt=1883                                   #Puerto de comunicacion de MQTT
topic = "channels/" + ID + "/publish/" + apikey
while True:
    u = requests.get('https://api.thingspeak.com/channels/1560453/fields/1/last.json')
    u_dictionary= u.json()
        ti=int(u_dictionary['field1'])

    h = requests.get('https://api.thingspeak.com/channels/1577876/fields/1/last.json')
    h_dictionary= h.json()
    hist=int(h_dictionary['field1'])
    
    if ti == 5 and hist == 0:           # intervalo de 5 segundos
	    gpio.output(7,gpio.LOW)
	    time.sleep(1)
	    gpio.output(7,gpio.HIGH)
	    time.sleep(5)
	    print("5 seg")
    elif ti==10 and hist == 0:          # intervalo de 10 segundos
	    gpio.output(7, gpio.LOW)
	    time.sleep(1)
	    gpio.output(7,gpio.HIGH)
	    time.sleep(10)
	    print("10 seg")
    elif ti==15 and hist == 0:          # intervalo de 15 segundos
	    gpio.output(7, gpio.LOW)
	    time.sleep(1)
	    gpio.output(7,gpio.HIGH)
	    time.sleep(15)
	    print("15 seg")
    elif hist==1 and ( ti==5 or ti==10 or ti==15):  # Cuando el valor del gas es muy alto  
        publish_mqtt = "field1="+'0'
        publish.single(topic,payload=publish_mqtt,hostname=host,port=port_mqtt,tls=None,transport=transport_mqtt)
        gpio.output(7, gpio.LOW)
        time.sleep(1)
        gpio.output(7,gpio.HIGH)
        time.sleep(7)
        print("7 seg Auto")
