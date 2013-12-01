<html>
	<head>
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


							console.log("LAtitud:"+msg[i].Latitud+"  Altittud:"+msg[i].Altitud);
							i++;
						}
					}
				});

		}





		</script>
	</head>
	<body>

		<input type="text" id="coordenadas"  value="">
	</body>
</html>