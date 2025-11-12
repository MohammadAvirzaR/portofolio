<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'user_id',
        'job_posting_id',
        'cv_path',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who applied
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job posting being applied to
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_posting_id');
    }
}
