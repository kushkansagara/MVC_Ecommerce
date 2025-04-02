<?php


class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{

    protected $_allowedActions = [
        'new'
    ];
    public function newAction()
    {

        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('Admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main.css');


        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Product_Index_List');
        // ->setTemplate('Admin/product/index/list.phtml');


        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }

    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $id = $request->getQuery('id');
        $image = $product->load($id)->getData()['filepath'];

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
        $product->save();
        $this->redirect('admin/product_index/list');
    }
}


?>