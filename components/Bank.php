<?php
namespace app\components;

use Yii;
use SoapClient;
use yii\base\component;
use yii\base\Exception;

class Bank extends component
{
	public $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
// 	public $MerchantID = 'a38d4fda-b66d-11e8-b4b6-005056a205be'; //Required
// 	public $CallbackURL = 'modir.ir/pay/back'; // Required

	// PAYMENT FUNCTION
	public function Pay($Price, $Description, $CallbackURL)
	{
		$client = new SoapClient('https://zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
		$result = $client->PaymentRequest(
			[
				'MerchantID' => $this->MerchantID,
				'Amount' => $Price,
				'Description' => $Description,
				'CallbackURL' => $CallbackURL,
			]
		);
		return $result;
	}

	// GO TO BANK
	public function Go($result)
	{
		Header('Location: https://zarinpal.com/pg/StartPay/'.$result->Authority);
	}

	// CHECK STATUS PAYMENT
	function Check($Authority, $Amount)
	{
		$client = new SoapClient('https://zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
		$result = $client->PaymentVerification(
			[
				'MerchantID' => $this->MerchantID,
				'Authority' => $Authority,
				'Amount' => $Amount,
			]
		);
		return $result;
	}
}