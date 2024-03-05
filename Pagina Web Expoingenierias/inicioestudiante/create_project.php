<?php
	session_start();
	$_SESSION['color'];

	$color = $_SESSION['color'];

	//Declaracion de variables
	require 'database.php';

		$nombreProyectoError = null;
		$descripcionError = null;
        $categoriaError = null;
		$unidadFormacionError = null;
        $linkarchivoError = null;
		$liderError = null;
		$idproyectoError = null;


	if ( !empty($_POST)) {

		$nombreProyecto = $_POST['nombreProyecto'];
		$descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
		$unidadFormacion = $_POST['unidadFormacion'];
        $linkarchivo = $_POST['linkarchivo'];
		$idproyecto = $_POST['idproyecto'];
		$edicion = 2;
		$lider = $_POST['liderMenu'];


		// Validar inputs
		$valid = true;

		if (empty($nombreProyecto)) {
			$nombreProyectoError = 'Ingrese un nombre de proyecto';
			$valid = false;
		}
		if (empty($descripcion)) {
			$descripcionError = 'Ingrese una descripción del proyecto';
			$valid = false;
		}
		if (empty($categoria)) {
			$categoria = 'Seleccione una categoría';
			$valid = false;
		}
		if (empty($unidadFormacion)) {
			$unidadFormacion = 'Seleccione una categoría';
			$valid = false;
		}
		if (empty($linkarchivo)) {
			$linkarchivo = 'Seleccione una categoría';
			$valid = false;
		}
		if (empty($lider)) {
			$lider = 'Ingresa tu matrícula para continuar';
			$valid = false;
		}
		if (empty($idproyecto)) {
			$idproyecto = 'Ingresa tu matrícula para continuar';
			$valid = false;
		}

		// Insertar data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO proyecto (id_proyecto, nombre, lider, id_ufprof, id_categoria, id_edicion, linkArchivo, descripcion) values(?, ?, ?, ?, ?, ?, ?, ?)';
			$q = $pdo->prepare($sql);
			$q->execute(array($idproyecto, $nombreProyecto, $lider, $unidadFormacion, $categoria, $edicion, $linkarchivo, $descripcion));
			Database::disconnect();
			$_SESSION["proyectomat"]=$idproyecto;
			header("Location: indexEst.php?id=$color");
		}

	}
?>

