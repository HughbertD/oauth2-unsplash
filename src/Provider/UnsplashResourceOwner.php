<?php

namespace Unsplash\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class UnsplashResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * @var array
     */
    private $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->getValueByKey($this->response, 'id');
    }

    public function getName()
    {
        return $this->getFirstname() . " " . $this->getLastname();
    }

    public function getFirstname()
    {
        return $this->getValueByKey($this->response, 'firstname', '');
    }

    public function getLastname()
    {
        return $this->getValueByKey($this->response, 'lastname', '');
    }

    public function toArray()
    {
        return $this->response;
    }
}