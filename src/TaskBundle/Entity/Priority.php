<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Priority
 *
 * @ORM\Table(name="tm_priorities")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\PriorityRepository")
 */
class Priority
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_priority_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pkPriorityId;

    /**
     * @var string
     *
     * @ORM\Column(name="priority_name", type="string", length=255)
     */
    private $priorityName;

    /**
     * Get pkPriorityId
     *
     * @return integer
     */
    public function getPkPriorityId()
    {
        return $this->pkPriorityId;
    }

    /**
     * Set priorityName
     *
     * @param string $priorityName
     *
     * @return Priority
     */
    public function setPriorityName($priorityName)
    {
        $this->priorityName = $priorityName;

        return $this;
    }

    /**
     * Get priorityName
     *
     * @return string
     */
    public function getPriorityName()
    {
        return $this->priorityName;
    }
}
