/*
Daniela Lozada Bracamoentes - A01736594
Gerardo Deústua Hernández - A01736455
Hugo Muñoz Rodríguez - A01736149
*/

/* Programa que se encarga de hacer una busqueda por ip desde un archivo de
 texto, una vez realizada la busqueda se hacer ordenamiento de manera
 desdecente y si una ip se repite, se ordena por medio de la fecha*/
#include <iostream>
#include <fstream>
#include <string>
#include <sstream>
using namespace std;

/*Estructura de los nodos donde se declaran las variables donde se almacera por partes cada
linea de la bitacora, tambien se declaran los apuntadores del nodo*/
struct Node{
  string value;
  int mes, dia, hora;
  int minuto, segundo;
  int red, subred, dominio, ordenador, puerto, fallo;

  Node *right;
  Node *left;
  Node *root;
};

//Funcion encargada de crear nuevos nodos
typedef struct Node *BST;
BST crearnode(Node *root, string value,int mesint,int dia1,int hrs1,int min1,int seg1,int red,int subred,int dominio,int ordenador,int puerto,int fallo){
     BST nuevonode = new(struct Node);
    nuevonode -> value = value;
    nuevonode -> mes = mesint;
    nuevonode -> dia = dia1;
    nuevonode -> hora = hrs1;
    nuevonode -> minuto = min1;
    nuevonode -> segundo = seg1;
    nuevonode -> red = red;
    nuevonode -> subred = subred;
    nuevonode -> dominio = dominio;
    nuevonode -> ordenador = ordenador;
    nuevonode -> puerto = puerto;
    nuevonode -> fallo = fallo;
     nuevonode->left = NULL;
     nuevonode->right = NULL;
    nuevonode->root = root;
     return nuevonode;
}

/*Funcion que agregara los nodos al arbol, esta misma funcion se encargara de ordenar los
nodos en caso de que haya coincidencias en los nodos, si la red de un IP es menor lo envia a
la izquierda, pero si es mayor a la derecha y en caso de haber coincidencias en la red pasara
a ordenar por subred, dominio, ordenador y puerto, y en caso de que todo coincida, se ordenara por fecha y hora*/
void insertar(BST &arbol, string value,int mes,int dia2,int hrs1,int min1,int seg1,int red1,int subred1,int dominio1,int ordenador1,int puerto1,int fallo1,  Node *root){
     if(arbol==NULL)
     {
           arbol = crearnode(root,value,mes, dia2,hrs1, min1,seg1,red1,subred1,dominio1, ordenador1, puerto1,fallo1);
     }
     else if(red1 < arbol->red)
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);
     else if(red1 > arbol->red)
         insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);

    else if (red1 == arbol->red){
      if (subred1 < arbol->subred){
        insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
      else if (subred1 > arbol->subred){
        insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

      else if (subred1 == arbol->subred){
        if (dominio1 < arbol->dominio){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (dominio1 > arbol->dominio){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

       else if(dominio1 == arbol->dominio ) {
         if (ordenador1 < arbol->ordenador){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (ordenador1 > arbol->ordenador){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

        else if (ordenador1 == arbol->ordenador){
           if (puerto1 < arbol->puerto){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (puerto1 > arbol->puerto){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

        else if (puerto1 == arbol->puerto){
           if (mes < arbol->mes){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (mes > arbol->mes){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

        else if (mes == arbol->mes){
           if (dia2 < arbol->dia){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (dia2 > arbol->dia){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

       else if (dia2 == arbol->dia){
           if (hrs1 < arbol->hora){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (hrs1 > arbol->hora){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

        else if (hrs1 == arbol->hora){
           if (min1 < arbol->minuto){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (min1 > arbol->minuto){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

       else if (min1 == arbol->minuto){
           if (seg1 < arbol->segundo){
          insertar(arbol->left ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}
        else if (seg1 > arbol->segundo){
          insertar(arbol->right ,value ,mes,dia2,hrs1,min1,seg1,red1,subred1,dominio1,ordenador1,puerto1,fallo1,arbol);}

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

//Creacion de archivo donde se almacenaran los 5 valores mas altos
ofstream MyFile("reverse.txt");

//Funcion encargada de ingresar los nodos ordenados de mayor a menor al archivo creado anteriormente
void ReverseInorder(struct Node* node){
    if (node != NULL){
    //Primero recurre al lado derecho
    ReverseInorder(node->right);
    //Imprime el valor del nodo
      MyFile<< node->value <<endl;
    //Luego recurre al lado izquierdo
    ReverseInorder(node->left);
    }
  return;
}

//Funcion encargada de imprimir los 5 valores mas altos del arbol sacando los valores del archivo de texto
void print(struct Node* node){
  string value;
  int i=0;
  ifstream archivo3("reverse.txt");
  if(node != NULL){
    for (i=0;i<5;i++){
    getline(archivo3, value);
    cout<<value<<endl;
    remove("reverse.txt");
   }
  }
   else{
     remove("reverse.txt");
   }
}

int main(){
    //Variables utilizadas para crear los nodos
    string mes, value;
    string dia1, hrs1, min1, seg1, red, subred, dominio, order, puerto, fallo1;
    int mesint=0, fallo;
    BST arbol = NULL;

    //Apertura de los archivos de texto
    ifstream archivo1("bitacora.txt");
    ifstream archivo2("bitacora.txt");

    //Asignacion de valores a las variables correspondientes
    while (getline(archivo1, value)){
        getline(archivo2, mes, ' ');
        getline(archivo2, dia1, ' ');
        getline(archivo2, hrs1, ':');
        getline(archivo2, min1, ':');
        getline(archivo2, seg1, ' ');
        getline(archivo2, red, '.');
        getline(archivo2, subred, '.');
        getline(archivo2, dominio, '.');
        getline(archivo2, order, ':');
        getline(archivo2, puerto, ' ');
        getline(archivo2, fallo1);

        //Asignacion de cada mes a un valor numerico
        if (mes == "Jan") {
            mesint = 1;
        }
        else if (mes == "Feb") {
            mesint = 2;
        }
        else if (mes == "Mar") {
            mesint = (3);
        }
        else if (mes == "Abr") {
            mesint = (4);
        }
        else if (mes == "May") {
            mesint = (5);
        }
        else if (mes == "Jun") {
            mesint = (6);
        }
        else if (mes == "Jul") {
            mesint = (7);
        }
        else if (mes == "Aug") {
            mesint = (8);
        }
        else if (mes == "Sep") {
            mesint = (9);
        }
        else if (mes == "Oct") {
            mesint = (10);
        }
        else if (mes == "Nov") {
            mesint = (11);
        }
        else if (mes == "Dec") {
            mesint = (12);
        }
        else {
            mesint = 0;
        }
        fallo = fallo1.size();
//Se cambia los strings a enteros para implementarlos dentro de la fucnion y el codigo funcione correctamente
      int day1 = stoi(dia1);
      int hr1 = stoi(hrs1);
      int minute1 = stoi(min1);
      int second1 = stoi(seg1);
      int rd = stoi(red);
      int subr = stoi(subred);
      int dom = stoi(dominio);
      int ord = stoi(order);
      int por = stoi(puerto);
insertar(arbol,value,mesint,day1,hr1,minute1,second1,rd,subr,dom,ord,por,fallo, NULL);
    }
    archivo1.close();

ReverseInorder(arbol);
print(arbol);
    return 0;
}
