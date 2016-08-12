<?php

namespace LoginBundle\Repository;

class MemberRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMemberByEmailAndPassword($email, $password)
    {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare('select * from tm_members where member_email = :email and member_password = :password');

        $statement->bindValue('email', $email);
        $statement->bindValue('password', $password);

        $statement->execute();
        $result = $statement->fetch();

        return $result;
    }
}
