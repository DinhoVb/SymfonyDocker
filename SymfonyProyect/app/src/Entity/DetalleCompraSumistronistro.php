<?php

namespace App\Entity;

use App\Repository\DetalleCompraSumistronistroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetalleCompraSumistronistroRepository::class)]
class DetalleCompraSumistronistro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /* #[ORM\Column(type: 'bigint')]
    private $compra_id;

    #[ORM\Column(type: 'bigint')]
    private $producto_id; */

    #[ORM\Column(type: 'bigint')]
    private $cantidad;

    #[ORM\Column(type: 'bigint')]
    private $precio_compra;

    #[ORM\Column(type: 'bigint')]
    private $subtotal;

    #[ORM\ManyToOne(targetEntity: Producto::class, inversedBy: "detalles")]
    private $producto;

    #[ORM\ManyToOne(targetEntity: CompraSuministro::class, inversedBy: "detalles")]
    private $compra;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto): void
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * @param mixed $compra
     */
    public function setCompra($compra): void
    {
        $this->compra = $compra;
    }


    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecioCompra(): ?string
    {
        return $this->precio_compra;
    }

    public function setPrecioCompra(string $precio_compra): self
    {
        $this->precio_compra = $precio_compra;

        return $this;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function setSubtotal(string $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }
}
