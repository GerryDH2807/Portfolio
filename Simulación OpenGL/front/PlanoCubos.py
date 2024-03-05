#Autor: Ivan Olmos Pineda
#Curso: Multiagentes - Graficas Computacionales

import pygame
from pygame.locals import *

# Cargamos las bibliotecas de OpenGL
from OpenGL.GL import *
from OpenGL.GLU import *
from OpenGL.GLUT import *

from random import randrange

# Se carga el archivo de la clase Cubo
from Cubo import Cubo

import requests

URL_BASE = "http://localhost:5000"
r = requests.post(URL_BASE+ "/games", allow_redirects=False)
print(r)
#LOCATION = r.headers["location"]


elementos = r.json()
bots = elementos["bots"]
trash = elementos["trash"]
incinerador = elementos["incinerador"]
LOCATION = elementos["location"]

screen_width = 500
screen_height = 500

#vc para el obser.
FOVY=60.0
ZNEAR=0.01
ZFAR=900.0
#Variables para definir la posicion del observador
#gluLookAt(EYE_X,EYE_Y,EYE_Z,CENTER_X,CENTER_Y,CENTER_Z,UP_X,UP_Y,UP_Z)
EYE_X=300.0
EYE_Y=200.0
EYE_Z=300.0
CENTER_X=0
CENTER_Y=0
CENTER_Z=0
UP_X=0
UP_Y=1
UP_Z=0
#Variables para dibujar los ejes del sistema
X_MIN=-500
X_MAX=500
Y_MIN=-500
Y_MAX=500
Z_MIN=-500
Z_MAX=500
#Dimension del plano
DimBoard = 200

pygame.init()

cubos = {}
basuras = {}
burner = {}

for agent in bots:
    cubo = Cubo(agent["x"], agent["z"])
    cubos[agent["id"]] = cubo

for agent in trash:
    basura = Cubo(agent["x"], agent["z"])
    basuras[agent["id"]] = basura

for agent in incinerador:
    incinerator = Cubo(agent["x"]-320, agent["z"]-320)
    burner[agent["id"]] = incinerator

def Init():
    pygame.display.set_mode(
        (screen_width, screen_height), DOUBLEBUF | OPENGL)
    pygame.display.set_caption("OpenGL: cubos")

    glMatrixMode(GL_PROJECTION)
    glLoadIdentity()
    gluPerspective(FOVY, screen_width/screen_height, ZNEAR, ZFAR)

    glMatrixMode(GL_MODELVIEW)
    glLoadIdentity()
    gluLookAt(EYE_X,EYE_Y,EYE_Z,CENTER_X,CENTER_Y,CENTER_Z,UP_X,UP_Y,UP_Z)
    glClearColor(0,0,0,0)
    glEnable(GL_DEPTH_TEST)
    glPolygonMode(GL_FRONT_AND_BACK, GL_FILL)

    glLightfv(GL_LIGHT0, GL_POSITION,  (-40, 200, 100, 0.0))
    glLightfv(GL_LIGHT0, GL_AMBIENT, (1., 1, 1, 1.0))
    glLightfv(GL_LIGHT0, GL_DIFFUSE, (0.5, 0.5, 0.5, 1.0))
    glEnable(GL_LIGHT0)
    glEnable(GL_LIGHTING)
    glEnable(GL_COLOR_MATERIAL)
    glEnable(GL_DEPTH_TEST)
    glShadeModel(GL_SMOOTH)           # most obj files expect to be smooth-shaded

    
    for cubo in cubos.values():
        cubo.loadmodel("R2D2.obj")
    for basura in basuras.values():
        basura.loadmodel("coin.obj")
    for incinerator in burner.values():
        incinerator.loadmodel("Big Treasure Chest.obj")

def display():
    glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT)
    #Se dibuja el plano gris
    glColor3f(0.3, 0.3, 0.3)
    glBegin(GL_QUADS)
    glVertex3d(-DimBoard, 0, -DimBoard)
    glVertex3d(-DimBoard, 0, DimBoard)
    glVertex3d(DimBoard, 0, DimBoard)
    glVertex3d(DimBoard, 0, -DimBoard)
    glEnd()
    #Se dibuja cubos
    for cubo in cubos.values():
        cubo.generate(30, 180)
    for basura in basuras.values():
        if basura.valid == 0:
            basura.generate(1, randrange(1,15))
    for incinerator in burner.values():
        incinerator.generate(0.7, 180)
    
    response = requests.get(URL_BASE + LOCATION)
    elementos = response.json()
    bots = elementos["bots"]
    trash = elementos["trash"]
    
    for agent in bots:
        cubos[agent["id"]].update(agent["x"] * 20 - 160, agent["z"] * 20 - 160)
    for agent in trash:
        basuras[agent["id"]].update(agent["x"] * 20 - 160, agent["z"] * 20 - 160)
        basuras[agent["id"]].updatevalid(agent["state"])
    for agent in incinerador:
        burner[agent["id"]].update(agent["x"] * 20 - 160, agent["z"] * 20 - 160)
done = False
Init()
while not done:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            done = True

    display()

    pygame.display.flip()
    pygame.time.wait(50)

pygame.quit()