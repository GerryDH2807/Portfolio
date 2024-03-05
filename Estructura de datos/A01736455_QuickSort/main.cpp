/*     
   Hugo Muñoz Rodríguez - A01736149  
   Daniela Lozada Bracamontes - A01736594
   Gerardo Deústua Hernández - A01736455
   Tarea 4.3
*/

#include "Registro.h"
#include <fstream>
#include <vector>
using namespace std;

// Estructura que almacenará la informacion de las lineas del archivo de texto 
struct objects{
   string ip;
   int graphOut = 0;
   vector<objects*> vectRegistro;
   objects* down = NULL;
};

//Función auxiliar que ayuda al metodo de ordenamiento QuickSort dividiendo el vector por la mitad. 
int auxQuicksort(vector<Registro > &data, int left, int right) {
    int pivotIndex = left + (right - left) / 2;
    Registro  pivotData= data[pivotIndex];
    int i = left, j = right;
    Registro  auxiliar;
    while(i <= j) {
        while(data[i] < pivotData) {
            i++;
        }
        while(pivotData < data[j]  ) {
            j--;
        }
        if(i <= j) {
            auxiliar = data[i];
            data[i] = data[j];
            data[j] = auxiliar;
            i++;
            j--;
        }}
    return i;}

// Metodo de ordenamiento quicksort con recursividad.Donde el peor de los casos es O(n2) y el caso promedio O(n log n)
void quicksort(vector<Registro > &data, int left, int right) {
    if(left < right) {
        int pivotIndex = auxQuicksort(data, left, right);
        quicksort(data, left, pivotIndex - 1);
        quicksort(data, pivotIndex, right);
    }
}

int main(){
  // Declaracion de variables, apertura de archivos de texto y creacion del vector
    vector <Registro > list;
    ifstream archivo("bitacora2.txt");
    ifstream archivo2("bitacora2.txt");
    string value, mes, dia, hora, minuto, segundo, red, subred, dominio, ordenador,puerto,falla;
    // Asignamos a cada variable su valor corespondiente de cada linea que sea leida 
    while(getline (archivo2, value)){
      getline (archivo, mes, ' ');
      getline (archivo, dia, ' ');
      getline (archivo, hora, ':');
      getline (archivo, minuto, ':');
      getline (archivo, segundo, ' ');
      getline (archivo, red, '.');
      getline (archivo, subred, '.');
      getline (archivo, dominio, '.');
      getline (archivo, ordenador, ':');
      getline (archivo, puerto, ' ');
      getline (archivo, falla);
      /*Se agregan los valores de las variables al vector y se hace la conversion de ciertos           datos de string a entero */ 
       list.push_back(Registro (value, mes, stoi(dia), stoi(hora), stoi(minuto), stoi(segundo), stoi(red),
      stoi(subred), stoi(dominio), stoi(ordenador), stoi(puerto), falla));
    }

    quicksort(list, 0, list.size() - 1);
  
   // Apuntadores auxiliares para la creacion de vertices 
   struct objects* root, *aux, *aux2;
  
     //Si el vector ya tiene un elemento, se hace uso de los apuntadores aux para crear nuevos vertices    
    if(list.empty()){
        return 0;
    }
    else{
        if(!list.empty()){
          //Creacion de nuevos vertices vacios para agregar al grafo usando los apuntadores auxiliares
            aux2 = new objects();
            aux2 -> ip = list[0].Ip();
            aux = new objects;
            aux->ip = list[0].Host();
            aux->graphOut++;
            aux->vectRegistro.push_back(aux2);
            root = new struct objects();
            root->ip = list[0].fullRed();
            root->graphOut++;
            root->vectRegistro.push_back(aux);

            struct objects* current = root;
          
            /*Agregar los nuevos vertices al grafo haciendo uso de los apuntadores auxiliares y dandole forma de grafo a la estructura*/
            for(int i = 1; i < list.size(); i++){
                if(list[i].fullRed() == list[i-1].fullRed()){
                    if(list[i].Host() == list[i-1].Host()){
                    aux2 = new objects();
                    aux2 -> ip = list[i].Ip();
                    aux->graphOut++;
                    aux->vectRegistro.push_back(aux2);
                    }
                    else{
                    current->graphOut++;
                    aux2 = new objects;
                    aux2 -> ip = list[i].Ip();
                    aux = new objects;
                    aux->ip = list[i].Host();
                    aux->graphOut++;
                    aux->vectRegistro.push_back(aux2);
                    current->vectRegistro.push_back(aux);
                    }
                }
                else{
                    aux2 = new objects;
                    aux2 -> ip = list[i].Ip();
                    current->down = new struct objects();
                    current = current->down;
                    aux = new objects;
                    aux->ip = list[i].Host();
                    aux->graphOut++;
                    aux->vectRegistro.push_back(aux2);
                    current->ip = list[i].fullRed();
                    current->graphOut++;
                    current->vectRegistro.push_back(aux);
                }
            }
        }
        // Declaracion de apuntadores y variables para el vertice actual y el ultimo agregado 
        struct objects *current = root;
        int last = 0, lastH = 0;
        struct objects *lastRoot = root, *printRoot = root, *lastHost = root, *printH = root;
        
        while(lastRoot != NULL){
            if (lastRoot->graphOut > last)
                last = lastRoot -> graphOut;
            lastRoot = lastRoot->down;
        }
        while(printRoot != NULL){
            if(last == printRoot -> graphOut)
                cout<<printRoot->ip<<endl;
            printRoot = printRoot -> down;
        }
        cout<<"\n";
        while(lastHost != NULL){
            for(int i=0;i < lastHost->vectRegistro.size(); i++ )
                if((lastHost -> vectRegistro[i])->graphOut > lastH)
                    lastH = (lastHost -> vectRegistro[i])->graphOut;
            lastHost = lastHost->down;
        }
        while(printH!= NULL){
            for(int i=0;i < printH->vectRegistro.size(); i++ )
                    if((printH -> vectRegistro[i])->graphOut == lastH)
                        cout<<((printH -> vectRegistro[i])->vectRegistro[0])->ip<<endl;
            printH = printH -> down;
        }
    }
   return 0;
}
