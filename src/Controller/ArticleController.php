<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ArticleController extends AbstractController
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }





	/**
	 * @Route("/")
	 */
	public function homepage()
	{
        //dump($slug, $this);

		return $this->render('article/homepage.html.twig');
	}

	/**
     * Detail
	 * @Route("/blog/{slug}", name="blog_show")
     * @return string twig
	 */
	public function show($slug)
	{
		//return new Response(sprintf(
		//	"other response %s",
		//	$slug
		//));

//        // METHOD 1
//        $url = $this->generateUrl(
//            'blog_show',
//            array(
//                'slug' => 'my-blog-post',
//                'categ' => 'symfony',       // query string
//            )
//        );

        // METHOD 2
        // /blog/my-blog-post2?categ=symfony
        $url = $this->router->generate(
            'blog_show',
            array(
                'slug' => 'my-blog-post2',
                'categ' => 'symfony',     // query string
            )
        );

//        // METHOD 3
//        //http://localhost:8000/blog/my-blog-post3?categ=symfony
//        $url = $this->router->generate(
//            'blog_show',
//            array(
//                'slug' => 'my-blog-post3',
//                'categ' => 'symfony',     // query string
//            ),
//            UrlGeneratorInterface::ABSOLUTE_URL
//        );

		$comments = ['lorem ipsum 01', 'lorem ipsum 02', 'lorem ipsum 03', ];
		return $this->render('article/show.html.twig', [
			'title' 	=> ucwords(str_replace('-', ' ', $slug)),
			'desc'		=> 'In auctor lobortis lacus. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
			 quis gravida magna mi a libero. In turpis. Praesent vestibulum dapibus nibh. Suspendisse potenti.
			 Praesent egestas neque eu enim. Morbi mollis tellus ac sapien. Phasellus leo dolor, tempus non, auctor et,
			  hendrerit quis, nisi. Donec vitae sapien ut libero venenatis faucibus.',
			'comments'	=> $comments,
            'url' => $url,
		]);
	}

    /**
     * Listing
     * @param $page
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function list($page=1)
    {
    }

    /**
     * @Route(
     *     "/blog/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *     }
     * )
     */
    public function aaa($_locale, $year, $slug)
    {
    }
}
