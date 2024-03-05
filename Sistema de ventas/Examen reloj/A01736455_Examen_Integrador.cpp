//Programa en C++ que incluye una clase
   
#include <iostream>  
using namespace std; 

void saludar(int x, int y);//Esta declaración de función sólo la puse para compararla con la declaración 
		//de los métodos de la clase que no contienen las variables de los parámetros sino sólo su tipo (ver abajo)

class clockType
{
public:
    void setTime(int, int, int);//A diferencia de las funciones, en la declaración de los métodos no se incluyen las variables de los parámetros sino solamente su tipo.
    void getTime(int&, int&, int&) const; // int& básicamente referencia el espacio de memoria de una variable entera (vás abajo lo comento)
    void printTime() const;//const hace que este método no pueda ser modificado 
    void decrementSeconds();//Para decrementar en 1 la cantidad de segundos.
    void decrementMinutes(); // Para decrementar en 1 la cantidad de minutos.
    void decrementHours(); // Para decrementar en 1 la cantidad de horas.
    void resetandseeTime(); // Para poner la hora en 00:00:00 e imprimirla inmediatamente.

private:
    int hr; //los atributos privados o variables de la clase, son globales dentro de los métodos de la clase en cada objeto creado
    int min;
    int sec;

}; 

int main()                                             //Line 1
{                                                      //Line 2
    clockType myClock;                                 //Line 3 Creando un objeto myClock
    clockType yourClock;                               //Line 4 Creando un objeto yourClock

    int hours;                                         //Line 5 Estas tres variables se usan en main()
    int minutes;                                       //Line 6
    int seconds;                                       //Line 7

        //Set the time of myClock
    myClock.setTime(5, 4, 30);                         //Line 8 en el objeto myClock llamamos el método para fijar hora, minutos, segundos
							//El usar el método myClock.setTime(5,4,30); no despliega nada sólo
							//hace que los atributos locales sean hr=5 min=4 sec=30 dentro del objeto myClock

    cout << "Line 9: myClock: ";                       //Line 9
    myClock.printTime();  //print the time of myClock    Line 10 Aquí sí se imprime el tiempo anteriormente definido para myClock con este método
    cout << endl;                                     //Line 11

    cout << "Line 12: yourClock: ";                    //Line 12
    yourClock.printTime(); 				//Line 13 usamos el método yourClock.printTime() sinhaber fijado el tiempo del objeto yourClock con el método yourClock.setTime 
							//y obviamente se despliega basura (el contenido del espacio de la memoria para las variables
							// hr min y sec para el objeto yourClock o sea "basura")
    cout << endl;                                      //Line 14

        //Set the time of yourClock
    yourClock.setTime(5, 45, 16);                      //Line 15 Aquí finalmente inicializamos el tiempo en yourClock

    cout << "Line 16: After setting, yourClock: ";     //Line 16
    yourClock.printTime(); //print the time of yourClock Line 17 Y obtenemos el tiempo fijado arriba 05:45:16 (y ya no "basura")
    cout << endl;                                      //Line 18

                                      

    cout << "Line 19: Enter the hours, minutes, and "
         << "seconds: ";                               //Line 19
    cin >> hours >> minutes >> seconds;                //Line 20 Usamos estas variables que declaramos arriba aquí mismo en main()
    cout << endl;                                      //Line 21 para permitirle al usuario dar una hora que se inicializará abajo en el objeto myClock

    myClock.setTime(hours, minutes, seconds);          //Line 24 (aquí se cambiará hr min sec para el objeto myClock; ver en la programación del método cómo)

    cout << "Line 25: New time in myClock: ";           //Line 25
    myClock.printTime();   				//Line 26 Y vemos el tiempo para myClock cambiado por el usuario 
    cout << endl;                                      //Line 27

        //Decrement the time of myClock by one second
    myClock.decrementSeconds();                        //Line 28 Se decrementa en 1 segundo la variable sec del objeto myClock; no se despliega nada en pantalla.

    cout << "Line 29: After decrementing myClock by " 
         << "one second, myClock: ";                   //Line 29
    myClock.printTime();   				// Line 30 Aquí se despliega el tiempo de myClock y se observa que aumentó en 1 segundo
    cout << endl;                                      //Line 31

        
    myClock.getTime(hours, minutes, seconds);          //Line 34 Ojo con este método: parece que le pasamos valores pero sólo le pasamos las direcciones
							// de memoria de hours, minutes, seconds recordar: void getTime(int&, int&, int&) const;

        //Output the value of hours, minutes, and seconds
    cout << "Line 35: horas = " << hours 
         << ", minutos = " << minutes 
         << ", segundos = " << seconds << endl;         //Line 35 Aquí desplegamos los valores para myClock encontrados con: 
							//myClock.getTime(hours, minutes, seconds);  
    return 0;                                          //Line 36
}						      // Line 37 del main()

