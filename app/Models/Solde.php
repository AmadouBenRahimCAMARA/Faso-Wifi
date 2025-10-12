<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solde extends Model
{
    use HasFactory;

    protected $fillable = [
        "solde",
        "type",
        "slug",
        "user_id",
        "paiement_id"
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
