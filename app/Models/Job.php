<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'company_name',
        'logo',
        'location',
        'description',
        'job_type',
        'salary_range',
        'status',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    /**
     * Get applications for this job
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_posting_id');
    }
}
