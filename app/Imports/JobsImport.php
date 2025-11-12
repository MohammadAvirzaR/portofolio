<?php

namespace App\Imports;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['title'])) {
            return null;
        }

        return new Job([
            'title' => $row['title'] ?? null,
            'description' => $row['description'] ?? null,
            'company_name' => $row['company_name'] ?? null,
            'location' => $row['location'] ?? null,
            'salary_range' => $row['salary_range'] ?? null,
            'job_type' => $row['job_type'] ?? 'Full-time',
            'status' => $row['status'] ?? 'active',
        ]);
    }
}
