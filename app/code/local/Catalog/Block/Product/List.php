<?php

class Catalog_Block_Product_List extends Core_Block_Template
{
    protected $_collection;
    public function __construct()
    {
        $filter = $this->getLayout()->createBlock('Catalog/Product_List_Filter');
        $products = $this->getLayout()->createBlock('Catalog/Product_List_Products');

        $this->addChild('filter', $filter);
        $this->addChild('products', $products);

    }

    protected $_productImage;
    public function getProductData()
    {
        $request = Mage::getModel("core/request");
        $id = $request->getQuery('id');
        $product = Mage::getModel('catalog/product')
            ->load($id);
        return $product;
    }
    public function getImage()
    {
        // $request = Mage::getModel("core/request");
        // $id = $request->getQuery('id');
        // $product = Mage::getModel('catalog/product')
        //     ->load($id);
        // $this->_productImage = Mage::getModel('catalog/product')->getCollection()
        //     ->joinLeft(
        //         ['cmp' => 'catalog_media_gallery'],
        //         'cmp.product_id = main_table.product_id',
        //         ['media_file_path' => 'file_path', 'media_type' => 'type']
        //     )
        //     ->groupBy(['cmp.product_id'])
        // ;
        // return $this->_productImage->getData();
    }

    public function image($id)
    {
        $image = Mage::getModel('catalog/product')->load($id);
        $key = array_search(1, $image->getMainImage());

        if ($key != '') {
            $filepath = $image->getFilepath()[$key];
            return $filepath;
        } else {
            return isset($image->getFilepath()[0]) ? $image->getFilepath()[0] : '';
        }
    }
    public function getCategories()
    {
        $data = Mage::getModel('catalog/category')->getCollection()
            // ->addFieldToFilter('parent_id', 1)
            ->getData();
        return $data;
    }
    public function getAttributes()
    {
        $attribute = Mage::getModel("catalog/attribute")->getCollection()->getData();
        return $attribute;
    }
    public function getProductAttribute($id)
    {
        $attribute = Mage::getModel("catalog/product_attribute")->getCollection()
            ->addFieldToFilter('attribute_id', $id)
            ->getData();

        return $this->uniquevalues($attribute);
    }
    public function listAjaxAction()
    {
        header('Content-Type: application/json');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $postData = json_decode(file_get_contents('php://input'), true);
        try {
            $collection = Mage::getModel("catalog/filter")
                ->getProductCollection();
            $products = [];
            foreach ($collection as $product) {
                $productData = $product->getData();
                $products[] = [
                    'id' => $productData['product_id'] ?? $productData['id'] ?? 0,
                    'name' => $productData['name'] ?? 'Unknown Product',
                    'price' => $productData['price'] ?? '0.00',
                    'image' => 'images/product-2.jpg',
                ];
            }
            $response = [
                'products' => $products,
                'status' => 'success',
                'count' => count($products)
            ];
            echo json_encode($response);
        } catch (Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'products' => []
            ];
            echo json_encode($errorResponse);
        }
    }
    public function uniqueValues($data)
    {
        $newdata = [];
        foreach ($data as $values) {

            if (!empty($values->getValue())) {
                $newdata[] = $values->getValue();
            }
        }

        return array_values(array_unique($newdata));
    }
}
?>