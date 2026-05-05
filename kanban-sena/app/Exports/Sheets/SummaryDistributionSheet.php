<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SummaryDistributionSheet implements FromArray, WithEvents, WithTitle
{
    public function __construct(
        private array $taskDistribution,
        private string $generatedAt
    ) {}

    public function array(): array
    {
        return [
            ['SENA — Resumen de indicadores (Kanban)'],
            ['Documento generado', $this->generatedAt],
            ['Sistema', config('app.name')],
            ['', ''],
            ['Indicador', 'Valor'],
            ['Tareas completadas (%)', $this->taskDistribution['done'].'%'],
            ['Tareas en proceso (%)', $this->taskDistribution['progress'].'%'],
            ['Tareas pendientes (%)', $this->taskDistribution['pending'].'%'],
        ];
    }

    public function title(): string
    {
        return 'Resumen';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1:B1')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('003770');
                $sheet->getStyle('A1:B1')->getFont()->getColor()->setRGB('FFFFFF');
                $sheet->getStyle('A1:B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->mergeCells('A1:B1');
                $sheet->getStyle('A5:B5')->getFont()->setBold(true);
                $sheet->getStyle('A5:B5')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('39A900');
                $sheet->getStyle('A5:B5')->getFont()->getColor()->setRGB('FFFFFF');
                $sheet->getColumnDimension('A')->setWidth(42);
                $sheet->getColumnDimension('B')->setWidth(24);
            },
        ];
    }
}
