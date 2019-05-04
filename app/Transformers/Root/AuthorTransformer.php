<?php

namespace App\Transformers\Root;

use App\Contracts\Root\AuthorContract;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['image'];
    protected $availableIncludes = ['image'];

    public function transform(AuthorContract $author)
    {
        return [
            'id' => $author->getId(),
            'full_name' => $author->getFullName(),
            'username' => $author->getUsername(),
        ];
    }

    public function includeImage(AuthorContract $author)
    {
        return $this->item($author->getProfilePicture(), new ImageTransformer());
    }
}
