@foreach ( $reportes as $reporte )
	
@endforeach

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>System Sop Reporte</title>
	</head>
	<body>
			<style>
					.clearfix:after {
						content: "";
						display: table;
						clear: both;
					}
		
					a {
						color: #5D6975;
						text-decoration: underline;
					}
		
		
					/*  */
					*{
						font-size:12px;
						font-family: Arial;
					}
		
					body {
						position: relative;
						margin: 0 auto;
						font-size: 12px;
						font-family: Arial;
					}
		
					header {
						padding: 10px 0;
						margin-bottom: 30px;
					}
		
					#logo {
						text-align: center;
						margin-bottom: 10px;
					}
		
					#logo img {
						width: 320px;
					}
		
					input {
						margin: 1px;
						padding: 3px;
						border: none;
						text-align: center;
						border-bottom: 1px solid #000;
					}
		
					.folio {
						width: 100px;
					}
		
					.codigo {
						width: 100px;
					}
		
					.fecha {
						width: 80px;
					}
		
					.periodo {
						width: 100px;
					}
		
					.crasi {
						width: 280px;
					}
		
					.importe {
						width: 358px;
					}
		
					.importeletra {
						margin: 0px auto;
						display: block;
						width: 96%;
					}
		
					.beneficiario {
						width: 75%;
					}
		
					.rfc {
						width: 30%;
					}
		
					.numbene {
						width: 30%;
					}
		
					.nombre {
						width: 31%;
					}
		
					.tipo {
						width: 79%;
					}
		
					.concepto {
						margin: 10px;
						width: 86%;
						height: 47px;
						text-align: justify;
						border: 1px solid #000;
					}
		
					.cuenta {
						width: 72%;
					}
		
					.dependencia {
						width: 83%;
					}
		
					.unidad {
						width: 88%;
					}
		
		
					/* TABLA */
		
					.border {
						margin: 0;
						width: 100%;
						height: 85px;
						border: 1px solid #000;
						font-family: Arial, Helvetica, sans-serif;
						font-size: 12px;
					}
		
					.border1 {
						height: 205px;
						border: 1px solid #000;
					}
		
					.border2 {
						height: 89px;
						border: 1px solid #000;
					}
		
					.firma1 {
						width: 40%;
						text-align: center;
						float: left;
					}
		
					.firma1 input {
						width: 100%;
					}
		
					.firma2 {
						width: 40%;
						text-align: center;
						float: right;
					}
		
					.firma2 input {
						width: 100%;
					}
		
					.minimi {
						text-align: center;
						font-size: 9px;
					}
		
					#project {
						float: left;
					}
		
					#project span {
						color: #5D6975;
						text-align: right;
						width: 52px;
						margin-right: 10px;
						display: inline-block;
						font-size: 0.8em;
					}
		
					#company {
						float: right;
						text-align: right;
					}
		
					#project div,
					#company div {
						white-space: nowrap;
					}
		
					table {
						border-collapse: collapse;
						border-spacing: 0;
						margin-bottom: 20px;
						margin: 10px;
						padding: 10px;
						color: #000;
					}
		
					table tr:nth-child(2n-1) td {
						background: white;
					}
		
					table th,
					table td {
						text-align: center;
					}
		
					table th {
						padding: 5px 20px;
						border-bottom: 1px solid #C1CED9;
						font-weight: normal;
						background: gray;
					}
		
					table .service,
					table .desc {
						text-align: left;
					}
		
					table td {
						padding: 5px;
						text-align: right;
					}
		
					table td.service,
					table td.desc {
						vertical-align: top;
					}
		
					table td.unit,
					table td.qty,
					table td.total {
						font-size: 1.2em;
					}
		
					table td.grand {
						border-top: 1px solid #5D6975;
						;
					}
		
					#notices .notice {
						color: #5D6975;
						font-size: 1.2em;
					}
		
					footer {
						color: #5D6975;
						width: 100%;
						height: 30px;
						position: absolute;
						bottom: 0;
						padding: 8px 0;
						text-align: center;
					}
				</style>
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