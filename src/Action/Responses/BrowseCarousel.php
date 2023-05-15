<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;
use Dialogflow\Action\Responses\BrowseCarousel\Option;

class BrowseCarousel implements ResponseInterface
{
    protected string $imageDisplayOptions;

    protected array $options = [];

    /**
     * Create a new BrowseCarousel instance.
     *
     * @return self
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Type of image display option. Possible value: DEFAULT, WHITE and CROPPED.
     *
     * @param string $imageDisplayOptions
     *
     * @return self
     */
    public function imageDisplayOptions($imageDisplayOptions)
    {
        $this->imageDisplayOptions = $imageDisplayOptions;

        return $this;
    }

    /**
     * Add BrowseCarousel option.
     *
     * @param Option $option
     *
     * @return self
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;

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
        $carouselBrowse = [];

        if ($this->imageDisplayOptions) {
            $carouselBrowse['imageDisplayOptions'] = $this->imageDisplayOptions;
        }

        $items = [];
        foreach ($this->options as $option) {
            $items[] = $option->render();
        }

        $carouselBrowse['items'] = $items;

        $out['carouselBrowse'] = $carouselBrowse;

        return $out;
    }
}
