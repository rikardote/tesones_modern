<?php

namespace App\Console\Commands;

use App\Models\Cancelacion;
use App\Models\Teson;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCancelaciones extends Command
{
    protected $signature = 'tesones:import-cancelaciones';
    protected $description = 'Importa cancelaciones faltantes desde tesones.sql a la BD';

    public function handle(): int
    {
        $sqlFile = base_path('tesones.sql');

        if (! file_exists($sqlFile)) {
            $this->error("No se encontró el archivo: {$sqlFile}");

            return Command::FAILURE;
        }

        $this->info('Leyendo archivo SQL...');
        $content = file_get_contents($sqlFile);

        // Extraer todos los INSERT INTO `cancelations`
        $pattern = "/INSERT INTO `cancelations`.*?VALUES\s*(.*?);/s";
        preg_match_all($pattern, $content, $matches);

        if (empty($matches[1])) {
            $this->error('No se encontraron datos de cancelaciones en el SQL.');
            return Command::FAILURE;
        }

        $totalEnSQL = 0;
        $importados = 0;
        $yaExistentes = 0;
        $tesonNoExiste = 0;
        $errores = 0;

        // IDs de cancelaciones que ya existen
        $idsExistentes = Cancelacion::pluck('id')->flip()->toArray();

        // IDs de tesones que existen
        $tesonIds = Teson::pluck('id')->flip()->toArray();

        $this->info('Procesando cancelaciones...');
        $bar = $this->output->createProgressBar();

        foreach ($matches[1] as $block) {
            // Limpiar y dividir por filas
            $block = trim($block);
            $lines = explode("),\n", $block);

            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;

                // Limpiar paréntesis
                $line = ltrim($line, '(');
                $line = rtrim($line, '),');
                $line = rtrim($line, ';');
                $line = trim($line);
                if (empty($line)) continue;

                $totalEnSQL++;

                // Parsear: (id, teson_id, num_empleado, 'nombre', numero_cheque, 'importe', clave, 'created_at', 'updated_at')
                $parts = $this->parseLine($line);
                if (! $parts) {
                    $errores++;
                    continue;
                }

                [$id, $tesonId, $numEmpleado, $nombre, $numeroCheque, $importe, $clave, $createdAt, $updatedAt] = $parts;

                // Ya existe?
                if (isset($idsExistentes[$id])) {
                    $yaExistentes++;
                    continue;
                }

                // Tesón existe?
                if (! isset($tesonIds[$tesonId])) {
                    $tesonNoExiste++;
                    continue;
                }

                try {
                    DB::table('cancelaciones')->insert([
                        'id' => $id,
                        'teson_id' => $tesonId,
                        'num_empleado' => $numEmpleado,
                        'nombre' => $nombre,
                        'numero_cheque' => $numeroCheque,
                        'importe' => $importe,
                        'clave' => $clave,
                        'created_at' => $createdAt,
                        'updated_at' => $updatedAt,
                    ]);
                    $importados++;
                } catch (\Exception $e) {
                    $this->warn("Error al insertar ID {$id}: {$e->getMessage()}");
                    $errores++;
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newline(2);

        $this->info('=== Resumen de importación ===');
        $this->table(
            ['Total SQL', 'Ya existían', 'Tesón no existe', 'Importados', 'Errores'],
            [[$totalEnSQL, $yaExistentes, $tesonNoExiste, $importados, $errores]]
        );

        return Command::SUCCESS;
    }

    private function parseLine(string $line): ?array
    {
        // Separar usando expresión regular que respeta strings
        $parts = [];
        $current = '';
        $inString = false;
        $len = strlen($line);

        for ($i = 0; $i < $len; $i++) {
            $ch = $line[$i];

            if ($ch === "'" && ! $inString) {
                $inString = true;
                $current .= $ch;
            } elseif ($ch === "'" && $inString) {
                $inString = false;
                $current .= $ch;
            } elseif ($ch === ',' && ! $inString) {
                $parts[] = trim($current);
                $current = '';
            } else {
                $current .= $ch;
            }
        }

        if (! empty($current)) {
            $parts[] = trim($current);
        }

        if (count($parts) < 9) {
            return null;
        }

        $clean = fn($v) => trim($v, "' \t\n\r\0\x0B");

        return [
            (int) $parts[0],
            (int) $parts[1],
            (int) $parts[2],
            $clean($parts[3]),
            (int) $parts[4],
            (float) $clean($parts[5]),
            (int) $parts[6],
            $clean($parts[7]),
            $clean($parts[8]),
        ];
    }
}
