<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 6/11/18
 * Time: 6:32 PM
 */

namespace AppBundle\Controller\Tarea;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TareaController extends Controller
{


    /**
     *
     * @Route("/tarea", name="lista_tareas")
     */
    public function indexTareas()
    {


        return $this->render('@App/Tarea/lista_tareas.html.twig');
    }



}