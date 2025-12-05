<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Course Model
 * Représente un cours dans le système E-Learning
 * 
 * Attributs:
 * - id: Identifiant unique
 * - teacher_id: ID du professeur qui crée le cours
 * - name: Nom du cours
 * - description: Description du cours
 * - category: Catégorie du cours
 * - level: Niveau (beginner, intermediate, advanced)
 * - price: Prix du cours (0 pour gratuit)
 * - duration_hours: Durée en heures
 * - status: État (draft, published, archived)
 * - cover_image: Image de couverture
 * - created_at, updated_at: Timestamps
 */
class Course extends Model
{
    protected $fillable = [
        'teacher_id',
        'name',
        'description',
        'category',
        'level',
        'price',
        'duration_hours',
        'status',
        'cover_image',
    ];

    /**
     * Relation: Un cours appartient à un professeur
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relation: Un cours a plusieurs inscriptions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relation: Un cours a plusieurs avis
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Obtenir le nombre d'étudiants inscrits
     * @return int
     */
    public function getStudentCountAttribute()
    {
        return $this->enrollments()->count();
    }

    /**
     * Obtenir la note moyenne du cours
     * @return float
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
