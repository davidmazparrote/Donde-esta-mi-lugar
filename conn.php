<?php
$servername = "Variable_De_Entorno";
$username = "Variable_De_Entorno";
$password = "Variable_De_Entorno";
$dbname = "Variable_De_Entorno";
$userCode = $_POST["codeUser"];
$sunday = $_POST["dateEvent"];
$MAX_RESERVATION = 7;
$alreadyReserved = false;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CodigoDeUsuario, NombreCompleto, FechaDeReserva FROM Reservas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	foreach ($result as $row) {
		if ($userCode == $row["CodigoDeUsuario"]) {
			$alreadyReserved = true;
		}
		//echo "Codigo de usuario: " . $row["CodigoDeUsuario"] . " " . "Fecha de reserva: " . $row["FechaDeReserva"] . "\n";
	}
}
if ($result->num_rows == $MAX_RESERVATION) {
	echo "No hay mas lugares disponibles";
} else if ($alreadyReserved) {
	echo "Ya reservo lugar para la fecha : " . $sunday;
} else {

	$proj = isset($_POST['project']) ? $_POST['project'] : '';
	$sql = "INSERT INTO Reservas(CodigoDeUsuario, NombreCompleto, FechaDeReserva,YaReservo) 
					VALUES ($userCode,'Martin Vanegas', \"'$sunday'\", true)";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo "Reserva exitosa";
}

$conn->close();
