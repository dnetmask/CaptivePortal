<?php
/**
 * @author: Juan Angel
 * Add export to excel action
 */

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WifiUserExport implements FromCollection, WithHeadings, WithMapping
{
    private $headings;
    private $data;

    public function __construct($headings, $data)
    {
        $this->headings = $headings;
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($wifiUser): array
    {
        return $wifiUser->toArray();
    }

    public function headings(): array
    {
        $headings = ['ID'];

        foreach ($this->headings as $item) {
            $headings[] = $item->display_name;
        }

        $headings [] = 'Creado';
        $headings [] = 'Modificado';

        return $headings;
    }


}