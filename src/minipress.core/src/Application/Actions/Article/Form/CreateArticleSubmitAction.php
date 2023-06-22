<?php

declare(strict_types=1);

namespace App\Application\Actions\Article\Form;

use App\Application\Actions\Article\ArticleAction;
use App\Domain\Category\Category;
use App\Infrastructure\Persistence\Service\Identity\AuthenticationStateProviderService;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateArticleSubmitAction extends ArticleAction
{
    protected function action(): Response
    {
        $formData = $this->getFormData();

        if (empty($formData['title'])
            || empty($formData['content'])
            || empty($formData['summary'])
            || empty($formData['category'])) {
            return $this->respondWithData(['error' => 'Invalid form data'], 400);
        }

        $article = $this->repository->create([
            'titre' => $formData['title'],
            'resume' => $formData['summary'],
            'contenu' => $formData['content'],
            'auteur_id' => AuthenticationStateProviderService::getInstance()->getUserId(),
        ]);

        $category = Category::find($formData['category']);
        if ($category) {
            $article->categories()->attach($category->id);
        }

        $this->logger->info('Article was created successfully: ' . $formData['title']);

        return $this->response
            ->withHeader('Location', '/admin/articles/')
            ->withStatus(302);
    }
}