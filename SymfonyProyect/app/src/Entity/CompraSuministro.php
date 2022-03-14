<?php

namespace App\Entity;

use App\Repository\CompraSuministroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompraSuministroRepository::class)]
class CompraSuministro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;



    #[ORM\Column(type: 'string')]
    private $fecha;

    #[ORM\Column(type: 'bigint')]
    private $total_compra;

    #[ORM\Column(type: 'bigint')]
    private $total_impuesto;

    #[ORM\Column(type: 'string', length: 255)]
    private $direccion;

    /* #[ORM\Column(type: 'bigint', nullable: true)]
    private $usuario; */
    
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "compras")]
    private $usuario;

    #[ORM\OneToMany(targetEntity: DetalleCompraSumistronistro::class, mappedBy: "compra")]
    private $detalles;

    public function __construct()
    {
        $this->detalleCompras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }



    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTotalCompra(): ?string
    {
        return $this->total_compra;
    }

    public function setTotalCompra(string $total_compra): self
    {
        $this->total_compra = $total_compra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalImpuesto()
    {
        return $this->total_impuesto;
    }

    /**
     * @param mixed $total_impuesto
     */
    public function setTotalImpuesto($total_impuesto): void
    {
        $this->total_impuesto = $total_impuesto;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }



    /**
     * @return Collection<int, DetalleCompraSumistronistro>
     */
    /* public function getDetalleCompras(): Collection
    {
        return $this->detalleCompras;
    }

    public function addDetalleCompra(DetalleCompraSumistronistro $detalleCompra): self
    {
        if (!$this->detalleCompras->contains($detalleCompra)) {
            $this->detalleCompras[] = $detalleCompra;
            $detalleCompra->setCompraId($this);
        }

        return $this;
    }

    public function removeDetalleCompra(DetalleCompraSumistronistro $detalleCompra): self
    {
        if ($this->detalleCompras->removeElement($detalleCompra)) {
            // set the owning side to null (unless already changed)
            if ($detalleCompra->getCompraId() === $this) {
                $detalleCompra->setCompraId(null);
            }
        }

        return $this;
    } */


}
