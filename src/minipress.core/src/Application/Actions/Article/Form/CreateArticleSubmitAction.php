<?php

declare(strict_types=1);

use App\Application\Actions\Article\ArticleAction;
use App\Domain\Article\Article;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateArticleSubmitAction extends ArticleAction
{
    protected function action(): Response
    {
        $formData = $this->getFormData();

        if (empty($formData['title']) || empty($formData['content'])) {
            return $this->respondWithData(['error' => 'Invalid form data'], 400);
        }

        $article = new Article();
        $article->title = $formData['title'];
        $article->content = $formData['content'];
        $article->summary = $formData['summary'] ?? '';
        $article->user_id = $this->request->getAttribute('user')->id; // Supposez que l'utilisateur est connecté et accessible
        $article->category_id = $formData['category_id'];
        $article->save();

        $this->logger->info('Article was created successfully: ' . $article->id);

        return $this->response
            ->withHeader('Location', '/articles/' . $article->id)
            ->withStatus(302);
    }
}