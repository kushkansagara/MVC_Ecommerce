<?php

class Cms_Block_Index extends Core_Block_Template
{
    protected $_media;
    protected $_productImage;
    public function getImage()
    {
        $_media = Mage::getModel('catalog/media_gallery')->getCollection()->getData();
        return $_media;
    }

    public function getImageSlider()
    {
        $_productImage = Mage::getModel('catalog/product')->getCollection()
            // ->joinLeft(
            //     'catalog_product_attribute',
            //     'catalog_product_attribute.product_id = catalog_product.product_id',
            //     ['attribute_value' => 'value', 'attribute_id']
            // )->joinLeft(
            //         'catalog_attribute',
            //         'catalog_attribute.attribute_id = catalog_product_attribute.attribute_id',
            //         ['attribute_name' => 'name', 'attribute_type' => 'type']
            //     )
            ->joinLeft(
                ['cmg' => 'catalog_media_gallery'],
                'cmg.product_id = main_table.product_id',
                ['media_file_path' => 'file_path', 'media_type' => 'type']
            )
            ->groupBy(['cmg.product_id'])
        ;
        return $_productImage->getData();

    }

}

?>