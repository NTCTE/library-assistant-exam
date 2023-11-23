<?php

namespace App\Models\Library\Readers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Reader extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'lastname',
        'firstname',
        'patronymic',
        'type_of_reader',
        'group_id',
        'can_get_books',
    ];

    protected $casts = [
        'can_get_books' => 'boolean',
    ];

    public static $types = [
        'teacher' => 'Преподаватель',
        'student' => 'Студент',
        'other' => 'Другое',
    ];

    public function getFullNameAttribute()
    {
        return $this -> lastname . ' ' . $this -> firstname . ' ' . $this -> patronymic;
    }

    public function group()
    {
        return $this -> belongsTo(Group::class);
    }
}
