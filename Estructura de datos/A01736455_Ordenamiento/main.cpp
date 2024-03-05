#include <iostream>
#include <fstream>
#include <string>
#include <vector>
using namespace std; 

//.cpp datos
#include "Datos.h"
Datos:: Datos(){
    mesSTRING = "Sin datos";
    diaSTRING = "Sin datos disponibles";
    hrsSTRING = "Sin datos disponibles";
    minSTRING = "Sin datos disponibles";
    segSTRING = "Sin datos disponibles";
    dirrIP = "Sin datos disponibles";
    errorCASO = "Sin datos disponibles";
}
//Constructor que solicita los 7 valores indispensables de cada registro
Datos::Datos(string mS, string dS, string hS, string miS, string sS, string ipS, string eS) {
    mesSTRING = mS;
    diaSTRING = dS;
    hrsSTRING = hS;
    minSTRING = miS;
    segSTRING = sS;
    dirrIP = ipS;
    errorCASO = eS;
}
int Datos::getMesINT() {
  if (mesSTRING == "Jan") {
    return (1);
  }
  else if (mesSTRING == "Feb") {
    return (2);
  }
  else if (mesSTRING == "Mar") {
    return (3);
  }
  else if (mesSTRING == "Apr") {
    return (4);
  }
  else if (mesSTRING == "May") {
    return (5);
  }
  else if (mesSTRING == "Jun") {
    return (6);
  }
  else if (mesSTRING == "Jul") {
    return (7);
  }
  else if (mesSTRING == "Aug") {
    return (8);
  }
  else if (mesSTRING == "Sep") {
    return (9);
  }
  else if (mesSTRING == "Oct") {
    return (10);
  }
  else if (mesSTRING == "Nov") {
    return (11);
  }
  else if (mesSTRING == "Dec") {
    return (12);}
  else {
    return (0);}
}
//Convertimos los valores string a int para usarlos en el ordenamiento y busqueda
int Datos::getDiaINT() {
    return stoi(diaSTRING);
}

int Datos::getHrsINT() {
    return stof(hrsSTRING);
}

int Datos::getMinINT() {
    return stof(minSTRING);
}

int Datos::getSegINT() {
    return stof(segSTRING);
}

string Datos::getDirrIP() {
    return dirrIP;
}

string Datos::getErrorCASO() {
    return (errorCASO);
}

string Datos::getMesSTRING() {
    return (mesSTRING);
}

void Datos::setMes(string mS) {
    mesSTRING = mS;
}

void Datos::setDia(string dS) {
    diaSTRING = dS;
}

void Datos::setHrs(string hS) {
    hrsSTRING = hS;
}
void Datos::setMin(string miS) {
    minSTRING = miS;
}
void Datos::setSeg(string sS) {
    segSTRING = sS;
}
void Datos::setDirrIP(string ipS) {
    dirrIP = ipS;
}
void Datos::setErrorCASO(string eS) {
    errorCASO = eS;
}

int Datos::convFECH(int mS, int dS, int hS, int miS, int sS){
  if (mS==6) {
    int seg=(mS*60*60*24*30)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
    }
    else if (mS==1) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==2) {
    int seg=(mS*60*60*24*28)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==3) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==4) {
    int seg=(mS*60*60*24*30)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==5) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==6) {
    int seg=(mS*60*60*24*30)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==7) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==8) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
      
    else if (mS==8) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
      
    else if (mS==9) {
    int seg=(mS*60*60*24*30)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }

    else if (mS==10) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==11) {
    int seg=(mS*60*60*24*30)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
    else if (mS==12) {
    int seg=(mS*60*60*24*31)+(dS*60*60*24)+(hS*60*60)+(miS*60)+sS;
    return (seg);
      }
  else{
      return 0;
    }
}

void Datos::imprimeFechasBuscadas(){  //  Imprime las fechas buscadas y las guarda en el archivo creado
    string a = mesSTRING + " " + diaSTRING + " " + hrsSTRING + ":" + minSTRING + ":" + segSTRING + " " + dirrIP + " " + errorCASO;

  cout << a << endl << endl;

  sorted << a << endl;
}
//Fin del .cpp

