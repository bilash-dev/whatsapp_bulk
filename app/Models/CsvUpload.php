<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    use HasFactory;

    protected $table = 'csv_uploads';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
