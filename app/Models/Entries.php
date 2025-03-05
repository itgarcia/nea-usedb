<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    use HasFactory;
    protected $fillable = ['ec_name','reporting_month','status','upload','created_by'];
}
