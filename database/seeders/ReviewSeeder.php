<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les inscriptions complétées
        $completedEnrollments = Enrollment::where('status', 'completed')
            ->orWhere('status', 'active')
            ->with(['student', 'course'])
            ->get();

        // Créer des avis pour certaines inscriptions
        foreach ($completedEnrollments as $enrollment) {
            // 70% de chances qu'un avis soit créé
            if (rand(0, 100) > 30) {
                Review::create([
                    'student_id' => $enrollment->student_id,
                    'course_id' => $enrollment->course_id,
                    'rating' => rand(3, 5),
                    'comment' => $this->getRandomComment(),
                ]);
            }
        }

        echo "✅ Reviews seeded successfully!\n";
    }

    /**
     * Retourne un commentaire aléatoire
     */
    private function getRandomComment(): string
    {
        $comments = [
            'Excellent cours ! Très bien expliqué et facile à suivre.',
            'Superbe contenu. Le professeur est vraiment compétent.',
            'Un cours très utile. Je recommande vivement!',
            'Très instructif. J\'ai appris beaucoup de choses.',
            'Parfait pour les débutants. Merci pour ce cours!',
            'Bien structuré et très clair. Merci beaucoup!',
            'Un must pour tous ceux qui veulent apprendre. Bravo!',
            'Le meilleur cours que j\'ai suivi. Cinq étoiles!',
            'Formidable! Exactement ce que je cherchais.',
            'Je suis très satisfait du contenu et de la qualité.',
        ];

        return $comments[array_rand($comments)];
    }
}
