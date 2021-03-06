<?php

namespace BuscaSorocaba\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estabelecimentos extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'nome', 'telefone', 'telefone2', 'logradouro', 'numero', 'complemento',
        'email', 'cep', 'bairro', 'cidade', 'quemSomos', 'servicos', 'site', '_24h', 'emergencia'
    ];

    protected $dates = ['deleted_at'];

    public function subCategoria()
    {
        return $this->belongsToMany(SubCategoria::class);
    }

    public function responsavel()
    {
        return $this->hasMany(Responsavel::class);
    }

    public function avaliacao()
    {
       return $this->hasMany(Avaliacao::class);
    }

}
