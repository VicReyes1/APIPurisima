<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Entity\Rol;
use App\Repository\UsuarioRepository;
use App\Repository\RolRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/UserCreate', name: 'adminUserCreate')]
    public function CreateUser(Request $request, ManagerRegistry $doctrine): Response
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
    
    #[Route('/admin/UserList', name: 'admin_userList')]
    public function ShowUserList(ManagerRegistry $doctrine): Response
    {
        $userObj = new Usuario;
        $rolObj = new Rol;
        $em = $doctrine->getManager();
        $userRepo = $em->getRepository($userObj::class);
        $rolRepo = $em->getRepository($rolObj::class);
        $users = $userRepo->findAll();
        $datos = array();
        foreach ($users as $user) {
            $datos[] = array(
                'email' => $user->getEmail(),
                'nombre' => $user->getNombre(),
                'apellidoP' => $user->getApellidoP(),
                'apellidoM' => $user->getApellidoM(),
                'rol' => $user->getRol()->getId(),
                'cel' => $user->getCel(),
                'ultima_conexion' => $user->getUltimaConexion()
            );
        }
        $json = json_encode($datos);
        $response = new JsonResponse();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }



}
