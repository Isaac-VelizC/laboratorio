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
            <table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Historia</td></tr><tr><td>&nbsp; Tarea Completo </td><td>&nbsp; 232</td><td>&nbsp; 18</td><td>&nbsp; 79</td></tr><tr><td>Nombre del Paciente</td><td>N° Asegurado</td><td>Sexo</td><td>N° Consulta</td></tr><tr><td>&nbsp; Roberto Bolaños Gomez</td><td>&nbsp; 765</td><td>&nbsp; Masculino</td><td>&nbsp; 876</td></tr><tr><td>Origén</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIO PEREZ</strong></td><td><strong>LABORATORIO PEREZ</strong></td><td>&nbsp; 97</td><td>&nbsp; 45</td></tr></tbody></table></figure><p>&nbsp;</p><figure class="table"><table><tbody><tr><td><strong>Inmunología</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Determinación</td><td>Resultado</td><td>Unidades</td><td>Valores de Referencia</td><td>!</td></tr><tr><td><strong>Resultado Toxoplasmosis IgM</strong></td><td><strong>87</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Cut Off</td><td><strong>98</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Conclusión</td><td colspan="4"><strong>La muestra&nbsp; Simio &nbsp;presenta Anticuerpos de tipo IgM contra Toxoplasma Gondii.</strong></td></tr><tr><td><strong>Resultado Toxoplasmosis IgG</strong></td><td><strong>23</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Cut Off</td><td><strong>12 &nbsp;</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Conclusión</td><td colspan="4"><strong>La muestra&nbsp; Simio &nbsp;presenta Anticuerpos de tipo IgG contra Toxoplasma Gondii.</strong></td></tr><tr><td colspan="5"><strong>YIH Prueba Rápida</strong></td></tr><tr><td colspan="5">&nbsp;Método: Prueba Rápida de detección de anticuerpos contra VIH.</td></tr><tr><td colspan="5"><strong>asi es  &nbsp; contra el virus de inmunodeficiencia humana.</strong></td></tr><tr><td><strong>Reagina Plasmática Rápida. (R.P.R.)</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan="5">Método: Aglutinación Látex cuantitativo.</td></tr><tr><td colspan="5"><strong>End Fin</strong></td></tr></tbody></table></figure>
            ',
        ]);

        ImagenFile::create(['path' => 'cover1.png',]);
        ImagenFile::create(['path' => 'cover2.png']);
    }
}
