<?php

namespace LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Member
 *
 * @ORM\Table(name="tm_members")
 * @ORM\Entity(repositoryClass="LoginBundle\Repository\MemberRepository")
 */
class Member
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_member_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pkMemberId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_role_id", type="integer")
     * @Assert\NotBlank(message="Rol Numarası boş bırakılamaz")
     *
     */
    private $fkRoleId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_team_id", type="integer")
     * @Assert\NotBlank(message="Takım Numarası boş bırakılamaz")
     */
    private $fkTeamId;

    /**
     * @var string
     *
     * @ORM\Column(name="member_name", type="string", length=255)
     * @Assert\NotBlank(message="Üye Adı boş bırakılamaz")
     */
    private $memberName;

    /**
     * @var string
     *
     * @ORM\Column(name="member_surname", type="string", length=255)
     * @Assert\NotBlank(message="Üye Soy Adı bırakılamaz")
     */
    private $memberSurname;

    /**
     * @var string
     *
     * @ORM\Column(name="member_email", type="string", length=255)
     * @Assert\NotBlank(message="Uye E-Posta bırakılamaz")
     */
    private $memberEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="member_password", type="string", length=255)
     * @Assert\NotBlank(message="Uye Sifre bırakılamaz")
     */
    private $memberPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="member_created_date", type="datetime")
     */
    private $memberCreatedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="member_modification_date", type="datetime")
     */
    private $memberModificationDate;

    /**
     * Get pkMemberId
     *
     * @return integer
     */
    public function getPkMemberId()
    {
        return $this->pkMemberId;
    }

    /**
     * Set fkRoleId
     *
     * @param integer $fkRoleId
     *
     * @return Member
     */
    public function setFkRoleId($fkRoleId)
    {
        $this->fkRoleId = $fkRoleId;

        return $this;
    }

    /**
     * Get fkRoleId
     *
     * @return integer
     */
    public function getFkRoleId()
    {
        return $this->fkRoleId;
    }

    /**
     * Set fkTeamId
     *
     * @param integer $fkTeamId
     *
     * @return Member
     */
    public function setFkTeamId($fkTeamId)
    {
        $this->fkTeamId = $fkTeamId;

        return $this;
    }

    /**
     * Get fkTeamId
     *
     * @return integer
     */
    public function getFkTeamId()
    {
        return $this->fkTeamId;
    }

    /**
     * Set memberName
     *
     * @param string $memberName
     *
     * @return Member
     */
    public function setMemberName($memberName)
    {
        $this->memberName = $memberName;

        return $this;
    }

    /**
     * Get memberName
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->memberName;
    }

    /**
     * Set memberSurname
     *
     * @param string $memberSurname
     *
     * @return Member
     */
    public function setMemberSurname($memberSurname)
    {
        $this->memberSurname = $memberSurname;

        return $this;
    }

    /**
     * Get memberSurname
     *
     * @return string
     */
    public function getMemberSurname()
    {
        return $this->memberSurname;
    }

    /**
     * Set memberEmail
     *
     * @param string $memberEmail
     *
     * @return Member
     */
    public function setMemberEmail($memberEmail)
    {
        $this->memberEmail = $memberEmail;

        return $this;
    }

    /**
     * Get memberEmail
     *
     * @return string
     */
    public function getMemberEmail()
    {
        return $this->memberEmail;
    }

    /**
     * Set memberPassword
     *
     * @param string $memberPassword
     *
     * @return Member
     */
    public function setMemberPassword($memberPassword)
    {
        $this->memberPassword = $memberPassword;

        return $this;
    }

    /**
     * Get memberPassword
     *
     * @return string
     */
    public function getMemberPassword()
    {
        return $this->memberPassword;
    }

    /**
     * Set memberCreatedDate
     *
     * @param \DateTime $memberCreatedDate
     *
     * @return Member
     */
    public function setMemberCreatedDate($memberCreatedDate)
    {
        $this->memberCreatedDate = $memberCreatedDate;

        return $this;
    }

    /**
     * Get memberCreatedDate
     *
     * @return \DateTime
     */
    public function getMemberCreatedDate()
    {
        return $this->memberCreatedDate;
    }

    /**
     * Set memberModificationDate
     *
     * @param \DateTime $memberModificationDate
     *
     * @return Member
     */
    public function setMemberModificationDate($memberModificationDate)
    {
        $this->memberModificationDate = $memberModificationDate;

        return $this;
    }

    /**
     * Get memberModificationDate
     *
     * @return \DateTime
     */
    public function getMemberModificationDate()
    {
        return $this->memberModificationDate;
    }
}
