<?php

namespace App\Actions\Activity\Request;

use App\Activity;
use Illuminate\Http\Request;
use App\Contracts\ActivityProperties;

class HandleCreateActivityPayload
{
    /**
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setPropertiesFromRequest();
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    private function setPropertiesFromRequest(): void
    {
        $properties = $this->request->only([
            'title',
            'description'
        ]);
        $this->title = $properties['title'];
        $this->description = $properties['description'];
    }

    /**
     *
     * @return void
     */
    public function  saveRouteFile(): void
    {
        $this->url = $this->request->file('route')
            ->store('routes');
    }

    /**
     *
     * @return void
     */
    public function saveActivity(): Activity
    {
        return auth()->user()->createActivity($this->getProperties());
    }

    /**
     *
     * @return Activity
     */
    public function execute(): Activity
    {
        $this->saveRouteFile();
        return $this->saveActivity();
    }

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
     * @return void
     */
    public function getProperties()
    {
        return new class ($this) implements ActivityProperties
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
             * @param array $properties
             * @return self
             */
            public function __construct($properties)
            {
                $this->title        = $properties->title;
                $this->description  = $properties->description;
                $this->url          = $properties->url;
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
             * @return array
             */
            public function getRouteProperies(): array
            {
                return [
                    'url' => $this->url
                ];
            }
        };
    }
}
