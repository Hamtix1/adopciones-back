<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'code',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shelters()
    {
        return $this->hasMany(Shelter::class);
    }
}
