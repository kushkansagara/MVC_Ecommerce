<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Customer_Controller_Account extends Core_Controller_Customer_Action
{
    protected $_allowedActions = [
        'registration',
        'login',
        'save',
        'loginPost',
        'verifyOTP',
        'change',
        'sendOTP',
        'forgot'
    ];
    public function registrationAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $registration = $layout->createBlock('Customer/Account_registration')
            ->setTemplate('customer/account/registration.phtml');
        $layout->getChild('content')->addChild('list', $registration);
        $layout->toHtml();
    }

    public function saveAction()
    {
        $params = $this->getRequest()->getParams();
        $params['customer_account']['password_hash'] = hash('sha256', $params['customer_account']['password_hash']);

        $CustomerData = $params['customer_account'];
        $CustomerAccount = Mage::getModel('customer/account')
            ->setData($CustomerData);
        $CustomerAccount->save();
        $this->redirect('customer/account/dashboard');

    }
    public function loginAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $login = $layout->createBlock('Customer/Account_login')
            ->setTemplate('customer/account/login.phtml');
        $layout->getChild('content')->addChild('list', $login);
        $layout->toHtml();

    }
    public function loginPostAction()
    {
        $params = $this->getRequest()->getParams();
        $session = Mage::getSingleton('core/session');
        $message = $this->getRequest()->getMessages();


        $customer = Mage::getSingleton('customer/account')
            ->load($params['customer_login']['email'], 'email');

        $current_pass = hash('sha256', $params['customer_login']['password']);

        if ($current_pass === $customer->getPasswordHash()) {
            $session->set('customer_id', $customer->getCustomerId());
            $this->redirect('');
            $message->addMessage('success', 'Login Successfully');

        } else {
            $message->addMessage('error', 'Wrong credentials!');
            // die;
            $this->redirect('customer/account/login');

        }

    }
    public function logoutAction()
    {
        $session = $this->getSession()->remove('customer_id');
        $this->redirect('');
    }
    public function forgotAction()
    {

        $layout = Mage::getBlockSingleton('Core/Layout');
        $forgot = $layout->createBlock('Customer/Account_forgot')
            ->setTemplate('customer/account/forgot.phtml');
        $layout->getChild('content')->addChild('list', $forgot);
        $layout->toHtml();
    }
    public function sendOTPAction()
    {
        $params = $this->getRequest()->getParams();
        $customer_id = Mage::getModel('customer/account')->load($params['email'], 'email');
        $id = $customer_id->getCustomerId();
        if (empty($customer_id->getCustomerId())) {
            echo json_encode(["success" => false, "message" => "No registered email found!"]);
            exit;
        }

        $session = $this->getSession();

        $email = trim($params['email']);

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(["success" => false, "message" => "Invalid email address"]);
        }

        $otp = rand(100000, 999999);
        $session->set('otp', $otp);
        $session->set('otp_expiry', time() + (10 * 60)); // OTP valid for 10 minutes
        $session->set('otp_email', $email);

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP Server (Gmail, Outlook, etc.)
            $mail->SMTPAuth = true;
            $mail->Username = 'kush02032004@gmail.com'; // Replace with your email
            $mail->Password = 'fjjt xvpk vtmr xrqy'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Details
            $mail->setFrom('kush02032004@gmail.com', 'Kansagara Kush');
            $mail->addAddress($email);
            $mail->Subject = "Your One-Time Password (OTP)";
            $mail->Body = "Dear User,\n\nYour OTP is: $otp\n\nThis OTP is valid for 10 minutes. Do not share it.";

            if ($mail->send()) {
                echo json_encode(["success" => true, "message" => "OTP sent to $email"]);
                exit;
            } else {
                echo json_encode(["success" => false, "message" => "Failed to send OTP."]);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Mailer Error: " . $mail->ErrorInfo]);
            exit;
        }
    }

    public function changeAction()
    {
        // header('Content-Type: application/json');
        $params = $this->getRequest()->getParams();
        $customer_id = Mage::getModel('customer/account')->load($params['email'], 'email');
        $id = $customer_id->getCustomerId();
        $session = $this->getSession();

        $email = $session->get('otp_email');
        if ($email !== $params['email']) {
            echo json_encode(["success" => false, "message" => "Unauthorized request!"]);
            exit;
        }
        $password = hash('sha256', $params['password']);
        try {
            $customer = Mage::getModel('customer/account')
                ->setPasswordHash($password)
                ->setCustomerId($id)
                ->save();
            echo json_encode(["success" => true, "message" => "Password changed successfully!"]);
            exit;
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Error updating password: " . $e->getMessage()]);
        }
    }
    public function dashboardAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $dashboard = $layout->createBlock('Customer/Account_dashboard')
            ->setTemplate('customer/account/dashboard.phtml');
        $layout->getChild('content')->addChild('list', $dashboard);
        $layout->toHtml();
        // $customer_id = $this->getSession()->get('customer_id');
        // $order = Mage::getModel('sales/order')
        //     ->load($customer_id);


        // $layout = Mage::getBlock('Core/Layout');

        // $view_order = $layout
        //     ->createBlock('Admin/sales_order_view')
        //     ->setOrder($order);

        // $order_block = $layout
        //     ->createBlock('Admin/sales_order_view_info');
        // // ->setOrderBlock($view_order);
        // $view_order->addChild("order", $order_block);

        // $item_block = $layout
        //     ->createBlock('Admin/sales_order_view_item');
        // // ->setOrderBlock($view_order);
        // $view_order->addChild("item", $item_block);

        // $address_block = $layout
        //     ->createBlock('Admin/sales_order_view_address');
        // // ->setOrderBlock($view_order);
        // $view_order->addChild("address", $address_block);

        // $layout->getChild("content")
        //     ->addChild("view_order", $view_order);

        // $layout->toHtml();
    }
    public function setDefaultAction()
    {
        $session = Mage::getSingleTon("core/session");
        $address = Mage::getModel("customer/account_address");

        $oldDefaultAddress = $address->getCollection()
            ->addFieldToFilter("customer_id", $session->get('customer_id'))
            ->addFieldToFilter('is_default', '1')
            ->getFirstItem();

        if (!empty($oldDefaultAddress->getData())) {
            $oldDefaultAddress->setIsDefault(0)
                ->save();
        }
        $address->load($this->getRequest()->getQuery('id'))
            ->setIsDefault(1)
            ->save();

        $this->redirect("customer/account/dashboard");
    }

    public function verifyOTPAction()
    {
        $params = $this->getRequest()->getParams();
        $session = $this->getSession();
        $otp = trim($params['otp']);

        if ($session->get('otp') == $otp) {
            echo json_encode(["success" => true, "message" => "OTP Verified!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid OTP!"]);
        }
    }

    public function changePasswordAction()
    {
        $layout = Mage::getBlockSingleton('Core/Layout');
        $forgot = $layout->createBlock('Customer/Account_change')
            ->setTemplate('customer/account/change.phtml');
        $layout->getChild('content')->addChild('list', $forgot);
        $layout->toHtml();
    }

    public function changepassAction()
    {
        $params = $this->getRequest()->getParams();

        $old_pass_hash = hash('sha256', $params['old_password']);
        $new_pass_hash = hash('sha256', $params['new_password']);
        $session = $this->getSession()->get('customer_id');
        $customer = Mage::getModel('customer/account')->load($session);
        if ($customer->getPasswordHash() !== $old_pass_hash) {
            echo json_encode(["success" => false, "message" => "old password not match"]);
            exit;
        } else {
            $password = Mage::getModel('customer/account')
                ->setPasswordHash($new_pass_hash)
                ->setCustomerId($session)
                ->save();
            echo json_encode(["success" => true, "message" => "Password change successfully"]);
            exit;

        }

    }

}
?>