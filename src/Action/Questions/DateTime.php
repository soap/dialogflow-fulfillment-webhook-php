<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class DateTime implements QuestionInterface
{
    protected string $requestDateTimeText;

    protected string $requestDateText;

    protected string $requestTimeText;

    /**
     * Constructor for DateTime object.
     *
     * @param string $requestDateTimeText initial question
     * @param string $requestDateText     follow up question about the exact date
     * @param string $requestTimeText     follow up question about the exact time
     */
    public function __construct($requestDateTimeText, $requestDateText, $requestTimeText)
    {
        $this->requestDateTimeText = $requestDateTimeText;
        $this->requestDateText = $requestDateText;
        $this->requestTimeText = $requestTimeText;
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
                'textToSpeech' => 'PLACEHOLDER',
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
            'intent' => 'actions.intent.DATETIME',
            'data' => [
                '@type'      => 'type.googleapis.com/google.actions.v2.DateTimeValueSpec',
                'dialogSpec' => [
                    'requestDatetimeText' => $this->requestDateTimeText,
                    'requestDateText'     => $this->requestDateText,
                    'requestTimeText'     => $this->requestTimeText,
                ],
            ],
        ];
    }
}
