<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController

{
/**
* @Route("/home", name="Home")
 */

 public function number()
 {
 $number = random_int(0, 100);
 return $this->render('Emp/home.html.twig', [
    'number' => $number,
    ]);
   
 }


}
?>