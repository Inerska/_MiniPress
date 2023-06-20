<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'auteur';

    protected $fillable = ['nom', 'email', 'mot_de_passe'];

    public $timestamps = false;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}