<?php

namespace App\Blog\Domain;

use App\Blog\Exceptions\InvalidContentBlockOrderException;
use App\Core\Domain\BaseEntity;
use App\Core\Domain\Str;
use DateTime;

class Post extends BaseEntity
{
    protected string $type;

    protected string $title;

    protected DateTime $createdAt;

    protected string $category;

    protected array $content;

    protected string $description;

    protected string $keywords;

    public function __construct(
        string $title,
        string $type,
        DateTime $createdAt,
        string $description,
        string $keywords,
        string $category,
        ?array $tags,
        ?array $content,
        ?string $id,
    )
    {
        parent::__construct($id);

        $this->title = $title;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->category = $category;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->content = $content ?? [];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'createdAt' => $this->getCreatedAtFormatted(),
            'slug' => $this->getSlug(),
            'type' => $this->type,
            'preview_text' => $this->getPreviewText(),
            'category' => $this->category,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'content' => $this->content,
        ];
    }

    public function addText(string $text): void
    {
        $this->content[] = ['type' => ContentType::TEXT, 'text' => $text];
    }

    /**
     * @throws InvalidContentBlockOrderException
     */
    public function addPictures(array $pictures): void
    {
        if (empty($this->content)) {
            throw new InvalidContentBlockOrderException('The block with images cannot be the first');
        }

        $this->content[] = ['type' => ContentType::PICTURES, 'pictures' => $pictures];
    }

    protected function getSlug(): string
    {
        return Str::slugify($this->title);
    }

    const PREVIEW_TEXT_LENGTH = 200;

    public function getPreviewText(): string
    {
        if (!count($this->content)) {
            return '';
        }

        return substr(strip_tags($this->content[0]['text']), 0, static::PREVIEW_TEXT_LENGTH) . ' ...';
    }

    public function getCreatedAtFormatted(): string
    {
        if (empty($this->date)) {
            return '';
        }

        if ($this->type === 'BLOG') {
            return $this->date->format('Y-m');
        }

        return $this->date->format('Y-m-d');
    }
}