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
 * @ORM\Table(name="gallery")
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   denormalizationContext={"groups" = {"write"}}
 * )
 */
class gallery
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
    public $user_id;
 
    /**
     * @ORM\Column(length=128, unique=true)
     * @Groups({"read", "write"})
     */
    public $name;
 
    /**
     * @ORM\Column(type="text")
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
    public function getUserId()
    {
        return $this->user_id;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
 
}