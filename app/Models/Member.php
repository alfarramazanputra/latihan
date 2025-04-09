<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'phone_number',
        'member_point',
        'date',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'member_id');
    }
}
