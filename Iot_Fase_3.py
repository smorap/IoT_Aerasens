#-----------------Bliotecas de funcionesutilizadas-------------#
##
import RPi.GPIO as GPIO
## Biblioteca de funciones para MQTT
import paho.mqtt.client as mqtt
import paho.mqtt.publish as publish
import paho.mqtt.subscribe as subscribe
## Biblioteca de funciones para archivo .json
import json
## Biblioteca de funciones para http
import requests
## Biblioteca de funciones para el uso de la Raspberry
import math     #Para la funcion pow en el tratamiento de datos
import time     #Para la funcion sleep()
import busio    #protocolo I2C
import board    #uso de los pines de la raspberry
import digitalio
##------------------------pines actuadores------------------------------------#
Encendido = True
Apagado = False

ledR3 = digitalio.DigitalInOut(board.D17)
ledR3.direction = digitalio.Direction.OUTPUT
ledV3 = digitalio.DigitalInOut(board.D27)
ledV3.direction = digitalio.Direction.OUTPUT

ledR5 = digitalio.DigitalInOut(board.D22)
ledR5.direction = digitalio.Direction.OUTPUT
ledV5 = digitalio.DigitalInOut(board.D10)
ledV5.direction = digitalio.Direction.OUTPUT

ledR7 = digitalio.DigitalInOut(board.D9)
ledR7.direction = digitalio.Direction.OUTPUT
ledV7 = digitalio.DigitalInOut(board.D11)
ledV7.direction = digitalio.Direction.OUTPUT

Buzz = digitalio.DigitalInOut(board.D5)
Buzz.direction = digitalio.Direction.OUTPUT

## Blioteca de funciones respectivas al ADC
import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn

#--------------------I2C--------------------------------------------------------#
## Activar los pines respectivos de la Raspeberry(SDA, SCL) para el protocolo I2C.
i2c = busio.I2C(board.SCL, board.SDA)

## Configuracion de la direccion I2C del conversor.
ads = ADS.ADS1115(address=0x49,i2c=i2c)

## Ganancia del amplificador digital del conversor ADC
ads.gain = 1

#-----------------------------------------MQTT--------------------------------------------------------#
#ID del canal en Thingspeak
ID = "1486425"                                   #ID respectivo al canal en thingspeak
apikey = "16OLSLDMQZEGMOYL"                      #Key para conectar con el canal de thingspeak
host = "mqtt.thingspeak.com"                     #Servidor donde se encuentra alojada la base de datos
transport_mqtt="tcp"                             #Protocolo de transporte
port_mqtt=1883                                   #Puerto de comunicacion de MQTT
topic = "channels/" + ID + "/publish/" + apikey  #Informacion con el canal ID su key publish