<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" href="http://lab403azms01.itesm.mx/TC2005B_401_3/RETOFINAL/img/miniicon.png">
		<title>Registrar Proyecto</title>
		<meta charset = "utf-8" />
	</head>

	<body>
		
		<div class="scrollogo">
			<table align="center">
				<tr>
					<td align="center" style="width: 33.33%;"><h1 style="font-size: 35px;"><strong>Registrar Proyecto</strong></h1></td>
					<td align="center" style="width: 33.33%;" class="logo"> <img src="https://admision.tec.mx/expo-ingenierias/images/logo-expo.svg" style="width: 45%;"></td>
					<td align="center" style="width: 33.33%;"> <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png" style="width: 45%;"></td>
				</tr>
			</table>
			<hr size="4px" color="#b8b4b4">
		</div>
		
		

		<form class="form-horizontal" action="create_project.php" method="post">

			<table align="center" width="100%">
				

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Nombre del proyecto </strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input type="text" id="nombreProyecto" name="nombreProyecto" required maxlength="50" placeholder="   Ingresa el nombre del proyecto" size="50"  class="input" value="<?php echo !empty($nombreProyecto)?$nombreProyecto:'';?>">
					<?php if (($nombreProyectoError != null)) ?>
						<span class="help-inline"><?php echo $nombreProyectoError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>
                
                
				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Descripción</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input style="height: 59px;" type="text" id="descripcion" name="descripcion" required maxlength="400" placeholder="   Descripción del proyecto (máximo 300 caracteres)" size="70" class="input" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
					<?php if (($descripcionError != null)) ?>
						<span class="help-inline"><?php echo $descripcionError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Categoría</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>
	
				<tr> 
					<td style="width: 33.33%;"></td>
					<td>
						<div class="control-group <?php echo !empty($categoriaError)?'error':'';?>">
							<div class="controls">
								<select class="input" style="width: 160%;" name ="categoria">
									<option value="">Seleccionar</option>
									<?php
										$pdo = Database::connect();
										$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$query = 'SELECT * FROM categoria';
										foreach ($pdo->query($query) as $row) {
											echo '<option value='. $row['id_categoria'] .'>' . $row['nombre'] . '</option>'; 
										}
										//Database::disconnect();
									?>
								</select>
								<?php if (($categoriaError) != null) ?>
									<span class="help-inline"><?php echo $categoriaError;?></span>
							</div>
						</div>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Unidad de Formación y Profesor</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td style="width: 33.33%;">
						<div class="control-group <?php echo !empty($unidadFormacionError)?'error':'';?>">
							<div class="controls">
								<select class="input" style="width: 160%;" name ="unidadFormacion">
									<option value="">Seleccionar</option>
									<?php
										//$pdo = Database::connect();
										$query = 'SELECT * FROM profesor
													INNER JOIN ufprof ON ufprof.id_profesor = profesor.id_profesor';
													
										foreach ($pdo->query($query) as $row) {
											echo '<option value=' . $row['id_ufprof'] . '>' . $row['id_uf'] . ' - ' . $row['nombre'] . ' ' . $row['apellidoPaterno'] . ' ' . $row['apellidoMaterno'] . '</option>';
										}
										//Database::disconnect();
									?>
								</select>
								<?php if (($unidadFormacionError) != null) ?>
									<span class="help-inline"><?php echo $unidadFormacionError;?></span>
							</div>
						</div>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Líder del proyecto</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td>
						<div class="control-group <?php echo !empty($liderError)?'error':'';?>">
							<div class="controls">
								<select class="input" style="width: 160%;" name ="liderMenu">
									<option value="">Seleccionar</option>
									<?php
										//$pdo = Database::connect();
										$query = 'SELECT * FROM estudiante';
										foreach ($pdo->query($query) as $row) {
											echo '<option value=' . $row['id_estudiante'] . '>' . $row['nombre']  .' '. $row['apellidoPaterno'] .' '. $row['apellidoMaterno'] . '</option>'; 
										}
										//Database::disconnect();
									?>
								</select>
								<?php if (($liderError) != null) ?>
									<span class="help-inline"><?php echo $liderError;?></span>
							</div>
						</div>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>ID del proyecto</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input style="height: 59px;" type="text" id="idproyecto" name="idproyecto" required maxlength="8" placeholder="   Con este ID se uniran los miembros del equipo" size="50" class="input" value="<?php echo !empty($idproyecto)?$idproyecto:'';?>">
					<?php if (($idproyectoError != null)) ?>
						<span class="help-inline"><?php echo $idproyectoError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="center" style="width:33.33%; font-size: 12px"><p style="color:#646464"><strong>Como crear tu ID del proyecto:</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="center" style="width:33.33%; color:#646464; font-size: 12px">1. Escribe las 2 primeras letras del nombre de tu proyecto en mayusculas</td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="center" style="width:33.33%; color:#646464; font-size: 12px">2. Despues escribe las dos primeras letras de la categoria en mayusculas</td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="center" style="width:33.33%; color:#646464; font-size: 12px">3. Por ultimo ingresa el dia y el mes del dia de hoy</td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="center" style="width:33.33%; font-size: 12px"><p style="color:#646464"><strong> Tu ID deberia verse algo así: AGNA2704</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong>Link del archivo</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input style="height: 59px;" type="text" id="linkarchivo" name="linkarchivo" required maxlength="50" placeholder="   Ingresa el link de drive donde subiras tus archivos del proyecto" size="50" class="input" value="<?php echo !empty($linkarchivo)?$linkarchivo:"";?>">
					<?php if (($linkarchivoError != null)) ?>
						<span class="help-inline"><?php echo $linkarchivoError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>





				<tr><td style="height: 40px;"></td></tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="center" class="botonborde" style="width: 33.33%;"><button type="submit" align="center" class="botonfinal" id="botonfinal"><strong>Registrar Proyecto</strong></button></td>
					<td style="width: 33.33%;"></td>
				</tr>

			</table>
		</form>

		
		<p class="footer">@2023 <a href="https://tec.mx/es">Tecnológico de Monterrey.</a></p>

	</body>
</html>
