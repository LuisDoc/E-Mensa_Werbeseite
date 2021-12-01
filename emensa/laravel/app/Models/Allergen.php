<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gericht;
class Allergen extends Model
{
    use HasFactory;
    protected $table ='allergen';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'code';
    protected $keyType='string';
    protected $fillable=[
        'code',
        'name',
        'typ'
    ];

    public function gerichte(){
        return $this->belongsToMany(Gericht::class,'gericht_hat_allergen', 'gericht_id','code');
    }
}
