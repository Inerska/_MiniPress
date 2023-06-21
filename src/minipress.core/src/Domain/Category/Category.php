<?php

declare(strict_types=1);

namespace App\Domain\Category;

use App\Domain\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['nom'];

    public $timestamps = false;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_categories');
    }
}
