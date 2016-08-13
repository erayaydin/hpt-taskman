<?php

namespace MemberBundle\Service\Password;

class PasswordServiceNormal implements PasswordInterface
{
    public function generate()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyz";

        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, count($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }

        return $pass;
    }
}