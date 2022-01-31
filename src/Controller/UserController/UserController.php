<?php

namespace App\Controller\UserController;

use App\Entity\Projects;
use App\Form\ContactType;
use App\Repository\CounterRepository;
use App\Repository\ProjectsRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;
use App\Service\Mailer\MailerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private UserRepository $userRepository;
    private TagsRepository $tagsRepository;
    private ProjectsRepository $projectRepository;
    private CounterRepository $counterRepository;

    public function __construct(
        UserRepository $userRepository,
        TagsRepository $tagsRepository,
        ProjectsRepository $projectRepository,
        CounterRepository $counterRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->tagsRepository = $tagsRepository;
        $this->projectRepository = $projectRepository;
        $this->counterRepository = $counterRepository;
    }

    #[Route('/', name: 'app_home_user')]
    public function index(Request $request, MailerServiceInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $toAdress = [new Address('contact@romaric-rapine.fr')];
            $mailer->send(
                $data['mail'],
                $toAdress,
                $data['subject'],
                'emails/contact.mjml.twig',
                'emails/contact.txt.twig',
                [
                    'name' => $data['name'],
                    'mail' => $data['mail'],
                    'subject' => $data['subject'],
                    'message' => $data['message']
                ]
            );
            return $this->redirectToRoute('app_home_user');
        }

        return $this->render('user/index.html.twig', [
            'users' => $this->userRepository->findAll(),
            'projects' => $this->projectRepository->findAll(),
            'counters' => $this->counterRepository->findAll(),
            'contact' => $form->createView()
        ]);

    }

    #[Route('/project/{slug}', name: 'app_view_project_user')]
    public function viewProject(Projects $projects): Response
    {
        return $this->render('user/project.html.twig', [
            'projects' => $projects,
            'counters' => $this->counterRepository->findAll(),
        ]);
    }


}
