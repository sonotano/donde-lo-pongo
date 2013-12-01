3<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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


							//console.log("Latitud:"+formatocoordenada(msg[i].Latitud, "Latitud")+"  Longitud:"+formatocoordenada(msg[i].Longitud, "Longitud"));
							i++;
						}
					}
				});

		}

	function formatocoordenada(coordenada, tipo){
		str1= "";
		str2="";
		str3="";
		valor = 0;
		
		if (coordenada.length == 6) {
			if (tipo == "Longitud")
		    alert(coordenada);
			str1= coordenada.substring(0,2);
			str2= coordenada.substring(2,4);
			
			str3= coordenada.substring(4,6);
		}
		
		if (coordenada.length == 7) {
			str1= coordenada.substring(0,3);
			str2= coordenada.substring(3,5);
			str3= coordenada.substring(5,7);
		}
		
		
		
		/*console.log(str1);
		console.log(str2);
		console.log(str3);*/
		
		int1 = parseInt(str1);
		int2 = parseInt(str2); 
		int3 = parseInt(str3);
		
		//console.log(int1+((int2*100)/60/100)+(int3*10000/3600/10000));
		
		
		valor = int1+((int2*100)/60/100)+(int3*10000/3600/10000);
		if (tipo == "Longitud") valor = valor * -1;
		
		return valor;


	}
	
	function initialize(coords) {
        
								
		$.ajax({
					type: "POST",
					url: "php/conecta.php",
					dataType: "json",
					success: function(msg){
							i=0;
							
							var point1 = 0;
							var point2 = 0;
							if (coords == '') {
								point1 = 29.0891857;
								point2 = -110.9613299;
								point3 = 29.0893;
								point4 = -110.9613299;
							} else {
								scoords = (String(coords)).split(",")
								point1 = scoords[0].replace('(', '').trim();
								point2 = scoords[1].replace(')', '').trim();
							}
							// var latLng = new google.maps.LatLng(point1, point2);
							//alert(coords);
        
							var latLng = new google.maps.LatLng(point1, point2);
							var latLng2 = new google.maps.LatLng(point3, point4);
							//var latLng = new google.maps.LatLng(29.04347535654008, -110.87468477499988);
							var map = new google.maps.Map(document.getElementById('mapCanvas'), {
								zoom: 10,
								center: latLng2,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							});

        
		

							var marker = new google.maps.Marker({
									position: latLng,
									title: 'Point A',
									map: map,
									draggable: true
							});

							var marker2 = new google.maps.Marker({
								position: latLng2,
								title: 'Point B',
								map: map,
								draggable: true
							});
		
							var marcadores = [];

							while(msg[i].Latitud){
							
								
								var marcador = new google.maps.Marker({
						
								position: new google.maps.LatLng(formatocoordenada(msg[i].Latitud, "Latitud"), formatocoordenada(msg[i].Longitud, 'Longitud')),
								map: map
								});
								
								marcadores.push(marcador);
								//console.log("Latitud:"+formatocoordenada(msg[i].Latitud, "Latitud")+"  Longitud:"+formatocoordenada(msg[i].Longitud, "Longitud"));
								i++;
							}
						
						for (var i = 0, length = marcadores.length; i < length; i++) {
							marcadores[i].setVisible(true);
						}
						
						// Add dragging event listeners.
						google.maps.event.addListener(marker, 'dragstart', function () {
							updateMarkerAddress('Dragging...');
						});

						google.maps.event.addListener(marker, 'drag', function () {
							updateMarkerStatus('Dragging...');
							updateMarkerPosition(marker.getPosition());
						});

						google.maps.event.addListener(marker, 'dragend', function () {
							updateMarkerStatus('Drag ended');
							geocodePosition(marker.getPosition());
						});
					}
					
				
				

        
				
				});
				

        
        
    }

		initialize('');

		</script>
	</head>
	<body>

		<input type="text" id="coordenadas"  value="">
		<div id="mapCanvas" style="width: 1100px; height: 800px;"></div>
	</body>
</html>