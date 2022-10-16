<?php

namespace App\Controller;

use App\Entity\ClubStudent;
use App\Form\ClubStudentType;
use App\Repository\ClubStudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class ClubStudentController extends AbstractController
{
    #[Route('/club/student', name: 'app_club_student')]
    public function index(): Response
    {
        return $this->render('club_student/index.html.twig', [
            'controller_name' => 'ClubStudentController',
        ]);
    }
    #[Route('/clubsts', name: 'list_clubst')]
    public function listClubSt(ClubStRepository $clubStRepository)
    {
        $clubsts = $clubStRepository->findAll();
        return $this->render('clubst/listClubst.html.twig', [
            'clubsts' => $clubsts,
        ]);

    }
    #[Route('/addClubSt', name:'addclubst')]
    public function addClubSt(ManagerRegistry $doctrine,Request $request){
        $clubst = new ClubSt();
        $form = $this->createForm(ClubStType::class,$clubst);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $doctrine->getManager();
            $em->persist($clubst);
            $em->flush();
            return $this->redirectToRoute("list_clubst");

        }

        return $this->renderForm("clubst/addClubst.html.twig",
            array("formClubst"=>$form));}
}
