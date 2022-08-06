<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory,UuidTrait;

    public $incrementing = false;
    public $keyType = 'uuid';

    protected $fillable = ['status','description'];

    public $statusOptions = [
        'P' => 'Pendente, Agurdando Professor',
        'A' => 'Agurdando Aluno',
        'C' => 'Concluido',
    ];
}
