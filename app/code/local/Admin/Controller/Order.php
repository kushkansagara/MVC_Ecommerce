<?php
class Admin_Controller_Order extends core_Controller_Admin_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/order')
            ->setTemplate('Admin/order.phtml');

        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }

    public function viewAction()
    {
        $order_id = $this->getRequest()->getQuery('id');
        $order = Mage::getModel('sales/order')
            ->load($order_id);


        $layout = Mage::getBlock('Core/Layout');

        $view_order = $layout
            ->createBlock('Admin/sales_order_view')
            ->setOrder($order);

        $order_block = $layout
            ->createBlock('Admin/sales_order_view_info');
        // ->setOrderBlock($view_order);
        $view_order->addChild("order", $order_block);

        $item_block = $layout
            ->createBlock('Admin/sales_order_view_item');
        // ->setOrderBlock($view_order);
        $view_order->addChild("item", $item_block);

        $address_block = $layout
            ->createBlock('Admin/sales_order_view_address');
        // ->setOrderBlock($view_order);
        $view_order->addChild("address", $address_block);

        $layout->getChild("content")
            ->addChild("view_order", $view_order);

        $layout->toHtml();
    }
}
?>