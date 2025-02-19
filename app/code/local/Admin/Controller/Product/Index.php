<?php

class Admin_Controller_Product_Index
{
    public function newAction()
    {
        // echo $_GET['id'];

        // print_r($product);

        $layout = Mage::getBlock('Core/Layout');
        $new = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('Admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main.css');

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Admin/Product_Index_List')
            ->setTemplate('Admin/product/index/list.phtml');


        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }
    public function saveAction()
    {
        echo "<pre>";
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        // print_r($request->getParam('catlog_product'));
        $product->setData($request->getParam('catlog_product'));
        $oldImage = $product->getImage();

        if (isset($_FILES['catlog_product']['name']['image']) && $_FILES['catlog_product']['error']['image'] == 0) {
            $uploadDir = Mage::getBaseDir() . "/media/product/";

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES['catlog_product']['name']['image']);
            $uploadFilePath = $uploadDir . $fileName;
            $tmpFilePath = $_FILES['catlog_product']['tmp_name']['image'];

            if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
                $path = "media/product/" . $fileName;
                $product->setImage($path);
            }
        }
        echo "<pre>";
        $newImage = $product->getImage();
        // print_r($product);
        // die();


        if ($oldImage && ($oldImage != $newImage)) {
            unlink($oldImage);
        }

        $product->save();

        header('Location: http://localhost/MVC/admin/product_index/list');
        exit;
        // $layout = Mage::getBlock('Core/Layout');
        // $save = $layout->createBlock('Admin/Product_Index_Save')
        //     ->setTemplate('Admin/product/index/save.phtml');
        // $layout->getChild('content')->addChild('save', $save);

        // $layout->toHtml();

    }
    public function deleteAction()
    {
        echo "<pre>";
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $id = $request->getQuery('id');
        $product->load($id);
        // print_r($request->getParam('catlog_product'));
        // $product->setData($request->getParam('catlog_product'));
        $oldImage = $product->getImage();

        if ($oldImage) {
            unlink($oldImage);
        }
        $product->delete();


        header('Location: http://localhost/MVC/admin/product_index/list');

        // $layout = Mage::getBlock('Core/Layout');
        // $delete = $layout->createBlock('Admin/Product_Index_Delete')
        //     ->setTemplate('Admin/product/index/delete.phtml');
        // $layout->getChild('content')->addChild('delete', $delete);

        // $layout->toHtml();
    }

}

?>