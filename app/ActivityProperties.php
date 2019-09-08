<?php

namespace App;

class ActivityProperties
{
    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string
     */
    private $description;

    /**
     *
     * @var string
     */
    private $url;

    /**
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     *
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     *
     * @return array
     */
    public function getActivityProperties(): array
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description
        ];
    }

    /**
     *
     * @return void
     */
    public function getRouteProperties(): array
    {
        return [
            'url' => $this->url
        ];
    }
}
