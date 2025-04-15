<?php

class Ticket_Controller_Answer extends Core_Controller_Front_Action
{
    public function IndexAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('ticket/Answer_Index');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();

    }
}
?>