//main
int main() {
  
  cout << "ORDENAMIENTO y BÚSQUEDA";

  cout << "Act 1.3 - Actividad Integral de Conceptos Básicos y Algoritmos Fundamentales"<<"\n"<<"\n";

  //Creación del vector donde se introducirán más adelante las líneas de texto del archivo anexado, señalando que tiene 145 objetos 7*20=140 16807
  int A=(16807*7)+5;
  Datos * vectorFECHAS[A];
  
  string mS, dS, hS, miS, sS, ipS, eS;

  //Declaración del contador "i" con un valor inicial nulo
  int i= 0;
  //Solicitamos los datos del txt
  ifstream filetxtFECH("bitacora.txt");
  //solicitamos los valores como strings y les asignamos una variable
  while (getline (filetxtFECH, mS, ' ')) {
     getline (filetxtFECH, dS, ' ');
     getline (filetxtFECH, hS, ':');
     getline (filetxtFECH, miS, ':');
     getline (filetxtFECH, sS, ' ');
     getline (filetxtFECH, ipS, ' ');
     getline (filetxtFECH, eS);
    
     vectorFECHAS[i] = new Datos(mS, dS, hS, miS, sS, ipS, eS);

     i=i + 1;
    }
  
  filetxtFECH.close();

    bool interruptor = true;
  
  for (int i = 0; i < 16807 - 1 && interruptor; i++) {
    interruptor = false;
    for (int j = 0; j < 16807 - 1 - i; j++) {
        if (vectorFECHAS[j + 1] -> convFECH(vectorFECHAS[j + 1] -> getMesINT(),vectorFECHAS[j + 1] -> getDiaINT(), vectorFECHAS[j + 1] -> getHrsINT(), vectorFECHAS[j + 1] -> getMinINT(),vectorFECHAS[j + 1] -> getSegINT()) > vectorFECHAS[j] -> convFECH(vectorFECHAS[j] -> getMesINT(),vectorFECHAS[j] -> getDiaINT(), vectorFECHAS[j] -> getHrsINT(), vectorFECHAS[j] -> getMinINT(),vectorFECHAS[j] -> getSegINT())) {
          
          string mes1 = vectorFECHAS[j] -> getMesSTRING();
          string dia1 = to_string(vectorFECHAS[j] -> getDiaINT());
          string hora1 = to_string(vectorFECHAS[j] -> getHrsINT());
          string minu1 = to_string(vectorFECHAS[j] -> getMinINT());
          string segu1 = to_string(vectorFECHAS[j] -> getSegINT());
          string dirrIP1 = vectorFECHAS[j] -> getDirrIP();
          string errorCASO1 = vectorFECHAS[j] -> getErrorCASO();

          string mes2 = vectorFECHAS[j + 1] -> getMesSTRING();
          string dia2 = to_string(vectorFECHAS[j + 1] -> getDiaINT());
          string hora2 = to_string(vectorFECHAS[j + 1] -> getHrsINT());
          string minu2 = to_string(vectorFECHAS[j + 1] -> getMinINT());
          string segu2 = to_string(vectorFECHAS[j + 1] -> getSegINT());
          string dirrIP2 = vectorFECHAS[j + 1] -> getDirrIP();
          string errorCASO2 = vectorFECHAS[j + 1] -> getErrorCASO();

          vectorFECHAS[j] -> setMes(mes2);
          vectorFECHAS[j] -> setDia(dia2);
          vectorFECHAS[j] -> setHrs(hora2);
          vectorFECHAS[j] -> setMin(minu2);
          vectorFECHAS[j] -> setSeg(segu2);
          vectorFECHAS[j] -> setDirrIP(dirrIP2);
          vectorFECHAS[j] -> setErrorCASO(errorCASO2);

          vectorFECHAS[j + 1] -> setMes(mes1);
          vectorFECHAS[j + 1] -> setDia(dia1);
          vectorFECHAS[j + 1] -> setHrs(hora1);
          vectorFECHAS[j + 1] -> setMin(minu1);
          vectorFECHAS[j + 1] -> setSeg(segu1);
          vectorFECHAS[j + 1] -> setDirrIP(dirrIP1);
          vectorFECHAS[j + 1] -> setErrorCASO(errorCASO1);

          interruptor = true;
        }
    }
  }
//BUSQUEDA
  int mesINB;
  int diaINB;
  int mesFIB;
  int diaFIB;

  //Impresión del texto que aparece antes de los resultados
  
  cout << "Ordenamiento Terminado..."<<"\n";
  cout << "INICIALIZANDO BÚSQUEDA"<<"\n";

  //Solicitud al usuario de las fechas limite del rango de busqueda. 
  cout << "Ingrese el mes de inicio de búsqueda: ";
  cin >> mesINB;
  cout << "Ingrese el dia de inicio de busqueda: ";
  cin >> diaINB;
  cout <<"\n"<<"\n";
  cout << "Ingrese el mes de fin de busqueda: ";
  cin >> mesFIB;
  cout << "Ingrese el día de fin de busqueda: ";
  cin >> diaFIB;
  cout <<"\n";

  //Ciclo para la impresion de los registros despues de la Busqueda
  
  for (int i=0; i<16807; i++){ 
    if(((vectorFECHAS[i] -> getMesINT()) >= mesINB)&&(((vectorFECHAS[i] -> getMesINT()) <= mesFIB))){
      if(((vectorFECHAS[i] -> getDiaINT()) >= diaINB)&&(((vectorFECHAS[i] -> getDiaINT()) <= diaFIB))){
        vectorFECHAS[i] -> imprimeFechasBuscadas();
      }
    }
  }
}