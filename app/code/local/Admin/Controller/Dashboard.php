<?php
class Admin_Controller_Dashboard extends Core_Controller_Admin_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout();

        $new = $layout->createBlock('Admin/dashboard')
            ->setTemplate('Admin/dashboard.phtml');

        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
}
?>