#ifndef datos_h
#define datos_h
#include <iostream>
#include <fstream>
#include <string>
using namespace std;

//Crea el archivo para guardar las fechas buscadas.
ofstream sorted("sorted.txt"); 
//Se crea la clase datos que nos permitira manejarlos
class Datos {
    private:
    string mesSTRING;
    string diaSTRING;
    string hrsSTRING;
    string minSTRING;
    string segSTRING;
    string dirrIP;
    string errorCASO;

    public:
    int getMesINT();
    int getDiaINT();
    int getHrsINT();
    int getMinINT();
    int getSegINT();
    string getDirrIP();
    string getErrorCASO();
    string getMesSTRING();

    void setMes(string);
    void setDia(string);
    void setHrs(string);
    void setMin(string);
    void setSeg(string);
    void setDirrIP(string);
    void setErrorCASO(string);

    int convFECH(int, int, int, int, int);
    void imprimeFechasBuscadas();

    Datos(); //Constructos vacio
    Datos(string, string, string, string, string, string, string);

};
#endif