//Hugo Muñoz Rodríguez - A01736149
//Daniela Lozada Bracamontes - A01736594
//Gerardo Deústua Hernández - A01736455
#include <vector>
#include <iostream>
#include <sstream>
#include <fstream>
using namespace std; 

// Declaración de función auxiliar para el ordenamiento 
bool comparaHost(string host1, string host2);

// Creación de la clase Dominio 
class Dominio{
private:
    string red; 
    int connections;
    int access;
    vector <string> hosts;
    bool empty;
public:

//Constructores de la clase Dominio 
   Dominio();
   Dominio(string, string, int);

//Metodos de la clase Dominio 
bool isEmpty();
string getRed();
void actDominio(string);
void resumen();
};

// Declaración de los constructores de la clase, donde se almacenarán los accesos, las conexiones y si es que se encuentra vacio 
Dominio:: Dominio(){
    access = 0;
    connections = 0;
    empty = 1;
}
Dominio:: Dominio(string _red, string _host, int key){
    red = _red;
    access=1;
    connections=1;
    empty = 0;
    hosts.push_back(_host);
}

//Declaración de los metodos de la clase 

//Regresa si es que un espacio se encuentra ocupado o vacio 
bool Dominio:: isEmpty(){
  return empty;
}

string Dominio:: getRed(){
  return red;
}
// Metodo para actualizar el dominio 
void Dominio:: actDominio(string host){
    access++; //Se actualiza el host d 
    for(int i = 0; i < hosts.size(); i++){
      if(hosts[i]==host)
        return;
    }
    //Si el host no existia: 
    hosts.push_back(host);
    connections++; 
}
//Realiza el resumen con la red, los accesos y las conexiones, tambien se ordenara el host de menor a mayor 
void Dominio:: resumen(){
    if(access>0){
      cout << red << endl;
      cout << access << endl;
      cout << connections << endl; 
      //Se realiza el ordenamiento de menor a mayor
      string temp; 
      for(int h = 0 ; h < hosts.size(); h++){
        for(int i = 0; i < hosts.size()-1; i++){
          if(comparaHost(hosts[i],hosts[i+1])){
            temp = hosts[i+1];
            hosts[i+1] = hosts[i];
            hosts[i] = temp; 
          }
        }        
      //Impreción de las IPs 
      }
      for(int j = 0; j < hosts.size(); j++){
        cout<<red<<'.'<<hosts[j]<<endl; 
        }
        cout<<endl; 
      }
}

// Función auxiliar al ordenamiento, tiene como objetivo el comparar los hosts para determinar cual es mayor y cual menor.
bool comparaHost(string host1, string host2){
  string Ahost1, Bhost1, Ahost2, Bhost2; 
  stringstream stream1(host1);
  stringstream stream2(host2);
  getline(stream1, Ahost1,'.'); getline(stream2, Ahost2, '.');
  getline(stream1, Bhost1); getline(stream2, Bhost2);
  
  if(stoi(Ahost1)>stoi(Ahost2))
    return true; 
  else if(stoi(Ahost1)<stoi(Ahost2))
    return false; 
  if(stoi(Bhost1)>stoi(Bhost2))
    return true; 
  else if(stoi(Bhost1)<stoi(Bhost2))
    return false;
  return false; 
}


int cont = 0;
//Declaramos las funciones 
void ins(vector<Dominio> &hash, string red, string host, int key) {
  //Caso en el que la tabla se encuentre llena, en este caso el numero primo menor a 32768 es 32749

if (cont >= 32749) {
    cout << "Tabla llena, imposible meter más datos" << endl;
    return;
  }
  // En caso de que la tabla no se encuentre llena, se buscara el primer espacio vacio disponible para ingresar la información 
  int i = key;
  //Se realiza un recorrido al vector para encontrar la red o para encontrar el primer espacio disponible
  while(true){
    if(hash[i].getRed() == red){ //Dominio existente
       hash[i].actDominio(host);
      return; 
    }
    else if(hash[i].isEmpty()){
      hash[i] = Dominio (red, host, key);
      cont++;       
      return; 
    }
    if(i == 32749) //Se reinicia la busqueda en la tabla para buscar espacios vacios que se hayan podido pasar por alto 
      i=0;
    i++;
  }
}

// Función encargada de la busqueda de las IPs deseadas 
void search(string red, vector<Dominio > &hash) {
  stringstream stream(red);
  string red1, red2; 
  int red1_int, red2_int; 
  int key; 
  getline(stream, red1, '.');
  getline(stream, red2);
  red1_int=stoi(red1);
  red2_int=stoi(red2);

  red = to_string(red1_int)+'.'+to_string(red2_int);
 
  key = ( red1_int * red2_int ) % 32749;
  int i = key; 
  int aux = 0;
  while(aux<32749){
    if(hash[i].getRed() == red){
      hash[i].resumen();
      return; 
    }
    if(i == 32749)
      i=0;
    i++;
    aux++;
  }
  //En caso de que no se haya encontrado la IP solicitada, se mandara un mensaje de error 
  cout << "Dominio no encontrado" << endl;
  cout << endl; 
}
//Funcion main controladora del codigo 
int main() {

  //Declaración de las variables, vectores y archivos de textos necesarios 
  vector <Dominio > IP(32749, Dominio ());
  ifstream FILE;
  FILE.open("bitacora2.txt");
  string line, temp, red1, red2, host1, host2, red, host; 
  int red1_int, red2_int, host1_int, host2_int; 

  //Se obtiene toda la información necesaria linea por linea del archivo de texto y lo manda a sus varibales respectivas 
  while( getline(FILE, line) ){
    stringstream stream(line);
    
    // Se lee el día, el mes y la hora pero serán eliminadas ya que no son necesarias 
    getline(stream, temp, ' '); 
    getline(stream, temp, ' '); 
    getline(stream, temp, ' '); 

    //los demas datos son mandados a su variable respectiva 
    getline(stream, red1, '.');
    getline(stream, red2, '.');
    red1_int=stoi(red1);
    red2_int=stoi(red2);
    getline(stream, host1, '.');
    getline(stream, host2, ':');
    host1_int=stoi(host1);
    host2_int=stoi(host2);
    
    red=to_string(red1_int)+'.'+to_string(red2_int); 
    host=to_string(host1_int)+'.'+to_string(host2_int);

    int key = ( stoi(red1) * stoi(red2) ) % 32749;

    ins(IP, red, host, key);
}
  
  //Se solicita la cantidad de dominios que se quieran buscar y despues se solicitará los dominios de interes 
  int NDominios; 
  cin >> NDominios;
  vector <string> redes; 
  
  for (int i = 0; i < NDominios ; i++){
    cin >> temp;
    redes.push_back(temp);
  }
  cout<<endl; 
  for(int j = 0; j < NDominios ; j++){
    search(redes[j],IP);
  }
}