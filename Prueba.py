import math
import time
import board

#libreria para usar protocolos de comunicación
import busio

#Declaracio del protocolo I2C y los pines respectivos de la Raspeberry
i2c = busio.I2C(board.SCL, board.SDA)

#libreria para usar el ADC
import adafruit_ads1x15.ads1115 as ADS

#Funcion de lectura análoga del ADC
from adafruit_ads1x15.analog_in import AnalogIn

#Pendiente m y corrimiento b para la regresión logaritmica del MQ2
MQ2_m=-0.410
MQ2_b=1.485
#Pendiente m y corrimiento b para la regresión logaritmica del MQ4
MQ4_m=-1.045
MQ4_b=2.6
#Pendiente m y corrimiento b para la regresión logaritmica del MQ7
MQ7_m=-0.652
MQ7_b=1.303


while True:
    #Configutacion ADC
    ads = ADS.ADS1115(address=0x4b,i2c=i2c)         #Declaracion del ADC con su respectiva dirección para I2C
    ads.gain = 1                                    #Ganancia del amplificador interno del ADC
    
    #Lectura MQ2
    MQ_2 = AnalogIn(ads, ADS.P1)                    #lectura 1er canal del ADC
    Rs_2=(((5*1)/(MQ_2.voltage))-1)                 #Cálculo de Rs
    Ro_2=Rs_2/1.8                                   #Cálculo de Ro
    Ratio_2=(math.log10(Rs_2/Ro_2)-MQ2_b)/MQ2_m
    MetanoPPM=(math.pow(Ratio_2,10));               #PPM
    Per_metano=MetanoPPM/10000

    print( "Metano %")                              #Mostrar resultado
    print(Per_metano)
    
    #Lectura MQ4
    MQ_4 = AnalogIn(ads, ADS.P2)                    #lectura 2do canal del ADC
    Rs_4=(((5*1)/(MQ_4.voltage))-1)                 #Cálculo de Rs
    Ro_4=Rs_4/1.8                                   #Cálculo de Ro
    Ratio_4=(math.log10(Rs_4/Ro_4)-MQ4_b)/MQ4_m
    MQ4PPM=(math.pow(Ratio_4,10));                  #PPM
    Per_MQ4=MQ4PPM/10000
    
    print( "MQ4%")                                  #Mostrar resultado
    print(Per_MQ4)
    
    #Lectura MQ7
    MQ_7 = AnalogIn(ads, ADS.P3)                    #lectura 3er canal del ADC
    Rs_7=(((5*1)/(MQ_7.voltage))-1)                 #Cálculo de Rs
    Ro_7=Rs_7/1.8                                   #Cálculo de Ro
    Ratio_7=(math.log10(Rs_7/Ro_7)-MQ7_b)/MQ7_m
    MQ7PPM=(math.pow(Ratio_7,10));                  #PPM         
    Per_MQ7=MQ7PPM/10000
    
    print( "MQ7")                                   #Mostrar resultado
    print(Per_MQ7)
    


    time.sleep(0.5)                                 #Espera 0.5 segundos
