<?php

class Catalog_Controller_Product
{

    public function viewAction()
    {
        $product = Mage::getModel('catalog/product');
        $product->getResourceModel();
        // echo "<pre>";
        // print_r($product);
        // print_r($product->getResourceModel());
        // echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $view = $layout->createBlock('catalog/product_view')
            ->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view', $view);

        $layout->toHtml();


    }
    public function listAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Catalog/Product_List')
            ->setTemplate('catalog/product/list.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();
    }


    public function testAction()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('product_id', 1)
            ->joinLeft('catlog_category', 'catlog_category.category_id = catlog_product.category_id', ['category_name' => 'name'])
            ->groupBy(['a', 'b', 'c'])
            ->having('product_id', 1)
            ->addFieldToFilter('product_id', ['IN' => [2, 3, 4]])
            ->having('product_id', ['IN' => [2, 3, 4]])
            ->orderBy(['a desc', 'b', 'c']);

        // ->getCollection();
        ;
        // print_r($product);

        print_r($product->getData());
        // $product->setName("abc's");
        // $product->setPrice("50000");
        // $product->setRating("5");
        // $product->save();
        // echo "<pre>";
        // print_r($product);
        // die();
        // $product->getResourceModel();
        // echo "<pre>";
        // $data = $product->getData();
        // echo $product->getCategoryId();
        // echo "<pre>";
        // print_r($data);
        // die();

        // print_r($product->getResourceModel());
        // foreach ($data as $_data) {

        // }
    }
}

?>