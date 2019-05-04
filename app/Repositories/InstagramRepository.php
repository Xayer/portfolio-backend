<?php

namespace App\Repositories;

use App\Services\InstagramService;

class InstagramRepository
{
    private $instagramService;

    /**
     * InstagramRepository constructor.
     */
    public function __construct()
    {
        $this->instagramService = new InstagramService();
    }

    public function getRecentPosts()
    {
        return $this->instagramService->getRecentPosts() ?: null;
    }

}
