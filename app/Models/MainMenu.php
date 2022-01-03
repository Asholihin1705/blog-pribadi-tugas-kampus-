<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    protected $table ='mainmenu';

    protected $fillable = [
        'title',
        'status',
        'content',
        'parent',
        'category',
        'file',
        'url',
        'order'
    ];

    public static $rules = [
        'title'     => 'required',
        'status'    => 'required',
        'parent'    => 'required',
        'category'  => 'required|in:link,file,content',
        'order'     => 'required'
    ];
}
