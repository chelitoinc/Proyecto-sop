@foreach ($reportes as $reporte)
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>System Sop Reporte</title>
		<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
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

				body {
					position: relative;
					padding: 5px;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 10px;
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
					width: 90%;
				}

				.beneficiario {
					width: 70%;
				}

				.rfc {
					width: 30%;
				}

				.numbene {
					width: 30%;
				}

				.nombre {
					width: 25%;
				}

				.tipo {
					width: 70%;
				}

				.concepto {
					width: 80%;
					height: 35px;
					text-align: justify;
					border: 1px solid #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 10px;
					float: right;
					margin-right: 1cm;
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


				/* Bloques div*/

				.border {
					margin: 5px;
					padding: 5px;
					height: 60px;
					border: 1px solid #000;
					text-align:justify;
				}

				.border1 {
					margin: 5px;
					padding: 5px;
					height: 173px;
					border: 1px solid #000;
				}

				.border2 {
					margin: 5px;
					padding: 5px;
					height: 85px;
					border: 1px solid #000;
				}

				.firma1 {
					width: 40%;
					text-align: center;
					float: left;
				}

				.firma1 input {
					width: 90%;
				}

				.firma2 {
					width: 40%;
					text-align: center;
					float: right;
				}
				.firma1, .firma2, .firma3, p {
					font-family: Arial, Helvetica, sans-serif;
					font-size: 10px;
				}

				.firma2 input {
					width: 90%;
				}

				.firma3 {
					width: 40%;
					display: block;
					text-align: center;
					float: left;
				}

				.firma3 input {
					width: 90%;
				}

				.minimi {
					text-align: center;
					font-size: 9px;
				}

				#project {
					float: left;
					margin: 5px;
					padding: 5px;
				}

				#project span {
					color: #5D6975;
					text-align: right;
					width: 52px;
					margin-right: 10px;
					display: inline-block;
					font-size: 10px;
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
					color: #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 10px;

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
					text-align: center;
				}

				

				#notices .notice {
					color: #5D6975;
					font-size: 1.2em;
				}

				#company{
					float: left;
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

				.scape{
					margin: 0 auto;
					padding: 0 auto
				}

			</style>
			<h2>GOBIERNO DEL ESTADO DE MORELOS</h2>
			<p>SOLICITUD DE LIBERACIÓN DE RECURSOS <br>GASTO CORRIENTE</p>
			<div id="company" >
				<div>FOLIO: <span class="folio">{{ $reporte->num_folio }}</span></div>
				<div>CODIGO: <span class="codigo">{{ $reporte->codigo }}</span> </div>   
			</div>
		</header>
		<main>
			<div class="border">
				<div>
				 	FECHA: <span class="fecha">{{ $reporte->fecha }} </span> 
					PERIODO: <span class="perido">{{ $reporte->periodo }}</span>
					CRASIFICACIÓN FINANCIERA: <span class="crasi">PROVEEDOR{{-- {{ $reporte->clasi_financiera }} --}}</span>
				</div><br>


				<div>RECIBI DEL GOBIERNO DEL ESTADO DE MORELOS LA CANTIDAD DE: $<span class="importe">{{ $sumas }} </span></div>
				<div><input type="text" value="{{ $cifraLetras }} " class="importeletra"></div>
			</div><br>

				
			<div class="border1">
				<div>
					<br>
					NOMBRE DEL BENEFICIARIO: <input type="text" value="{{ $reporte->beneficiario }}" class="beneficiario">
				</div>
				<div>
					RFC: <input type="text" class="rfc" value="{{ $reporte->rfc }}">
					N° BENEFICIARIO: <input class="numbene" type="text" value="{{ $reporte->num_beneficiario }}">
				</div>
				<div>
					TIPO DE BENEFICIARIO: <input type="text" value="{{ $reporte->tipo }}" class="tipo">
				</div>
				<div>CONCEPTO: <textarea name="conepto" class="concepto">{{ $reporte->concepto }}</textarea> </div>
				<br><div><div class="div clearfix">. <br><br></div>
					NUM DE PRECEDENCIA: <input type="text" class="num" value="{{ $reporte->num_beneficiario }}">
					NOMBRE DE LA DEPENDENCIA <input type="text" class="nombre" value="{{ $reporte->nom_procedencia }}">
				</div>
				<div>CUENTA BANCARIA DE CARGO: <input type="text" class="cuenta" value="{{ $reporte->cuenta_bancaria }}"></div>
			</div>
			<br>
			<div class="border2">
				<center><p><strong>RESPONSABLE DEL TRÁMITE</strong></p></center>	
				<div>	
					DEPENDENCIA: <input type="text" value="0{{ $reporte->num_dependencia }} {{ $reporte->dependencia }}" class="dependencia"> 
				</div>
				<div>	
					UNIDAD: <input type="text" value="0{{ $reporte->num_unidad }} {{ $reporte->unidad }}" class="unidad">
				</div>
			</div><br>
