<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    use HasFactory;
    protected $fillable = ['ec','island','region', 'province','district','citymun','brgy','sitio',
    'status','energdate','brgycert','epelecsol','epelecsolspecific','eptargetyear','eptotalhouse',
    'frprojcost','frgenfundsource','frfundsource','frfundstatus',
    'icpeaceorder','icrightway','icnoroad','icscathouse','icislandbrgymun','icremote','icothers','remarks',''];
}
