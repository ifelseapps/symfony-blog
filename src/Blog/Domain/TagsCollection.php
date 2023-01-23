<?php

namespace App\Blog\Domain;

class TagsCollection
{
    /**
     * @var array<Tag>
     */
    protected array $tags;

    public function __construct(?array $tags)
    {
        $this->tags = $tags ?? [];
    }

    public function toArray(): array
    {
        return $this->tags;
    }

    public function add(Tag $tag)
    {
        $this->tags[] = $tag;
        $this->sort();
    }

    public function remove(Tag $tag)
    {
        $this->tags = array_filter($this->tags, function (Tag $current) use ($tag) {
            return $current->getId() !== $tag->getId();
        });
        $this->sort();
    }

    protected function sort(): void
    {
        usort($this->tags, [TagsCollection::class, 'compareTags']);
    }

    public static function compareTags(Tag $a, Tag $b): int
    {
        return strtolower($a->getTitle()) <=> strtolower($b->getTitle());
    }
}