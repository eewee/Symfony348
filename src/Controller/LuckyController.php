<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    public function number($max)
    {
        $number = mt_rand(0, $max);
        $url = $this->generateUrl("app_lucky_number", array("max"=>$max));
        $name = "Thomas";
        return $this->render('lucky/number.html.twig', array(
            "name" => $name,
            "url" => $url,
        ));

//        return new Response(
//            '<html><body>Lucky number: '.$number.'</body></html>'
//        );
    }

    /**
     * @Route("/lucky/index", name="app_lucky_index")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index()
    {
        // redirect to the "homepage" route
//        return $this->redirectToRoute('app_article_homepage');

        // redirectToRoute is a shortcut for:
        // return new RedirectResponse($this->generateUrl('homepage'));

        // do a permanent - 301 redirect
//        return $this->redirectToRoute('app_article_homepage', array(), 301);

        // redirect to a route with parameters
//        return $this->redirectToRoute('app_lucky_number', array('max' => 10));

        // redirect externally
        return $this->redirect('http://symfony.com/doc');
    }

    /**
     * File download
     * Need : extension=php_fileinfo.dll in php.ini
     *
     * @Route("/lucky/aaa")
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function fileAction(Request $request, Packages $assetPackage)
    {
        // load the file from the filesystem
        $file = new File('doc/symfony2018.pdf');
        //return $this->file($file);

        // rename the downloaded file
        return $this->file($file, 'symfo.pdf');

        // display the file contents in the browser instead of downloading it
        //return $this->file('doc/symfony2018.pdf', 'your_new_filename.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}