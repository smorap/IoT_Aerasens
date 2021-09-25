import math
import time
import board
import busio
import requests 

## Activar los pines respectivos de la Raspeberry(SDA, SCL) para el protocolo I2C.
i2c = busio.I2C(board.SCL, board.SDA)

## Blioteca de funciones respectivas al ADC
import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn

##Valor de la resistencia para calibrar los sensores
RL_MQ2 = 180
RL_MQ4 = 1000
RL_MQ7 = 20
## voltaje de entrada
Vin = 5
##constante del aire
Rair = 9.83
## Valores constantes de la regresión logaritmica 
CH4curve = [ 2.3, 0.477, -0.372] 
Gasnatcurve = [ 2.3, 0.415, -0.335]
Monoxidocurve = [1.699, 0.230, -0.671]

while True:
    ## Configuracion de la dirección I2C del conversor.
    ads = ADS.ADS1115(address=0x4b,i2c=i2c)
    ## Ganancia del amplificador digital del conversor ADC
    ads.gain = 1
    
    ## calculo de ppm para el sensor MQ2
    MQ_2 = AnalogIn(ads, ADS.P1)
    Ro_MQ2 = (MQ_2.value)/Rair
    Rs_MQ2 = (RL_MQ2*(32768 - MQ_2.value)) / (MQ_2.value)
    CH4ppm = math.pow(((math.log10(Rs_MQ2/Ro_MQ2))+(CH4curve[1]/CH4curve[2])),10)
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
    ## Impresion de los valores de ppm en consola
    print ("CH4=%.3f      Gasnat=%.3f     Monoxido=%.3f "%(CH4ppm, Gasnatppm, Monoxidoppm))
    ## Envio de datos al servidor ThingSpeak
    Packg = requests.get("https://api.thingspeak.com/update?api_key=16OLSLDMQZEGMOYL&field1="+str(CH4ppm)+"&field2="+str(Gasnatppm)+"&field3="+str(Monoxidoppm))
    Packg = requests.get("https://api.thingspeak.com/update?api_key=91586M7UYWNH6ZW5&field1="+str(CH4ppm)+"&field2="+str(Gasnatppm)+"&field3="+str(Monoxidoppm))
    ## Tiempo de espera de 0,5 segundos
    time.sleep(0.5)
