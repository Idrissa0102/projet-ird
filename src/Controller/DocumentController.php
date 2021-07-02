<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;


/**
     * @Route("/document", name="document_controller")
     */

class DocumentController extends AbstractController
{
    /**
     * @Route("/index", name="document_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('document/index.html.twig', [
            'controller_name' => 'DocumentController',
        ]);
    }



     
    

    /**
	 * @Route("/view", name="view_document")
	*/

    public function view(Request $request){

    }

    /**
	 * @Route("/add", name="add_document")
	*/

    public function add(){
        return $this->render('document/add.html.twig');
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

    

}
