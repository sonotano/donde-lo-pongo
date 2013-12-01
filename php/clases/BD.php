<?php

class BD{
	public function conectoBD(){
		$_con=mysql_connect("localhost", "root", "")  or die($this->msg(0,"Error Conexion BD")); 
		//$_con=mssql_connect("localhost", "sa", "15101987")  or die($this->msg(0,"Error Conexion BD")); 
		$dbselected=mysql_select_db("hackaton", $_con) or die($this->msg(0,"Error Conexion BD")); 
		//mysql_set_charset('utf8');
		return $_con;
	}	
	
	public function msg($status,$txt)
	{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}


	public function damecoordenadas(){


		$sql="select Colonia,Longitud,Latitud from inegi";
		$select = mysql_query($sql);
		$i=0; //creo una variable del tipo entero
		
		while($fila=mysql_fetch_array($select))
		{
		 //insertamos en el array los datos
		$coordenadas[$i]=array("Latitud"=>$fila["Latitud"],"Longitud"=>$fila["Longitud"]);
		 $i++; //incremento
		}


		return json_encode($coordenadas);
	}
	
}//fin de la clase BD