import math
import time
import board
import busio

i2c = busio.I2C(board.SCL, board.SDA)

import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn


MQ2_m=-0.410
MQ2_b=1.485

MQ4_m=-1.045
MQ4_b=2.6

MQ7_m=-0.652
MQ7_b=1.303


while True:
    ads = ADS.ADS1115(address=0x4b,i2c=i2c)
    ads.gain = 1
    
    MQ_2 = AnalogIn(ads, ADS.P1)
    Rs_2=(((5*1)/(MQ_2.voltage))-1)
    Ro_2=Rs_2/1.8
    Ratio_2=(math.log10(Rs_2/Ro_2)-MQ2_b)/MQ2_m
    MetanoPPM=(math.pow(Ratio_2,10));
    Per_metano=MetanoPPM/10000

    print( "Metano %")
    print(Per_metano)

    MQ_4 = AnalogIn(ads, ADS.P2)
    Rs_4=(((5*1)/(MQ_4.voltage))-1)
    Ro_4=Rs_4/1.8
    Ratio_4=(math.log10(Rs_4/Ro_4)-MQ4_b)/MQ4_m
    MQ4PPM=(math.pow(Ratio_4,10));
    Per_MQ4=MQ4PPM/10000
    
    print( "MQ4%")
    print(Per_MQ4)
    
    MQ_7 = AnalogIn(ads, ADS.P3)
    Rs_7=(((5*1)/(MQ_7.voltage))-1)
    Ro_7=Rs_7/1.8
    Ratio_7=(math.log10(Rs_7/Ro_7)-MQ7_b)/MQ7_m
    MQ7PPM=(math.pow(Ratio_7,10));
    Per_MQ7=MQ7PPM/10000
    
    print( "MQ7")
    print(Per_MQ7)
    


    time.sleep(0.5)