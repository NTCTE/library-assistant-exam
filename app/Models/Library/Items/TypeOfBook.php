<?php

namespace App\Models\Library\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TypeOfBook extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
    ];
}
