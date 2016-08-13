<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Project
 *
 * @ORM\Table(name="tm_projects")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_project_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_team_id", type="integer")
     */
    private $fkTeamId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_project_type_id", type="integer")
     */
    private $fkProjectTypeId;


    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=255)
     * @Assert\NotBlank(message="Proje Adı boş bırakılamaz")
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="project_description", type="string", length=255)
     * @Assert\NotBlank(message="Proje Açıklama boş bırakılamaz")
     */
    private $projectDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="project_property", type="string", length=255)
     * @Assert\NotBlank(message="Proje Özellikler boş bırakılamaz")
     */
    private $projectProperty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_created_date", type="datetime")
     */
    private $projectCreatedDate;

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
     * Set fkTeamId
     *
     * @param integer $fkTeamId
     *
     * @return Project
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
     * Set fkProjectTypeId
     *
     * @param integer $fkProjectTypeId
     *
     * @return Project
     */
    public function setFkProjectTypeId($fkProjectTypeId)
    {
        $this->fkProjectTypeId = $fkProjectTypeId;

        return $this;
    }

    /**
     * Get fkProjectTypeId
     *
     * @return integer
     */
    public function getFkProjectTypeId()
    {
        return $this->fkProjectTypeId;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set projectDescription
     *
     * @param string $projectDescription
     *
     * @return Project
     */
    public function setProjectDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    /**
     * Get projectDescription
     *
     * @return string
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }

    /**
     * Set projectProperty
     *
     * @param string $projectProperty
     *
     * @return Project
     */
    public function setProjectProperty($projectProperty)
    {
        $this->projectProperty = $projectProperty;

        return $this;
    }

    /**
     * Get projectProperty
     *
     * @return string
     */
    public function getProjectProperty()
    {
        return $this->projectProperty;
    }

    /**
     * Set projectCreatedDate
     *
     * @param \DateTime $projectCreatedDate
     *
     * @return Project
     */
    public function setProjectCreatedDate($projectCreatedDate)
    {
        $this->projectCreatedDate = $projectCreatedDate;

        return $this;
    }

    /**
     * Get projectCreatedDate
     *
     * @return \DateTime
     */
    public function getProjectCreatedDate()
    {
        return $this->projectCreatedDate;
    }
}
