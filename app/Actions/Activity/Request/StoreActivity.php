<?php

namespace App\Actions\Activity\Request;

use App\Activity;
use Illuminate\Http\Request;
use App\ActivityProperties;
use App\Actions\Activity\CreateActivity;

class StoreActivity
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
     * @var Request
     */
    private $request;

    /**
     *
     * @var CreateActivity
     */
    private $createActivity;

    /**
     *
     * @var ActivityProperties
     */
    private $properties;

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
     * @param Request $request
     * @param CreateActivity $createActivity
     * @param ActivityProperties $properties
     * @return self
     */
    public function __construct(Request $request, CreateActivity $createActivity, ActivityProperties $properties)
    {
        $this->request          = $request;
        $this->createActivity   = $createActivity;
        $this->properties       = $properties;
        $this->title            = $this->request->input('title');
        $this->description      = $this->request->input('description');
    }

    /**
     *
     * @return void
     */
    public function saveRouteFile(): void
    {
        $this->url = $this->request->file('route')
            ->store('routes');
    }

    /**
     *
     * @return void
     */
    protected function buildPropertiesObject(): void
    {
        $this->properties->setTitle($this->getTitle());
        $this->properties->setDescription($this->getDescription());
        $this->properties->setUrl($this->getUrl());
    }

    /**
     *
     * @return Activity
     */
    public function execute(): Activity
    {
        $this->saveRouteFile();
        $this->buildPropertiesObject();
        return $this->createActivity
            ->execute(auth()->user(), $this->properties);
    }
}
