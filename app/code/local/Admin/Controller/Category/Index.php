<?php


class Admin_Controller_Category_Index extends Core_Controller_Admin_Action
{

    protected $_allowedActions = [
        'new'
    ];
    public function newAction()
    {
        $layout = $this->getLayout();
        $new = $layout->createBlock('Admin/Category_Index_New')
            ->setTemplate('Admin/Category/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('main.css')->addCss('Admin/Category/index/New.css');

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $list = $layout->createBlock('Admin/Category_Index_List');

        $layout->getChild('content')->addChild('list', $list);
        $layout->getChild('head')->addCss('main.css')->addCss('Admin/Category/index/list.css');
        $layout->toHtml();

    }
    public function saveAction()
    {

        $request = Mage::getModel('core/request');
        $Category = Mage::getModel('catalog/Category');
        $Category->setData($request->getParam('catalog_category'));
        $oldImage = $Category->getImage();
        if (isset($_FILES['catlog_Category']['name']['image']) && $_FILES['catlog_Category']['error']['image'] == 0) {
            $uploadDir = Mage::getBaseDir() . "/media/Category/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . "_" . basename($_FILES['catlog_Category']['name']['image']);
            $uploadFilePath = $uploadDir . $fileName;
            $tmpFilePath = $_FILES['catlog_Category']['tmp_name']['image'];

            if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
                $path = "media/Category/" . $fileName;
                $Category->setImage($path);
            }
        }
        ;
        $newImage = $Category->getImage();
        if ($oldImage && ($oldImage != $newImage)) {
            unlink($oldImage);
        }
        $Category->save();
        header('Location: http://localhost/mvc_main/admin/Category_index/list');
        exit;
    }
    public function deleteAction()
    {
        ;
        $request = Mage::getModel('core/request');
        $Category = Mage::getModel('catalog/Category');
        $id = $request->getQuery('id');
        $Category->load($id);
        $oldImage = $Category->getImage();

        if ($oldImage) {
            unlink($oldImage);
        }
        $Category->delete();


        header('Location: http://localhost/mvc_main/admin/Category_index/list');
    }

}

?>