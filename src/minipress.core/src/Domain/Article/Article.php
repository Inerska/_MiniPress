<?php

declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Category\Category;
use App\Domain\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['titre', 'resume', 'contenu', 'date_creation', 'auteur_id', 'category_id'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
