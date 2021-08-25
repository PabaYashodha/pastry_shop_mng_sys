<?php
include_once '../model/Customer.php';
$customerObj = new Customer();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addCustomer':
        try {
            $customerFirstName = $_POST['customerFirstName'];
            $customerLastName = $_POST['customerLastName'];
            $customerContact = $_POST['customerContact'];
            $customerEmail = $_POST['customerEmail'];
            $customerAdd1 = $_POST['customerAdd1'];
            $customerAdd2 = $_POST['customerAdd2'];
            $customerAdd3 = $_POST['customerAdd3'];
            $customerPostalCode = $_POST['customerPostalCode'];
            $customerBirthday = $_POST['customerBirthday'];
            $customerNic = $_POST['customerNic'];
            $customerGender = $_POST['customerGender'];

            if ($customerFirstName == "") {
                throw new Exception("Customer first name is required");
            }

            if ($customerLastName == "") {
                throw new Exception("Customer last name is required");
            }

            if ($customerContact == "") {
                throw new Exception("Customer contact is required");
            }

            if ($customerEmail == "") {
                throw new Exception("Customer email is required");
            }

            if ($customerAdd1 == "") {
                throw new Exception("Address no is required");
            }

            if ($customerAdd2 == "") {
                throw new Exception("Lane is required");
            }

            if ($customerAdd3 == "") {
                throw new Exception("street is required");
            }

            if ($customerPostalCode == "") {
                throw new Exception("Postal code is required");
            }

            if ($customerBirthday == "") {
                throw new Exception("Birthday is required");
            }

            if ($customerNic == "") {
                throw new Exception("NIC is required");
            }
            if ($customerGender == "") {
                throw new Exception("Gender is required");
            }
            $result = $customerObj->addCustomer($customerFirstName, $customerLastName, $customerContact, $customerEmail, $customerAdd1, $customerAdd2, $customerAdd3, $customerPostalCode, $customerNic, $customerBirthday, $customerGender);
            if ($result == 1) {
                $res = 1;
                $result = $customerObj->getCustomerData();
                $customerArray = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($customerArray, $row);
                }
                $msg = $customerArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getCustomerData':
        $result = $customerObj->getCustomerData();
        $customerArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($customerArray, $row);
        }
        echo json_encode($customerArray);
        break;

    case 'viewCustomerDetails':
        $customerId = base64_decode($_POST['customerId']);
        $result = $customerObj->viewCustomerDetails($customerId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editCustomer':
        try {
            $customerId = base64_decode($_POST['editCustomerId']);
            $customerFirstName = $_POST['editCustomerFirstName'];
            $customerLastName = $_POST['editCustomerLastName'];
            $customerContact = $_POST['editCustomerContact'];
            $customerEmail = $_POST['editCustomerEmail'];
            $customerAdd1 = $_POST['editCustomerAdd1'];
            $customerAdd2 = $_POST['editCustomerAdd2'];
            $customerAdd3 = $_POST['editCustomerAdd3'];
            $customerPostalCode = $_POST['editCustomerPostalCode'];
            $customerBirthday = $_POST['editCustomerBirthday'];
            $customerNic = $_POST['editCustomerNic'];
            $customerGender = $_POST['editCustomerGender'];

            if ($customerFirstName == "") {
                throw new Exception("Customer first name is required");
            }

            if ($customerLastName == "") {
                throw new Exception("Customer last name is required");
            }

            if ($customerContact == "") {
                throw new Exception("Customer contact is required");
            }

            if ($customerEmail == "") {
                throw new Exception("Customer email is required");
            }

            if ($customerAdd1 == "") {
                throw new Exception("Address no is required");
            }

            if ($customerAdd2 == "") {
                throw new Exception("Lane is required");
            }

            if ($customerAdd3 == "") {
                throw new Exception("street is required");
            }

            if ($customerPostalCode == "") {
                throw new Exception("Postal code is required");
            }

            if ($customerBirthday == "") {
                throw new Exception("Birthday is required");
            }

            if ($customerNic == "") {
                throw new Exception("NIC is required");
            }
            if ($customerGender == "") {
                throw new Exception("Gender is required");
            }
            $result = $customerObj->editCustomer($customerId, $customerFirstName, $customerLastName, $customerContact, $customerEmail, $customerAdd1, $customerAdd2, $customerAdd3, $customerPostalCode, $customerNic, $customerBirthday, $customerGender);
            if ($result == 1) {
                $res = 1;
                $result = $customerObj->getCustomerData();
                $customerArray = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($customerArray, $row);
                }
                $msg = $customerArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;
}
