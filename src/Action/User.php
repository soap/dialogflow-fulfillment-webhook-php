<?php

namespace Dialogflow\Action;

use Carbon\Carbon;
use Dialogflow\Action\User\Name;
use Dialogflow\Action\User\Storage;

class User
{
    protected ?Name $name;

    protected ?Storage $storage;

    protected ?Carbon $lastSeen;

    /**
     * @param array $data request array
     */
    public function __construct(array $data)
    {
        if (isset($data['profile'])) {
            $this->name = new Name($data['profile']);
        }

        if (isset($data['userStorage']) && count(get_object_vars(json_decode($data['userStorage'])->data))) {
            $this->storage = new Storage(json_decode($data['userStorage']));
        } else {
            $this->storage = new Storage(json_decode(''));
        }

        if (isset($data['lastSeen'])) {
            $this->lastSeen = new Carbon($data['lastSeen']);
        }
    }

    /**
     * User's permissioned name info.
     *
     * @return null|Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * User's session storage.
     *
     * @return null|Storage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Timestamp for the last access from the user.
     *
     * @return null|Carbon
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }
}
