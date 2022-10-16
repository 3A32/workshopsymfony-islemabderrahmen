<?php

namespace App\Controller;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use App\Form\ClassroomType;
use App\Repository\ClubRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  Doctrine\Persistence\ManagerRegistry;
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/listclassroom', name: 'app_classrooms')]

    public function listClassroom(ClassroomRepository $repository)
    {
        $Classroom= $repository->findAll();
        return $this->render("classroom/listClassroom.html.twig",array("tabClassroom"=>$Classroom));
    }


    #[Route('/addClassroom',name: 'app_addClassroom')]
    public function addClassroom(ManagerRegistry $doctrine,Request $request){
        $Classroom= new Classroom();
        //$Classroom->setName("2A22");
        $form=$this->createForm(ClassroomType::class,$Classroom);

        $form->handleRequest($request);
        if($form->isSubmitted()){
        $em= $doctrine->getManager();
        $em->persist($Classroom);
        $em->flush();
        return $this->redirectToRoute("app_classrooms");



}    return $this->renderForm("classroom/addClassroom.html.twig",
            array("formClassroom"=>$form)); }


    #[Route('/updateClassroom/{id}', name: 'app_updateClassroom')]
    public function updateClassroom(ClassroomRepository $repository,$id,ManagerRegistry $doctrine,Request $request)
    {
        $Classroom= $repository->find($id);
        $form=$this->createForm(ClassroomType::class,$Classroom);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em =$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("app_classrooms");
        }
        return $this->renderForm("classroom/updateClassroom.html.twig",
            array("formClassroom"=>$form));
    }
    #[Route('/deleteClassrrom/{id}', name: 'app_deleteClassroom')]

    public function deleteClassroom(ManagerRegistry $doctrine,$id,ClassroomRepository $repository)
    {
        $Classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($Classroom);
        $em->flush();
        return $this->redirectToRoute("app_classrooms");

    }
}
