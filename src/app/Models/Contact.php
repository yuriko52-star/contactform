<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// 必要

class Contact extends Model
{
    use HasFactory;
    // 必要
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
