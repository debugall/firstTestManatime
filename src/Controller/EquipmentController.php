<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use App\Service\EditEquipmentService;
use App\Service\EquipmentService;
use App\Tests\EditEquipmentServiceTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class EquipmentController extends AbstractController
{
    /**
     * @var EquipmentService
     */
    private $equipmentService;
    /**
     * @var EditEquipmentService
     */
    private $editEquipmentService;

    /**
     * EquipmentController constructor.
     */
    public function __construct(EquipmentService $equipmentService, EditEquipmentService $editEquipmentService)
    {
        $this->equipmentService = $equipmentService;
        $this->editEquipmentService = $editEquipmentService;
    }


    /**
     * @Route("/", name="equipment_index", methods={"GET"})
     */
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/index.html.twig', [
            'equipment' => $this->equipmentService->getAllEquipments(),
        ]);
    }

    /**
     * @Route("/new", name="equipment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipment = new Equipment();
        $form      = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editEquipmentService->saveEquipment($form->getData());
            return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipment/new.html.twig', [
            'equipment' => $equipment,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function show(Equipment $equipment): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipment $equipment = null): Response
    {
        if (empty($equipment)) {
            return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editEquipmentService->updateEquipment($form->getData());
            return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipment $equipment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipment->getId(), $request->request->get('_token'))) {
            $this->editEquipmentService->deleteEquipment($equipment);
        }

        return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
