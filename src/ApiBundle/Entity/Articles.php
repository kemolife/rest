<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Articles
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ArticlesRepository")
 */
class Articles
{
    const STS_ACTIVE = 1;
    const STS_NO_ACTIVE = 0;

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
     * @ORM\Column(name="title", type="string", length=100, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="image", size="imageSize")
     * @var File
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=100)
     */
    private $alias;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", options = {"default": 1})
     */
    private $status = 1;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinTable(
     *  name="cat_article",
     *  joinColumns={
     *      @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *  }
     * )
     */
    private $category;

    /**
     * @var array
     *
     * @ORM\Column(name="meta_tag", type="array")
     */
    private $meta_tag;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @ORM\JoinTable(
     *  name="tag_article",
     *  joinColumns={
     *      @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *  }
     * )
     */
    private $tag;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;


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
     * Set title.
     *
     * @param string $title
     *
     * @return Articles
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Articles
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param File|UploadedFile|null $image
     */

    public function setFile(File $image = null)
    {
        $this->file = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return mixed
     */

    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Articles
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set alias.
     *
     * @param string $alias
     *
     * @return Articles
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias.
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Articles
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set metaTag.
     *
     * @param array $metaTag
     *
     * @return Articles
     */
    public function setMetaTag($metaTag)
    {
        $this->meta_tag = $metaTag;

        return $this;
    }

    /**
     * Get metaTag.
     *
     * @return array
     */
    public function getMetaTag()
    {
        return $this->meta_tag;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category.
     *
     * @param \ApiBundle\Entity\Category $category
     *
     * @return Articles
     */
    public function addCategory(\ApiBundle\Entity\Category $category)
    {
        $this->category[] = $category;
        return $this;
    }

    /**
     * Remove category.
     *
     * @param \ApiBundle\Entity\Category $category
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCategory(\ApiBundle\Entity\Category $category)
    {
        return $this->category->removeElement($category);
    }

    /**
     * Get category.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Add tag.
     *
     * @param \ApiBundle\Entity\Tag $tag
     *
     * @return Articles
     */
    public function addTag(\ApiBundle\Entity\Tag $tag)
    {
        $this->tag[] = $tag;

        return $this;
    }

    /**
     * Remove tag.
     *
     * @param \ApiBundle\Entity\Tag $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag(\ApiBundle\Entity\Tag $tag)
    {
        return $this->tag->removeElement($tag);
    }

    /**
     * Get tag.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Articles
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Articles
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
