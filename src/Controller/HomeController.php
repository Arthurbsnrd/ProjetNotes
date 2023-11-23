<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\MatiereRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, MatiereRepository $matiereRepository, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);


        $notes = $noteRepository->findAll();
        $average = $this->calculateAverage($notes);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($note);
            $this->entityManager->flush();
            $this->addFlash('success', 'Note ajoutée avec succès');
            
            return $this->redirectToRoute('home');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'var' => $this->entityManager->getRepository(Note::class)->findAll(),
            'form' => $form->createView()
        ]);

 
    }

    private function calculateAverage(array $notes): float
    {
        if (empty($notes)) {
            return 0;
        }

        $total = 0;
        $totalCoefficients = 0;

        foreach ($notes as $note) {
            $total += $note->getValue() * $note->getMatiere()->getCoefficient();
            $totalCoefficients += $note->getMatiere()->getCoefficient();
        }

        return $totalCoefficients > 0 ? $total / $totalCoefficients : 0;
    }
}