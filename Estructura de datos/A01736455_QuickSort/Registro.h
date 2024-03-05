#include <iostream>
#include <string>
using namespace std;

// Declaración de la clase
class Registro {
// Atributos
private:
  string value;
  string month;
  int day;
  int hour;
  int minute;
  int second;
  int red;
  int subred;
  int domain;
  int device;
  int port;
  string text;

public:
//Constructores
  Registro();
  Registro(string value, string month, int day, int hour, int minute,
           int second, int red, int subred, int domain, int device, int port,string text);
//Metodos
  int Digitomonth();
  int Day();
  int Hour();
  int Minute();
  int Second();
  int Red();
  int Subred();
  int Domain();
  int Device();
  int Port();
  string Text();
  long long int Tiempo();
  string Value();
  string fullRed();
  string Host();
  string Restante();
  string Ip();
};

// Constructor vacio
Registro::Registro() {
  month = "NA";
  day = 0;
  hour = 0;
  minute = 0;
  second = 0;
  red = 0;
  subred = 0;
  domain = 0;
  device = 0;
  port = 0;
  text = "NA";
}

// Constructor donde se asignaran los valuees del mensaje a cada variable
Registro::Registro(string value, string month, int day, int hour, int minute,
                   int second, int red, int subred, int domain, int device,
                   int port, string text) {
  this->value = value;
  this->month = month;
  this->day = day;
  this->hour = hour;
  this->minute = minute;
  this->second = second;
  this->red = red;
  this->subred = subred;
  this->domain = domain;
  this->device = device;
  this->port = port;
  this->text = text;
}

// Conversion de los meses de string a un valor numerico
int Registro::Digitomonth() {
  if (month == "Jan") {
    return 1;
  } else if (month == "Feb") {
    return 2;
  } else if (month == "Mar") {
    return 3;
  } else if (month == "Abr") {
    return 4;
  } else if (month == "May") {
    return 5;
  } else if (month == "Jun") {
    return 6;
  } else if (month == "Jul") {
    return 7;
  } else if (month == "Aug") {
    return 8;
  } else if (month == "Sep") {
    return 9;
  } else if (month == "Oct") {
    return 10;
  } else if (month == "Nov") {
    return 11;
  } else if (month == "Dec") {
    return 12;
  } else {
    return 0;
  }
}

// Sobrecarga del operador == 
bool operator==(Registro dato1, Registro dato2) {
  if (dato1.Red() == dato2.Red() && dato1.Subred() == dato2.Subred() &&
      dato1.Domain() == dato2.Domain() && dato1.Device() == dato2.Device() &&
      dato1.Port() == dato2.Port() &&
      dato1.Digitomonth() == dato2.Digitomonth() &&
      dato1.Hour() == dato2.Hour() && dato1.Minute() == dato2.Minute() &&
      dato1.Second() == dato2.Second() && dato1.Text() == dato2.Text()) {
    return true;
  }
  return false;
}

// Sobrecarga de Operador <
bool operator<(Registro dato1, Registro dato2) {
  if (dato1.Red() < dato2.Red())
    return true;
  else if (dato1.Red() == dato2.Red()) {
    if (dato1.Subred() < dato2.Subred())
      return true;
    else if (dato1.Subred() == dato2.Subred()) {
      if (dato1.Domain() < dato2.Domain())
        return true;
      else if (dato1.Domain() == dato2.Domain()) {
        if (dato1.Device() < dato2.Device())
          return true;
        else if (dato1.Device() == dato2.Device()) {
          if (dato1.Port() < dato2.Port())
            return true;
          else if (dato1.Port() == dato2.Port()) {
            if (dato1.Digitomonth() < dato2.Digitomonth())
              return true;
            else if (dato1.Digitomonth() == dato2.Digitomonth()) {
              if (dato1.Day() < dato2.Day())
                return true;
              else if (dato1.Day() == dato2.Day()) {
                if (dato1.Hour() < dato2.Hour())
                  return true;
                else if (dato1.Hour() == dato2.Hour()) {
                  if (dato1.Minute() < dato2.Minute())
                    return true;
                  else if (dato1.Minute() == dato2.Minute()) {
                    if (dato1.Second() < dato2.Second())
                      return true;
                    else if (dato1.Second() == dato2.Second()) {
                      if (dato1.Text() < dato2.Text())
                        return true;
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  return false;
}

// getters de cada dato de las lineas leidas. 
int Registro::Day() { return day; }

int Registro::Hour() { return hour; }

int Registro::Minute() { return minute; }

int Registro::Second() { return second; }

int Registro::Red() { return red; }

int Registro::Subred() { return subred; }

int Registro::Domain() { return domain; }

int Registro::Device() { return device; }

int Registro::Port() { return port; }

string Registro::Text() { return text; }

string Registro::Value() { return value; }

string Registro::fullRed() {
  string fullRed = to_string(red) + "." + to_string(subred);
  return fullRed;
}
string Registro::Host() {
  string host = to_string(domain) + "." + to_string(device);

  return host;
}

string Registro::Restante() {
  string restante = to_string(port) + " " + month + " " + to_string(day) + " " +
                    to_string(hour) + ":" + to_string(minute) + ":" +
                    to_string(second) + " " + text;
  return restante;
}

// Union de IP 
string Registro::Ip() {
  string host = to_string(domain) + "." + to_string(device);
  string fullRed = to_string(red) + "." + to_string(subred);
  string ip = fullRed + "." + host;
  return ip;
}
