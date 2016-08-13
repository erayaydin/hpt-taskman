<?php

namespace MemberBundle\Manager\Password;

use MemberBundle\Service\Password\PasswordInterface;

class PasswordManager implements PasswordInterface
{
    private $passwordInterface;

    public function __construct(PasswordInterface $passwordInterface)
    {
        $this->passwordInterface = $passwordInterface;
    }

    public function generate()
    {
        return $this->passwordInterface->generate();
    }
}