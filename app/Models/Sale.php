<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'member_id',
        'date',
        'no_sales',
        'amount_paid',
        'change',
        'point_used',
        'total',
        'sub_total',
        'created_by',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
}
