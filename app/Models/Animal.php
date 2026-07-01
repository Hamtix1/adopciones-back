<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shelter_id',
        'animal_status_id',
        'name',
        'species',
        'sex',
        'age',
        'size',
        'weight',
        'breed',
        'color',
        'rescue_date',
        'rescue_location',
        'story',
        'sterilized',
        'vaccinated',
        'dewormed',
        'microchipped',
        'medical_conditions',
        'disabilities',
        'medications',
        'medical_observations',
        'available_for_adoption',
        'available_for_sponsorship',
        'adopted',
        'in_recovery',
        'deceased',
        'lost',
        'personality',
        'lives_with_dogs',
        'lives_with_cats',
        'lives_with_children',
        'video_url',
    ];

    protected $casts = [
        'rescue_date' => 'date',
        'sterilized' => 'boolean',
        'vaccinated' => 'boolean',
        'dewormed' => 'boolean',
        'microchipped' => 'boolean',
        'available_for_adoption' => 'boolean',
        'available_for_sponsorship' => 'boolean',
        'adopted' => 'boolean',
        'in_recovery' => 'boolean',
        'deceased' => 'boolean',
        'lost' => 'boolean',
        'lives_with_dogs' => 'boolean',
        'lives_with_cats' => 'boolean',
        'lives_with_children' => 'boolean',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function status()
    {
        return $this->belongsTo(AnimalStatus::class, 'animal_status_id');
    }

    public function images()
    {
        return $this->hasMany(AnimalImage::class);
    }

    public function histories()
    {
        return $this->hasMany(AnimalHistory::class);
    }
}
