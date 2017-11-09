<?php
require_once 'PHPUnit/Framework/TestCase.php';
//namespace vdp;

class CybersourcePaymentsTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		$this->visaAPIClient = new VisaAPIClient;
		$this->paymentAuthorizationRequest = json_encode ([ 
	    'amount' => '0',
	    'currency' => 'USD',
	    'purchasingLevel' => '3',
	     'payment' => [
		    'cardNumber'=> '4111111111111111',
		    'cardExpirationMonth' => '10',
		    'cardExpirationYear' => '2020',
//----------------------------------------------------------------------------------------
			'cardVerificationIndicator' => '0',
			'cvn' => '111',
			'cardType' => '001',
			'encryptedData' => '',
			'encryptedDescriptor' => '',
			'encryptedEncoding' => '',
			'encryptedWrappedKey' => '',
			'cavv' => 'AAABAWFlmQAAAABjRWWZEEFgFz+='
			],
			'billTo' => [ 
			'street1' => '901 Metro Center Blvd',
			'street2' => 'Folsom street',
			'city' => 'Foster City',
			'country' => 'USA',
			'state' => 'CA',
			'postalCode' => '94404',
			'firstName' => 'userFirst',
			'lastName' => 'userLast',
			'email' => 'bill@cybs.com',
			'buildingNumber'=> '24',
			'district' => 'san mateo',
			'company' => 'visa',
			'ipAddress' => '10.20.408.500',
			'phoneNumber' => '6508764564'
			],
			'shipTo' => [
			'firstName' => 'userFirst',
			'lastName' => 'userLast',
			'street1' => '901 Metro Center Blvd',
			'street2' => 'Folsom st.',
			'city' => 'Foster City',
			'state' => 'CA',
			'postalCode' => '94404',
			'fromPostalCode' => '95135',
			'country' => 'USA',
			'phoneNumber' => '6507686543',
			'shippingMethod' => 'Mail'
			],
			'order'=> [
			'amexDataTAA1' => 'Sporting Goods',
			'amexDataTAA2' => 'Jewelry',
			'amexDataTAA3' => 'Accessories',
			'amexDataTAA4' => 'Electronics',
			'authorizedContactName' => 'Test',
			'cardAcceptorRefNumber' => '123',
			'alternateTaxAmount' => '35.50',
			'alternateTaxId' => '12',
			'alternateTaxAmountIndicator' => '1',
			'dutyAmount' => '0.10',
			'dutyAmountSign' => 'positive',
			'freightAmount' => '0.98',
			'freightAmountSign' => 'positive',
			'localTax' => '1.53',
			'localTaxIndicator' => '1',
			'nationalTax' => '2.99',
			'nationalTaxIndicator' => '1',
			'merchantVATRegistrationNumber' => 'AB12C3nomorethan20ch',
			'orderDiscountAmount' => '20.00',
			'orderDiscountAmountSign' => 'positive',
			'orderDiscountManagementIndicator' => '1',
			'purchaserCode' => 'testCode',
			'purchaserOrderDate' => '160913',
			'purchaserVATRegistrationNumber' => '98ZXW7Q554321',
			'summaryCommodityCode' => 'A2Zs',
			'taxIndicator' => 'Y',
			'taxManagementIndicator' => '0',
			'totalTaxTypeCode' => '056',
			'vatInvoiceRefNumber' => 'vivatrefnotest1',
			'vatTaxAmount' => '35.50',
			'vatTaxAmountSign' => 'positive',
			'vatTaxRate' => '.12'
			],
			'vcOrderId' => '',
			'commerceIndicator' => 'moto',
			'ignoreAvs' => 'YES',
			'ignoreBadCvn' => 'YES',
			'referenceId' => '124',
			'merchantDefinedData' => [
			'field1' => 'test1',
			],
			'items' => [
			'productSKU' => 'A100',
			'productCategoryCode' => 'electronics',
			'quantity' => '1',
			'amount' => '12.99',
			'taxAmount' => '0.80',
			'productName' => 'Test1',
			'commodityCode' => '123456789',
			'discountIndicator' => 'Y',
			'discountRate' => '0.05',
			'discountAmount' => '1.45',
			'discountManagementIndicator' => '1',
			'vatRate' => '1',
			'typeOfSupply' => '00',
			'unitOfMeasure' => 'meter',
			'totalAmount' => '5.00',
			'taxRate' => '0.10',
			'taxTypeApplied' => 'Cntry',
			'taxStatusIndicator' => '1',
			'invoiceNumber' => '123',
			'grossNetIndicator' => 'N',
			'nationalTax' => '0.10',
			'localTax' => '1.53',
			'alternateTaxId' => '98765432198765',
			'alternateTaxAmount' => '1.00',
			'alternateTaxRate' => '1.50',
			'alternateTaxTypeApplied' => 'VAT',
			'alternateTaxTypeIdentifier' => '10'
			],
			'merchantDescriptor' => [
			'primary' => 'iufkdjjjdsccsdkjc',
			'alternate' => 'kdlkfklsklsk',
			'city' => 'san Mateo',
			'contact' => '89787889887',
			'country' => 'USA',
			'postalCode' => '94404',
			'state' => 'CA',
			'street' => 'shellBlvd'
			],
			'payerAuth' =>  [
			'cavvAlgorithm' => '2',
			'paAuthStatus' => '05',
			'paAuthRawResult' => 'Y',
			'veResEnrolled' => 'Y'
			]
			
//----------------------------------------------------------------------------------------	    ]
	    ]);

	}
	public function testPaymentAuthorizations() {
		$baseUrl = "cybersource/";
		$resourcePath = "payments/v1/sales";
		$queryString = "apikey=".$this->visaAPIClient->conf ['VDP'] ['apiKey'];
		$statusCode = $this->visaAPIClient->doXPayTokenCall ( 'post', $baseUrl, $resourcePath, $queryString, 'Cybersource Payments', $this->paymentAuthorizationRequest );
			echo $this->assertEquals($statusCode, "201");
	}
			
}	
	 

?>	
