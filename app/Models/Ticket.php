<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "user",
        "password",
        "dure",
        "slug",
        "etat_ticket",
        "vente_date",
        "tarif_id",
        "user_id",

    ];

    public function tarif(){
        return $this->belongsTo(Tarif::class);
    }

    public function paiements(){
        $this->hasMany(Paiement::class);
    }

}
