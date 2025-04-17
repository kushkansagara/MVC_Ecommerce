<?php
class Admin_Controller_Ticket_Index extends Core_Controller_Admin_Action
{
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('admin/Ticket_Index_List');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();
    }
    public function viewAction()
    {
        $layout = $this->getLayout();
        $view = $layout->createBlock('admin/Ticket_Index_View');
        $layout->getChild('content')->addChild('list', $view);

        $layout->toHtml();
    }
    public function NewAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('admin/Ticket_Index_New');
        $layout->getChild('content')->addChild('list', $new);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $data = $this->getRequest()->getParams();
        $ticket = Mage::getModel('ticket/ticket')
            ->setTitle($data['ticket'])
            ->setCreatedAt(date('Y-m-d H:i:s'))
            ->save();
        $this->redirect('admin/ticket_index/view');
    }
    public function savecommentAction()
    {
        $data = $this->getRequest()->getParams();
        if ($data['parent_id'] == 0) {
            unset($data['parent_id']);
        }
        Mage::getModel('ticket/comment')
            ->setData($data)
            ->save();
    }
    public function completeCommentAction()
    {
        $data = $this->getRequest()->getParams();
        $id = $data['completeId'];

        Mage::getModel('ticket/comment')
            ->setIsActive(0)
            ->setCommentId($id)
            ->save();

    }

}
?>