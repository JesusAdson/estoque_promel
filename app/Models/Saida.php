<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;
    protected $fillable = ['quantidade_saida', 'data_saida', 'produto_id'];
    protected $dates = ['data_saida'];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
