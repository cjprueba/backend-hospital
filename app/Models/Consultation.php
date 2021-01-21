<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $table = 'consultation';

    protected $fillable = [
        'description',
        'fk_customer',
        'fk_doctor',
    ];

    public function user(){
        return $this->belongsTo("App\Models\User", "id");
    }
}
