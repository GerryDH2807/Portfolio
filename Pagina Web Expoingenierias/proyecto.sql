-- Estructura de la Base de datos
CREATE TABLE `juez` (
  `id_juez` VARCHAR(50),
  `nombre` VARCHAR(50),
  `apellidoPaterno` VARCHAR(50),
  `apellidoMaterno` VARCHAR(50),
  `correo` VARCHAR(50),
  `contraseña` VARCHAR(50),
  PRIMARY KEY (`id_juez`)
);

CREATE TABLE `estudiante` (
  `id_estudiante` VARCHAR(10),
  `nombre` VARCHAR(50),
  `apellidoPaterno` VARCHAR(50),
  `apellidoMaterno` VARCHAR(50),
  `correo` VARCHAR(50),
  `contraseña` VARCHAR(50),
  PRIMARY KEY (`id_estudiante`)
);

CREATE TABLE `edicion` (
  `id_edicion` INT,
  `edicion` VARCHAR(50),
  PRIMARY KEY (`id_edicion`)
);

CREATE TABLE `categoria` (
  `id_categoria` VARCHAR(50),
  `nombre` VARCHAR(50),
  PRIMARY KEY (`id_categoria`)
);

CREATE TABLE `uf` (
  `id_uf` VARCHAR(50),
  `nombre` VARCHAR(50),
  PRIMARY KEY (`id_uf`)
);

CREATE TABLE `profesor` (
  `id_profesor` VARCHAR(50),
  `nombre` VARCHAR(50),
  `apellidoPaterno` VARCHAR(50),
  `apellidoMaterno` VARCHAR(50),
  `correo` VARCHAR(50),
  `contraseña` VARCHAR(50),
  PRIMARY KEY (`id_profesor`)
);

CREATE TABLE `ufprof` (
  `id_ufprof` VARCHAR(50),
  `id_uf` VARCHAR(50),
  `id_profesor` VARCHAR(50),
  PRIMARY KEY (`id_ufprof`),
  FOREIGN KEY (`id_uf`) REFERENCES `uf`(`id_uf`) ON DELETE CASCADE,
  FOREIGN KEY (`id_profesor`) REFERENCES `profesor`(`id_profesor`) ON DELETE CASCADE,
  KEY `Fk` (`id_uf`, `id_profesor`)
);

CREATE TABLE `proyecto` (
  `id_proyecto` VARCHAR(50),
  `nombre` VARCHAR(50),
  `lider` VARCHAR(50),
  `id_ufprof` VARCHAR(50),
  `id_categoria` VARCHAR(50),
  `id_edicion` INT,
  `linkArchivo` VARCHAR(150),
  `descripcion` VARCHAR (400),
  PRIMARY KEY (`id_proyecto`),
  FOREIGN KEY (`lider`) REFERENCES `estudiante`(`id_estudiante`) ON DELETE CASCADE,
  FOREIGN KEY (`id_edicion`) REFERENCES `edicion`(`id_edicion`) ON DELETE CASCADE,
  FOREIGN KEY (`id_categoria`) REFERENCES `categoria`(`id_categoria`) ON DELETE CASCADE,
  FOREIGN KEY (`id_ufprof`) REFERENCES `ufprof`(`id_ufprof`) ON DELETE CASCADE
);

CREATE TABLE `califica` (
  `id_proyecto` VARCHAR(50),
  `id_juez` VARCHAR(50),
  `calificacion` INT,
  `retrojuez` VARCHAR(1000),
  FOREIGN KEY (`id_juez`) REFERENCES `juez`(`id_juez`) ON DELETE CASCADE,
  FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto`(`id_proyecto`) ON DELETE CASCADE
);

CREATE TABLE `administrador` (
  `id_admin` INT,
  `correo` VARCHAR(50),
  `Nombre` VARCHAR(50),
  `Apellido` VARCHAR(50),
  `contraseña` VARCHAR(50),
  PRIMARY KEY (`id_admin`)
);

CREATE TABLE `rubricaestudi` (
  `parametro` VARCHAR(3),
  `calificacion` INT,
  `descripción` VARCHAR(1000),
  PRIMARY KEY (`parametro`)
);

CREATE TABLE `miembrosProyecto` (
  `id_proyecto` VARCHAR(50),
  `id_estudiante` VARCHAR(10),
  FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto`(`id_proyecto`) ON DELETE CASCADE,
  FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante`(`id_estudiante`) ON DELETE CASCADE
);

CREATE TABLE `status` (
  `id_proyecto` VARCHAR(50),
  `id_profesor` VARCHAR(10),
  `status` VARCHAR(50),
  `retroprof` VARCHAR(1000),
  FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto`(`id_proyecto`) ON DELETE CASCADE,
  FOREIGN KEY (`id_profesor`) REFERENCES `profesor`(`id_profesor`) ON DELETE CASCADE
);



