<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Data\SearchDate;
use App\Data\SearchDomaine;
use App\Data\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use App\Entity\Document;
use App\Entity\Domaine;
use App\Entity\Fichier;
use App\Form\DocumentType;
use App\Form\SearchDateForm;
use App\Form\SearchDomaineForm;
use App\Form\SearchForm;
use App\Form\SearchTypeForm;
use Doctrine\DBAL\Types\Type;
use App\Repository\DocumentRepository;

use function PHPSTORM_META\type;

/**
     * @Route("/document", name="document_controller")
     */

class DocumentController extends AbstractController
{
    /**
     * @Route("/index/{page}", name="document_index", methods={"GET"},requirements={"page" = "\d+"}, defaults={"page"= 1})
     */
    
    public function index($page,  DocumentRepository $repository, Request $request): Response
    {
        $document = new Document();
        $nbrparpages = 3;
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        //dd($data);
        $listDocuments = $repository->findSearch($data);

        $nbpages = ceil(count($listDocuments) / $nbrparpages);

        if ($form->isSubmitted())
        {
            return $this->render('document/viewSearch.html.twig', [
                'listDocuments' => $listDocuments,
                'document'=>$document,
                'form' => $form->createView()
            ]);
        }

        return $this->render('document/index.html.twig', [
            'listDocuments' => $listDocuments,
            'nbpages'=>$nbpages, 
            'page'=>$page, 
            'document'=>$document ,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/show/", name="document_show", methods={"GET"}, requirements={"page" = "\d+"}, defaults={"page"= 1})
     */
    public function showAll($page , DocumentRepository $repository, Request $request): Response
    {

        $document = new Document();
        $nbrparpages = 10;
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        //dd($data);
        $listDocuments = $repository->findSearch($data);

        $nbpages = ceil(count($listDocuments) / $nbrparpages);
    
        if ($form->isSubmitted()) 
        {
            return $this->render('document/viewSearch.html.twig', [
                'listDocuments' => $listDocuments,
                'document'=>$document,
                'form' => $form->createView()
            ]);
        }
        return $this->render('document/show.html.twig', [
            'listDocuments' => $listDocuments,
            'nbpages'=>$nbpages, 
            'page'=>$page, 
            'document'=>$document,
            'form' => $form->createView()
        ]);

    }

 

    /**
	 * @Route("/view/{id}", name="view_document")
	*/

    public function view(Document $document){

        return $this->render('document/view.html.twig', [
            'document' =>$document,
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
	 * @Route("/edit", name="edit_document")
	*/

    public function edit($id){

    }

    /**
	 * @Route("/delete", name="delete_document")
	*/

    public function delete($id){

    }

    /**
     * @Route("/viewSearch", name="view_result")
     */
    public function showResult($page = 1, DocumentRepository $repository, Request $request)
    {
        $document = new Document();
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        //dd($data);
        $listDocuments = $repository->findSearch($data);

        return $this->render('document/viewSearch.html.twig', [
            'listDocuments' => $listDocuments,
            'page'=>$page, 
            'document'=>$document,
            'form' => $form->createView()
        ]);

    }

    /**
     * @param int $page
     * @param DocumentRepository $repository
     * @param Request $request
     * 
     * @return Response
     * @Route("/viewDomaine", name="view_domaine") 
     */
    public function showDomaine(DocumentRepository $repository, Request $request): Response
    {
        $data = new SearchDomaine();
        $form = $this->createForm(SearchDomaineForm::class, $data);
        $form->handleRequest($request);
        $listDocuments = $repository->searchDomaine($data);

        return $this->render('document/viewDomaine.html.twig', [
            'listDocuments' => $listDocuments,
            'form' => $form->createView()
        ]);

    }

    /**
     * @param DocumentRepository $repository
     * @param Request $request
     * @Route("/viewType", name="view_type") 
     * @return Response
     */
    public function showType(DocumentRepository $repository, Request $request): Response
    {
        $data = new SearchType();
        $form = $this->createForm(SearchTypeForm::class, $data);
        $form->handleRequest($request);
        //dd($data);
        $listDocuments = $repository->searchType($data);

        return $this->render('document/viewType.html.twig', [
            'listDocuments' => $listDocuments,
            'form' => $form->createView()
        ]);

    }


    /**
     * @param DocumentRepository $repository
     * @param Request $request
     * @Route("/viewDate", name="view_date")
     * @return Response
     */
    public function showDate(DocumentRepository $repository, Request $request): Response
    {
        $data = new SearchDate();
        $form = $this->createForm(SearchDateForm::class, $data);
        $form->handleRequest($request);
        //dd($data);
        $listDocuments = $repository->searchDate($data);

        return $this->render('document/viewDate.html.twig', [
            'listDocuments' => $listDocuments,
            'form' => $form->createView()
        ]);

    }

}
