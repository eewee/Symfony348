<?php
namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    public function localeTest($_locale, $year, $slug)
    {
    }

    /**
     * Insert db
     * @Route("/article/insert01", name="article_insert01")
     */
    public function insert01()
    {
        /*
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $article = new Article(5);
        $article->setTitle('Lorem ipsum');
        $article->setDescription('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.');

        $em->persist($article);
        $em->flush();
        */

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find(5);
        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id 5'
            );
        }
        $article->setEnable(0);
        $em->persist($article);
        $em->flush();

        return new Response('Saved new article with id '.$article->getId());
    }

    /**
     * .env : config for use MailTrap.io (test)
     * composer require mailer
     *
     * @Route("/email/shoot01", name="article_email01")
     */
    public function email01(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('contact@eewee.fr')
            ->setTo('aaa@eewee.fr')
            ->setBody(
                $this->renderView(
                // /templates/emails/registration.html.twig
                    'emails/email01.html.twig',
                    array('name' => "Eric")
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/test.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $mailer->send($message);

        return $this->render('article/homepage.html.twig');
    }

    /**
     * Query string
     * @Route("/aaa/{firstName}/{lastName}")
     * @param Request $request
     * @param         $firstName
     * @param         $lastName
     * @return
     */
    public function aaa($firstName, $lastName, Request $request)
    {
        $page = $request->query->get('page', 1);
        return $this->render('article/aaa.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * Session
     * @Route("/bbb")
     * @param SessionInterface $session
     */
    public function bbb(SessionInterface $session)
    {
        // store an attribute for reuse during a later user request
        //$session->set('foo', 'barrr');

        // get the attribute set by another controller in another request
        $foobar = $session->get('foo');

        // use a default value if the attribute doesn't exist
//        $filters = $session->get('filters', array());

        return $this->render('article/bbb.html.twig', array(
            'foobar' => $foobar
        ));
    }

    /**
     * Flash
     * @Route("/ccc")
     */
    public function ccc()
    {
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        return $this->render('article/ccc.html.twig');
    }

    /**
     * Get datas (ajax, lang, get, post, server, file, cookie, header)
     * @Route("/ddd")
     */
    public function ddd(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest(); // is it an Ajax request?

        $getPrefLang = $request->getPreferredLanguage(array('en', 'fr'));

        // retrieve GET and POST variables respectively
        $get = $request->query->get('page');
        $post = $request->request->get('page');

        // retrieve SERVER variables
        $server = $request->server->get('HTTP_HOST');

        // retrieves an instance of UploadedFile identified by foo
        $file = $request->files->get('foo');

        // retrieve a COOKIE value
        $cookie = $request->cookies->get('PHPSESSID');

        // retrieve an HTTP request header, with normalized, lowercase keys
        $header01 = $request->headers->get('host');
        $header02 = $request->headers->get('content_type');

        return $this->render('article/ddd.html.twig', array(
            'isAjax' => $isAjax,
            'getPrefLang' => $getPrefLang,
            'get' => $get,
            'post' => $post,
            'server' => $server,
            'file' => $file,
            'cookie' => $cookie,
            'header01' => $header01,
            'header02' => $header02,
        ));
    }

    /**
     * Json sample
     * @Route("/eee")
     */
    public function eee()
    {
        // returns '{"username":"jane.doe"}' and sets the proper Content-Type header
        return $this->json(array('username' => 'jane.doe'));

        // the shortcut defines three optional arguments
        // return $this->json($data, $status = 200, $headers = array(), $context = array());
    }

    /**
     * File (ex : pdf)
     * @Route("/fff")
     */
    public function fff(Request $request)
    {
        // send the file contents and force the browser to download it
        return $this->file('doc/aaa.pdf');

        //return $this->file('http://localhost:8001/doc/aaa.pdf');
    }

    /**
     * File
     * @Route("/ggg")
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function ggg()
    {
        // load the file from the filesystem
        $file = new File('doc/aaa.pdf');

        //return $this->file($file);

        // rename the downloaded file
        //return $this->file($file, 'custom_name.pdf');

        // display the file contents in the browser instead of downloading it
        return $this->file('doc/aaa.pdf', 'my_invoice.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
