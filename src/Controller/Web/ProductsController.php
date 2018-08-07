<?php

namespace App\Controller\Web;

use App\Traits\ProductTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductImage;
use App\Repository\ProductRepository;
use App\Form\FilterType;
use App\Model\Filter;

class ProductsController extends AbstractController
{
    use ProductTrait;

    /**
     * Rendering products page
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProducts(Request $request): Response
    {
        $doctrine = $this->getDoctrine();

        $filter = new Filter();
        $form = $this->createForm(FilterType::class, $filter);
        $products =  $doctrine->getRepository(Product::class)
            ->JoinedToProductImage();
        $categories =  $doctrine->getRepository(ProductCategory::class)
            ->findAll();

        $form->handleRequest($request);

        if ( $form->isSubmitted() &&  $form->isValid()) {

            $filter =$form->getData();

            /** @var ProductRepository $products */
            $products = $doctrine->getRepository(Product::class)
                ->findByFilter($filter);

            return $this->render("products/products.html.twig", [
                'products' => $products,
                'categories' => $categories,
                'form' => $form->createView(),
            ]);
        }

        return $this->render("products/products.html.twig", [
            'products' => $products,
            'categories' => $categories,
            'form' =>  $form->createView(),
        ]);
    }

    /**
     * Rendering product page
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProduct(Product $id): Response
    {
        $product = $this->getProduct($id, $this->getDoctrine());

        if(!$product) {
            throw $this->createNotFoundException();
        }
        $category = $product->getCategory()->getName();

        return $this->render("products/product.html.twig", [
            'product' => $product,
            'category' => $category
        ]);
    }

    /**
     * Rendering products_category page
     * @param $categoryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProductsCategory(int $categoryId): Response
    {
        /** @var ProductRepository $products */
        $products = $this->getDoctrine()
            ->getRepository(Product::class);
        $products = $products->findByIdCategory($categoryId);

        if(!$products) {
            throw $this->createNotFoundException();
        }

        return $this->render("products/productsCategory.html.twig", [
            'products' => $products,
        ]);
    }
}