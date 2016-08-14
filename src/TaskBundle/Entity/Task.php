<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table(name="tm_tasks")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_task_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pkTaskId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_member_id", type="integer")
     */
    private $fkMemberId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_action_id", type="integer")
     */
    private $fkActionId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_priority_id", type="integer")
     */
    private $fkPriorityId;

    /**
     * @var string
     *
     * @ORM\Column(name="task_title", type="string", length=255)
     * @Assert\NotBlank(message="Görev Başlık boş bırakılamaz")
     */
    private $taskTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="task_description", type="string", length=255)
     * @Assert\NotBlank(message="Görev Açıklama boş bırakılamaz")
     */
    private $taskDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="task_comment", type="string", length=255)
     * @Assert\NotBlank(message="Görev Yorum boş bırakılamaz")
     */
    private $taskComment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="task_created_date", type="datetime")
     */
    private $taskCreatedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="task_modification_date", type="datetime")
     */
    private $taskModificationDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="task_is_complete", type="boolean")
     */
    private $taskIsComplete;

    /**
     * @var bool
     *
     * @ORM\Column(name="task_is_active", type="boolean")
     */
    private $taskIsActive;

    /**
     * Get pkTaskId
     *
     * @return integer
     */
    public function getPkTaskId()
    {
        return $this->pkTaskId;
    }

    /**
     * Set fkMemberId
     *
     * @param integer $fkMemberId
     *
     * @return Task
     */
    public function setFkMemberId($fkMemberId)
    {
        $this->fkMemberId = $fkMemberId;

        return $this;
    }

    /**
     * Get fkMemberId
     *
     * @return integer
     */
    public function getFkMemberId()
    {
        return $this->fkMemberId;
    }

    /**
     * Set fkActionId
     *
     * @param integer $fkActionId
     *
     * @return Task
     */
    public function setFkActionId($fkActionId)
    {
        $this->fkActionId = $fkActionId;

        return $this;
    }

    /**
     * Get fkActionId
     *
     * @return integer
     */
    public function getFkActionId()
    {
        return $this->fkActionId;
    }

    /**
     * Set fkPriorityId
     *
     * @param integer $fkPriorityId
     *
     * @return Task
     */
    public function setFkPriorityId($fkPriorityId)
    {
        $this->fkPriorityId = $fkPriorityId;

        return $this;
    }

    /**
     * Get fkPriorityId
     *
     * @return integer
     */
    public function getFkPriorityId()
    {
        return $this->fkPriorityId;
    }

    /**
     * Set taskTitle
     *
     * @param string $taskTitle
     *
     * @return Task
     */
    public function setTaskTitle($taskTitle)
    {
        $this->taskTitle = $taskTitle;

        return $this;
    }

    /**
     * Get taskTitle
     *
     * @return string
     */
    public function getTaskTitle()
    {
        return $this->taskTitle;
    }

    /**
     * Set taskDescription
     *
     * @param string $taskDescription
     *
     * @return Task
     */
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;

        return $this;
    }

    /**
     * Get taskDescription
     *
     * @return string
     */
    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    /**
     * Set taskComment
     *
     * @param string $taskComment
     *
     * @return Task
     */
    public function setTaskComment($taskComment)
    {
        $this->taskComment = $taskComment;

        return $this;
    }

    /**
     * Get taskComment
     *
     * @return string
     */
    public function getTaskComment()
    {
        return $this->taskComment;
    }

    /**
     * Set taskCreatedDate
     *
     * @param \DateTime $taskCreatedDate
     *
     * @return Task
     */
    public function setTaskCreatedDate($taskCreatedDate)
    {
        $this->taskCreatedDate = $taskCreatedDate;

        return $this;
    }

    /**
     * Get taskCreatedDate
     *
     * @return \DateTime
     */
    public function getTaskCreatedDate()
    {
        return $this->taskCreatedDate;
    }

    /**
     * Set taskModificationDate
     *
     * @param \DateTime $taskModificationDate
     *
     * @return Task
     */
    public function setTaskModificationDate($taskModificationDate)
    {
        $this->taskModificationDate = $taskModificationDate;

        return $this;
    }

    /**
     * Get taskModificationDate
     *
     * @return \DateTime
     */
    public function getTaskModificationDate()
    {
        return $this->taskModificationDate;
    }

    /**
     * Set taskIsComplete
     *
     * @param boolean $taskIsComplete
     *
     * @return Task
     */
    public function setTaskIsComplete($taskIsComplete)
    {
        $this->taskIsComplete = $taskIsComplete;

        return $this;
    }

    /**
     * Get taskIsComplete
     *
     * @return boolean
     */
    public function getTaskIsComplete()
    {
        return $this->taskIsComplete;
    }

    /**
     * Set taskIsActive
     *
     * @param boolean $taskIsActive
     *
     * @return Task
     */
    public function setTaskIsActive($taskIsActive)
    {
        $this->taskIsActive = $taskIsActive;

        return $this;
    }

    /**
     * Get taskIsActive
     *
     * @return boolean
     */
    public function getTaskIsActive()
    {
        return $this->taskIsActive;
    }
}
