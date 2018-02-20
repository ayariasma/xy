<?php

namespace Esprit\BaseBundle\Controller;

use blackknight467\StarRatingBundle\Form\RatingType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Esprit\BaseBundle\Entity\Product;
use Esprit\BaseBundle\Entity\Rate;
use Esprit\BaseBundle\Form\RateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('EspritBaseBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('Esprit\BaseBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('Esprit\BaseBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function ratingProductAction($id,Request $request){

        $em= $this->getDoctrine()->getManager();
        $rate= new Rate();
        $product= $em->getRepository(Product::class)->find($id);
        $form= $this->createForm(RateType::class,$rate);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $rate->setProduct($product);
            $em->persist($rate);
            $em->flush();
            var_dump($rate);
            die();
            return $this->redirectToRoute("product_index");

        }

        return $this->render("product/rating.html.twig",array('form'=>$form->createView()));
    }


    public function chartAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine()->getManager();
        $enabled_products= $em->getRepository("EspritBaseBundle:Product")->findBy(array('enabled'=>true));
        $disabled_products= $em->getRepository("EspritBaseBundle:Product")->findBy(array('enabled'=>false));

        $pieChart->getData()->setArrayToDataTable(
            [['Produit', 'Nombre de produits'],

                ['Produit activé',     count($enabled_products)],
                ['Produit désactivé',  count($disabled_products)]
            ]
        );
        $pieChart->getOptions()->setTitle('Nombre de produits');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('chart/index.html.twig', array('piechart' => $pieChart));
    }
}
