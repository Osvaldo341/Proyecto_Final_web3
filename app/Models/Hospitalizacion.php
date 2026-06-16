<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
    use HasFactory;
    protected $table= 'hospitalizacion';
    public $timestamps = false;
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function diegogay()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
}
