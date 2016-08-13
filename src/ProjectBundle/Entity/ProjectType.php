<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectType
 *
 * @ORM\Table(name="tm_project_types")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\ProjectTypeRepository")
 */
class ProjectType
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_project_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pkProjectTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="project_type_name", type="string", length=255)
     */
    private $projectTypeName;

    /**
     * Get pkProjectTypeId
     *
     * @return integer
     */
    public function getPkProjectTypeId()
    {
        return $this->pkProjectTypeId;
    }

    /**
     * Set projectTypeName
     *
     * @param string $projectTypeName
     *
     * @return ProjectType
     */
    public function setProjectTypeName($projectTypeName)
    {
        $this->projectTypeName = $projectTypeName;

        return $this;
    }

    /**
     * Get projectTypeName
     *
     * @return string
     */
    public function getProjectTypeName()
    {
        return $this->projectTypeName;
    }
}
