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
                'nombre' => $row['nombre'],
                'apaterno' => $row['apaterno'],
                'amaterno' => $row['amaterno'],
                'npersonal' => $row['npersonal'],
                'rfc' => $row['rfc'],
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
