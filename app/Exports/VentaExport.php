<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Para que las columnas se ajusten
use Maatwebsite\Excel\Concerns\WithStyles;     // Para estilos (negritas, etc)
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VentaExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $ventas;

    // Constructor para recibir los datos filtrados
    public function __construct($ventas)
    {
        $this->ventas = $ventas;
    }

    // Carga la vista blade
    public function view(): View
    {
        return view('exports.ventas_excel', [
            'ventas' => $this->ventas
        ]);
    }

    // Estilos opcionales (pero recomendados)
    public function styles(Worksheet $sheet)
    {
        return [
            // Pone la fila 1 (Título) en negrita y tamaño 16
            1 => ['font' => ['bold' => true, 'size' => 16]],
            // Pone la fila 4 (Encabezados) en negrita
            4 => ['font' => ['bold' => true]],
        ];
    }
}