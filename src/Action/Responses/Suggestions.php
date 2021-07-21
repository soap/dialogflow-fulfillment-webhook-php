<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\SuggestionInterface;

class Suggestions implements SuggestionInterface
{
    protected array $suggestions = [];

    /**
     * Create a new Suggestions instance.
     *
     * @param array $suggestions
     *
     * @return self
     */
    public function __construct($suggestions)
    {
        $this->suggestions = $suggestions;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        return [];
    }

    /**
     * Render Rich Response suggestions as array.
     *
     * @return null|string|array
     */
    public function renderRichResponseSuggestion()
    {
        return $this->suggestions;
    }
}
