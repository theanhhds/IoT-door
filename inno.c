// This #include statement was automatically added by the Particle IDE.
#include "RFID.h"


#define SS_PIN      A2      // Same pin used as hardware SPI (SS)
#define RST_PIN     D2

/* Define the pins used for the DATA OUT (MOSI), DATA IN (MISO) and CLOCK (SCK) pins for SOFTWARE SPI ONLY */
/* Change as required and may be same as hardware SPI as listed in comments */
#define MOSI_PIN    D3      // hardware SPI: A5
#define MISO_PIN    D4      //     "     " : A4
#define SCK_PIN     D5      //     "     " : A3

/* Create an instance of the RFID library */
#if defined(_USE_SOFT_SPI_)
    RFID RC522(SS_PIN, RST_PIN, MOSI_PIN, MISO_PIN, SCK_PIN);    // Software SPI
#else
    RFID RC522(SS_PIN, RST_PIN);                                 // Hardware SPI
#endif

int door = D0;
int led = D7;
int flag = 0;
Servo myservo;

void setup()
{
    
  Serial.begin(9600);
  
#if !defined(_USE_SOFT_SPI_)
  /* Enable the HW SPI interface */
  SPI.setDataMode(SPI_MODE0);
  SPI.setBitOrder(MSBFIRST);
  SPI.setClockDivider(SPI_CLOCK_DIV8);
  SPI.begin();
#endif

  /* Initialise the RFID reader */
    RC522.init();
    pinMode(led, OUTPUT);
    Particle.function("open",toggle);
    digitalWrite(led, LOW);
    myservo.attach(door);
    myservo.write(0);
    Serial.begin(9600);
}

void loop()
{
  /* Temporary loop counter */
  uint8_t i,index=0;
  char *id, *tmp;
  String content= "";
  /* Has a card been detected? */
  if (RC522.isCard())
  {
    /* If so then get its serial number */
    RC522.readCardSerial();

    Serial.println("Card detected:");

    /* Output the serial number to the UART */
    for(i = 0; i <= 4; i++)
    {
        content+=String(RC522.serNum[i] < 0x10 ? "0" : "");
        content+=String(RC522.serNum[i],HEX);
    }
  }
    if (content == "e04a301b81")
        {
            openDoor();
            Serial.println("Ovi avaa");
        }
    //delay(500);
}

int toggle(String command) {
    if (flag == 0)
    {
        flag=1;
        openDoor();
        flag=0;
        return 1;
    }
    else return 0;
}

int openDoor(void)
{
    digitalWrite(led, HIGH);
    myservo.write(90);
    delay(2000);
    digitalWrite(led, LOW);
    myservo.write(0);
    return 1;
}
