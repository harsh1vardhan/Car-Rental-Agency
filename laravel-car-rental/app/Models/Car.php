<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function image()
    {
        return $this->belongsTo(CloudFile::class, 'cloud_file_id');
    }
}
