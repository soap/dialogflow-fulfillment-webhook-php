<?php

namespace Dialogflow\RichMessage;

class Payload extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    protected const V1MESSAGEOBJECTTEXT = 0;

    /**
     * Create a new Payload instance.
     *
     * @param array $payload
     *
     * @return self
     */
    public static function create($payload)
    {
        $payloadObject = new self();
        $payloadObject->payload($payload);

        return $payloadObject;
    }

    /**
     * Set the payload for a Payload.
     *
     * @param array $payload containing the payload response content
     */
    public function payload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Render rich message as array.
     *
     * @return array
     */
    public function render()
    {
        return [$this->requestSource => $this->payload];
    }
}
