<?php

namespace MichaelKaefer\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class WrikeResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['data'][0]['id'] ?: null;
    }

    /**
     * Get resource owner name
     *
     * @return string|null
     */
    public function getName()
    {
        if( isset($this->response['data'][0]['firstName']) && isset($this->response['data'][0]['lastName']) ) {
            return $this->response['data'][0]['firstName'] . ' ' . $this->response['data'][0]['lastName'];
        }
        
        return '';
    }

    /**
     * Get resource owner username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return null;
    }

    /**
     * Get resource owner location
     *
     * @return string|null
     */
    public function getLocation()
    {
        return null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
