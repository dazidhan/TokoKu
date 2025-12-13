<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Tambahkan ini agar Laravel tahu kolom apa saja yang boleh diisi
    protected $fillable = [
        'name',
        'role',
        'phone',
        'status',
        'joined_at'
    ];
}