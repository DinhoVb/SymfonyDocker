<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoType;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductoRepository;

class ProductoController extends AbstractController
{
    #[Route('/producto', name: 'app_producto')]
    public function index(): Response
    {
        return $this->render('producto/index.html.twig', [
            'controller_name' => 'ProductoController',
        ]);
    }

    #[Route('/lista-productos', name: 'filtrar_producto', methods: ['GET', 'POST'])]
    public function show(ManagerRegistry $doctrine, Request $request){

        $em = $doctrine->getManager();
        $num = $request->request->get('limit', '');
        $limit = (int)$num;
        $nom = $request->request->get('nombre', '');

        $productos = $em->getRepository(Producto::class)->BuscarProducto($limit, $nom);

        return $this->render('producto/show.html.twig', [
            'productos' => $productos,
            'nombre' => $nom,
            'limit' => $num
        ]);
    }


    #[Route('/lista-producto-all', name: 'list_producto')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $productos = $em->getRepository(Producto::class)->findAll();

        return $this->render('producto/list.html.twig', [
            'productos' => $productos,
        ]);
    }

    #[Route('/new/producto', name: 'new_producto')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em= $doctrine->getManager();
            $em->persist($producto);
            $em->flush();
            $this->addFlash('producto_exito', 'El producto se a registrado correctamente');
            return $this->redirectToRoute('list_producto');
        }

        return $this->render('producto/new.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }
}
