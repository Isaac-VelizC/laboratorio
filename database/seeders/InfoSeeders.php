<?php

namespace Database\Seeders;

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
            'meta_value' => 'uploads/logo-1689027717.png',
        ]);
        SystemInfo::create([
            'id' => 10,
            'meta_field' => 'form',
            'meta_value' => '<table style="border-collapse: collapse; width: 99.9726%; height: 100.125px;" border="1"><colgroup><col style="width: 34.5726%;"><col style="width: 22.6604%;">
           <tbody>
           
           <tr style="height: 18.6625px;">
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;"><span style="font-size: 10pt; font-family: arial, helvetica, sans-serif;">Doctor</span></td>
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">F. Petici&oacute;n</td>
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">Edad</td>
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">N&deg; Consulta</td>
           
           </tr>
           
           <tr style="height: 10px;">
           
           <td style="height: 10px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 10px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 10px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 10px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           </tr>
           
           <tr style="height: 18.6625px;">
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;"><span style="font-size: 10pt; font-family: arial, helvetica, sans-serif;">Nombre del pacien
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">N&deg; Asegurado</td>
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">Sexo</td>
           
           <td style="height: 18.6625px; text-align: center; line-height: 1.1;">N&deg; Historia</td>
           
           </tr>
           
           <tr style="height: 17.6px;">
           
           <td style="height: 17.6px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 17.6px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 17.6px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           <td style="height: 17.6px; text-align: center; line-height: 1.1;">&nbsp;</td>
           
           </tr>
           
           <tr style="height: 17.6px;">
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">Origen</td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">Entidad</td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">Cliente</td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">N&deg; Orden</td>
           
           </tr>
           
           <tr style="height: 17.6px;">
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;"><strong>LABORATORIOS PEREZ</strong></td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;"><strong>LABORATORIOS PEREZ</strong></td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">&nbsp;</td>
           
           <td style="text-align: center; line-height: 1.1; height: 17.6px;">&nbsp;</td>
           
           </tr>
           
           </tbody>
           
           </table>',
        ]);
    }
}
