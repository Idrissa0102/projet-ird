<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use App\Entity\Document;
use App\Form\DocumentType;
use Doctrine\DBAL\Types\Type;

use function PHPSTORM_META\type;

/**
     * @Route("/document", name="document_controller")
     */

class DocumentController extends AbstractController
{
    /**
     * @Route("/index/{page}", name="document_index", methods={"GET"},requirements={"page" = "\d+"}, defaults={"page"= 1})
     */
    public function index($page): Response
    {

        $document = new Document();
        $nbrparpages = 3;

        $listDocuments = $this->getDoctrine()->getManager()->getRepository(Document::class)->getDocuments($page, $nbrparpages);
        $nbpages = ceil(count($listDocuments) / $nbrparpages);
        return $this->render('document/index.html.twig', [
            'listDocuments' => $listDocuments,
            'nbpages'=>$nbpages, 
            'page'=>$page, 
            'document'=>$document
        ]);
    }


    /**
     * @Route("/show/", name="document_show", methods={"GET"}, requirements={"page" = "\d+"}, defaults={"page"= 1})
     */
    public function showAll($page): Response
    {

        $document = new Document();
        $nbrparpages = 3;

        $listDocuments = $this->getDoctrine()->getManager()->getRepository(Document::class)->getDocuments($page, $nbrparpages);
        $nbpages = ceil(count($listDocuments) / $nbrparpages);
        dump($nbpages);
        dump($page);
        return $this->render('document/show.html.twig', [
            'listDocuments' => $listDocuments,
            'nbpages'=>$nbpages, 
            'page'=>$page, 
            'document'=>$document
        ]);
    }



     
    

    /**
	 * @Route("/view/{id}", name="view_document")
	*/

    public function view(Document $document){
       // $repository = $this->getDoctrine()->getManager();

        return $this->render('document/view.html.twig', [
            'document' =>$document
        ]);
    }

    /**
	 * @Route("/add", name="add_document")
	*/

    public function add(Request $request){

       $document  = new Document();

       $form = $this->createForm(DocumentType::class, $document);
       if($request->isMethod('POST') && $form->handleRequest($request)->isValid() ) {//Requête soumis en POST 

            $em = $this->getDoctrine()->getManager();
            $slugger = new Slugify();
            $title = $slugger->slugify($document->getTitre());
            $document->setSlug($title);
            $document->setAuthor($this->getUser());

            $em->persist($document);
			$em->flush();
			//$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('document_controllerdocument_index');
       }
       /*foreach ($document->getMotClef() as $motclet) {
           # code...
           $document->addMotClef($motclet);
           $motclet->addDocument($document);
       }*/
        
        return $this->render('document/add.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    /**
	 * @Route("/edit/{id}", name="edit_document", requirements={"id" = "\d+"})
	*/

    public function edit($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        
        $document = $em->getRepository(Document::class)->find($id);

        $form = $this->get('form.factory')->create(DocumentEditType::class, $document);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {//Requête soumis en POST 
            # code...création et gestion de formulaire
            $em->flush();

            return $this->redirectToRoute('document_controllerview_document', array('id' =>$document->getId()));
        }
        return $this->render('document/edit.html.twig', array(
            'annonce' => $document, 'form'=>$form->createView()
        ));

    }

    /**
	 * @Route("/delete", name="delete_document",  requirements={"id" = "\d+"})
	*/

    public function delete($id, Request $request){

        $em = $this->getDoctrine()->getManager();

		    
		$document = $em->getRepository(Document::class)->find($id);

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
             $em->remove($document);
             $em->flush();

             
             return $this->redirectToRoute('document_controllerview_document');
         }

         return $this->render('document/delete.html.twig', array(
			'annonce' => $document, 'form'=>$form->createView(),
		  ));


    }

    

}
