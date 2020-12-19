<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExcelImport implements WithStartRow, ToCollection
{
    use Importable;

    public function startRow(): int
    {
        return 1;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
