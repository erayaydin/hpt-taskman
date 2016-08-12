<?php

namespace TeamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table(name="tm_teams")
 * @ORM\Entity(repositoryClass="TeamBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_team_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="team_name", type="string", length=255)
     * @Assert\NotBlank(message="Ad boş bırakılamaz")
     */
    private $teamName;

    /**
     * @var string
     *
     * @ORM\Column(name="team_slogan", type="string", length=255)
     * @Assert\NotBlank(message="Slogan boş bırakılamaz")
     */
    private $teamSlogan;

    /**
     * @var string
     *
     * @ORM\Column(name="team_photo", type="string", length=255)
     * @Assert\NotBlank(message="Fotoğraf boş bırakılamaz")
     */
    private $teamPhoto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="team_created_date", type="datetime")
     *
     */
    private $teamCreatedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="team_modification_date", type="datetime")
     */
    private $teamModificationDate;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set teamName
     *
     * @param string $teamName
     *
     * @return Team
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set teamSlogan
     *
     * @param string $teamSlogan
     *
     * @return Team
     */
    public function setTeamSlogan($teamSlogan)
    {
        $this->teamSlogan = $teamSlogan;

        return $this;
    }

    /**
     * Get teamSlogan
     *
     * @return string
     */
    public function getTeamSlogan()
    {
        return $this->teamSlogan;
    }

    /**
     * Set teamPhoto
     *
     * @param string $teamPhoto
     *
     * @return Team
     */
    public function setTeamPhoto($teamPhoto)
    {
        $this->teamPhoto = $teamPhoto;

        return $this;
    }

    /**
     * Get teamPhoto
     *
     * @return string
     */
    public function getTeamPhoto()
    {
        return $this->teamPhoto;
    }

    /**
     * Set teamCreatedDate
     *
     * @param \DateTime $teamCreatedDate
     *
     * @return Team
     */
    public function setTeamCreatedDate($teamCreatedDate)
    {
        $this->teamCreatedDate = $teamCreatedDate;

        return $this;
    }

    /**
     * Get teamCreatedDate
     *
     * @return \DateTime
     */
    public function getTeamCreatedDate()
    {
        return $this->teamCreatedDate;
    }

    /**
     * Set teamModificationDate
     *
     * @param \DateTime $teamModificationDate
     *
     * @return Team
     */
    public function setTeamModificationDate($teamModificationDate)
    {
        $this->teamModificationDate = $teamModificationDate;

        return $this;
    }

    /**
     * Get teamModificationDate
     *
     * @return \DateTime
     */
    public function getTeamModificationDate()
    {
        return $this->teamModificationDate;
    }
}
