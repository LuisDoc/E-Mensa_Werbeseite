<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ersteller;
class Wunschgericht extends Model
{
    use HasFactory;

    protected $table = 'wunschgericht';
    public $timestamps = false;
    protected $fillable= [
        'gerichtname',
        'beschreibung',
        'created_at', 
        'ersteller_email'
    ];

    public function ersteller(){
        return $this->belongsTo(Ersteller::class, 'ersteller_email', 'email');
    }
}
