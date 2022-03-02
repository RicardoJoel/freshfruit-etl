<?php

namespace App\Exports;

/* Hojas multiples */
//use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\InvoicesPerSheet;

class InvoicesExport implements WithMultipleSheets
{
    //use Exportable;
    protected $success, $failed;

    public function __construct(array $success, array $failed)
    {
        $this->success = $success;
        $this->failed = $failed;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            new InvoicesPerSheet('Productos encontrados', $this->success), 
            new InvoicesPerSheet('Productos sin encontrar', $this->failed)
        ];
    }
}