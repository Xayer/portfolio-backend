<?php

namespace App\Contracts\Social\Instagram;

use App\Contracts\Root\AuthorContract;
use Illuminate\Support\Collection;

interface PostContract
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function getCaption(): ?string;

    public function getCreatedTime(): ?int;

    public function getImages(): ?Collection;

    public function getLikes(): ?int;

    public function getTags(): ?Collection;

    public function getFilter(): ?string;

    public function getType(): ?string;

    public function getLink(): ?string;

    public function getAuthor(): ?AuthorContract;
}
