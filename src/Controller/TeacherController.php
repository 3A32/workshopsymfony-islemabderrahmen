<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }
    #[Route('/showteacher/{name}', name: 'app_show_teacher')]
    public  function showTeacher($name){
        return $this->render('teacher/showTeacher.html.twig', [
            'name' => $name,
        ]);
    }
    #[Route('/rediriger', name: 'app_rediriger')]
  public function showStudent(){
        return $this->redirectToRoute('app_student');
    }

}
