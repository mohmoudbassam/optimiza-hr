<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SummaryExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'user',
            'hours',
            'percentage',
            'paid',
            'project',
            'company',
        ];
    }

    public function map($row): array
    {
        return [
            $row['data']['user'],
            $row['data']['hours'],
            $row['data']['percentage'],
            $row['data']['paid'],
            $row['data']['project'],
            $row['data']['company'],
        ];
    }
}
