<?php

namespace Acme\StoreBundle\Controller;

use Acme\StoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function showAction($id)
	{
/*		$product = $this->getDoctrine()
			->getRepository('AcmeStoreBundle:Product')
			->findByPrice(19.99);*/


		$repository = $this->getDoctrine()
			->getRepository('AcmeStoreBundle:Product');

		$query = $repository->createQueryBuilder('p')
			->where('p.price > :price')
			->setParameter('price', '19.99')
			->orderBy('p.price', 'ASC')
			->getQuery();

		$products = $query->getResult();


		if (!$products) {
			throw $this->createNotFoundException('No product found for id '.$id);
		}

		return $this->render('AcmeStoreBundle:Default:product.html.twig', ['products' => $products]);

	}

	public function updateAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$product = $em->getRepository('AcmeStoreBundle:Product')->find($id);

		if (!$product) {
			throw $this->createNotFoundException('No product found for id '.$id);
		}

		$product->setName('New product name!');
		$em->flush();

		return $this->redirect($this->generateUrl('homepage'));
	}


	public function createAction()
	{
		$product = new Product();
		$product->setName('A Foo Bar');
		$product->setPrice('19.99');
		$product->setDescription('Lorem ipsum dolor');

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($product);
		$em->flush();

		return new Response('Created product id '.$product->getId());
	}

    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