void saludar(int x, int y){//Función declarada arriba y desarrollada aquí sólo para ejemplificar
    cout<<"Hola";//la diferencia con un método que tiene un scope del tipo void clockType::setTime(int mishoras, int misminutos, int missegundos) 
}//La función saludar(int x, int y) no pertenece a la clase.

void clockType::setTime(int mishoras, int misminutos, int missegundos) //Scope clockType:: que indica que setTime pertenece a la clase clockType
{
    if (0 <= mishoras && mishoras < 24) //Rango entre 0 y 23
        hr = mishoras;//si se cumple ese rango se deja el número
    else 
        hr = 0;// si no, se hace que hr=0

    if (0 <= misminutos && misminutos < 60)//Rango entre 0 y 59
        min = misminutos;//si se cumple ese rango se deja el número
    else 
        min = 0;// si no, se hace que min=0

    if (0 <= missegundos && missegundos < 60)//Rango entre 0 y 59
        sec = missegundos;//si se cumple ese rango se deja el número 
    else 
        sec = 0;// si no, se hace que sec=0
}

void clockType::getTime(int& otrashoras, int& otrosminutos, 
                        int& otrossegundos) const //En main estaba myClock.getTime(hours, minutes, seconds); 
{
    otrashoras = hr;//Le damos el valor de hr a la varible otrashoras pero escribimos ese valor directamente en la dirección de memoria de otrashoras int& otrashoras
    otrosminutos = min;//idem para otrosminutos
    otrossegundos = sec;//idem para otrossegundos
}//a su vez, en main() este espacio de memoria es el de hours, min, sec respectivamente

void clockType::decrementHours()
{
    hr = hr - 1;//se decrementran las horas en 1

    if (hr < 0) //si al decrementarse hr=24 entonces se hace que hr=0
        hr = 23;
        decrementHours();
}

void clockType::decrementMinutes()
{
    min = min - 1;//se decrementan los minutos en 1

    if (min < 0)//si al decrementarse min= -1 entonces se hace que min=59 y se llama el método decrementHours() para restar runa hora hr
    {
        min = 59;
        decrementHours(); //decrement hours
    }
}

void clockType::decrementSeconds()
{
    sec = sec - 1;//se decrementan los segundos en 1

    if (sec < 0)//si al decrementar sec= -1 entonces se hace que sec=0 y se llama el método decrementMinutes() para restar un minuto min
    {
        sec = 59;
        decrementMinutes(); //decrement minutes
    }
}
//Usar setTime para poner 23:59:59 y luego decrementSeconds para ver qué pasa

void clockType::printTime() const
{
    if (hr < 10)
        cout << "0";// pone un cero cuando es un número de un dígito; por ejemplo, no quiero 5 sino 05
    cout << hr << ":";//si es de dos dígitos se imprime directamente, sin anteponer un cero

    if (min < 10) //idem
        cout << "0";
    cout << min << ":";

    if (sec < 10)//idem
        cout << "0";
    cout << sec;
}