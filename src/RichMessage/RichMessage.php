<?php

namespace Dialogflow\RichMessage;

use RuntimeException;

abstract class RichMessage
{
    protected const API_V1 = 1;
    protected const API_V2 = 2;

    protected int $agentVersion = self::API_V2;
    protected string $requestSource;
    protected string $fallbackText;

    protected $v2PlatformMap = [
        'unspecified'        => 'PLATFORM_UNSPECIFIED',
        'facebook'           => 'FACEBOOK',
        'slack'              => 'SLACK',
        'slack_testbot'      => 'SLACK',
        'telegram'           => 'TELEGRAM',
        'kik'                => 'KIK',
        'skype'              => 'SKYPE',
        'line'               => 'LINE',
        'viber'              => 'VIBER',
        'google'             => 'ACTIONS_ON_GOOGLE',
        'DIALOGFLOW_CONSOLE' => 'DIALOGFLOW_CONSOLE',
    ];

    protected $supportedRichMessagePlatforms = [
        'facebook', 'slack', 'telegram', 'kik', 'skype', 'line', 'viber', 'google', 'DIALOGFLOW_CONSOLE',
    ];

    /** @var array */
    protected $payload;

    /**
     * Check if request source support rich message.
     *
     * @return bool
     */
    public function doesSupportRichMessage()
    {
        return in_array($this->requestSource, $this->supportedRichMessagePlatforms);
    }

    /**
     * Set the fallback text if a request source doesn't support rich messages.
     */
    public function setFallbackText($text)
    {
        $this->fallbackText = $text;

        return $this;
    }

    /**
     * Alias of setFallbackText() to fit more inline with text(), button(), image(), etc.
     */
    public function fallbackText($text)
    {
        return $this->setFallbackText($text);
    }

    /**
     * Get the fallback text.
     *
     * @return  string
     */
    public function getFallbackText()
    {
        return $this->fallbackText;
    }

    protected function setAgentVersion($agentVersion)
    {
        if (self::API_V1 != $agentVersion && self::API_V2 != $agentVersion) {
            throw new RuntimeException('Invalid agent version');
        }

        $this->agentVersion = $agentVersion;

        return $this;
    }

    protected function setRequestSource($requestSource)
    {
        if (null == $requestSource) {
            $requestSource = 'unspecified';
        }

        $this->requestSource = $requestSource;

        return $this;
    }

    /**
     * Render response as array.
     *
     * @return array
     */
    public function render()
    {
        if (self::API_V1 == $this->agentVersion) {
            return $this->renderV1();
        } elseif (self::API_V2 == $this->agentVersion) {
            return $this->renderV2();
        } else {
            throw new RuntimeException('Invalid agent version');
        }
    }

    /**
     * Render response as array for API V1.
     *
     * @return array
     */
    protected function renderV1()
    {
        return [];
    }

    /**
     * Render response as array for API V2.
     *
     * @return array
     */
    protected function renderV2()
    {
        return [];
    }
}
