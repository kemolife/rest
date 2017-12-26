<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\LogRepository")
 */
class Log
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
     * @var integer
     *
     * @ORM\Column(name="model_id", type="integer")
     */
    private $model_id;

    /**
     * @var array
     *
     * @ORM\Column(name="old_attributes", type="array")
     */
    private $old_attributes;

    /**
     * @var array
     *
     * @ORM\Column(name="new_attributes", type="array")
     */
    private $new_attributes;


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
     * Set modelId.
     *
     * @param string $modelId
     *
     * @return Log
     */
    public function setModelId($modelId)
    {
        $this->model_id = $modelId;

        return $this;
    }

    /**
     * Get modelId.
     *
     * @return string
     */
    public function getModelId()
    {
        return $this->model_id;
    }

    /**
     * Set oldAttributes.
     *
     * @param array $oldAttributes
     *
     * @return Log
     */
    public function setOldAttributes($oldAttributes)
    {
        $this->old_attributes = $oldAttributes;

        return $this;
    }

    /**
     * Get oldAttributes.
     *
     * @return array
     */
    public function getOldAttributes()
    {
        return $this->old_attributes;
    }

    /**
     * Set newAttributes.
     *
     * @param array $newAttributes
     *
     * @return Log
     */
    public function setNewAttributes($newAttributes)
    {
        $this->new_attributes = $newAttributes;

        return $this;
    }

    /**
     * Get newAttributes.
     *
     * @return array
     */
    public function getNewAttributes()
    {
        return $this->new_attributes;
    }
}
