<?php
    //src/Pizz/UserBundle/Entity/Group.php

    namespace Pizz\UserBundle\Entity;

    use FOS\UserBundle\Model\Group as BaseGroup;
    use Doctrine\ORM\Mapping as ORM;

    /**
    * @ORM\Entity
    * @ORM\Table(name="pizz_group")
    */
    class Group extends BaseGroup
    {
        /**
        * @ORM\Id
        * @ORM\Column(type="integer")
        * @ORM\GeneratedValue(strategy="AUTO")
        */
        protected $id;
    }