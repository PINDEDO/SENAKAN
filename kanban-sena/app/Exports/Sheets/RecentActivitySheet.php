<?php

namespace App\Exports\Sheets;

use App\Support\ReportFormat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RecentActivitySheet implements FromCollection, WithEvents, WithHeadings, WithTitle
{
    public function __construct(
        private Collection $activities
    ) {}

    public function collection()
    {
        return $this->activities->map(function ($task) {
            return [
                $task->updated_at->format('d/m/Y H:i'),
                $task->creator?->name ?? '—',
                $task->title,
                $task->project?->name ?? '—',
                ReportFormat::taskStatusLabel($task->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Última actualización',
            'Usuario responsable',
            'Tarea',
            'Proyecto',
            'Estado',
        ];
    }

    public function title(): string
    {
        return 'Actividad reciente';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1:E1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle('A1:E1')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('39A900');
                foreach (range('A', 'E') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
