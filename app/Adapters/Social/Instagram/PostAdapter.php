<?php
/**
 * Created by PhpStorm.
 * User: frederikrabol
 * Date: 04/05/2019
 * Time: 00.19
 */

namespace App\Adapters\Social\Instagram;

use App\Contracts\Root\AuthorContract;
use App\Contracts\Social\Instagram\PostContract;
use Illuminate\Support\Collection;


class PostAdapter implements PostContract
{
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function getId(): ?int
    {
        return intval($this->post->id);
    }

    public function getTitle(): ?string
    {
        return $this->post->caption->text ?: null;
    }

    public function getCaption(): ?string
    {
        return $this->post->caption->text ?: null;
    }

    public function getCreatedTime(): ?int
    {
        return intval($this->post->created_time);
    }

    public function getImages(): ?Collection
    {
        return collect($this->post->images);
    }

    public function getLikes(): ?int
    {
        return $this->post->likes->count ?: null;
    }

    public function getTags(): ?Collection
    {
        return collect($this->post->tags) ?: null;
    }

    public function getFilter(): ?string
    {
        return $this->post->filter ?: null;
    }

    public function getType(): ?string
    {
        return $this->post->type ?: null;
    }

    public function getLink(): ?string
    {
        return $this->post->link ?: null;
    }

    public function getAuthor(): ?AuthorContract
    {
        return new InstagramAuthorAdapter($this->post->caption->from ?? $this->post->user) ?: null;
    }
}
