<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    public $fillable = [
                            'sku',
                            'title',
                            'description',
                            'price',
                            'availability',
                            'color',
                            'dimensions'
                       ];
}
