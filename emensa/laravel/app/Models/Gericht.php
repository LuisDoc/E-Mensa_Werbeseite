<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategorie;
use App\Models\Allergen;
use App\Models\Bewertung;
class Gericht extends Model
{
    use HasFactory;

    protected $table = 'gericht';
    protected $fillable = [
        'name',
        'beschreibung',
        'erfasst_am',
        'vegetarisch',
        'vegan',
        'preis_intern',
        'preis_extern',
        'bildname'
    ];

    public function getPreisInternAttribute($value){
        return number_format($value, 2, ',', '');
    }

    public function getPreisExternAttribute($value){
        return number_format($value, 2, ',', '');
    }

    public function setVegetarischAttribute($value){
        $trimmed = str_replace(' ', '', $value);
        if(strtolower($trimmed)=="yes" )
        {
            $this->attributes['vegetarisch'] = true;
        }
        else if(strtolower($trimmed) =="no")
        {
            $this->attributes['vegetarisch'] = false;
        }
    }
    
    public function setVeganAttribute($value){
        $trimmed = str_replace(' ', '', $value);
        if(strtolower($trimmed)=="yes" )
        {
            $this->attributes['vegan'] = true;;
        }
        else if (strtolower($trimmed) =="no")
        {
            $this->attributes['vegan'] = false;
        }
    }


    public $timestamps = false;

    public function kategorien(){
        return $this->belongsToMany(Kategorie::class,'gericht_hat_kategorie', 'gericht_id', 'kategorie_id');
    }

    public function allergene(){
        return $this->belongsToMany(Allergen::class,'gericht_hat_allergen', 'gericht_id','code')->orderBy('code');
    }

    public function bewertungen(){
        return $this->hasMany(Bewertung::class);
    }
}
