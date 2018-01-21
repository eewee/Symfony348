<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
	/**
	 * @Route("/")
	 */
	public function homepage()
	{
		return $this->render('article/homepage.html.twig');
	}

	/**
	 * @Route("/new/{slug}")
	 */
	public function show($slug)
	{
		//return new Response(sprintf(
		//	"other response %s",
		//	$slug
		//));

		//dump($slug, $this);

		$comments = ['lorem ipsum 01', 'lorem ipsum 02', 'lorem ipsum 03', ];
		return $this->render('article/show.html.twig', [
			'title' 	=> ucwords(str_replace('-', ' ', $slug)),
			'desc'		=> 'In auctor lobortis lacus. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. In turpis. Praesent vestibulum dapibus nibh. Suspendisse potenti.
 				Praesent egestas neque eu enim. Morbi mollis tellus ac sapien. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Donec vitae sapien ut libero venenatis faucibus.',
			'comments'	=> $comments,
		]);
	}
}