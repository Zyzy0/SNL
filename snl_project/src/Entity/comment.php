<?php
 
 namespace App\Entity;

 use ApiPlatform\Core\Annotation\ApiResource;
 use App\Repository\AlbumRepository;
 use Doctrine\Common\Collections\ArrayCollection;
 use Doctrine\Common\Collections\Collection;
 use Doctrine\ORM\Mapping as ORM;
 use Symfony\Component\Serializer\Annotation\Groups;
 
 
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="comment")
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   denormalizationContext={"groups" = {"write"}}
 * )
 */
class comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id = null;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    public $image_id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    public $user_id;
 
    /**
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     */
    public $content;
 
    /**
     * @ORM\Column(length=32, unique=true)
     * @Groups({"read", "write"})
     */
    public $title;
 
    /******** METHODS ********/

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->image_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param mixed $image_id
     */
    public function setImageId($image_id): void
    {
        $this->image_id = $image_id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }
 
}