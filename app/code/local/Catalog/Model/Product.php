<?php

class Catalog_Model_Product extends Core_Model_Abstract
{
    public $status = [0 => "Disable", 1 => "Enable"];
    public function init()
    {
        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_collectionClassName = "Catalog_Model_Resource_Product_Collection";
    }

    public function getStatusText()
    {
        return isset($this->status[$this->getStatus()]) ? $this->status[$this->getStatus()] : "NA";
    }
    protected function _afterLoad()
    {
        if ($this->getProductId()) {
            $collection = Mage::getModel("catalog/product_attribute")
                ->getCollection()
                ->addFieldToFilter("product_id", $this->getProductId())
                ->joinLeft(["attr" => "catalog_attribute"], "attr.attribute_id = main_table.attribute_id", ["name" => "name"]);

            $imagescollection = Mage::getModel("catalog/Media_Gallery")
                ->getCollection()
                ->addFieldToFilter("product_id", $this->getProductId());
            // ->addFieldToFilter('main_image', 1);
            foreach ($collection->getData() as $_data) {
                $this->{$_data->getName()} = $_data->getValue();
            }

            $filepaths = [];
            $main_image = [];

            foreach ($imagescollection->getData() as $image) {
                $filepaths[] = $image->getFilePath();
                $main_image[] = $image->getMainImage();
            }

            $this->_data['filepath'] = $filepaths;
            $this->_data['main_image'] = $main_image;
        }
        return $this;
    }
    protected function _afterSave()
    {
        $attributes = Mage::getModel('catalog/attribute')->getCollection()->getData();
        foreach ($attributes as $_attribute) {
            // echo "<pre>";
            // print_r($_attribute);
            $productAttributes = Mage::getModel('catalog/product_attribute')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                ->getData();


            $value = $this->{$_attribute->getName()};

            if (isset($productAttributes[0])) {
                $productAttributes[0]->setValue($value)
                    ->save();
            } else {
                Mage::getModel('catalog/product_attribute')
                    ->setAttributeId($_attribute->getAttributeId())
                    ->setProductId($this->getProductId())
                    ->setValue($value)
                    ->save();
            }

            $images = Mage::getModel('catalog/media_gallery');
            $request = Mage::getModel('core/request');
            $imageData = [];
            // die;
            if (!empty($_FILES['catalog_product']['name']['file_path'][0])) {
                foreach ($_FILES['catalog_product']['name']['file_path'] as $key => $value) {
                    // echo "123";
                    // die;
                    if (move_uploaded_file($_FILES['catalog_product']['tmp_name']['file_path'][$key], "media/product/$value")) {
                        $imageData['product_id'] = $this->getProductId();
                        $imageData['file_path'] = "media/product/$value";
                        $type = $_FILES['catalog_product']['type']['file_path'][$key];
                        $imageData['type'] = substr($type, '0', strpos($type, '/'));
                        $images->setData($imageData);
                        if ($value === $request->getParam('main_image')) {
                            $images->setMainImage(1);
                        }
                        $images->save();
                    }
                }
            }
            // die;
            $deleteimg = $request->getParam('deletedimg');
            if ($deleteimg != "") {
                $gallery = Mage::getModel('catalog/media_gallery');
                foreach ($deleteimg as $img) {
                    $mediaid = $gallery->getCollection()->addFieldToFilter('product_id', $this->getProductId())->addFieldToFilter('file_path', $img)->getData()[0]->getMediaId();

                    if (file_exists($img)) {
                        unlink($img);
                    }
                    $gallery->setData($mediaid);
                    $gallery->delete();
                }
            }
        }
    }
}
?>