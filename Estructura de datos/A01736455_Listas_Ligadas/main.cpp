//Daniela Lozada Bracamontes A01736594
//Hugo Muñoz Rodriguez       A01736149
//Gerardo Deustua Hernandez  A01736455
//Porgrama que se encarga de hacer una busqueda por ip desde un archivo de texto, una vez realizada la busqueda se hacer ordenamiento de manera desdecente y si una ip se repite, se ordena por medio de la fecha
#include <iostream>
#include <fstream>
#include <string>
#include <sstream>

using namespace std;
//Estructura de Nodo que guarda unicamente los datos que solicitaremos para manej  ar cada registro, como el IP y la fecha en caso de doble Ip
struct Node{
  string value;
  int mes, dia, hora;
  int minuto, segundo;
  int red, subred, dominio, ordenador, puerto, fallo;
//Dos Apuntadores para crear lista doblemente Ligada
  Node *next;
  Node *prev;
};

//Divide la lista doblemente ligada en dos grupos para implementar el metodo de ordenamiento el siguiente de la lista ira a un lado y el segundo del segundo ira al otro. 
Node *divide(Node *head){
    Node *grup1 =(Node *) malloc(sizeof(Node)),*grup2 =(Node *) malloc(sizeof(Node));
    grup1 = head;
    grup2 = head;
    while (grup1->next && grup1->next->next){
        grup1 = grup1->next->next;
        grup2 = grup2->next;
    }
    Node *temp = (Node *) malloc(sizeof(Node));
    temp = grup2->next;
    grup2->next = nullptr;
    return temp;
}
//Funcion booleana que comprueba que el primer IP es menor que el segundo para comenzar a buscar los datos que estan entre ellos.
bool evaluate(Node *first, Node *second){
    if(first -> red < second -> red)
        return true;
    else if(first -> red > second -> red)
      return false;
    else if(first -> red == second ->red && first -> subred < second ->subred)
        return true;
      else if(first -> subred > second ->subred)
        return false;
      else if(first -> subred == second ->subred && first -> dominio <second -> dominio)
          return true;
          else if(first -> dominio > second ->dominio)
            return false;
        else if(first -> dominio == second ->dominio && first -> ordenador < second ->ordenador)
            return true;
          else if(first -> ordenador == second ->ordenador && first -> puerto < second ->puerto)
              return true;
            else if(first -> puerto == second ->puerto && first -> mes <second -> mes)
                return true;
              else if(first -> mes == second ->mes && first -> dia <second -> dia)
                  return true;
                else if(first -> dia == second ->dia && first -> hora < second ->hora)
                    return true;
                  else if(first -> hora == second ->hora && first -> minuto < second -> minuto)
                      return true;
                    else if(first -> minuto == second -> minuto && first -> segundo < second -> segundo )
                        return true;
                    else if(first -> segundo == second -> segundo && first -> fallo < second -> fallo)
                        return true;
              return false;
}

//Creará cada Nodo con la información del archivo txt, esta función será llamada en el main. 
void insert(Node *&node,Node *&head,Node *&tail,string value,int mesint,int dia1,int hrs1,int min1,int seg1,int red,int subred,int dominio,int ordenador,int puerto,int fallo){
    struct Node *newnode = (Node *) malloc(sizeof(Node));
    newnode -> value = value;
    newnode -> mes = mesint;
    newnode -> dia = dia1;
    newnode -> hora = hrs1;
    newnode -> minuto = min1;
    newnode -> segundo = seg1;
    newnode -> red = red;
    newnode -> subred = subred;
    newnode -> dominio = dominio;
    newnode -> ordenador = ordenador;
    newnode -> puerto = puerto;
    newnode -> fallo = fallo;
    if(node == nullptr){
        newnode -> next = nullptr;
        newnode -> prev = nullptr;
        node = newnode;
        head = newnode;
        tail = newnode;
    }
    else{
        newnode -> next = nullptr;
        newnode -> prev = tail;
        tail -> next = newnode;
        tail = newnode;
    }
}

//Función auxiliar de Merge
Node *merge(Node *primero, Node *segundo){
    if (!primero)
        return segundo;
    if (!segundo)
        return primero;;
    if (evaluate(primero, segundo)){
        primero->next = merge(primero->next,segundo);
        primero->next->prev = primero;
        primero->prev = nullptr;
        return primero;
    }
    else{
        segundo->next = merge(primero,segundo->next);
        segundo->next->prev = segundo;
        segundo->prev = nullptr;
        return segundo;
    }
}
//Funcion de Ordenamiento Merge
Node *mergeSort(Node *head){
    if (!head || !head->next)
        return head;
    Node *segundo = (Node *) malloc(sizeof(Node));
    segundo = divide(head);
    head = mergeSort(head);
    segundo = mergeSort(segundo);
    return merge(head,segundo);
}

