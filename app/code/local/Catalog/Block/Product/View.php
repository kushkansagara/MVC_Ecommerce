<?php
class Catalog_Block_Product_View extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('catalog/product/view.phtml');
    }

    public function getProductData()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        $product = Mage::getModel('catalog/product')
            ->load($id);
        return $product;
    }

    public function getAttributes()
    {
        $attributes = Mage::getModel("catalog/Attribute")
            ->getCollection();
        return $attributes->getData();
    }
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getProductReviews()
    {
        $product_id = $this->getRequest()->getQuery('id');
        $review = Mage::getModel('catalog/product_review')
            ->getCollection()
            ->joinInner(['customer' => 'customer_account'], 'customer.customer_id = main_table.customer_id', ['fn' => 'first_name', 'ln' => 'last_name'])
            ->orderBy(['created_at DESC'])
            ->addFieldToFilter('product_id', $product_id);

        return $review->getData();
    }

    // public function getUser($id)
    // {
    //     $user = Mage::getModel('customer/account')
    //         ->load($id);
    //     return $user;
    // }
}
?>