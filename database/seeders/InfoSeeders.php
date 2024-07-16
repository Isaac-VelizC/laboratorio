<?php

namespace Database\Seeders;

use App\Models\ImagenFile;
use App\Models\SystemInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // database/seeders/SystemInfoSeeder.php
        SystemInfo::create([
            'meta_field' => 'name',
            'meta_value' => 'Sistema de Laboratorio Clínico',
        ]);
        SystemInfo::create([
            'meta_field' => 'cover',
            'meta_value' => 'uploads/cover-1690914540.png',
        ]);
        SystemInfo::create([
            'meta_field' => 'short_name',
            'meta_value' => 'SIS-LABORATORIO',
        ]);
        SystemInfo::create([
            'meta_field' => 'user_avatar',
            'meta_value' => 'uploads/user_avatar.jpg',
        ]);
        SystemInfo::create([
            'meta_field' => 'logo',
            'meta_value' => 'uploads/1706040611.png',
        ]);
        SystemInfo::create([
            'id' => 10,
            'meta_field' => 'form',
            'meta_value' => '
            <figure class="table">
<table>
<tbody>
<tr>
<td><strong>Doctor</strong></td>
<td><strong>F. Petici&oacute;n</strong></td>
<td><strong>Edad</strong></td>
<td><strong>N&deg; Historia</strong></td>
</tr>
<tr>
<td>&nbsp;#nombreDoctor</td>
<td>#ePeticion</td>
<td>&nbsp;#edad</td>
<td>&nbsp;#nHistoria</td>
</tr>
<tr>
<td><strong>Nombre del Paciente</strong></td>
<td><strong>N&deg; Asegurado</strong></td>
<td><strong>Sexo</strong></td>
<td><strong>N&deg; Consulta</strong></td>
</tr>
<tr>
<td>&nbsp;#paciente</td>
<td>&nbsp;#asegurado</td>
<td>&nbsp;#sexo</td>
<td>&nbsp;#consulta</td>
</tr>
<tr>
<td><strong>Orig&eacute;n</strong></td>
<td><strong>Entidad</strong></td>
<td><strong>Cliente</strong></td>
<td><strong>N&deg; Orden</strong></td>
</tr>
<tr>
<td>Laboratorio Perez</td>
<td>Laboratorio Perez</td>
<td>&nbsp; #cliente</td>
<td>&nbsp;#nOrden</td>
</tr>
</tbody>
</table>
</figure>
<p>&nbsp;</p>
<figure class="table">
<table>
<tbody>
<tr>
<td><strong>Determinai&oacute;n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></td>
<td><strong>Resultado&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></td>
<td><strong>Unidades&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></td>
<td><strong>Valores de Referencia</strong></td>
<td><strong>!&nbsp;</strong> &nbsp; &nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><strong>&nbsp;&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</figure>',
        ]);

        ImagenFile::create(['path' => 'cover1.png',]);
        ImagenFile::create(['path' => 'cover2.png']);
    }
}
