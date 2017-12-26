<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogActivity
 *
 * @ORM\Table(name="log_activity")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\LogActivityRepository")
 */
class LogActivity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="model_name", type="string", length=50)
     */
    private $model_name;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="smallint")
     */
    private $active;

    /**
     * @var array
     *
     * @ORM\Column(name="daprecated_attributes", type="array")
     */
    private $daprecated_attributes;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set modelName.
     *
     * @param string $modelName
     *
     * @return LogActivity
     */
    public function setModelName($modelName)
    {
        $this->model_name = $modelName;

        return $this;
    }

    /**
     * Get modelName.
     *
     * @return string
     */
    public function getModelName()
    {
        return $this->model_name;
    }

    /**
     * Set active.
     *
     * @param int $active
     *
     * @return LogActivity
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set daprecatedAttributes.
     *
     * @param array $daprecatedAttributes
     *
     * @return LogActivity
     */
    public function setDaprecatedAttributes($daprecatedAttributes)
    {
        $this->daprecated_attributes = $daprecatedAttributes;

        return $this;
    }

    /**
     * Get daprecatedAttributes.
     *
     * @return array
     */
    public function getDaprecatedAttributes()
    {
        return $this->daprecated_attributes;
    }
}
