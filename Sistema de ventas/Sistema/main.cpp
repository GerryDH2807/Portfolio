#include <iostream>
#include <string>
#include <iomanip>
#include <fstream>
#include <cstdlib>
#include <list>
using namespace std;

class Negocio {
  private:
    string nombre;
    string tipo; //tipo de negocio Ej. (Bienes raíces, Restaurante Mexicano, Venta de Productos de Tamarindo, etc.)
    string ubicacion;

  public:

    void setNombre(string n) {
      nombre = n;
    }
    string getNombre() {
      return nombre;
    }

    void setTipo(string t) {
      tipo = t;
    }
    string getTipo() {
      return tipo;
    }

    void setUbicacion(string u) {
      ubicacion = u;
    }
    string getUbicacion() {
      return ubicacion;
    }
};


int main() {
  ofstream outFile;
	outFile.open("RegisterData.txt");

  char nombreDN[60];
  char tipoDN[80];
  char ubicacionDN[100];

  cout << "Te ofrecemos una cordial bienvenida al programa de Adaptación digital de Negocios, para comenzar, debes registrar los datos y productos de tu negocio." << endl;
  cout << "Nombre de Negocio: " << endl;
  cin.getline(nombreDN, 40);
  outFile << left << setw(24) << "Nombre del Negocio: " << "------   " << nombreDN << endl;

  cout << "Que tipo de Negocio es (Ej. Venta de productos de limpieza): " << endl;
  cin.getline(tipoDN, 60);
  outFile << left << setw(24) << "Tipo del Negocio: " << "------   " << tipoDN << endl;

  cout << "Ubicación del Negocio (En caso de tener multiples sucursales, favor de solo introducir la principal. En caso de ser negocio por internet escriba 'remoto'): " << endl;
  cin.getline(ubicacionDN, 80);
  outFile << left << setw(24) << "Ubicación del Negocio: " << " ------   " << ubicacionDN << endl << endl;

  Negocio negocio1;
  negocio1.setNombre(nombreDN);
  negocio1.setTipo(tipoDN);
  negocio1.setUbicacion(ubicacionDN);
  cout << "Perfecto! El negocio " << negocio1.getNombre() << " ha quedado registrado satisfactoriamente!" << endl << endl;

  cout << "Ahora es momento de agregar los productos o servicios de tu negocio. (En caso de que el nombre de algun producto o servicio tenga multiples palabras, escribelo con el metodo camelCase. Por ejemplo si tu producto es 'Hamburguesa con queso cheddar', escribe hamburguesaConQuesoCheddar)" << endl;

  string producto[20];
  int precio[20];
  int decision = 1; 
  int counter = 0;

  while (decision == 1) {
    cout << "Nombre de Producto " << counter + 1 << ": " << endl;
    cin >> producto[counter];
    cout << "Precio de Producto " << counter + 1 << ": " << endl;
    cin >> precio[counter];
    counter++;
    cout << "Deseas agregar otro producto? (0 para no, 1 para sí): " << endl;
    cin >> decision;
  }




  if (counter < 2){
    cout << "Enhorabuena! Se ha registrado " << counter << " producto con su respectivo precio";
  } else {
    cout << "Enhorabuena! Han quedado registrados " << counter << " productos con sus  respectivos precios." << endl;
  }
  cout << endl;

  decision = 1;
  while (decision != 0){
    for (int i = 0; i < counter; i++) {
      cout << i+1 << " " <<  left << setw(15) << producto[i] << "---  " << precio[i] << "$" << endl;
    }

    cout << "Asi han quedado registrados tus productos, selecciona una opcion: " << endl;

    cout << "0 - avanzar" << endl;
    cout << "1 - editar producto" << endl;
    cout << "2 - agregar producto" << endl;
    cout << "3 - eliminar producto" << endl;

    int numero;
    cin >> decision;

    if (decision == 0){
      outFile << left << "## ---- nombre de producto ---- precio" << endl;
      for(int j = 0; j < counter; j++ ){
        outFile << left << setw (2) << j + 1 <<" ---- ";
        outFile << left << setw (18) << producto[j] << " ---- ";
        outFile << left << setw(6) << precio[j] << "$" << endl;
      }
    } else if (decision == 1){
      cout << endl << "escribe el numero de producto que deseas editar: " << endl;
      cin >> numero;
      cout << endl << "Escribe el nombre del producto: ";
      cin >> producto[numero-1];
      cout << endl << "ahora escribe el precio del producto: " << endl;
      cin >> precio[numero-1];
    } else if (decision == 2){
      cout << endl << "escribe el nombre del producto nuevo : " << endl;
      cin >> producto[counter];
      cout << endl << "escribe su precio: " << endl;
      cin >> precio[counter];
      counter++;
    } else if (decision == 3){
      cout << "Escribe el numero de producto que deseas eliminar: " << endl;
      cin >> numero;

      for (int i = numero - 1; i <= counter ; i++ ){
        producto[i] = producto[i + 1];
        precio[i] = precio[i+1];
      }
      counter--;
    }
  }
  outFile.close();
  

  cout << endl << "ha concluido el proceso de registro de tu negocio, deseas consultar la información de tu negocio? (0 para no, 1 para si): " << endl ;

  ifstream inFile;
  inFile.open("RegisterData.txt");
  string myText;
  cin >> decision;
  cout << endl << endl;
  if (decision == 1){
    while (getline (inFile, myText)) {
      cout << myText << endl;
    }   
  }


  cout << endl << "Ya has dado el ultimo paso, ya has registrado tu negocio, de las ventas nos encargamos nosotros." << endl << endl << "Por ultimo, tenemos un servicio gratis en el que te recomendamos precios para productos, que tengan un balance entre costo bajo y alto para lograr la mayor ganancia posible";

    int apagador=0;

    cout << " "  << endl;
    cout << "Deseas calcular el precio de venta óptimo de algun producto?" << endl;
    cout << " " << endl;
    cout << "0. No" << endl;
    cout << "1. Si" << endl;
    cout << " " << endl;
    cout << "R: ";
    cin >> apagador; 

    if (apagador == 1 ){
        
        int index = 0;

        cout << " " << endl;
        cout << "Ingresa el numero del producto del cual deseas calcular su precio optimo: ";
        cout << " " << endl;
        cin >> index;

        if (apagador == 1){

            float utilidad;
            int costven;
            int resul;

            cout << " " << endl;
            cout << "Ingresa el porcentaje de utilidad de tu empresa por "<< producto[index+1] << " en decimales (Ej- '.40'): "<< endl;
            cout << " " << endl;
            cin >> utilidad;

            cout << " " << endl;
            cout << "Ingresa el costo de adquisisón o producción de " << producto[index] <<": "<< endl;
            cout << " " << endl;
            cin >> costven;

            resul = costven / (1-utilidad);

            if (resul > precio[0]){

                cout << " " << endl;
                cout << "Actualmente el producto " << producto[index] << " se esta vendiendo por " << precio[index] << ", nuestros analisis dicen que tu precio esta debajo del precio optimo, te recomendamos vender este producto por " << resul << "$" << endl;
                apagador+=1;

            }
            else{
                cout << " " << endl;
                cout << "Actualmente el producto " << producto[index] << " se esta vendiendo por " << precio[index] << ", nuestros analisis muestran que bajarle un poco el precio podria efectuar mas ventas, por lo tanto mas ganacias, te recomendamos asignar un precio cerca de" << resul << "$" << endl;
                apagador+=1;
            }
        }
    }

    cout << endl << endl << "Ha finalizado el proceso, bienvenido al mundo digital";
  return 0;
}