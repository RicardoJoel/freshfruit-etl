<?php

namespace App\Exports\Sheets;

/* Array */
use Maatwebsite\Excel\Concerns\FromArray;
/* Auto size column */
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
/* Column width */
use Maatwebsite\Excel\Concerns\WithColumnWidths;
/* Heading */
use Maatwebsite\Excel\Concerns\WithHeadings;
/* Title */
use Maatwebsite\Excel\Concerns\WithTitle;
/* Styling */
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesPerSheet implements FromArray, ShouldAutoSize, WithColumnWidths, WithHeadings, WithTitle, WithStyles
{
    private $title, $array;

    public function __construct(string $title, array $array)
    {
        $this->title = $title;
        $this->array = $array;
    }

    public function array(): array
    {
        return $this->array;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return [
            [
                'Información de los manifiesto', '', '', '', '', '', 
                'Información de los envíos del barco', '', '','', '', '', '', '',
                'Información del detalle', '', '', '', '', '', '', '', '', '', '', //'',
                'Información de los contenedores', '', '','', '', ''
            ],
            [
                'Tipo manifiesto', 'Manifiesto', 'Nave', 'Empresa', 'Num. Detalles', 'Fecha de salida', 
                'Conocimiento', 'Cod. Detalle', 'Puerto', 'Peso manif.', 'Bultos manif.', 'Consignatario', 'Embarcador', 'Fecha de transmisión', 
                'Bultos', 'Peso bruto', 'Consignatario', 'Embarcador', 'Marcas y números', 'Descripcion de mercadería', 
                'Conteo de conteiner', /*'Tamaño conteiner',*/ 'Producto', 'Variedad', 'Presentación', 'Orgánico', 
                'Número', 'Tamaño', 'Condición', 'Tipo', 'Operador', 'Tara'
            ]
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'D' => 40,
            'L' => 40,
            'M' => 40,
            'N' => 15,
            'Q' => 40,
            'R' => 40,
            'S' => 20,
            'T' => 40,
            'V' => 15,
            'W' => 15,
            'X' => 15,
            'Y' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A:AF')->getAlignment()->setWrapText(true);        
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('G1:N1');
        $sheet->mergeCells('O1:Y1');
        $sheet->mergeCells('Z1:AE1');
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
}