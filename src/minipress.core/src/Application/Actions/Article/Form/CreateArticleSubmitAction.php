<?php

declare(strict_types=1);

namespace App\Application\Actions\Article\Form;

use App\Application\Actions\Article\ArticleAction;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateArticleSubmitAction extends ArticleAction
{
    protected function action(): Response
    {
        $formData = $this->getFormData();

        if (empty($formData['title'])
            || empty($formData['content'])
            || empty($formData['summary'])) {
            return $this->respondWithData(['error' => 'Invalid form data'], 400);
        }

        $this->repository->create([
            'titre' => $formData['title'],
            'resume' => $formData['summary'],
            'contenu' => $formData['content'],
            //TODO(alexis): SESSION
            'auteur_id' => 1,
        ]);

        $this->logger->info('Article was created successfully: ' . $formData['title']);

        return $this->response
            ->withHeader('Location', '/admin/articles/' . $formData['title'])
            ->withStatus(302);
    }
}