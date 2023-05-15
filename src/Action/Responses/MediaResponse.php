<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;
use Dialogflow\Action\Responses\MediaObject;

class MediaResponse implements ResponseInterface
{
    protected array $mediaObjects = [];

    /**
     * Create a new MediaResponse instance.
     *
     * @param null|MediaObject $mediaObject Media objects
     */
    public function __construct($mediaObject = null)
    {
        if ($mediaObject instanceof MediaObject) {
            $this->mediaObjects[] = $mediaObject;
        }
    }

    /**
     * Create a new MediaResponse instance.
     *
     * @param null|MediaObject $mediaObject Media objects
     *
     * @return MediaResponse
     */
    public static function create($mediaObject = null)
    {
        return new self($mediaObject);
    }

    /**
     * Add MediaObject.
     *
     * @param MediaObject $mediaObject
     *
     * @return MediaResponse
     */
    public function add($mediaObject)
    {
        $this->mediaObjects[] = $mediaObject;

        return $this;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        $out = [];
        $mediaResponse = [];

        $mediaResponse['mediaType'] = 'AUDIO';

        $mediaObjects = [];
        foreach ($this->mediaObjects as $mediaObject) {
            $mediaObjects[] = $mediaObject->render();
        }

        if (count($mediaObjects) > 0) {
            $mediaResponse['mediaObjects'] = $mediaObjects;
        }

        $out['mediaResponse'] = $mediaResponse;

        return $out;
    }
}
