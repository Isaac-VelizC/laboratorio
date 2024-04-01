<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <table class="mb3" style="margin: 0 auto;">
                <thead>
                   <tr>
                       <th colspan="3">{{ $name }}</th>
                   </tr>
                   <tr>
                       <th colspan="3">{{ now() }}</th>
                   </tr>
                   <tr>
                       <th colspan="3">
                        Cliente: {{ isset($cita->client) ? $cita->client->user->nombres .' '. $cita->client->user->apellido_pa.' '. $cita->client->user->apellido_ma :"" }}<br />
                        NIT: {{ $cita->client->user->ci }}
                       </th>
                   </tr>
               </thead>
               <tbody>
                    @php
                        $totalCost = 0;
                    @endphp
                    @foreach ($cita->pruebas as $item)
                        <tr class="top">
                            <td colspan="3">{{ $item->test->name }}</td>
                        </tr>
                        <tr class="ttu">
                            <td colspan="2">Monto</td>
                            <td align="right">{{ number_format($item->test->cost ,2) }}bs.</td>
                        </tr>
                        @php
                            $totalCost += $item->test->cost;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="sup ttu p--0">
                        <td colspan="3">
                            <b>Total</b>
                        </td>
                    </tr>
                    <tr class="ttu">
                        <td colspan="2">Sub-total</td>
                        <td align="right">{{ number_format($totalCost, 2) }}bs.</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</body>
</html>