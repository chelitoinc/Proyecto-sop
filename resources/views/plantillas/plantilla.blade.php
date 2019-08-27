
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('img/obraspublicas.png') }}">
      </div>
      <h1>Secretaria de Obras Publicas</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>PROJECT</span> Website development</div>
        <div><span>CLIENT</span> John Doe</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">ID</th>
            <th class="desc">Numero de Folio</th>
            <th>CODIGO</th>
            <th>MONTO</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $reporte)
          <tr>      
              <td class="service">{{ $reporte->id }}</td>
              <td class="desc">{{ $reporte->num_folio }}</td>
              <td class="unit">{{ $reporte->codigo }}</td>
              <td class="qty">{{ $reporte->importe }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
