<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * 
     * Fillable fields to store data into the database.
     *
     */
    protected $fillable = ['title', 'description', 'status'];

}
