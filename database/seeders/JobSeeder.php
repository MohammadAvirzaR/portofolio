<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'company' => 'Tech Solutions Indonesia',
                'logo' => null, // Bisa diupload manual
                'location' => 'Jakarta, Indonesia',
                'description' => 'We are looking for an experienced Full Stack Developer to join our team. You will be responsible for developing and maintaining web applications using modern technologies.

Requirements:
- 5+ years of experience in web development
- Proficient in PHP, Laravel, JavaScript, Vue.js/React
- Experience with MySQL/PostgreSQL
- Strong understanding of RESTful APIs
- Good knowledge of Git and CI/CD

Benefits:
- Competitive salary
- Health insurance
- Remote work options
- Professional development opportunities',
                'type' => 'full-time',
                'category' => 'IT & Software',
                'salary_min' => 15000000,
                'salary_max' => 25000000,
                'status' => 'active',
                'deadline' => now()->addDays(30),
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Creative Studio',
                'logo' => null,
                'location' => 'Bandung, Indonesia',
                'description' => 'Join our creative team as a UI/UX Designer. You will work on exciting projects for various clients and help create amazing user experiences.

Requirements:
- 3+ years of experience in UI/UX design
- Proficient in Figma, Adobe XD, or Sketch
- Strong portfolio showcasing your work
- Understanding of design principles and best practices
- Good communication skills

Benefits:
- Flexible working hours
- Creative work environment
- Learning opportunities',
                'type' => 'full-time',
                'category' => 'Design',
                'salary_min' => 8000000,
                'salary_max' => 15000000,
                'status' => 'active',
                'deadline' => now()->addDays(20),
            ],
            [
                'title' => 'Marketing Intern',
                'company' => 'Startup Innovate',
                'logo' => null,
                'location' => 'Surabaya, Indonesia',
                'description' => 'We are seeking a motivated Marketing Intern to support our marketing team. This is a great opportunity to learn and grow in the digital marketing field.

Requirements:
- Currently pursuing or recently completed a degree in Marketing/Communications
- Basic understanding of social media marketing
- Creative and eager to learn
- Good writing skills in English and Indonesian

What you will learn:
- Social media management
- Content creation
- Digital marketing strategies
- Analytics and reporting',
                'type' => 'internship',
                'category' => 'Marketing',
                'salary_min' => 2000000,
                'salary_max' => 3000000,
                'status' => 'active',
                'deadline' => now()->addDays(15),
            ],
            [
                'title' => 'Data Analyst',
                'company' => 'Analytics Pro',
                'logo' => null,
                'location' => 'Jakarta, Indonesia',
                'description' => 'We need a skilled Data Analyst to help us make data-driven decisions. You will work with large datasets and provide insights to support business strategies.

Requirements:
- Bachelor\'s degree in Statistics, Mathematics, or related field
- 2+ years of experience in data analysis
- Proficient in SQL and Python
- Experience with data visualization tools (Tableau, Power BI)
- Strong analytical and problem-solving skills

Benefits:
- Competitive package
- Work-life balance
- Training and certification opportunities',
                'type' => 'contract',
                'category' => 'Data Science',
                'salary_min' => 10000000,
                'salary_max' => 18000000,
                'status' => 'active',
                'deadline' => now()->addDays(25),
            ],
            [
                'title' => 'Mobile App Developer',
                'company' => 'Mobile First Inc',
                'logo' => null,
                'location' => 'Remote',
                'description' => 'Looking for a talented Mobile App Developer to create innovative mobile applications for iOS and Android platforms.

Requirements:
- 3+ years of mobile development experience
- Proficient in Flutter or React Native
- Experience with native development (Swift/Kotlin) is a plus
- Published apps in App Store/Play Store
- Good understanding of mobile UI/UX principles

Benefits:
- 100% remote work
- Flexible hours
- Latest equipment provided
- Performance bonuses',
                'type' => 'full-time',
                'category' => 'IT & Software',
                'salary_min' => 12000000,
                'salary_max' => 20000000,
                'status' => 'active',
                'deadline' => now()->addDays(40),
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
