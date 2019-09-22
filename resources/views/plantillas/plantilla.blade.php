@foreach ($reportes as $reporte)
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>System Sop Reporte</title>
	</head>
	<body>
		<header>
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
					width: 10px;
				}

				.codigo {
					width: 10px;
				}

				.fecha {
					width: 80px;
					
				}
				
				span{
					text-decoration: underline;	
				}

				.periodo {
					width: 100px;
				}

				.crasi {
					width: 210px;
				}

				.importe {
					width: 50pxpx;
				}

				.importeletra {
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
					height: 80px;
					padding: 1px;
					border: 1px solid #000;
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
			<h2>GOBIERNO DEL ESTADO DE MORELOS</h2>
			<p>SOLICITUD DE LIBERACIÓN DE RECURSOS <br>GASTO CORRIENTE</p>
			<div id="company" >
				<div>FOLIO: <span class="folio">{{ $reporte->num_folio }}</span></div>
				<div>CODIGO:{{ $reporte->codigo }}</div>   
			</div>
		</header>
		<main>
			<br>
			<div class="border">
				<div>
					FECHA: <span class="fecha">{{ $reporte->fecha }} </span> 
					PERIODO: <span class="perido">{{ $reporte->periodo }}</span>
					CRASIFICACIÓN FINANCIERA: <span class="crasi">{{ $reporte->clasi_financiera }}</span>
				</div><br>
				<div>RECIBI DEL GOBIERNO DEL ESTADO DE MORELOS LA CANTIDAD DE: $<span class="importe">{{ $reporte->importe }}</span></div>
				<div><input type="text" value="({{ $reporte->importe_letra }})" class="importeletra"></div>
			</div><br>
			<div class="border1">
				<div>
					NOMBRE DEL BENEFICIARIO: <input type="text" value="{{ $reporte->beneficiario }}" class="beneficiario">
				</div>
				<div>
					RFC: <input type="text" class="rfc" value="{{ $reporte->rfc }}">
					N° BENEFICIARIO: <input class="numbene" type="text" value="{{ $reporte->num_beneficiario }}">
				</div>
				<div>
					TIPO DE BENEFICIARIO: <input type="text" value="{{ $reporte->tipo }}" class="tipo">
				</div>
				<div>CONCEPTO: <input  class="concepto" value="{{ $reporte->concepto }}" readonly></div>
				<div>
					NUM DE PRECEDENCIA: <input type="text" class="num" value="{{ $reporte->num_procedencia }}">
					NOMBRE DE LA DEPENDENCIA <input type="text" class="nombre" value="{{ $reporte->nom_procedencia }}">
				</div>
				<div>CUENTA BANCARIA DE CARGO: <input type="text" class="cuenta" value="{{ $reporte->cuenta_bancaria }}"></div>
			</div>
			<br>
			<div class="border2">
				<center><p><strong>RESPONSABLE DEL TRÁMITE</strong></p></center>	
				<div>	
					DEPENDENCIA: <input type="text" value="{{ $reporte->dependencia }}" class="dependencia"> 
				</div>
				<div>	
					UNIDAD: <input type="text" value="{{ $reporte->unidad }}" class="unidad">
				</div>
			</div><br>
			<table border="1">
				<thead>
					<tr>
						<th>DEPENDENCIA</th>
						<th>UNIDAD</th>
						<th>PROYECTO</th>
						<th>PARTIDA</th>
						<th>DESCRIPCIÓN</th>  
						<th>CLAVE DE COMPROMISO</th>
						<th>IMPORTE</th>
					</tr>
				</thead>
				<tbody>
					<tr>      
						<td>{{ $reporte->num_dependencia }}</td>
						<td>{{ $reporte->num_unidad }}</td>
						<td>{{ $reporte->num_proyecto }}</td>
						<td>{{ $reporte->codigo_p }}</td>
						<td>{{ $reporte->nombre_p }}</td>
						<td></td>
						<td>{{ $reporte->importe }}</td>
					</tr>
					<tr>
						<td colspan="6" class="total">TOTAL</td>
						<td>{{ $reporte->importe }}</td>
					</tr>
					<tr>
						<th colspan="6">DESGROSE DE DEDUCTIVAS</th>
						<th>IMPORTE</th>
					</tr>
					<tr>
						<td colspan="6">TOTAL</td>
						<td>{{ $reporte->importe }}</td>
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
@endforeach