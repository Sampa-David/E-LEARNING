<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Review Model
 * Représente un avis sur un cours
 * 
 * Attributs:
 * - id: Identifiant unique
 * - student_id: ID de l'étudiant qui fait l'avis
 * - course_id: ID du cours évalué
 * - rating: Note (1-5)
 * - comment: Commentaire texte
 * - created_at, updated_at: Timestamps
 */
class Review extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'rating',
        'comment',
    ];

    /**
     * Relation: Un avis appartient à un étudiant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Relation: Un avis appartient à un cours
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
