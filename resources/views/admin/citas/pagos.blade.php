<div class="modal fade" id="modal_show_pago">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario de Pago</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"">
                        <table class="mb3">
                            <thead>                    
                                @php
                                    $name = \App\Models\SystemInfo::find(3);
                                @endphp
                               <tr>
                                   <th class="title text-center" colspan="3">{{ $name->meta_value }}</th>
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
                        <div class="text-center gap-2">
                            <a type="button" href="{{ route('admin.pdf.pago', $cita->id) }}" class="btn btn-secondary">Imprimir</a>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>