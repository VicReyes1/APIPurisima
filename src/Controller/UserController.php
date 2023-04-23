<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Rol;
use App\Repository\UsuarioRepository;
use App\Repository\RolRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/SignIn', name: 'app_user_signIn')]
    public function signIn (Request $request, ManagerRegistry $doctrine): Response
    {
        $userObj = new Usuario;
        $rolObj = new Rol;
        $em = $doctrine->getManager();
        $rolRepo = $em->getRepository($rolObj::class);
        $userRepo = $em->getRepository($userObj::class);
        $content = $request->getContent();
        $obj = json_decode($content);
        $userArr = (array) $obj;
        $user = $userRepo->findOneBy(['email' => $userArr['email']]);
        if ($user) {
            unset($userObj);
            unset($rolObj);
            return $this->json(['Response'=> 'Usuario ya registrado'],200);
        }else{
            $userObj->setEmail($userArr['email']);
            $userObj->setNombre($userArr['nombre']);
            $userObj->setApellidoP($userArr['apellidoP']);
            $userObj->setApellidoM($userArr['apellidoM']);
            $userObj->setCel($userArr['cel']);
            $rolObj = $rolRepo->findOneBy(['id' => $userArr['rol']]);
            $rolObj->addUsuario($userObj);
            $userObj->setPassword(password_hash($userArr['password'],PASSWORD_DEFAULT));
            $em->persist($userObj);
            $em->flush();
            unset($userObj);
            unset($rolObj);
            return $this->json(['Response'=> 'Usuario creado'],201);   
        }
        

    }  

}
