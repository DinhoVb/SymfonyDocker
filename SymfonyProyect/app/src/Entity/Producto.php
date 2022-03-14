<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'bigint')]
    private $stock;

    #[ORM\Column(type: 'bigint')]
    private $precio_unitario;

    #[ORM\OneToMany(targetEntity: DetalleCompraSumistronistro::class, mappedBy: "producto")]
    private $detalles;

    public function __construct()
    {
        $this->detalleProducto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrecioUnitario(): ?string
    {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario(string $precio_unitario): self
    {
        $this->precio_unitario = $precio_unitario;

        return $this;
    }

    /* *
     * @return Collection<int, DetalleCompraSumistronistro>
     */
    /* public function getDetalleProducto(): Collection
    {
        return $this->detalleProducto;
    }

    public function addDetalleProducto(DetalleCompraSumistronistro $detalleProducto): self
    {
        if (!$this->detalleProducto->contains($detalleProducto)) {
            $this->detalleProducto[] = $detalleProducto;
            $detalleProducto->setProductoId($this);
        }

        return $this;
    }

    public function removeDetalleProducto(DetalleCompraSumistronistro $detalleProducto): self
    {
        if ($this->detalleProducto->removeElement($detalleProducto)) {
            // set the owning side to null (unless already changed)
            if ($detalleProducto->getProductoId() === $this) {
                $detalleProducto->setProductoId(null);
            }
        }

        return $this;
    } */
}
