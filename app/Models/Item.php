<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }
}
