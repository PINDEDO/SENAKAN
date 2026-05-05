<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProjectsMetricsSheet implements FromCollection, WithEvents, WithHeadings, WithTitle
{
    public function __construct(
        private Collection $projects
    ) {}

    public function collection()
    {
        return $this->projects->map(function ($project) {
            $percentage = $project->tasks_count > 0
                ? round(($project->completed_tasks_count / $project->tasks_count) * 100)
                : 0;

            return [
                $project->name,
                $project->code,
                $percentage,
                $project->tasks_count,
                $project->completed_tasks_count,
                $project->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Proyecto / ficha formativa',
            'Código ficha',
            'Cumplimiento (%)',
            'Total tareas',
            'Completadas',
            'Estado proyecto',
        ];
    }

    public function title(): string
    {
        return 'Proyectos';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1:F1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle('A1:F1')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('003770');
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
