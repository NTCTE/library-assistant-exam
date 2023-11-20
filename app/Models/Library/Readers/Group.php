<?php

namespace App\Models\Library\Readers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Group extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
    ];
}
