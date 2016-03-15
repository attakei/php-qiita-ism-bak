<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'title', 'body', 'status',
    ];

    /**
     * Get author object that write it.
     */
    public function author()
    {
        return $this->belongsTo(\App\User::class, 'author_id');
    }
}
