<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Gericht;
class Bewertung extends Model
{

    protected $table = "bewertung";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'gericht_id',
        'bemerkung',
        'bewertung',
        'highlighted',
    ];

    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gericht(){
        return $this->belongsTo(Gericht::class);
    }


    
}
