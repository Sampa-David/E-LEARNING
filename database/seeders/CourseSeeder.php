<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les professeurs
        $teachers = User::where('role', 'teacher')->get();

        if ($teachers->isEmpty()) {
            // Créer un professeur s'il n'en existe pas
            $teacher = User::create([
                'name' => 'Prof. Jean Dupont',
                'email' => 'jean.dupont@example.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]);
            $teachers = collect([$teacher]);
        }

        // Créer des cours pour chaque professeur
        foreach ($teachers as $teacher) {
            // Cours 1
            Course::create([
                'teacher_id' => $teacher->id,
                'name' => 'Introduction à Laravel',
                'description' => 'Apprenez les bases du framework Laravel avec ce cours complet. Idéal pour les débutants qui souhaitent apprendre le développement web moderne.',
                'category' => 'Web Development',
                'level' => 'beginner',
                'price' => 0,
                'duration_hours' => 15,
                'status' => 'published',
            ]);

            // Cours 2
            Course::create([
                'teacher_id' => $teacher->id,
                'name' => 'PHP Avancé',
                'description' => 'Maîtrisez les concepts avancés de PHP. Programmation orientée objet, design patterns, et meilleures pratiques.',
                'category' => 'Backend',
                'level' => 'intermediate',
                'price' => 29.99,
                'duration_hours' => 25,
                'status' => 'published',
            ]);

            // Cours 3
            Course::create([
                'teacher_id' => $teacher->id,
                'name' => 'Bases de Données PostgreSQL',
                'description' => 'Apprenez à gérer les bases de données avec PostgreSQL. SQL, normalisation, et optimisation des requêtes.',
                'category' => 'Database',
                'level' => 'intermediate',
                'price' => 19.99,
                'duration_hours' => 20,
                'status' => 'published',
            ]);

            // Cours 4
            Course::create([
                'teacher_id' => $teacher->id,
                'name' => 'Vue.js Avancé',
                'description' => 'Développez des applications Frontend modernes avec Vue.js. Composants, state management, et patterns avancés.',
                'category' => 'Frontend',
                'level' => 'advanced',
                'price' => 39.99,
                'duration_hours' => 30,
                'status' => 'draft',
            ]);
        }

        echo "✅ Courses seeded successfully!\n";
    }
}
