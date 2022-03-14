<?php

namespace App\Controller;

use App\Entity\CompraSuministro;
use App\Entity\DetalleCompraSumistronistro;
use App\Entity\Producto;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompraSuministroController extends AbstractController
{
    #[Route('/compra/suministro', name: 'app_compra_suministro')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $productos = $em->getRepository(Producto::class)->findAll();
        return $this->render('compra_suministro/index.html.twig', [
            'controller_name' => 'CompraSuministroController',
            'productos' => $productos
        ]);
    }

    #[Route('/compra/suministro/list', name: 'list_compra_suministro')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $user_id = $this->getUser();

        $compras = $em->getRepository(CompraSuministro::class)->MisCompras($user_id->getId());

        return $this->render('compra_suministro/list.html.twig', [
            'compras' => $compras
        ]);
    }

    #[Route('/compra/suministro/{id}', name: 'show_compra_suministro', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $em = $doctrine->getManager();

        $compra = $em->getRepository(CompraSuministro::class)->find($id);

        $detalles = $em->getRepository(DetalleCompraSumistronistro::class)->BuscarDetalles($id);

        return $this->render('compra_suministro/show.html.twig', [
            'detalles' => $detalles,
            'idCompra' => $compra
        ]);
    }

    #[Route('/compra/suministro/create', name: 'create_compra_suministro', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        /* Registro de la compra */

        $compra = new CompraSuministro();
        $usuario = $this->getUser();           // obtenemos el id del user validado
        $em_compra = $doctrine->getManager(); // creacion de la entity para guardar registro de la compra

        $total_compra=(int)$request->request->get('total_pagar', '');               // conversion a int requerida para guardar 
        $total_impuesto=(int)$request->request->get('input_total_impuesto', '');

        $compra->setFecha($request->request->get('date', ''));                      // asignamos los datos que vienen de los inputs a entity compra 
        $compra->setDireccion($request->request->get('direccion', ''));
        $compra->setTotalCompra($total_compra);
        $compra->setTotalImpuesto($total_impuesto);
        $compra->setUsuario($usuario);

        $em_compra->persist($compra);                               // Guardamos el registro de la compra
        $em_compra->flush();

        // Registro para los datos de la tabla detalle de compra


        $product_id = $request->request->all('product_id', '');
        $cantidad = $request->request->all('cantidad', '');
        $price = $request->request->all('price', '');
        $subtotal = $request->request->all('subtotal', '');

        $count = 0; 

        while ($count < count($product_id)) {
            $em_detalle = $doctrine->getManager();

            $producto = $doctrine->getRepository(Producto::class)->find((int)$product_id[$count]);



            $detalle = new DetalleCompraSumistronistro();
            $detalle->setProducto($producto);
            $detalle->setCompra($compra);
            $detalle->setCantidad((int)$cantidad[$count]);
            $detalle->setPrecioCompra((int)$price[$count]);
            $detalle->setSubtotal((int)$subtotal[$count]);

            $em_detalle->persist($detalle);
            $em_detalle->flush();
            $count = $count + 1;
        }
        $this->addFlash('compra_exito', 'La compra se realizo correctamente');
        return $this->redirectToRoute('list_compra_suministro');
    }
}
