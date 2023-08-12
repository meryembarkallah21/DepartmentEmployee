<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDept;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Responsable;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrSalarie;

    /**
* @ORM\Column(type="string",length=255)
*/
private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDept(): ?string
    {
        return $this->nomDept;
    }

    public function setNomDept(string $nomDept): self
    {
        $this->nomDept = $nomDept;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->Responsable;
    }

    public function setResponsable(string $Responsable): self
    {
        $this->Responsable = $Responsable;

        return $this;
    }

    public function getNbrSalarie(): ?int
    {
        return $this->nbrSalarie;
    }

    public function setNbrSalarie(int $nbrSalarie): self
    {
        $this->nbrSalarie = $nbrSalarie;

        return $this;
    }


    /**
    * @return mixed
*/
public function getImage()
{
return $this->image;
}
/**
* @param mixed $image
*/
public function setImage($image): void
{
$this->image = $image;
}


}
