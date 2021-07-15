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
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function show(Equipment $equipment): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }


}
