#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Servo.h>
Servo myservo;

constexpr uint8_t RST_PIN = D3;
constexpr uint8_t SS_PIN = D4;

byte readCard[4];
String MasterTag = "B63E29BC"; //alfi
String MasterTag2 = "2391CD95"; //ibnu
String MasterTag3 = "868157BD"; //adel
String MasterTag4 = "B6F058BD"; //ariq

String tagID = "";
int buzzer = D8;
int a = D0;

const char* ssid = "Error";
const char* pass = "error404";
const uint16_t port = 80;
const char* host = "192.168.172.32";

String BASE_URL = "http://" + String(host) + "/nodemcu/public/rfid/tambah";

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup() {
  Serial.begin(115200);
  Serial.print(F("Smart School test!"));
  WiFi.begin(ssid, pass);
  while (!Serial);
  SPI.begin();
  mfrc522.PCD_Init();
  lcd.init();
  lcd.backlight();
  lcd.clear();
  pinMode(buzzer, OUTPUT);
  myservo.attach(a);
  myservo.write(LOW);
}

void loop() {
  WiFiClient client;
  HTTPClient http;

  if(!client.connect(host, port)){
    Serial.println("Connection to server FAILED !");
    Serial.println(client.connect(host, port));
    delay(1000);
  }
  
  lcd.clear();
  String text1 = "-- LAB --";
  int text1tengah = text1.length();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(text1);
  String text2 = "Sekolah";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);
  delay(1000);

  while(getUID())
  {
    if ( tagID == MasterTag ){
      Serial.print("tag ID :");
      Serial.println(tagID);
      Serial.println("Terdaftar");
      rfid1();
      delay(1000);
    }
    else if ( tagID == MasterTag2 ){
      Serial.print("tag ID :");
      Serial.println(tagID);
      Serial.println("Terdaftar");
      rfid2();
      delay(1000);
    }
    else if ( tagID == MasterTag3 ){
      Serial.print("tag ID :");
      Serial.println(tagID);
      Serial.println("Terdaftar");
      rfid3();
      delay(1000);
    }
    else if ( tagID == MasterTag4 ){
      Serial.print("tag ID :");
      Serial.println(tagID);
      Serial.println("Terdaftar");
      rfid4();
      delay(1000);
    }
    else{
      Serial.print("tag ID :");
      Serial.println(tagID);
      Serial.println("Belum Terdaftar");
      belumterdaftar();
      delay(1000);
    }
    delay(1000);
  }
}

boolean getUID(){
  if(!mfrc522.PICC_IsNewCardPresent()){
    return false;
  }

  if(!mfrc522.PICC_ReadCardSerial()){
    return false;
  }

  tagID = "";
  for (uint8_t i = 0; i < 4; i++) {
    tagID.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  tagID.toUpperCase();
  mfrc522.PICC_HaltA();
  return true;
}

void rfid1(){
  WiFiClient client;
  HTTPClient http;
  String url;

  digitalWrite(buzzer, HIGH);
  delay(300);
  digitalWrite(buzzer, LOW);

  String nim = "Alfi";
  String text1 = "1";
  int text1tengah = nim.length();
  lcd.clear();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(nim);
  String text2 = "Berhasil Presensi";
  String text22 = "1";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);

  myservo.write(180);
  delay(3000);
  myservo.write(LOW);

  url = BASE_URL + "/" + String(tagID) + "/" + String(nim) + "/" + String(text22);
  http.begin(client, url);
  int httpResponse = http.GET();
  Serial.println(url);
}

void rfid2(){
  WiFiClient client;
  HTTPClient http;
  String url;

  digitalWrite(buzzer, HIGH);
  delay(300);
  digitalWrite(buzzer, LOW);

  String nim = "Sirozudin";
  String text1 = "1";
  int text1tengah = nim.length();
  lcd.clear();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(nim);
  String text2 = "Berhasil Presensi";
  String text22 = "1";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);

  myservo.write(180);
  delay(3000);
  myservo.write(LOW);

  url = BASE_URL + "/" + String(tagID) + "/" + String(nim) + "/" + String(text22);
  http.begin(client, url);
  int httpResponse = http.GET();
  Serial.println(url);
}

void rfid3(){
  WiFiClient client;
  HTTPClient http;
  String url;

  digitalWrite(buzzer, HIGH);
  delay(300);
  digitalWrite(buzzer, LOW);

  String nim = "Adel";
  String text1 = "1";
  int text1tengah = nim.length();
  lcd.clear();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(nim);
  String text2 = "Berhasil Presensi";
  String text22 = "1";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);

  myservo.write(180);
  delay(3000);
  myservo.write(LOW);

  url = BASE_URL + "/" + String(tagID) + "/" + String(nim) + "/" + String(text22);
  http.begin(client, url);
  int httpResponse = http.GET();
  Serial.println(url);
}

void rfid4(){
  WiFiClient client;
  HTTPClient http;
  String url;

  digitalWrite(buzzer, HIGH);
  delay(300);
  digitalWrite(buzzer, LOW);

  String nim = "Ariq";
  String text1 = "1";
  int text1tengah = nim.length();
  lcd.clear();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(nim);
  String text2 = "Berhasil Presensi";
  String text22 = "1";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);

  myservo.write(180);
  delay(3000);
  myservo.write(LOW);

  url = BASE_URL + "/" + String(tagID) + "/" + String(nim) + "/" + String(text22);
  http.begin(client, url);
  int httpResponse = http.GET();
  Serial.println(url);
}

void belumterdaftar(){
  WiFiClient client;
  HTTPClient http;
  String url;

  digitalWrite(buzzer, HIGH);
  delay(200);
  digitalWrite(buzzer, LOW);
  delay(100);
  digitalWrite(buzzer, HIGH);
  delay(200);
  digitalWrite(buzzer, LOW);
  delay(100);
  digitalWrite(buzzer, HIGH);
  delay(200);
  digitalWrite(buzzer, LOW);
  
  String nim = "Tak Terdaftar";
  String text1 = "0";
  int text1tengah = nim.length();
  lcd.clear();
  lcd.setCursor((16 - text1tengah) / 2, 0);
  lcd.print(nim);
  String text2 = "Regist ke Admin";
  String text22 = "0";
  int text2tengah = text2.length();
  lcd.setCursor((16 - text2tengah) / 2, 1);
  lcd.print(text2);

  myservo.write(LOW);

  // url = BASE_URL + "/" + String(tagID) + "/" + String(text1) + "/" + String(text22);
  // http.begin(client, url);
  // int httpResponse = http.GET();
  // Serial.println(url);
}
