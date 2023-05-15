<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class Confirmation implements QuestionInterface
{
    protected string $requestConfirmationText;

    /**
     * Constructor for Confirmation object.
     *
     * @param string $requestConfirmationText
     */
    public function __construct($requestConfirmationText)
    {
        $this->requestConfirmationText = $requestConfirmationText;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return array
     */
    public function renderRichResponseItem()
    {
        return [
            'simpleResponse' => [
                'textToSpeech' => 'PLACEHOLDER_FOR_CONFIRMATION',
            ],
        ];
    }

    /**
     * Render System Intent as array.
     *
     * @return array
     */
    public function renderSystemIntent()
    {
        return [
            'intent' => 'actions.intent.CONFIRMATION',
            'data' => [
                '@type'      => 'type.googleapis.com/google.actions.v2.ConfirmationValueSpec',
                'dialogSpec' => [
                    'requestConfirmationText' => $this->requestConfirmationText,
                ],
            ],
        ];
    }
}
