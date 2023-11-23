<?php 

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Matiere;

class MatiereController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/matiere", name="matiere", methods={"GET"})
     */
    public function index(MatiereRepository $matiereRepository)
    {
        $matieres = $matiereRepository->findAll();

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }
    

}