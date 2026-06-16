<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'paciente';
    public $timestamps = false;
    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'tipo_diagnostico_id');
    }
}
