<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gericht;

class Allergen extends Model
{
    use HasFactory;
    protected $table ='allergen';
    //Created_at und Updated_at automatisch gesetzt --> deaktiviert
    public $timestamps = false;
    //Primary Key Auto Increment an ? --> False
    public $incrementing = false;
    //Primärschlüssel setzen
    protected $primaryKey = 'code';
    protected $keyType='string';
    //Spaltenattribute, auf die das Model zugreifen darf
    protected $fillable=[
        'code',
        'name',
        'typ'
    ];

    public function gerichte(){
        return $this->belongsToMany(Gericht::class,'gericht_hat_allergen', 'gericht_id','code');
    }
}
