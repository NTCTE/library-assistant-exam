<?php

namespace App\Models\Library;

use App\Models\Library\Items\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class BooksAction extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'book_id',
        'reader_id',
        'get_date',
        'return_date',
        'count_of_books',
    ];

    protected $casts = [
        'get_date' => 'date:d.m.Y',
        'return_date' => 'date:d.m.Y',
        'created_at' => 'datetime:d.m.Y H:i:s',
        'updated_at' => 'datetime:d.m.Y H:i:s',
    ];

    public function book()
    {
        return $this -> hasOne(Book::class);
    }

    public function reader()
    {
        return $this -> hasOne(Book::class);
    }
}