-- Registros de la base de datos

INSERT INTO `administrador` (`id_admin`, `correo`, `Nombre`, `Apellido`, `contraseña`) VALUES
(1, 'rodrigo_hernadez@tec.mx', 'Rodrigo', 'Hernandez', '123abc'),
(2, 'fernanda_ortiz@tec.mx', 'Fernanda', 'Ortiz', '123def'),
(3, 'martin_fernandez@tec.mx', 'Martin', 'Fernandez', '123ghi');

INSERT INTO `estudiante` (`id_estudiante`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `correo`,`contraseña`) VALUES
('A01322234', 'Joaquin', 'Gomez', 'Sanchez', 'joaquin_gomez_sanche@tec.mx', '123a'),
('A01327397', 'Sofia', 'Lara', 'Nieves', 'sofia_lara_nieves@tec.mx', '123b'),
('A01722234', 'Clara', 'Mendez', 'Ortega', 'clara_mendez_ortega@tec.mx', '123c'),
('A017253466', 'Sara', 'Hernandez', 'Freyre', 'sara_her_fre@tec.mx', '456a'),
('A017253766', 'Juan', 'Osorio', 'Marquez', 'juan_oso_mar@tec.mx', '456a'),
('A01738265', 'Raul', 'Dominguez', 'Perez', 'raul_dom_per@tec.mx', '456b'),
('A01759241', 'Miguel', 'Camacho', 'Linares', 'miguel_cam_lin@tec.mx', '456c'),
('A01791207', 'Ximena', 'Fregoso', 'Maurer', 'Ximena_fre_mau@tec.mx', '789a'),
('A018263867', 'Alfredo', 'Rosas', 'Estrada', 'alfredo_rosas_estrada@tec.mx', '789b');

INSERT INTO `profesor` (`id_profesor`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `correo`, `contraseña`) VALUES
('L01274996', 'Daniel', 'Ramirez', 'Rojas', 'dan_ramirez_turbas@tec.mx', '111abc'),
('L0138456', 'Monica', 'Galindo', 'Turbas', 'monica_galindo_turbas@tec.mx', '111def'),
('L01492499', 'Sadam', 'Husein', 'Nassar', 'husein_sadam@tec.mx', '111ghi');

INSERT INTO `uf` (`id_uf`, `nombre`) VALUES
('TC2005B', 'Construccion de Software'), 
('TC2037', 'Implementacion de Metodos Computacionales'),
('EH1012', 'Ética, sostenibilidad y responsabilidad social');

INSERT INTO `edicion` (`id_edicion`, `edicion`) VALUES
(1, 'FJ 23'),
(2, 'AD 23'),
(3, 'FJ 24'),
(4, 'AD 24');

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
('1', 'Robotica'),
('2', 'Software'),
('3', 'Nanotecnologia'),
('4', 'Comunicacion'),
('5', 'Medio ambiente');

INSERT INTO `juez` (`id_juez`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `correo`, `contraseña`) VALUES
('1', 'Daniel', 'Ramirez', 'Rojas', '@tec.mx', '222abc'),
('L0138456', 'Monica', 'Galindo', 'Turbas', 'monica_galindo_turbas@tec.mx', '111def'),
('3', 'Oscar', 'Estrada', 'Cortinez', 'estrada@tec.mx', '222efg'),
('4', 'Gustavo', 'Fring', 'Ordaz', 'fring@tec.mx', '222dhi');

