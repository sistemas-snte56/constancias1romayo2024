<?php

namespace App\Imports;

use App\Models\Maestro;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaestrosImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // // dd($row);

        foreach ($rows as $row) {
            // Generar el código_id único
            do {
                $codigo_id = sprintf(
                    '%s-%s-%s-%s',
                    substr(md5(uniqid()), 0, 4),
                    substr(md5(uniqid()), 4, 4),
                    substr(md5(uniqid()), 8, 4),
                    substr(md5(uniqid()), 12, 4)
                );
            } while (Maestro::where('codigo_id', $codigo_id)->exists());

            // Crear el maestro con los datos y el código_id generado
            Maestro::create([
                'id_delegacion' => $row['id_delegacion'],
                'nombre' => mb_strtoupper($row['nombre'],'UTF-8'),
                'apaterno' => mb_strtoupper($row['apaterno'],'UTF-8'),
                'amaterno' => mb_strtoupper($row['amaterno'],'UTF-8'),
                'npersonal' => $row['npersonal'],
                'rfc' => mb_strtoupper($row['rfc'],'UTF-8'),
                'id_genero' => $row['id_genero'],
                'telefono' => $row['telefono'],
                'email' => $row['email'],
                'folio' => $row['folio'],
                'codigo_id' => $codigo_id,
                'codigo_qr' => $row['codigo_qr'],
            ]);
        }

    }
}