#----------------- constantes tratamiento de datos------------------#
##Valor de la resistencia para calibrar los sensores
RL_MQ2 = 50  #sensor MQ2
RL_MQ4 = 9000#sensor MQ4
RL_MQ7 = 300   #sensor MQ7
##constante del aire
Rair = 9.83
## Valores constantes de la regresion logaritmica 
Butanocurve = [ 2.3, 0.477, -0.372]    #sensor MQ2
Gasnatcurve = [ 2.3, 0.415, -0.335]    #sensor MQ4
Monoxidocurve = [1.699, 0.230, -0.671] #sensor MQ7
## Valores de ppm seguros
ButanoppmSafe=121
GasnatppmSafe=63
MonoxidoppmSafe=340
##excel
datos_excel= {}
while True:
    #Marca de tiempo
    ti = time.strftime("%H.%M.%S")
    #------------Estimacion de PPM a partir de una regresion logaritmica -----------#
    ## calculo de ppm para el sensor MQ2
    MQ_2 = AnalogIn(ads, ADS.P1)
    Ro_MQ2 = (MQ_2.value)/Rair
    Rs_MQ2 = (RL_MQ2*(32768 - MQ_2.value)) / (MQ_2.value)
    Butanoppm = math.pow(((math.log10(Rs_MQ2/Ro_MQ2))+(Butanocurve[1]/Butanocurve[2])),10)
    ## calculo de ppm para el sensor MQ4
    MQ_4 = AnalogIn(ads, ADS.P2)
    Ro_MQ4 = (MQ_4.value)/Rair
    Rs_MQ4 = (RL_MQ4*(32768 - (MQ_4.value))) / (MQ_4.value)
    Gasnatppm =math.pow((math.log10(Rs_MQ4/Ro_MQ4)+(Gasnatcurve[1]/Gasnatcurve[2])),10)
    ## calculo de ppm para el sensor MQ7
    MQ_7 = AnalogIn(ads, ADS.P3)
    Ro_MQ7 = (MQ_7.value)/Rair
    Rs_MQ7 = (RL_MQ7*(32768 - (MQ_7.value))) / (MQ_7.value)
    Monoxidoppm = math.pow((math.log10(Rs_MQ7/Ro_MQ7)+(Monoxidocurve[1]/Monoxidocurve[2])),10)
    
    #------------------------------------Visualizacion de datos---------------------------------#
    ## Impresion de los valores de ppm en consola
    print ("Metano=%.3f      Gasnat=%.3f     Monoxido=%.3f "%(Butanoppm, Gasnatppm, Monoxidoppm))
    #-----------------------------------Encendido de actuadores---------------------------------#
    ##butano
    if (Butanoppm > ButanoppmSafe):
        ledR3.value = Encendido
        ledV3.value = Apagado
    else:
        if (Butanoppm > (ButanoppmSafe/2) and Butanoppm < ButanoppmSafe) :
            ledR3.value = Encendido
            ledV3.value = Encendido
        else:
            if Butanoppm < (ButanoppmSafe/2):
                ledR3.value = Apagado
                ledV3.value = Encendido
            else:
                ledR3.value = Apagado
                ledV3.value = Apagado
    ##Monoxido
    if (Monoxidoppm > MonoxidoppmSafe):
        ledR7.value = Encendido
        ledV7.value = Apagado
    else:
        if (Monoxidoppm > (MonoxidoppmSafe/2) and Monoxidoppm < MonoxidoppmSafe) :
            ledR7.value = Encendido
            ledV7.value = Encendido
        else:
            if Monoxidoppm < (MonoxidoppmSafe/2):
                ledR7.value = Apagado
                ledV7.value = Encendido
            else:
                ledR7.value = Apagado
                ledV7.value = Apagado

    ##Gas natural
    if (Gasnatppm > GasnatppmSafe):
        ledR5.value = Encendido
        ledV5.value = Apagado
    else:
        if (Gasnatppm> (GasnatppmSafe/2) and Gasnatppm < GasnatppmSafe) :
            ledR5.value = Encendido
            ledV5.value = Encendido
        else:
            if Gasnatppm < (GasnatppmSafe/2):
                ledR5.value = Apagado
                ledV5.value = Encendido
            else:
                ledR5.value = Apagado
                ledV5.value = Apagado

      
    if (Butanoppm > ButanoppmSafe) or (Monoxidoppm > MonoxidoppmSafe) or (Gasnatppm > GasnatppmSafe) :
        Buzz.value = Encendido
    else:
        Buzz.value = Apagado              
               
    #------------------------------------------------MQTT---------------------------------------#
    ## Envio de datos al servidor ThingSpeak MQTT
    publish_mqtt = "field1="+str(Butanoppm)+"&field2="+str(Gasnatppm)+"&field3="+str(Monoxidoppm)
    publish.single(topic,payload=publish_mqtt,hostname=host,port=port_mqtt,tls=None,transport=transport_mqtt)
    
    #DICCIONARIO
    datos_excel["Metano"]= round(float(Butanoppm),3)
    datos_excel["GasNatural"]= round(float(Gasnatppm),3)
    datos_excel["Monoxido"]= round(float(Monoxidoppm),3)
    datos_excel["Hora"]= ti
    
    #Envio de datos a la hoja de excel
    re=requests.post("https://hook.integromat.com/hpvkma21528iav236xu6fbwn2jczhxpz", json = datos_excel)
        
    ## Tiempo de espera de 5 segundos
    time.sleep(1)
