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


		$sql="select Colonia,Longitud,Latitud,NivelSocioeconomico,Masculino,Femenino,((1*(PobMasc0a2  + PobMasc3a5  + PobMasc6a11 +PobFem0a2 +  PobFem3a5 +  PobFem6a11))/ PoblacionTotal) as porcentajeninos,((1*(PobMasc12a14 +PobMasc15a17+PobMasc18a24+PobFem12a14 +PobFem15a17+PobFem18a24))/ PoblacionTotal) as porcentajeadolescentes,((1*(PobMasc60ymas + PobFem60ymas))/ PoblacionTotal) as porcentajeadultos,( (1*(PobMasc0a2  + PobMasc3a5  + PobMasc6a11 ))/ PoblacionTotal+ (1*(PobFem0a2 +  PobFem3a5 +  PobFem6a11))/ PoblacionTotal  + (1*(PobMasc12a14 +PobMasc15a17+PobMasc18a24))/ PoblacionTotal + (1*(PobFem12a14 +PobFem15a17+PobFem18a24))/ PoblacionTotal  + (1*(PobMasc60ymas))/ PoblacionTotal + (1*(PobFem60ymas))/ PoblacionTotal) as poblacionobjetivo from inegi where NivelSocioeconomico=2 order by poblacionobjetivo desc";
		$select = mysql_query($sql);
		$i=0; //creo una variable del tipo entero
		
		while($fila=mysql_fetch_array($select))
		{
		 //insertamos en el array los datos
		$coordenadas[$i]=array("Latitud"=>$fila["Latitud"],"Longitud"=>$fila["Longitud"],"NivelSocioeconomico"=>$fila["NivelSocioeconomico"],"Masculino"=>$fila["Masculino"],"Femenino"=>$fila["Femenino"],"Ninos"=>$fila["porcentajeninos"],"Adolescentes"=>$fila["porcentajeadolescentes"],"Adultos"=>$fila["porcentajeadultos"]);
		 $i++; //incremento
		}


		return json_encode($coordenadas);
	}
	
}//fin de la clase BD