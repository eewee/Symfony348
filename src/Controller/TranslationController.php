<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route(
 *     "/{_locale}/trad",
 *     requirements={
 *         "_locale": "en|fr"
 *     }
 * )
 */
class TranslationController extends Controller
{
    /**
     * @Route("/aaa", name="trad_aaa")
     */
    public function trad01(TranslatorInterface $translator)
    {
        $translated = $translator->trans('Hello');

        return $this->render("trad/aaa.html.twig", array(
            "trad" => $translated,
        ));
    }

    /**
     * @Route("/bbb", name="trad_bbb")
     */
    public function trad02(TranslatorInterface $translator)
    {
        return $this->render("trad/bbb.html.twig", array(
            "count" => 5
        ));
    }
}
