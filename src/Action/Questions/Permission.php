<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;
use RuntimeException;

class Permission implements QuestionInterface
{
    protected string $context;

    protected array $permissions = [];

    protected array $validPermissions = [
        'NAME',
        'DEVICE_PRECISE_LOCATION',
        'DEVICE_COARSE_LOCATION',
        'UPDATE',
    ];

    /**
     * Constructor for Permission object.
     *
     * @param string $context
     * @param array  $permissions
     *
     * @throws RuntimeException
     */
    public function __construct($context, $permissions)
    {
        $this->context = $context;

        foreach ($permissions as $permission) {
            if (! in_array($permission, $this->validPermissions)) {
                throw new RuntimeException('Invalid permission: '.$permission);
            }
        }

        $this->permissions = $permissions;
    }

    /**
     * Create a new Permission instance.
     *
     * @param string $context
     * @param array  $permissions
     *
     * @return self
     */
    public static function create($context, $permissions)
    {
        return new self($context, $permissions);
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
                'textToSpeech' => 'PLACEHOLDER_FOR_PERMISSION',
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
            'intent' => 'actions.intent.PERMISSION',
            'data' => [
                '@type'       => 'type.googleapis.com/google.actions.v2.PermissionValueSpec',
                'optContext'  => $this->context,
                'permissions' => $this->permissions,
            ],
        ];
    }
}
