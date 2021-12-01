<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gericht;
class Kategorie extends Model
{
    use HasFactory;

    protected $table = 'kategorie';
    public $timestamps = false;
    protected $fillable= [
        'name',
        'eltern_id',
        'bildname'
    ];
    public function gerichte(){
        return $this->belongsToMany(Gericht::class,'gericht_hat_kategorie', 'gericht_id', 'kategorie_id');
    }

}
