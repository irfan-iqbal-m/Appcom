<?php

namespace App\Exports;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataExport implements FromArray, WithHeadings, WithStyles
{
    protected $datas;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function array(): array
    {
        return $this->datas->map(function ($data, $index) {
            return [
                $index + 1,
                $data->title,
                $data->title,
                $data->description,
                $data->category->title ?? '',
                $data->start_date,
                $data->end_date
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return ['S No', 'Title', 'Description', 'Category', 'Start Date', 'End Date'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
