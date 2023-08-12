<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Departement;
use App\Entity\Employe;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;

use App\Form\DepartementType;



class DepartementController extends AbstractController
{
    /**
     * @Route("/departement", name="app_departement")
     */
    public function index(): Response
    {

//ajout des departements c:
        $entityManager = $this->getDoctrine()->getManager();
        $departement = new Departement();
        $departement->setnomDept('Informatique');
        $departement->setResponsable('Meryem Barkallah');
        $departement->setnbrSalarie('24');




//ajout des employés c: 


        $employe1=new Employe();
        $employe1->setNom("Isiah");
        $employe1->setSalaire('2000');
        $employe1->setBornAt(new \DateTimeImmutable());
        $employe1->setEmail("isiah@gmail.com");

        $employe2=new Employe();
        $employe2->setNom("Zakia");
        $employe2->setSalaire('3000');
        $employe2->setBornAt(new \DateTimeImmutable());
        $employe2->setEmail("zakia@gmail.com");

        $employe1->setDepartement($departement);
        $employe2->setDepartement($departement);




$entityManager->persist($departement);
$entityManager->persist($employe1);
$entityManager->persist($employe2);

//excution
 $entityManager->flush();

        return $this->render('departement/index.html.twig', [
            'id' =>$departement->getId(),
        ]);
    }



     /**
     * @Route("/departement/{id}", name="departement_show")
     */
    public function show($id, Request $request)
    {
        $departement = $this->getDoctrine()
            ->getRepository(Departement::class)
            ->find($id);


        $em=$this->getDoctrine()->getManager();
        $listEmployes=$em->getRepository(Employe::class)
            ->findBy(['Departement'=>$departement]);

            $publicPath = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath().'/uploads/departements/';

      
        if (!$departement) {
            throw $this->createNotFoundException(
                'No departement found for id '.$id
            );
        }
        return $this->render('departement/show.html.twig', [
            'listEmployes'=> $listEmployes,
            'departement' =>$departement,
            'publicPath'=>$publicPath


        ]);
    }



    

    /**
     * @Route("/addM", name="employe_addM")
     */
    public function addM (Request $request)
    {
        $employe00=new Employe();
        $fb = $this->createFormBuilder($employe00)
        ->add('nom', TextType::class)
        ->add('salaire', TextType::class)
// manich msad9a kifch l9itelha 7al hethi ya rabi rani bch nebki ml far7aa
        ->add('bornAt', DateType::class, [
            'widget' => 'choice',
            'input'  => 'datetime_immutable'
        ])


        ->add('email', TextType::class)
        //importer les departement dans une liste c:
        
        ->add('departement', EntityType::class, [
            'class' => Departement::class,
            'choice_label' => 'nomDept',
        ])


        ->add('Valider', SubmitType::class);
        //generer le formulaire a partir du FormBuilder
        $form=$fb->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($employe00);
            $em->flush();

            //lazem name mch route l 3adi :c 
            return $this->redirectToRoute('emp_page');
        }

        //utiliser la méthode createView() pour que l'objet soit exploitable par la vue
        return $this->render('departement/ajouter.html.twig',
        ['f' => $form->createView()]);

    }


 /**
     * @Route("/Ajouter", name="ajout_departement")
     */
    public function ajouter(Request $request)
    { 

        $publicPath="uploads/departements/";

        $departement = new Departement();
        $form = $this->createForm("App\Form\DepartementType", $departement);
        $form -> handleRequest($request);
        if ($form->isSubmitted())
        {



             /*
            * @var UploadedFile $image
            */
            $image=$form->get('image')->getData();



            $em=$this->getDoctrine()->getManager();


            if ($image){
                $imageName = $departement->getResponsable().'.'. $image->guessExtension();
                $image->move($publicPath,$imageName);
                $departement->setImage($imageName);
            }
 
            $em->persist($departement);
            $em->flush();
            return $this->redirectToRoute('dep_page');
        }

        return $this->render('departement/ajouter.html.twig',
        ['f'=>$form->createView()]);


    }

      /**
     * @Route("/", name="home_page")
     */

     public function home ()
     {
        $em = $this->getDoctrine()->getManager();
        $repo=$em->getRepository(Employe::class);
        $lesEmployes=$repo->findAll();
        return $this->render('departement/home.html.twig',
        ['lesEmployes' => $lesEmployes]);
     }


      /**
     * @Route("/emp", name="emp_page")
     */

     public function homeE ()
     {
        $em = $this->getDoctrine()->getManager();
        $repo=$em->getRepository(Employe::class);
        $lesEmployes=$repo->findAll();
        return $this->render('departement/emp.html.twig',
        ['lesEmployes' => $lesEmployes]);
     }

      /**
     * @Route("/dep", name="dep_page")
     */

     public function homeD ()
     {
        $em = $this->getDoctrine()->getManager();
        $repo=$em->getRepository(Departement::class);
        $lesDepartements=$repo->findAll();
        return $this->render('departement/dep.html.twig',
        ['lesDepartements' => $lesDepartements]);
     }



       /**
     * @Route("/delete/{id}", name="emp_delete")
     */

     public function delete(Request $request, $id): Response
     {

        $c= $this->getDoctrine()
            ->getRepository(Employe::class)
            ->find($id);
      if(!$c) {
        throw $this->createNotFoundException(
            'No Employee found for id' .$id
        );
      }      
     $entityManager=$this->getDoctrine()->getManager();
     $entityManager->remove($c);

     $entityManager->flush();
     return $this->redirectToRoute('emp_page');

     }





   /**
* @Route("/editAll/{id}", name="emp_edit")
* Method({"GET","POST"})
*/
public function edit(Request $request, $id)
{ $employe123 = new Employe();
$employe123 = $this->getDoctrine()
->getRepository(Employe::class)
->find($id);
if (!$employe123) {
throw $this->createNotFoundException(
'No employe123 found for id '.$id
);
}
$fb = $this->createFormBuilder($employe123)

->add('nom', TextType::class)
->add('salaire', TextType::class)
->add('bornAt', DateType::class, [
    'widget' => 'choice',
    'input'  => 'datetime_immutable'
])
->add('email', TextType::class)


->add('departement', EntityType::class, [
'class' => Departement::class,
'choice_label' => 'nomDept',
])


->add('Valider', SubmitType::class);
// générer le formulaire à partir du FormBuilder
$form = $fb->getForm();
$form->handleRequest($request);
if ($form->isSubmitted()) {
$entityManager = $this->getDoctrine()->getManager();
$entityManager->flush();
return $this->redirectToRoute('emp_page');
}
return $this->render('departement/ajouter.html.twig',
['f' => $form->createView()] );
}





}
