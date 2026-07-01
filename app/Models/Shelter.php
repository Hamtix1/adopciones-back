<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'logo_path',
        'cover_image_path',
        'description',
        'mission',
        'municipality_id',
        'address',
        'neighborhood',
        'phone',
        'whatsapp',
        'email',
        'facebook',
        'instagram',
        'responsible_person',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
