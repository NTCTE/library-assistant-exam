<?php

namespace App\Models\Library\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Book extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'fullname',
        'type_of_book_id',
        'author_id',
        'publishing_id',
        'year_of_publishing',
        'count_of_sheets',
        'count_of_items',
    ];

    public function typeOfBook()
    {
        return $this -> belongsTo(TypeOfBook::class);
    }

    public function author()
    {
        return $this -> belongsTo(Author::class);
    }

    public function publishing()
    {
        return $this -> belongsTo(Publishing::class);
    }
}
