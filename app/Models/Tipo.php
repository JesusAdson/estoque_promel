<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $fillable = ['descricao'];
    public function produto(){
        $this->hasOne('App\Models\Produto', 'tipo_id', 'id');
    }
}
