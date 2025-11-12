<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JobsTemplateExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Return array data for Excel template
     * Berisi contoh data untuk memudahkan admin
     */
    public function array(): array
    {
        return [
            [
                'Software Engineer',
                'Kami mencari software engineer berpengalaman untuk mengembangkan aplikasi web modern. Bertanggung jawab untuk design, develop, dan maintain aplikasi.',
                'PT Tech Indonesia',
                'Jakarta',
                'Rp 8.000.000 - Rp 12.000.000',
                'full-time',
                'active'
            ],
            [
                'Marketing Manager',
                'Memimpin tim marketing dan campaign untuk meningkatkan brand awareness. Minimal 3 tahun pengalaman di bidang marketing.',
                'PT Marketing Solutions',
                'Surabaya',
                'Rp 10.000.000 - Rp 15.000.000',
                'full-time',
                'active'
            ],
            [
                'Graphic Designer',
                'Membuat desain visual untuk berbagai kebutuhan marketing. Mahir Adobe Creative Suite.',
                'PT Creative Agency',
                'Bandung',
                'Rp 5.000.000 - Rp 8.000.000',
                'part-time',
                'active'
            ],
            [
                'Data Analyst Intern',
                'Program magang 6 bulan untuk fresh graduate. Analisis data dan membuat laporan.',
                'PT Data Corp',
                'Jakarta',
                'Rp 3.000.000 - Rp 4.000.000',
                'internship',
                'active'
            ],
        ];
    }

    /**
     * Return column headings
     */
    public function headings(): array
    {
        return [
            'title',
            'description',
            'company_name',
            'location',
            'salary_range',
            'job_type',
            'status'
        ];
    }

    /**
     * Style the Excel sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Make heading row bold
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
