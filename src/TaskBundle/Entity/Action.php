<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="tm_actions")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\ActionRepository")
 */
class Action
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_action_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pkActionId;

    /**
     * @var string
     *
     * @ORM\Column(name="action_name", type="string", length=255)
     */
    private $actionName;

    /**
     * Get pkActionId
     *
     * @return integer
     */
    public function getPkActionId()
    {
        return $this->pkActionId;
    }

    /**
     * Set actionName
     *
     * @param string $actionName
     *
     * @return Action
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    /**
     * Get actionName
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }
}
