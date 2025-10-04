<?php

namespace App\Imports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class TicketsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $tarifId = session('current_import_tarif_id');
        $userId = session('current_import_user_id');

        return new Ticket([
            'user'     => $row[0],
           'password'    => $row[1],
           'dure' => $row[2],
           'slug' => Str::slug(Str::random(10)),
           'tarif_id' => $tarifId,
           'user_id' => $userId,
        ]);
    }
}
