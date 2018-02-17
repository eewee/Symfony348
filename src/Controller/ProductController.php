<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: <b>'.$product->getName().'</b>');

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/product/find/{id}", name="product_show_find")
     * @param int $id
     */
    public function showActionFind($id)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        // look for a single Product by its primary key (usually "id")
        $product = $repository->find($id);

        // look for a single Product by name
        $product = $repository->findOneBy(['name' => 'Keyboard']);
        // or find by name and price
//        $product = $repository->findOneBy([
//            'name' => 'Keyboard',
//            'price' => 19.99,
//        ]);

        // look for multiple Product objects matching the name, ordered by price
        $products = $repository->findBy(
            ['name' => 'Keyboard'],
            ['price' => 'ASC']
        );

        // look for *all* Product objects
        $products = $repository->findAll();
        foreach ($products as $p) {
            echo '<pre>'.var_export($p->getId().' - '.$p->getName(), true).'</pre>';
        }

        return new Response('Find : '.$product->getId().' - '.$product->getDescription());
    }

    /**
     * @Route("/product/edit/{id}")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     * @param int $id
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        $em->remove($product);
        $em->flush();

        return new Response("delete : id=".$id);
    }


    
    
    /**
     * @Route("/product/sql01/{price}", name="product_sql01")
     */
    public function getSql01Action($price)
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            //->findAllGreaterThanPrice01($price);
            //->findAllGreaterThanPrice02($price);
            ->findAllGreaterThanPrice03($price);
            //->findByName('Keyboard');
        
        echo '<pre>'.var_export($products, true).'</pre>';

        return new Response('xxx');
    }
}
