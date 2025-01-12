<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class Place implements QuestionInterface
{
    /**
     * This is the initial response by location sub-dialog.
     * For example: "Where do you want to get picked up?".
     */
    protected string $requestPrompt;

    /**
     * This is the context for seeking permissions.
     * For example: "To find a place to pick you up"
     * Prompt to user: "*To find a place to pick you up*, I just need to check your location.
     *     Can I get that from Google?".
     */
    protected string $permissionContext;

    /**
     * Constructor for Place object.
     *
     * @param string $requestPrompt     initial question
     * @param string $permissionContext the context for seeking permissions
     */
    public function __construct($requestPrompt, $permissionContext)
    {
        $this->requestPrompt = $requestPrompt;
        $this->permissionContext = $permissionContext;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
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
     * @return null|array
     */
    public function renderSystemIntent()
    {
        return [
            'intent' => 'actions.intent.PLACE',
            'data' => [
                '@type'      => 'type.googleapis.com/google.actions.v2.PlaceValueSpec',
                'dialogSpec' => [
                    'extension' => [
                        '@type'                 => 'type.googleapis.com/google.actions.v2.PlaceValueSpec.PlaceDialogSpec',
                        'requestPrompt'         => $this->requestPrompt,
                        'permissionContext'     => $this->permissionContext,
                    ],
                ],
            ],
        ];
    }
}
