#-----------------Bliotecas de funcionesutilizadas-------------#
## Biblioteca de funciones para MQTT
import paho.mqtt.client as mqtt
import paho.mqtt.publish as publish

## Biblioteca de funciones para el uso de la Raspberry
import math     #Para la función pow en el tratamiento de datos
import time     #Para la funcion sleep()
import busio    #protocolo I2C
import board    #uso de los pines SDA CLA de la raspberry

## Blioteca de funciones respectivas al ADC
import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn

#--------------------I2C--------------------------------------------------------#
## Activar los pines respectivos de la Raspeberry(SDA, SCL) para el protocolo I2C.
i2c = busio.I2C(board.SCL, board.SDA)

## Configuracion de la dirección I2C del conversor.
ads = ADS.ADS1115(address=0x4b,i2c=i2c)

## Ganancia del amplificador digital del conversor ADC
ads.gain = 1

#-----------------------------------------MQTT--------------------------------------------------------#
#ID del canal en Thingspeak
ID = "1486425"                                   #ID respectivo al canal en thingspeak
# 1512123 1486425
apikey = "16OLSLDMQZEGMOYL"                      #Key para conectar con el canal de thingspeak
# 16OLSLDMQZEGMOYL  91586M7UYWNH6ZW5
host = "mqtt.thingspeak.com"                     #Servidor donde se encuentra alojada la base de datos
transport_mqtt="tcp"                             #Protocolo de transporte
port_mqtt=1883                                   #Puerto de comunicacion de MQTT
topic = "channels/" + ID + "/publish/" + apikey  #Informacion con el canal ID su key publish

#----------------- constantes tratamiento de datos------------------#
##Valor de la resistencia para calibrar los sensores
RL_MQ2 = 180  #sensor MQ2
RL_MQ4 = 1000 #sensor MQ4
RL_MQ7 = 30   #sensor MQ7
##constante del aire
Rair = 9.83
## Valores constantes de la regresión logaritmica 
Butanocurve = [ 2.3, 0.477, -0.372]    #sensor MQ2
Gasnatcurve = [ 2.3, 0.415, -0.335]    #sensor MQ4
Monoxidocurve = [1.699, 0.230, -0.671] #sensor MQ7


while True:
    #------------Estimacion de PPM a partir de una regresion logarítmica -----------#
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
    print ("Butano=%.3f      Gasnat=%.3f     Monoxido=%.3f "%(Butanoppm, Gasnatppm, Monoxidoppm))
    
    #------------------------------------------------MQTT---------------------------------------#
    ## Envio de datos al servidor ThingSpeak MQTT
    publish_mqtt = "field1="+str(Butanoppm)+"&field2="+str(Gasnatppm)+"&field3="+str(Monoxidoppm)
    publish.single(topic,payload=publish_mqtt,hostname=host,port=port_mqtt,tls=None,transport=transport_mqtt)
    
    ## Tiempo de espera de 0,5 segundos
    time.sleep(0.5)