INSERT INTO `ufprof` (`id_ufprof`, `id_uf`, `id_profesor`) VALUES
('u1', 'TC2005B', 'L01274996'), 
('u2', 'TC2005B', 'L0138456'),
('u3', 'TC2037', 'L0138456'),
('u4', 'EH1012', 'L01492499');

 
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('CU0201', 'CryptoUniversidad', 'A01327397', 'u1', '2', 1, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('FDA0501', 'FIltro de agua', 'A01722234', 'u4', '5', 1, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('MGNE0201', 'Motor Grafico no euclideano', 'A01722234', 'u2', '2', 2, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('NRM0301', 'NanoRobot medico', 'A017253766', 'u4', '3', 2, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('PDM0301', 'Placas de microfluidos', 'A01722234', 'u4', '3', 3, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");
INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `lider`, `id_ufprof`, `id_categoria`, `id_edicion`, `linkArchivo`, `descripcion`) VALUES ('RA0101', 'Robot Automata', 'A01322234', 'u3', '1', 4, "https://drive.google.com/drive/folders/12fwYQ9zkEkErfab-Eql4xtQx6msPQ3-p?usp=share_link", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.");

INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('CU0201', 'L01274996', 'Corregir', 'Buen Proyecto, mejora la descripcion');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('CU0201', 'L01274996', 'Corregir', 'Buen Proyecto, mejora la descripcion');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('FDA0501', 'L01492499', 'Aceptado', 'Excelente proyecto, buena suerte');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('MGNE0201', '4L0138456', 'Rechazado', 'No aprobaron la materia');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('NRM0301', 'L01492499', 'Corregir', 'Mal uso de la edicion');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('PDM0301', 'L01492499', 'Corregir', 'No te preocupes');
INSERT INTO `status` (`id_proyecto`, `id_profesor`, `status`, `retroprof`) VALUES ('RA0101', 'L0138456', 'Aceptado', 'me encanto la idea, tienen gran posibilidades de ganar');

INSERT INTO `califica` (`id_proyecto`, `id_juez`, `calificacion`, `retrojuez`) VALUES
('CU0201', '1', 9, "Buen Trabajo"),
('FDA0501', 'L0138456', NULL, NULL),
('NRM0301', '3', NULL,  NULL),
('PDM0301', 'L0138456', NULL, NULL),
('RA0101', '4', NULL, NULL);

INSERT INTO `miembrosProyecto` (`id_proyecto`, `id_estudiante`) VALUES
('RA0101', 'A01322234'),
('RA0101', 'A01327397'),
('RA0101', 'A01722234'),
('PDM0301', 'A017253466'),
('PDM0301', 'A017253766'),
('NRM0301', 'A01738265'),
('NRM0301', 'A01759241'),
('MGNE0201', 'A01791207'),
('FDA0501', 'A018263867'),
('CU0201', 'A017253466');

INSERT INTO `rubricaestudi`(`parametro`, `calificacion`, `descripción`) VALUES ('1', 20, 'Utilidad: El proyecto resuelve un problema actual en el área de interpes y/o el proyecto da alta prioridad al cleinte quien queda ampliamente satisfecho');
INSERT INTO `rubricaestudi`(`parametro`, `calificacion`, `descripción`) VALUES ('2', 20, 'Impacto e innovación: El proyecto presenta una idea nueva e impacta positivamente en el área de interés y/o el producto presenta una idea nueva e incrementa la productividad');
INSERT INTO `rubricaestudi`(`parametro`, `calificacion`, `descripción`) VALUES ('3', 20, 'Desarrollo experimental o técnico y/o resultados o producto final: Ausiencia de errores técnicos los resultados y/o producto resuelven el problema propuestos');
INSERT INTO `rubricaestudi`(`parametro`, `calificacion`, `descripción`) VALUES ('4', 20, 'Impacto e innovación: Claridad y precisión de ideas: La presentación es concreta y clara');
INSERT INTO `rubricaestudi`(`parametro`, `calificacion`, `descripción`) VALUES ('5', 20, 'Respuestas a preguntas: Respuestas precisas de acuerdo al diseño, al estado de avance del proyecto, al impactoy a los resultados obtenidos');