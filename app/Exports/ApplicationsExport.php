<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ApplicationsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $applications;

    public function __construct($applications = null)
    {
        $this->applications = $applications;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $apps = $this->applications ?? Application::with('user', 'job')->get();

        return $apps->map(function ($app) {
            return [
                $app->user->name ?? 'N/A',
                $app->user->email ?? 'N/A',
                $app->job->title ?? 'N/A',
                $app->job->company_name ?? 'N/A',
                ucfirst($app->status),
                $app->created_at->format('Y-m-d H:i'),
                $app->admin_notes ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Applicant Name',
            'Email',
            'Job Title',
            'Company',
            'Status',
            'Applied Date',
            'Admin Notes',
        ];
    }
}