@endforeach

			<table border="1" id="miTabla">
				<thead>
					<tr>
						<th>DEPENDENCIA</th>
						<th>UNIDAD</th>
						<th>PROYECTO</th>
						<th>PARTIDA</th>
						<th style="width: 50%">DESCRIPCIÓN</th>  
						<th style="width: 5%">CLAVE DE COMPROMISO</th> 
						<th>IMPORTE</th>
					</tr>
				</thead>
				<tbody>
						 
					@foreach ($tables as $table)
					<tr>
						<td>0{{ $table->num_dependencia }}</td>
						<td>0{{ $table->num_unidad }}</td>
						<td>0{{ $table->num_proyecto }} </td>
						<td>{{ $table->codigo_p }}</td>
						<td>{{ $table->descripcion_p }}</td>
						<td></td>
						<td>${{ number_format($table->importe,2) }}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="6" class="total">TOTAL</td>
						<td> ${{ $sumas }}</td>	
					</tr>
					<tr>
						<th colspan="6">DESGROSE DE DEDUCTIVAS</th>
						<th>IMPORTE</th>
					</tr>
					<tr>
						<td colspan="6">TOTAL</td>
						<td></td>
					</tr>
					
				</tbody>
			</table>


		</main>
		<div class="firma1">
			<p>RECIBE</p><br>
			<input type="text" value="">
			<p>Nombre de quien recibe</p>
		</div>
		<div class="firma2">
			<p>SOLICITA</p> <br>
			<input type="text" value="">
			<p>Nombre de quien solicita</p>
			<p class="minimi">
				BAJO PROTESTA DE DECIR LA VERDAD MANIFIESTO QUE LA DOCUMENTACIÓN REPORTE QUE SE RELACIONA Y ANEXA, CUMPLE CON 
				TODOS LOS REQUERIMIENTOS DE LA LEY Y LOS CALCULOS DE NUMEROS SON CORRECTOS ASI MISMO LOS TRABAJOS O MATERIALES
				QUE SE CONSUGAN HAN SIDO RECIBIDOS A NUETRA ENTERA SASTISFACCIÓN
			</p>
		</div>
		<div class="clearfix"> </div>
		<div class="firma3">
				<p>TRAMITO</p><br><br>
				<input type="text" value="">
				<p>Nombre de quien tramito</p>
			</div>
		<footer>
			<p style="float:right; color:black">Página 1 de 1</p>
		</footer>
	</body>
</html>

<script type="text/javascript">
	/* SUMAR CELDAS DE miTabla */
		/* Formato a numeros */
    var formatNumber = {
        separador: ",", // separador para los miles
        sepDecimal: '.', // separador para los decimales
        formatear:function (num){
            num +='';
            var splitStr = num.split('.');
            var splitLeft = splitStr[0];
            var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
            var regx = /(\d+)(\d{3})/;
            while (regx.test(splitLeft)) {
                splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
            }
            return this.simbol + splitLeft +splitRight;
        },
        new:function(num, simbol){
            this.simbol = simbol ||'';
            return this.formatear(num);
        }
    }
    /* Fin */
    /* FIN */
</script>