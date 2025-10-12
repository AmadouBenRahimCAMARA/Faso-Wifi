<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wifi extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "description",
        "slug",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tarifs(){
        
        return $this->hasMany(Tarif::class);
    }
}
