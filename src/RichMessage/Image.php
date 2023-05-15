<?php

namespace Dialogflow\RichMessage;

class Image extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    protected const V1MESSAGEOBJECTIMAGE = 3;

    protected string $imageUrl;

    /**
     * Create a new Image instance.
     *
     * @param string $imageUrl image URL
     *
     * @return self
     */
    public static function create($imageUrl = null)
    {
        $image = new self();
        $image->image($imageUrl);

        return $image;
    }

    /**
     * Set the image for a Image.
     *
     * @param string $imageUrl
     */
    public function image($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Render response as array for API V1.
     *
     * @return array
     */
    protected function renderV1()
    {
        if ('google' == $this->requestSource) {
            $out = [
                'type'     => 'basic_card',
                'platform' => $this->requestSource,
            ];

            if ($this->imageUrl) {
                $out['image'] = [
                    'url'               => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            return $out;
        } else {
            $out = [
                'type'     => self::V1MESSAGEOBJECTIMAGE,
                'platform' => $this->requestSource,
            ];

            if ($this->imageUrl) {
                $out['imageUrl'] = $this->imageUrl;
            }

            return $out;
        }
    }

    /**
     * Render response as array for API V2.
     *
     * @return array
     */
    protected function renderV2()
    {
        if ('google' == $this->requestSource) {
            $out = [
                'basicCard' => [],
                'platform'  => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->imageUrl) {
                $out['basicCard']['image'] = [
                    'imageUri'          => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            return $out;
        } else {
            $out = [
                'image'    => [],
                'platform' => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->imageUrl) {
                $out['image']['imageUri'] = $this->imageUrl;
            }

            return $out;
        }
    }
}
