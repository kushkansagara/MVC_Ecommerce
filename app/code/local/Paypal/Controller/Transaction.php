<?php

class Paypal_Controller_Transaction extends Core_Controller_Front_Action
{
    public function startAction()
    {

        $cart = Mage::getModel('checkout/session')->getCart();
        $price = $cart->getTotalAmount();
        $paypal = new Paypal_Init();
        $paypal = $paypal->getApiContext();
        echo "<pre>";
        print_r($paypal);


        $payer = new PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new PayPal\Api\Amount();
        $amount->setTotal($price)->setCurrency('USD');

        $transaction = new PayPal\Api\Transaction();

        $transaction->setAmount($amount)->setDescription('Payment for Order #1234');



        $redirectUrls = new PayPal\Api\RedirectUrls();

        $redirectUrls->setReturnUrl(Mage::getBaseUrl() . 'paypal/transaction/success')
            ->setCancelUrl(Mage::getBaseUrl() . 'paypal/transaction/cancel');

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
    public function cancelAction()
    {

    }
    public function successAction()
    {
        $paypal = new Paypal_Init();
        $paypal = $paypal->getApiContext();
        if (!isset($_GET['paymentId'], $_GET['PayerID'])) {
            die("Payment failed or canceled.");
        }

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        try {
            $payment = PayPal\Api\Payment::get($paymentId, $paypal);

            $execution = new PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $paypal);

            if ($result->getState() == 'approved') {
                echo "Payment successful! Transaction ID: " . $result->getId();
                $this->redirect("checkout/cart_order/convert?transaction_id={$result->getId()}");
            } else {
                echo "Payment not approved.";
            }

        } catch (Exception $ex) {
            echo "Payment execution error: " . $ex->getMessage();
        }
    }


}
?>