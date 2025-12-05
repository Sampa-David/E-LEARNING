<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Enrollment Model
 * Représente l'inscription d'un étudiant à un cours
 * 
 * Attributs:
 * - id: Identifiant unique
 * - student_id: ID de l'étudiant
 * - course_id: ID du cours
 * - progress: Pourcentage de progression (0-100)
 * - status: État (active, completed, paused)
 * - enrolled_at: Date d'inscription
 * - completed_at: Date de complétude (nullable)
 * - created_at, updated_at: Timestamps
 */
class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'progress',
        'status',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Relation: Une inscription appartient à un étudiant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Relation: Une inscription appartient à un cours
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
