<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;
use Dialogflow\Action\Questions\ListCard\Option;

class ListCard implements QuestionInterface
{
    /** @var string */
    protected string $title;

    /** @var Option[] */
    protected array $options = [];

    /**
     * Create a new List instance.
     *
     * @return self
     */
    public static function create()
    {
        return new self();
    }

    /**
     * List title.
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
     * Add list option.
     *
     * @param \Dialogflow\Action\Questions\ListCard\Option $option
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
     * @return array
     */
    public function renderRichResponseItem()
    {
        return [];
    }

    /**
     * Render System Intent as array.
     *
     * @return array
     */
    public function renderSystemIntent()
    {
        $out = [];
        $items = [];

        foreach ($this->options as $option) {
            $items[] = $option->render();
        }

        $out['intent'] = 'actions.intent.OPTION';
        $out['data'] = [
            '@type'      => 'type.googleapis.com/google.actions.v2.OptionValueSpec',
            'listSelect' => [
                'title' => $this->title,
                'items' => $items,
            ],
        ];

        return $out;
    }
}
