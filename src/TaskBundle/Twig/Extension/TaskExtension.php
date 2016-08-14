<?php

namespace TaskBundle\Twig\Extension;

class TaskExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('complete', array($this, 'taskCompleteFilter')),
            new \Twig_SimpleFilter('status', array($this, 'taskStatusFilter'))
        );
    }

    public function taskCompleteFilter($val)
    {
        return $val == 0 ? "Devam Ediyor" : "Tamamlandı";
    }

    public function taskStatusFilter($val)
    {
        return $val == 0 ? "Pasif" : "Aktif";
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}
