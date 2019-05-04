<?php
/**
 * Created by PhpStorm.
 * User: frederikrabol
 * Date: 04/05/2019
 * Time: 17.54
 */

namespace App\Models\Social;

use App\Contracts\Root\AuthorContract;
use App\Contracts\Social\Instagram\PostContract;
use Illuminate\Support\Collection;

class SocialPost implements PostContract
{

    public function __construct(PostContract $post)
    {
        $this->post = $post;
    }

    public function getId(): ?int
    {
        return $this->post->getId();
    }

    public function getTitle(): ?string
    {
        return $this->post->getTitle();
    }

    public function getCaption(): ?string
    {
        return $this->post->getCaption();
    }

    public function getCreatedTime(): ?int
    {
        return $this->post->getCreatedTime();
    }

    public function getImages(): ?Collection
    {
        return $this->post->getImages();
    }

    public function getLikes(): ?int
    {
        return $this->post->getLikes();
    }

    public function getTags(): ?Collection
    {
        return $this->post->getTags();
    }

    public function getFilter(): ?string
    {
        return $this->post->getFilter();
    }

    public function getType(): ?string
    {
        return $this->post->getType();
    }

    public function getLink(): ?string
    {
        return $this->post->getLink();
    }

    public function getAuthor(): ?AuthorContract
    {
        return $this->post->getAuthor();
    }
}
