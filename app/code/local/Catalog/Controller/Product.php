<?php

use PayPal\Rest\ApiContext;

class Catalog_Controller_Product
{

    public function viewAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $view = $layout->createBlock('Catalog/Product_View')->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view', $view);
        $layout->getChild('head')->addCss('catalog/product/view.css')
            ->addJs('catalog/product/view.js');
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $list = $layout->createBlock('Catalog/Product_List')
            ->setTemplate('catalog/product/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->getChild('head')->addCss('catalog/product/list.css');
        $layout->toHtml();
    }

    public function TestAction()
    {

        $paypal = new Paypal_Init();
        $paypal = $paypal->getApiContext();
        echo "<pre>";
        print_r($paypal);


        $payer = new PayPal\Api\Payer();

        $payer->setPaymentMethod('paypal');



        $amount = new PayPal\Api\Amount();

        $amount->setTotal('10.00')->setCurrency('USD');



        $transaction = new PayPal\Api\Transaction();

        $transaction->setAmount($amount)->setDescription('Payment for Order #1234');



        $redirectUrls = new PayPal\Api\RedirectUrls();

        $redirectUrls->setReturnUrl("http://localhost/kush/paypal_success.php")

            ->setCancelUrl("http://yourwebsite.com/paypal_cancel.php");



        $payment = new PayPal\Api\Payment();

        $payment->setIntent('sale')

            ->setPayer($payer)

            ->setRedirectUrls($redirectUrls)

            ->setTransactions([$transaction]);



        try {

            $payment->create($paypal);

            header("Location: " . $payment->getApprovalLink());

        } catch (Exception $ex) {

            echo "Error: " . $ex->getMessage();

        }


    }


}
?>