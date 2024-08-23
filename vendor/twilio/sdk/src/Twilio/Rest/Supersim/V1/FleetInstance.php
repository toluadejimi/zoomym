<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Supersim
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Supersim\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $accountSid
 * @property string|null $sid
 * @property string|null $uniqueName
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $url
 * @property bool|null $dataEnabled
 * @property int|null $dataLimit
 * @property string $dataMetering
 * @property bool|null $smsCommandsEnabled
 * @property string|null $smsCommandsUrl
 * @property string|null $smsCommandsMethod
 * @property string|null $networkAccessProfileSid
 * @property string|null $ipCommandsUrl
 * @property string|null $ipCommandsMethod
 */
class FleetInstance extends InstanceResource
{
    /**
     * Initialize the FleetInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID of the Fleet resource to fetch.
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
            'dataEnabled' => Values::array_get($payload, 'data_enabled'),
            'dataLimit' => Values::array_get($payload, 'data_limit'),
            'dataMetering' => Values::array_get($payload, 'data_metering'),
            'smsCommandsEnabled' => Values::array_get($payload, 'sms_commands_enabled'),
            'smsCommandsUrl' => Values::array_get($payload, 'sms_commands_url'),
            'smsCommandsMethod' => Values::array_get($payload, 'sms_commands_method'),
            'networkAccessProfileSid' => Values::array_get($payload, 'network_access_profile_sid'),
            'ipCommandsUrl' => Values::array_get($payload, 'ip_commands_url'),
            'ipCommandsMethod' => Values::array_get($payload, 'ip_commands_method'),
        ];

        $this->solution = ['sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return FleetContext Context for this FleetInstance
     */
    protected function proxy(): FleetContext
    {
        if (!$this->context) {
            $this->context = new FleetContext(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the FleetInstance
     *
     * @return FleetInstance Fetched FleetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): FleetInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the FleetInstance
     *
     * @param array|Options $options Optional Arguments
     * @return FleetInstance Updated FleetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): FleetInstance
    {

        return $this->proxy()->update($options);
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Supersim.V1.FleetInstance ' . \implode(' ', $context) . ']';
    }
}

