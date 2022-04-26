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
 * @ORM\Table(name="image")
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   denormalizationContext={"groups" = {"write"}}, 
 * )
 */
class image
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
    public $gallery_id;
 
    /**
     * @ORM\Column(length=128, unique=true)
     * @Groups({"read", "write"})
     */
    public $source;
 
    /**
     * @ORM\Column(length=128, unique=true)
     * @Groups({"read", "write"})
     */
    public $description;
 
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getGalleryId()
    {
        return $this->gallery_id;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $gallery_id
     */
    public function setGalleryId($gallery_id): void
    {
        $this->gallery_id = $gallery_id;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }
}