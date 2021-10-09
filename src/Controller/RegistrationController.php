<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Cocur\Slugify\Slugify;
use App\Form\UserEditType;
class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $slugger = new Slugify();
                $email = $slugger->slugify($user->getEmail());
                $user->setSlug($email);
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('irdespdataportal@gmail.com', 'Data Portal Mail Bot'))
                    ->to($user->getEmail())
                    ->subject("Confirmation de votre Email")
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_login');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_login');
    }

    /**
 	* @Route("/showUser", name="app_show")
     */
    public function showUser(User $user){

       

        return $this->render('security/show.html.twig', [
            'user'=>$user
        ]);

    }

    /**
     * @Route("/editUser/{id}", name="register_edit", requirements={"id" = "\d+"})
     */

    public function editUser($id, Request $request){

        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $user = $em->getRepository(User::class)->find($id);

        $form = $this->get('form.factory')->create(UserEditType::class, $user);
          if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {//Requête soumis en POST 
            # code...création et gestion de formulaire
            $em->flush();
            #Redirection vers la page de visualisation de cette annonce
            return $this->redirectToRoute('document_controllerdocument_index');
        }
        return $this->render('security/edit.html.twig', array(
          'user' => $user, 'registrationForm'=>$form->createView()
          ));

     }
}
