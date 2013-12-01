<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript">
		damecoordenadas();


		function damecoordenadas(){


			$.ajax({
					type: "POST",
					url: "php/conecta.php",
					dataType: "json",
					success: function(msg){
							i=0;

						while(msg[i].Latitud){


							console.log("Latitud:"+formatocoordenada(msg[i].Latitud)+"  Longitud:"+formatocoordenada(msg[i].Longitud));
							i++;
						}
					}
				});

		}

	function formatocoordenada(coordenada){

		str="";
		count=1;
		for(a=coordenada.length;a>=0;a--){


			if(count==1)str='"'+str;
			str=coordenada.charAt(a)+""+str;
			if(count==3)str="'"+str;
			if(count==5)str="°"+str;
			count++;
		}
		return str;
		


	}



		</script>
	</head>
	<body>

		<input type="text" id="coordenadas"  value="">
	</body>
</html>