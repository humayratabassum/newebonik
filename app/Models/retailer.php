<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retailer extends Model
{
    use HasFactory;
    // protected $table ='retailer';
    protected $fillable=['shop_name','proprietor_name','shop_area','shop_type','contact_no','shop_no'];

}
