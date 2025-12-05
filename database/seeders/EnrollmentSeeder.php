<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les étudiants et les cours
        $students = User::where('role', 'student')->get();
        $courses = Course::where('status', 'published')->get();

        if ($students->isEmpty()) {
            // Créer quelques étudiants s'il n'en existe pas
            for ($i = 1; $i <= 5; $i++) {
                User::create([
                    'name' => "Student $i",
                    'email' => "student$i@example.com",
                    'password' => bcrypt('password'),
                    'role' => 'student',
                ]);
            }
            $students = User::where('role', 'student')->get();
        }

        // Créer des inscriptions
        foreach ($students as $student) {
            // Chaque étudiant s'inscrit à 2-3 cours
            $coursesToEnroll = $courses->random(rand(2, 3));

            foreach ($coursesToEnroll as $course) {
                // Vérifier que l'inscription n'existe pas déjà
                $exists = Enrollment::where('student_id', $student->id)
                    ->where('course_id', $course->id)
                    ->exists();

                if (!$exists) {
                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'progress' => rand(0, 100),
                        'status' => collect(['active', 'completed', 'paused'])->random(),
                        'enrolled_at' => now()->subDays(rand(1, 30)),
                        'completed_at' => rand(0, 1) ? now()->subDays(rand(1, 10)) : null,
                    ]);
                }
            }
        }

        echo "✅ Enrollments seeded successfully!\n";
    }
}
