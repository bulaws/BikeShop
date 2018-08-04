<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductImage;
use App\Repository\ProductRepository;
use App\Form\FilterType;
use App\Model\Filter;
use Symfony\Component\HttpKernel\Exception;

class ProductsController extends AbstractController
{
    /**
     * Rendering products page
     * @param $request
     * @param $filter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProducts(Request $request, Filter $filter) : Response
    {
        $doctrine = $this->getDoctrine();
        $form = $this->createForm(FilterType::class, $filter);

        $products =  $doctrine->getRepository(Product::class)->JoinedToProductImage();
        $categories =  $doctrine->getRepository(ProductCategory::class)->findAll();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->render("products/products.html.twig", [
                'products' => $products,
                'categories' => $categories,
                'form' => $form->createView(),
            ]);
        }

        return $this->render("products/products.html.twig", [
            'products' => $products,
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Rendering product page
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProduct(int $id): Response
    {
        $product = $this->getDoctrine()
                    ->getRepository(Product::class)
                    ->find($id);

        if(!$product) {
            return $this->render('products/product.html.twig', [
                'product' => null,
                'productId'=> $id,
            ]);
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
            return $this->render('products/productsCategory.html.twig', [
                'products' => null,
                'categoryId'=> $categoryId,
            ]);
        }

        return $this->render("products/productsCategory.html.twig", [
            'products' => $products,
        ]);
    }
}