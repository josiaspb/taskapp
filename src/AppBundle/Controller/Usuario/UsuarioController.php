<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 6/11/18
 * Time: 6:32 PM
 */

namespace AppBundle\Controller\Usuario;


use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{


    /**
     *
     * @Route("/usuario", name="lista_usuarios")
     *
     */
    public function indexUsuario()
    {

        $usuarios = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findAll();

        return $this->render('@App/Usuario/lista_usuarios.html.twig',
            [
                "usuarios" => $usuarios
            ]
        );
    }

    /**
     *
     * @Route("/usuario/{id}", name="editar_usuario")
     * @Method("GET")
     * @param Usuario $usuario
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexEditUsuario(Usuario $usuario)
    {

        return $this->render('@App/Usuario/editar_usuario.html.twig',
            [
                "usuario" => $usuario
            ]
        );
    }

    /**
     *
     * @Route("/usuario/{id}", name="eliminar_usuario")
     * @Method("DELETE")
     * @param Usuario $usuario
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexEliminarUsuario(Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($usuario);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);
        return new JsonResponse($jsonContent);
    }


    // Restful API

    /**
     *
     * @Route("/rest/usuario/", name="buscar_usuarios")
     * @Method("GET")
     */
    public function buscarUsuarios()
    {

        return null;
    }


    /**
     *
     * @Route("/rest/usuario/{id}", name="buscar_usuario")
     * @Method("GET")
     * @param Usuario $usuario
     */
    public function buscarUsuario(Usuario $usuario)
    {

        $jsonContent = $this->get('serializer')->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);
        return new JsonResponse($jsonContent);
    }

    /**
     *
     * @Route("/rest/usuario", name="guardar_usuario")
     * @Method("POST")
     */
    public function guardarUsuario(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $usuario = new Usuario();
        $usuario->setNombre($data["nombre"]);
        $usuario->setUsername($data["username"]);


        $em = $this->getDoctrine()->getManager();

        $em->persist($usuario);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);
    }

    /**
     *
     * @Route("/rest/usuario/{id}", name="actualizar_usuario")
     * @Method("PUT")
     * @param Request $request
     * @param Usuario $usuario
     * @return JsonResponse
     */
    public function actualizarUsuario(Request $request, Usuario $usuario)
    {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $usuario->setNombre($data["nombre"]);
        $usuario->setUsername($data["username"]);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);
    }


}