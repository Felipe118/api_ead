<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory,UuidTrait;

    public $incrementing = false;
    public $keyType = 'uuid';

    protected $fillable = ['name','description','video'];

    public function supports()
    {
        return $this->hasMany(Support::class);
    }
}
