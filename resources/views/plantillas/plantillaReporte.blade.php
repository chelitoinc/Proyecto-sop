@foreach ($reportes as $reporte)
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>System Sop Reporte</title>
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	</head>
	<body>
		<header>
			<h2>GOBIERNO DEL ESTADO DE MORELOS</h2>
			<p>SOLICITUD DE LIBERACIÓN DE RECURSOS <br>GASTO CORRIENTE</p>
			<div id="company" class="clearfix">
				<div>FOLIO: <input type="text" value="sin datos" class="folio"></div>
				<div>CODIGO:<input type="text" value="sin datos" class="codigo"></div>
			</div>
		</header>
		<main>
			<br>
			<div class="border">
				<div>
					FECHA: <input type="text" value="sin datos" class="fecha"> 
					PERIODO: <input type="text" value="sin datos" class="periodo">
					CRASIFICACIÓN FINANCIERA: <input type="text" value="sin datos" class="crasi">
				</div>
				<div>RECIBI DEL GOBIERNO DEL ESTADO DE MORELOS LA CANTIDAD DE: $<input type="text" value="sin datos" class="importe"></div>
				<div><input type="text" value="(sin datos)" class="importeletra"></div>
			</div><br>
			<div class="border1">
				<div>
					NOMBRE DEL BENEFICIARIO: <input type="text" value="sin datos" class="beneficiario">
				</div>
				<div>
					RFC: <input type="text" class="rfc" value="sin datos">
					N° BENEFICIARIO: <input class="numbene" type="text" value="sin datos">
				</div>
				<div>
					TIPO DE BENEFICIARIO: <input type="text" value="sin datos" class="tipo">
				</div>
				<div>CONCEPTO: <input  class="concepto" value="sin datos" readonly></div>
				<div>
					NUM DE PRECEDENCIA: <input type="text" class="num" value="sin datos">
					NOMBRE DE LA DEPENDENCIA <input type="text" class="nombre" value="sin datos">
				</div>
				<div>CUENTA BANCARIA DE CARGO: <input type="text" class="cuenta" value="sin datos"></div>
			</div>
			<br>
			<div class="border2">
				<center><p><strong>RESPONSABLE DEL TRÁMITE</strong></p></center>	
				<div>	
					DEPENDENCIA: <input type="text" value="sin datos" class="dependencia"> 
				</div>
				<div>	
					UNIDAD: <input type="text" value="sin datos" class="unidad">
				</div>
			</div><br>
			<table border="1">
				<thead>
					<tr>
						<th>DEPENDENCIA</th>
						<th>UNIDAD</th>
						<th>PROYECTO</th>
						<th>DESCRIPCIÓN</th>  
						<th>CLAVE DE COMPROMISO</th>
						<th>IMPORTE</th>
					</tr>
				</thead>
				<tbody>
					<tr>      
						<td>sin datos</td>
						<td>sin datos</td>
						<td>sin datos</td>
						<td>sin datos</td>
						<td>sin datos</td>
						<td>sin datos</td>
					</tr>
					<tr>
						<td colspan="5" class="total">TOTAL</td>
						<td>sin datos</td>
					</tr>
					<tr>
						<th colspan="5">DESGROSE DE DEDUCTIVAS</th>
						<th>IMPORTE</th>
					</tr>
					<tr>
						<td colspan="5">TOTAL</td>
						<td>sin datos</td>
					</tr>
				</tbody>
			</table>
			<br><br>
		</main>
		<div class="firma1">
			<p>RECIBE</p><br>
			<input type="text" value="">
			<p>PRESTACIÓN DE SERVICIOS DE CONSTRUCCIÓN INFRAESTRUCTURA Y MANTENIMIENTO URBANO SA DE CV</p>
		</div>
		<div class="firma2">
			<p>....</p><br>
			<input type="text" value="">
			<p>ENLACE FINANCIERO ADMINISTRATIVO</p>
			<p class="minimi">
				BAJO PROTESTA DE DECIR LA VERDAD MANIFIESTO QUE LA DOCUMENTACIÓN REPORTE QUE SE RELACIONA Y ANEXA, CUMPLE CON 
				TODOS LOS REQUERIMIENTOS DE LA LEY Y LOS CALCULOS DE NUMEROS SON CORRECTOS ASI MISMO LOS TRABAJOS O MATERIALES
				QUE SE CONSUGAN HAN SIDO RECIBIDOS A NUETRA ENTERA SASTISFACCIÓN
			</p>
		</div>
		<div class="firma1">
			<p>TRAMITO</p><br>
			<input type="text" value="">
			<p>PRESTACIÓN DE SERVICIOS DE CONSTRUCCIÓN INFRAESTRUCTURA Y MANTENIMIENTO URBANO SA DE CV</p>
		</div>
		<footer>
			<p style="float:right; color:black">Página 1 de 1</p>
		</footer>
	</body>
</html>