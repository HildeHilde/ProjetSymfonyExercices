<?php

//création du Controller1 qui dépend de la classe abstraite AbstractController

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller1 extends AbstractController
{
    //2.Création d'une action qui renvoie une simple Response sans vue
    /**
     * @route ("afficher/message/action1")
     */
    public function MonAction1()
    {
        return new Response('Ce controller est nouveau et je suis une action à l\'intérieur');
    }

    //4.Création d'une action qui renvoie une autre Response
    /**
     * @route ("afficher/message/belge")
     */
    public function MessageBelge()
    {
        return new Response('Vive la Belgique !');
        
    }

    //5.Création d'une action avec une vue associée avec 3 valeurs dans l'URL
    /**
     * @route ("afficher/moyenne/{nb1}/{nb2}/{nb3}")
     */
    public function AfficherMoyenne(Request $re)
    {
        $nb1 = $re->get("nb1");
        $nb2 = $re->get("nb2");
        $nb3 = $re->get("nb3");
        $moyenne = ($nb1 + $nb2 + $nb3) / 3;
        //simple response sans vue
        //return new Response("la moyenne est de " . $moyenne);

        //vue associée à l'action
        return $this->render("/afficher.moyenne.html.twig", ['moyenne' => $moyenne]);
    }

    //6.Création d'une action qui envoie un array de noms à sa vue
    /**
     * @route ("afficher/array/noms")
     */
    public function AfficherArrayNoms()
    {
        $noms = ["Mathilde", "Darris", "Gabriel"];

        return $this->render("afficher.array.noms.html.twig", ['noms' => $noms]);
    }

    //7.Création d'une action qui reçoit 2 valeurs ds l'URL
    //Gérer la condition dans la vue
    /**
     * @route ("afficher/message/oupas/{v1}/{v2}")
     */
    public function EstPlusGrand(Request $value)
    {
        $v1 = $value->get("v1");
        $v2 = $value->get("v2");
        $addition = $v1 + $v2;

        return $this->render("afficher.message.oupas.html.twig", ['addition' => $addition]);
    }

    //8.Création d'une action avec 1 param qui renvoie sur un moteur de recherche
    /**
     * @route ("redirect/duckduck/{recherche})
     */
    public function Redirection(Request $rec)
    {
        $recherche = $rec->get("recherche");
        $url = "https://duckduckgo.com/?q=".$recherche."&va=z&t=hk";
        return $this->redirect($url);
    }
}
