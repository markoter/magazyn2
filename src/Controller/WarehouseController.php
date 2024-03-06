<?php

namespace App\Controller;

use App\Entity\Warehouse;
use App\Form\WarehouseType;
use App\Repository\WarehouseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

#[Route('/warehouse')]
class WarehouseController extends AbstractController
{
    #[Route('/', name: 'app_warehouse_index', methods: ['GET'])]
    public function index(WarehouseRepository $warehouseRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if($this->isGranted('ROLE_ADMIN')) {
            $warehouses = $warehouseRepository->findAll();
        }
        else {
            $warehouses = $userRepository->findWarehousesByUser($user);
        }


        // dump($warehouses); // Add this line before the render method call
        return $this->render('warehouse/index.html.twig', [
            'warehouses' => $warehouses,
        ]);
    }

    #[Route('/new', name: 'app_warehouse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $warehouse = new Warehouse();
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($warehouse);
            $entityManager->flush();

            return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('warehouse/new.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warehouse_show', methods: ['GET'])]
    public function show(Warehouse $warehouse): Response
    {
        return $this->render('warehouse/show.html.twig', [
            'warehouse' => $warehouse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_warehouse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Warehouse $warehouse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('warehouse/edit.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warehouse_delete', methods: ['POST'])]
    public function delete(Request $request, Warehouse $warehouse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warehouse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($warehouse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
    }
}
