<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;
    protected $table = 'katalogs';
    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'game_id', 'id');
    }
}
