<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_students')]
    public function index(): Response

    {
        return new Response('Bonjour mes étudiants ');
    }
    #[Route('/student', name: 'app_student')]

    public function listStudent(StudentRepository $repository)
    {
        $student= $repository->findAll();
        return $this->render("student/listStudent.html.twig",array("tabStudents"=>$student));
    }
    #[Route('/addStudent',name: 'app_addStudent')]
    public function addStudent(ManagerRegistry $doctrine,Request $request){
        $student= new Student();
        $form=$this->createForm(StudentType::class,$student);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em =$doctrine->getManager() ;
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("app_students");
        }
        return $this->renderForm("student/addStudent.html.twig",
            array("formStudent"=>$form));
    }
    #[Route('/updateStudent/{nsc}', name: 'app_updateStudent')]
    public function updateStudent(StudentRepository $repository,$nsc,ManagerRegistry $doctrine,Request $request)
    {
        $student= $repository->find($nsc);
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em =$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("app_student");
        }
        return $this->renderForm("student/updateStudent.html.twig",
            array("formStudent"=>$form));
    }
    #[Route('/removeStudent/{nsc}', name: 'app_removeStudent')]

    public function deleteStudent(ManagerRegistry $doctrine,$nsc,StudentRepository $repository)
    {
        $student= $repository->find($nsc);
        $em= $doctrine->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute("app_student");

    }
}