//Funcion que se encarga de comprar la busqueda de las ip que fueron solicitadas 
bool compararBusquedaF(Node *uno,int redi,int subredi,int dominioi,int ordenadori,int puertoi,int redf,int subredf,int dominiof,int ordenadorf,int puertof){
    if((uno -> red == redf && uno -> subred == subredf && uno -> dominio == dominiof && uno -> ordenador == ordenadorf && uno -> puerto == puertof) && (uno -> red == redi && uno -> subred == subredi && uno -> dominio == dominioi && uno -> ordenador == ordenadori && uno -> puerto == puertoi))
        return true;
    if((uno -> red == redf && uno -> subred == subredf && uno -> dominio == dominiof && uno -> ordenador == ordenadorf && uno -> puerto == puertof) || (uno -> red == redi && uno -> subred == subredi && uno -> dominio == dominioi && uno -> ordenador == ordenadori && uno -> puerto == puertoi))
        return true;

    if((uno -> red > redi) && (uno -> red < redf))
        return true;
    if((uno -> red < redi) || (uno -> red > redf))
        return false;
    if(uno -> red == redi || uno -> red == redf)
        if(uno -> subred < subredi && uno -> subred > subredf)
        return false;
    if(uno -> subred > subredi && uno -> subred < subredf)
        return true;
    if((uno -> subred < subredi) || (uno -> subred > redf))
        return false;
    if(uno -> subred == subredi || uno -> subred == subredf)
        if(uno -> dominio < dominioi && uno -> dominio > dominiof)
        return false;
    if(uno -> dominio > dominioi && uno -> dominio < dominiof)
        return true;
    if((uno -> dominio < dominioi) || (uno -> dominio > dominiof))
        return false;
    if(uno -> dominio == dominioi || uno -> dominio == dominiof)
        if(uno -> ordenador < ordenadori && uno -> ordenador > ordenadorf)
        return false;
    if(uno -> ordenador > ordenadori && uno -> ordenador < ordenadorf)
        return true;
    if((uno -> ordenador < ordenadori) || (uno -> ordenador > ordenadorf))
        return false;
    if(uno -> ordenador == ordenadori || uno -> ordenador == ordenadorf)
        if(uno -> puerto < puertoi && uno -> puerto > puertof)
        return false;
    if(uno -> puerto > puertoi && uno -> puerto < puertof)
        return true;
    if((uno -> puerto < puertoi) || (uno -> puerto > puertof))
        return false;
    return false;
}

//Busqueda que utiliza el IP inicial y el IP final para buscar los que se encuentran entre ellos, finalmente imprime los resultados en la consola. 
void searchh(Node *lista,int redi,int subredi,int dominioi,int ordenadori,int puertoi,int redf,int subredf,int dominiof,int ordenadorf,int puertof){
    Node *actual =(Node *) malloc(sizeof(Node));
    actual = lista;
    while((actual != nullptr)){
        if(compararBusquedaF(actual, redi, subredi, dominioi, ordenadori, puertoi, redf, subredf, dominiof, ordenadorf, puertof))
        cout<<actual -> value << endl;
        actual = actual -> prev;
    }
    return;
}
//Función para imprimir la busqueda en el archivo SortedData.txt
void prins(Node *lista,int redi,int subredi,int dominioi,int ordenadori,int puertoi,int redf,int subredf,int dominiof,int ordenadorf,int puertof){
    Node *actual =(Node *) malloc(sizeof(Node));
    actual = lista;
  ofstream Myfiile("SortedData.txt");
    while((actual != nullptr)){
        if(compararBusquedaF(actual, redi, subredi, dominioi, ordenadori, puertoi, redf, subredf, dominiof, ordenadorf, puertof))
        Myfiile<<actual -> value << endl;
        actual = actual ->prev;
    }
    return;
}

int main(){
    string iPi, iPf;
    getline(cin, iPi);
    stringstream a(iPi);
    string red1, subred1, dominio1, ordenador1, puerto1;
    getline(a, red1,'.');
    getline(a, subred1,'.');
    getline(a,dominio1,'.');
    getline(a, ordenador1,':');
    getline(a,puerto1);
    getline(cin, iPf);
    stringstream b(iPf);
    string red2, subred2, dominio2, ordenador2, puerto2;
    getline(b, red2,'.');
    getline(b, subred2,'.');
    getline(b,dominio2,'.');
    getline(b, ordenador2,':');
    getline(b,puerto2);
    string mes, value;
    string mes1, dia1, hrs1, min1, seg1, red, subred, dominio, order, puerto, fallo1;
    int mesint=0, fallo;
    struct Node* head = (Node *) malloc(sizeof(Node));
    struct Node* tail = (Node *) malloc(sizeof(Node));
    struct Node* node = (Node *) malloc(sizeof(Node));
    node = nullptr;
    head = node;
    tail = node;
    ifstream archivo1("bitacora.txt");
    ifstream archivo2("bitacora.txt");
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
        if (mes == "Jan") {
            mes = 1;
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
            mesint = (0);
        }
        fallo = fallo1.size();
//Cambiamos los strings a enteros para implementarlos dentro de la fucnion y el codigo funcione correctamente
      int day1 = stoi(dia1);
      int hr1 = stoi(hrs1);
      int minute1 = stoi(min1); 
      int second1 = stoi(seg1);
      int rd = stoi(red);
      int subr = stoi(subred);  
      int dom = stoi(dominio); 
      int ord = stoi(order);
      int por = stoi(puerto);
insert(node,head,tail,value,mesint,day1,hr1,minute1,second1,rd,subr,dom,ord,por,fallo);
    }
    archivo1.close();
    head = mergeSort(head);
    struct Node *tailFinal = (Node *) malloc(sizeof(Node));
    while(tail != nullptr){
        tailFinal = tail;
        tail = tail ->next;
    }
  int redi=stoi(red1);
  int subredi=stoi(subred1);
  int dominioi= stoi(dominio1);
  int ordenadori=stoi(ordenador1);
  int puertoi=stoi(puerto1);
  int redf=stoi(red2);
  int subredf=stoi(subred2);
  int dominiof=stoi(dominio2);
  int ordenadorf=stoi(ordenador2);
  int puertof=stoi(puerto2);
   searchh(tailFinal,redi,subredi,dominioi,ordenadori,puertoi,redf,subredf,dominiof,ordenadorf,puertof);
    
prins(tailFinal,redi,subredi,dominioi,ordenadori,puertoi,redf,subredf,dominiof,ordenadorf,puertof);
    return 0;
}