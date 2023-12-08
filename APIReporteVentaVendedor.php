<?php

$datos = $_REQUEST;
$idprod=$datos['idproducto'];
$idprod2=$datos['idproducto2'];

$valor = $idprod;

$respuesta = mdlMostrarUsuarios($valor);

	if($respuesta == true){
		if($respuesta['perfilvend']=="Vendedor"){
			echo "El vendedor: ";
			echo $respuesta['nombrevend'];
			echo " ha hecho [";
			echo $respuesta['cant_ventas'];
			echo "] ventas con un total de [S/. [";
			echo $respuesta['total_ventas'];
			echo "] soles, con un promedio de ventas de [S/. ";
			echo $respuesta['prom_ventas'];
			echo "] soles, generando utilidades de [S/. ";
			echo $respuesta['utilidad_total'];
			echo "] para la empresa.";
		}else{
			echo "El usuario seleccionado no es Vendedor";
		}
		
	}else{
		echo "error_prod";
		echo " ";
		echo $usuario_login;
	}


function mdlMostrarUsuarios($valor) {
	$HOST = '127.0.0.1';
	$USER = 'u195516339_acasanovav';
	$PASSWORD = 'Acasanovav310794';
	$BDNAME = 'u195516339_multinvercas';
	try {
		$dsn = "mysql:host=".$HOST.";dbname=".$BDNAME.";";
		$dbh = new PDO($dsn, $USER, $PASSWORD);
	} catch (PDOException $e){
		echo $e->getMessage();
	}
        
		$stmt = $dbh->prepare("SELECT (SELECT nombre from usuarios WHERE id=$valor) as nombrevend, (SELECT perfil from usuarios WHERE id=25) as perfilvend, COUNT(id) as cant_ventas, SUM(total) as total_ventas, SUM(utilidad) as utilidad_total, ROUND(AVG(total),2) as prom_ventas FROM venta WHERE codvendedor=$valor;");
		
		$stmt->execute();
		return $stmt->fetch();
       
        $stmt->close();
        $stmt = null;
    }
?>