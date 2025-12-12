<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Account extends Model
{
    use HasFactory;


    protected $fillable = ['company_name','contact_first_name','contact_last_name','contact_email','contact_phone'];
}