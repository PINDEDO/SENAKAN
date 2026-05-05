<?php

namespace App\Exports;

use App\Exports\Sheets\ProjectsMetricsSheet;
use App\Exports\Sheets\RecentActivitySheet;
use App\Exports\Sheets\SummaryDistributionSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InstitutionalReportExport implements WithMultipleSheets
{
    public function __construct(
        private array $taskDistribution,
        private Collection $projects,
        private Collection $recentActivities,
        private string $generatedAt
    ) {}

    public function sheets(): array
    {
        return [
            new SummaryDistributionSheet($this->taskDistribution, $this->generatedAt),
            new ProjectsMetricsSheet($this->projects),
            new RecentActivitySheet($this->recentActivities),
        ];
    }
}
