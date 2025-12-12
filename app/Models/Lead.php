<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lead extends Model
{
    use HasFactory;


    protected $fillable = ['first_name','last_name','email','phone','source_description'];
}