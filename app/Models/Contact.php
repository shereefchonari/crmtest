<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contact extends Model
{
    use HasFactory;


    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'type', // b2c or b2b
    'source_type',
    'source_id',
    ];


    protected $casts = [
    'source_id' => 'integer',
    ];
}