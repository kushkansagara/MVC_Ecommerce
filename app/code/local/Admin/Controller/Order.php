<?php
class Admin_Controller_Order extends core_Controller_Admin_Action
{
    public function listAction()
    {
        $new = $this->getLayout()->createBlock('Admin/order');

        $this->getLayout()->getChild('content')->addChild('new', $new);
        $this->getLayout()->toHtml();
    }

    public function viewAction()
    {
        $order_id = $this->getRequest()->getQuery('id');
        $order = Mage::getModel('sales/order')
            ->load($order_id);


        // $this->getLayout() = Mage::getBlock('Core/Layout');

        $view_order = $this->getLayout()
            ->createBlock('Admin/sales_order_view')
            ->setOrder($order);

        $order_block = $this->getLayout()
            ->createBlock('Admin/sales_order_view_info');
        // ->setOrderBlock($view_order);
        $view_order->addChild("order", $order_block);

        $item_block = $this->getLayout()
            ->createBlock('Admin/sales_order_view_item');
        // ->setOrderBlock($view_order);
        $view_order->addChild("item", $item_block);

        $address_block = $this->getLayout()
            ->createBlock('Admin/sales_order_view_address');
        // ->setOrderBlock($view_order);
        $view_order->addChild("address", $address_block);

        $this->getLayout()->getChild("content")
            ->addChild("view_order", $view_order);
        // Mage::log($this->getLayout());
        $this->getLayout()->toHtml();
    }

    public function updateStatusAction()
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        $data = $this->getRequest()->getParams();
        Mage::getModel('sales/order')->setData($data)->save();
        $this->redirect('admin/order/index');
    }
}
?>