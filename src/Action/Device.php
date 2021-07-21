<?php

namespace Dialogflow\Action;

use Dialogflow\Action\Types\Location;

class Device
{
    protected ?Location $location;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
    }

    /**
     * If granted permission to device's location in previous intent, returns device's location.
     *
     * @return null|Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
