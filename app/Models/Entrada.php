<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = ['quantidade_entrada', 'data_entrada', 'produto_id'];
    protected $dates = ['data_entrada'];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
    use HasFactory;
}
