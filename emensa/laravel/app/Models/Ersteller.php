<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wunschgericht;
class Ersteller extends Model
{
    use HasFactory;

    protected $table = 'ersteller';
    public $incrementing = false;
    protected $primaryKey = 'email';
    protected $keyType='string';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email'
    ];


    public function wunschgerichte(){
        return $this->hasMany(Wunschgericht::class,'ersteller_email', 'email');
    }
    
}
