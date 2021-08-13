<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo;
use App\Models\Capsula;
use App\Models\Peso;
use App\Models\Quantidade;
use App\Models\Estoque;

class Produto extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';

    protected $dates = ['dataFab', 'dataVal'];

    protected $fillable = ['nome', 'lote', 'dataFab', 'dataVal', 'tipo_id', 'capsula_id', 'peso_id', 'quantidade_id'];
    
    public function tipo(){
        return $this->belongsTo(Tipo::class, 'tipo_id', 'id');
    }

    public function capsulas(){
        return $this->belongsTo(Capsula::class, 'capsula_id', 'id');
    }

    public function pesos(){
        return $this->belongsTo(Peso::class, 'peso_id', 'id');
    }

    public function quantidades(){
        return $this->belongsTo(Quantidade::class, 'quantidade_id', 'id');
    }

    public function estoque(){
        return $this->hasOne('App\Models\Estoque');
    }

}
