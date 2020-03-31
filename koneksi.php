<?php
$server= 'localhost'; 
$user= 'root';
$password= ''; 
$database= 'db_radiologi';
$konek= mysqli_connect($server,$user,$password,$database);
if ($konek){
		echo "";
	}else
		{							
		echo "GAGAL KONEK KE DATABASE";
}
?>
