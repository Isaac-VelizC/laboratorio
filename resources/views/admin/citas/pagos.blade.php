<div class="modal fade" id="modal_show_pago">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario de Pago</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="printer-ticket">
                            <thead>
                               <tr>
                                   <th class="title" colspan="3">SIS-LABORATORIO PEREZ</th>
                               </tr>
                               <tr>
                                   <th colspan="3">{{ now() }}</th>
                               </tr>
                               <tr>
                                   <th colspan="3">
                                    Nombre Cliente: {{ isset($cita->client) ? $cita->client->user->nombres .' '. $cita->client->user->apellido_pa.' '. $cita->client->user->apellido_ma :"" }}<br />
                                    NIT: {{ $cita->client->user->ci }}
                                   </th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach ($cita->pruebas as $item)
                                <tr class="top">
                                    <td colspan="3">{{ $item->test->name }}</td>
                                </tr>
                                <tr class="ttu">
                                    <td colspan="2">Monto</td>
                                    <td align="right">{{ number_format($item->test->cost ,2) }}bs.</td>
                                </tr>
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
                                   <td align="right">Sumabs.</td>
                               </tr>
                               <tr class="sup">
                                   <td colspan="3" align="center">
                                       <b>Pedido:</b>
                                   </td>
                               </tr>
                               <tr class="sup">
                                   <td colspan="3" align="center">
                                       www.site.com
                                   </td>
                               </tr>
                           </tfoot>
                        </table>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary">Imprimir</button>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>