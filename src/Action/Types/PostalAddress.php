<?php

namespace Dialogflow\Action\Types;

/**
 * TODO: can't seem to find an example for this.
 */
class PostalAddress
{
    private array $data = [];

    /**
     * @param array $data request array
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
