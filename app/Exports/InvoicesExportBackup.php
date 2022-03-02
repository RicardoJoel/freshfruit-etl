<?php

namespace App\Exports;

/* From array */
use Maatwebsite\Excel\Concerns\FromArray;
/* Heading */
use Maatwebsite\Excel\Concerns\WithHeadings;
/* Value binders
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;*/
/* Auto size column */
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
/* Styling */
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
/* Ancho de columna */
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class InvoicesExportBackup /*extends StringValueBinder*/ implements FromArray, WithHeadings, /*WithCustomValueBinder,*/ ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            [
                'Información de los manifiesto', '', '', '', '', '', 
                'Información de los envíos del barco', '', '','', '', '', '', '',
                'Información del detalle', '', '', '', '', '', '', '', '', '', '', '',
                'Información de los contenedores', '', '','', '', ''
            ],
            [
                'Tipo manifiesto', 'Manifiesto', 'Nave', 'Empresa', 'Num. Detalles', 'Fecha de salida', 
                'Conocimiento', 'Cod. Detalle', 'Puerto', 'Peso manif.', 'Bultos manif.', 'Consignatario', 'Embarcador', 'Fecha de transmisión', 
                'Bultos', 'Peso bruto', 'Consignatario', 'Embarcador', 'Marcas y números', 'Descripcion de mercadería', 
                'Conteo de conteiner', 'Tamaño conteiner', 'Producto', 'Variedad', 'Presentación', 'Orgánico', 
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
            'W' => 15,
            'X' => 15,
            'Y' => 15,
            'Z' => 15,
        ];
    }

    /*public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);
            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }*/

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A:AF')->getAlignment()->setWrapText(true);        
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('G1:N1');
        $sheet->mergeCells('O1:Z1');
        $sheet->mergeCells('AA1:AF1');
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
}