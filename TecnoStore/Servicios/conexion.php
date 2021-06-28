<?php
    $host = 'localhost';
    $user = 'root';
    $dbpass= '';
    $dbname= 'db_tecnostore';
    $dbport= '3307';

	$con = mysqli_connect($host,$user,$dbpass,$dbname,$dbport);

    if ($con==false){
        echo '
		<script>
			alert("No se pude conectar con la base de datos");
		</script>
        ';
    }
?>