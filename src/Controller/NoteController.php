<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Moyenne;
use Symfony\Contracts\Translation\TranslatorInterface;


class NoteController extends AbstractController
{
    private $moyenne;

    public function __construct(private EntityManagerInterface $em, private NoteRepository $noteRepository)
    {

    }

    #[Route('/note', name: 'app_note')]
    public function index(Request $request, TranslatorInterface $translator, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $notes = $noteRepository->findAll();
        $average = $this->moyenne->calculateAverage($notes);
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('danger', $translator->trans('note.form_error'));
        } elseif ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($note);
            $this->em->flush();
            $this->addFlash('success', $translator->trans('note.form_success'));
            return $this->redirectToRoute('listeNotes');
        }

        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
            'notes' => $this->noteRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

}