<?php


class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{

    protected $_allowedActions = [
        'new'
    ];
    public function newAction()
    {

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

    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $id = $request->getQuery('id');
        $image = $product->load($id)->getData()['filepath'];
        echo '<pre>';
        print_r($id);
        echo '</pre>';

        $product->delete();
        header('Location: http://localhost/mvc_main/admin/product_index/list');
    }

    public function saveAction()
    {
        $request = $this->getRequest();
        $pdata = $request->getParam('catalog_product');
        $product = Mage::getModel('catalog/product')
            ->load($pdata['product_id'])
            ->setData($pdata);
        // echo '<pre>';
        // print_r($product);
        // echo '</pre>';
        $product->save();
        // die;
        // $attr = $request->getParam('catalog_product_attribute');
        // $pdata['sku'] = "{$pdata['product_id']}{$pdata['name']}";
        // $product->setData($pdata);

        // $pid = $product->getProductId();
        // $attributetable = Mage::getModel('catalog/product_attribute');
        // $valueId = $attributetable->getCollection()->addFieldToFilter('product_id', $pid)->getData();
        // $ct = 0;
        // foreach ($attr as $key => $value) {
        //     if (!empty($valueId)) {
        //         $value['value_id'] = $valueId[$ct]->getValueId();
        //     }
        //     $value['product_id'] = $pid;
        //     $value['attribute_id'] = $key;
        //     $attributetable->setData($value);
        //     $attributetable->save();
        //     $ct++;
        // }
        // $ct = 0;

        // echo '<pre>';
        // print_r($_POST);
        // print_r($images);
        // echo '</pre>';
        // die;
        $this->redirect('admin/product_index/list');
    }


}


?>