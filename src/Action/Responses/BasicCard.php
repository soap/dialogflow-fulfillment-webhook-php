<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;

class BasicCard implements ResponseInterface
{
    protected string $title;

    protected string $formattedText;

    protected string $imageUrl;

    protected string $accessibilityText;

    protected array $buttons = [];

    /**
     * Create a new Basic Card instance.
     *
     * @return self
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Set the title for a Card.
     *
     * @param string $title
     *
     * @return self
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the formattedText for a Card.
     *
     * @param string $formattedText
     *
     * @return self
     */
    public function formattedText($formattedText)
    {
        $this->formattedText = $formattedText;

        return $this;
    }

    /**
     * Set the image for a Card.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return self
     */
    public function image($imageUrl, $accessibilityText = null)
    {
        $this->imageUrl = $imageUrl;
        $this->accessibilityText = $accessibilityText;

        return $this;
    }

    /**
     * Set the button for a Card.
     *
     * @param string $buttonText button text
     * @param string $buttonUrl  button link URL
     *
     * @return self
     */
    public function button($buttonText, $buttonUrl)
    {
        $this->buttons[] = [
            'buttonText' => $buttonText,
            'buttonUrl' =>  $buttonUrl,
        ];

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
        $basicCard = [];

        if ($this->title) {
            $basicCard['title'] = $this->title;
        }

        if ($this->formattedText) {
            $basicCard['formattedText'] = $this->formattedText;
        }

        if ($this->imageUrl) {
            $basicCard['image'] = [
                'url'               => $this->imageUrl,
                'accessibilityText' => ($this->accessibilityText) ? $this->accessibilityText : 'accessibility text',
            ];
        }

        if ($this->buttons) {
            foreach ($this->buttons as $button) {
                $basicCard['buttons'][] =
                    [
                        'title'         => $button['buttonText'],
                        'openUrlAction' => [
                            'url' => $button['buttonUrl'],
                        ],
                    ];
            }
        }

        $out['basicCard'] = $basicCard;

        return $out;
    }
}
