<?php

namespace App\Http\Controllers;

use Mpesa;
use App\Models\MpesaTransaction;
use App\Models\MpesaTransactionB2C;
use App\Models\MpesaTransactionB2B;
use App\Models\STKMpesaTransaction;
use App\Models\MpesaTransactionStatus;
use App\Models\MpesaTransactionAccountBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use DB;
use Auth;


class MpesaController extends Controller
{
      /**
     * Lipa na M-PESA password
     * */
    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }
    /**
     * Lipa na M-PESA STK Push method
     * */
    public function customerMpesaSTKPush(Request $request)
    {
        $phoneNumber = $request->phone_number;
        $AmountSTK = $request->Amount;
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 174379,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $AmountSTK,
            'PartyA' => $phoneNumber, // replace this with your phone number
            'PartyB' => 174379,
            'PhoneNumber' => $phoneNumber, // replace this with your phone number
            'CallBackURL' => 'https://pipdotfx.com/api/v1/stk/push_call_back',
            'AccountReference' => "Account Reference",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        // Insert MerchantRequestID
        $curl_content=json_decode($curl_response);
        $mpesa_transaction = new STKMpesaTransaction();
        $mpesa_transaction->CheckoutRequestID =  $curl_content->CheckoutRequestID;
        $mpesa_transaction->MerchantRequestID =  $curl_content->MerchantRequestID;
        $mpesa_transaction->user_id =  $request->user_id;
        $mpesa_transaction->save();

        Log::info($curl_response);
        $CheckoutRequestID = $curl_content->CheckoutRequestID;
        $table = 'lnmo_api_response';
        return $this->checklast($CheckoutRequestID,$table,$curl_response);
    }

    public function customerMpesaSTKPushCallBack(Request $request){
        Log::info($request->getContent());
        $content=json_decode($request->getContent(), true);
            $CheckoutRequestID = $content['Body']['stkCallback']['CheckoutRequestID'];
            
            $nameArr = [];
            foreach ($content['Body']['stkCallback']['CallbackMetadata']['Item'] as $row) {
                
                if(empty($row['Value'])){
                    continue;
                }
                $nameArr[$row['Name']] = $row['Value'];
                // addUserID
            }
            DB::table('lnmo_api_response')->where('CheckoutRequestID',$CheckoutRequestID)->update($nameArr);
            $updateStatus = array(
                'status' =>1
            );
            DB::table('lnmo_api_response')->where('CheckoutRequestID',$CheckoutRequestID)->update($updateStatus);
        // Log To Laravel LOgs
        activity()->log('STK Payment Has Been Made');
        Log::info($request->getContent());
 
        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["STKPUSHPaymentConfirmationResult"=>"Success"]));
        return $response;
    }
    

    public function generateAccessToken()
    {
        $consumer_key="s7AHpPSYx2rB8rpT7GQbKufpu81KlL1F";
        $consumer_secret="SmL3Vw8Jh1KSlvIB";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
 
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;
    }

    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description){
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */
 
    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }
 
    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */
 
    public function mpesaConfirmation(Request $request)
    {
        $content=json_decode($request->getContent());
        Log::info($request->getContent());

        $mpesa_transaction = new MpesaTransaction();
        $mpesa_transaction->TransactionType = $content->TransactionType;
        $mpesa_transaction->TransID = $content->TransID;
        $mpesa_transaction->TransTime = $content->TransTime;
        $mpesa_transaction->TransAmount = $content->TransAmount;
        $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        $mpesa_transaction->MSISDN = $content->MSISDN;
        $mpesa_transaction->FirstName = $content->FirstName;
        $mpesa_transaction->MiddleName = $content->MiddleName;
        $mpesa_transaction->LastName = $content->LastName;
        $mpesa_transaction->save();

        $LastRecord = DB::table('mobile_payments')->orderBy('transLoID','desc')->first();
        if(Auth::user()){
            
                $updateDetails = array(
                    'user_id' => Auth::user()->id,
                );
                DB::table('mobile_payments')->where('transLoID',$LastRecord->transLoID)->update($updateDetails);
            
        }else{
           
                $updateDetails = array(
                    'user_id' => $content->BillRefNumber,
                );
                DB::table('mobile_payments')->where('transLoID',$LastRecord->transLoID)->update($updateDetails);
            
        }
        

        // Log To Laravel LOgs
        activity()->log('C2B Payment Has Been Made');
        
 
        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
        return $response;
    }

     /**
     * M-pesa Register Validation and Confirmation method
     */

    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "603021",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://pipdotfx.com/api/v1/transaction/confirmation",
            'ValidationURL' => "https://pipdotfx.com/api/v1/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }


    public function b2c(Request $request)
    {
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'SalaryPayment';
        $Amount =  '2500';
        $PartyA =  '603021';
        $PartyB =  '254708374149';
        $Remarks =  'Remarks';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/b2c/callbacks';
        $ResultURL =  'https://pipdotfx.com/api/v1/b2c/callbacks';
        $Occasion =  'Optionally';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'InitiatorName' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
            'Occasion' => $Occasion,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function b2ccallback(Request $request){

        // Log To Laravel LOgs
        activity()->log('B2C Payment Has Been Made');
        Log::info($request->getContent());
        // Add To Database
        $content=json_decode($request->getContent(), true);
 
        $nameArr = [];
        foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
            $nameArr[$row['Key']] = $row['Value'];
        }
        DB::table('b2c_api_response')->insert($nameArr);
        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["B2CPaymentConfirmationResult"=>"Success"]));
        return $response;
    }


    public function b2b(Request $request)
    {
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'BusinessPayBill';
        $Amount =  '500';
        $PartyA =  '603021';
        $PartyB =  '600000';
        $Remarks =  'Remarks';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/b2b/callbacks';
        $ResultURL =  'https://pipdotfx.com/api/v1/b2b/callbacks';
        $Occasion =  'Optionally';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'Initiator' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'SenderIdentifierType' => 4,
            'RecieverIdentifierType' => 4,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'AccountReference' => 'PipDot FX',
            'Remarks' => 'This is a test comment or remark',
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function b2bcallback(Request $request){

        // Log To Laravel LOgs
        activity()->log('B2B Payment Has Been Made');
        Log::info($request->getContent());
        // Add To Database
        $content=json_decode($request->getContent());
 
        $mpesa_transaction = new MpesaTransactionB2B();
        $mpesa_transaction->TransactionID = $content->TransactionID;
        $mpesa_transaction->InitiatorAccountCurrentBalance = $content->InitiatorAccountCurrentBalance;
        $mpesa_transaction->DebitAccountCurrentBalance = $content->DebitAccountCurrentBalance;
        $mpesa_transaction->Amount = $content->Amount;
        $mpesa_transaction->DebitPartyAffectedAccountBalance = $content->DebitPartyAffectedAccountBalance;
        $mpesa_transaction->DebitPartyCharges = $content->DebitPartyCharges;
        $mpesa_transaction->ReceiverPartyPublicName = $content->ReceiverPartyPublicName;
        $mpesa_transaction->Currency = $content->Currency;
        $mpesa_transaction->save();
        

        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["B2CPaymentConfirmationResult"=>"Success"]));
        return $response;
    }

    public function balance(Request $request)
    {
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'AccountBalance';
        $PartyA =  '603021';
        $Remarks =  'Remarks';
        $IdentifierType = '4';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/balance/callbacks';
        $ResultURL =  'https://pipdotfx.com/api/v1/balance/callbacks';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'Initiator' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'IdentifierType' => $IdentifierType,
            'PartyA' => $PartyA,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function balancecallbacks(Request $request){

        // Log To Laravel LOgs
        activity()->log('Account Balance Request');
        Log::info($request->getContent());
        // Add To Database
        $content=json_decode($request->getContent(), true);

        $nameArr = [];
        foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
            $nameArr[$row['Key']] = $row['Value'];
        }

        $AccBalanceValue = $nameArr['AccountBalance'];
        $BOCompletedTime = $nameArr['BOCompletedTime'];
        
        $data[] = 0;
      
        // usable array data = $data;
        $newAr = explode('&', $AccBalanceValue);


        $WorkingAccount = array();
        $FloatAccount = array();
        $UtilityAccount = array();
        $ChargesPaidAccount = array();
        $OrganizationSettlementAccount = array();

        $WorkingAccount = $newAr[0];
        $WorkingAccount = explode('|', $WorkingAccount);
        $WorkingAccount[0] = str_replace(" ", "", $WorkingAccount[0]);

        $FloatAccount = $newAr[1];
        $FloatAccount = explode('|', $FloatAccount);
        $FloatAccount[0] = str_replace(" ", "", $FloatAccount[0]);

        $UtilityAccount = $newAr[2];
        $UtilityAccount = explode('|', $UtilityAccount);
        $UtilityAccount[0] = str_replace(" ", "", $UtilityAccount[0]);

        $ChargesPaidAccount = $newAr[3];
        $ChargesPaidAccount = explode('|', $ChargesPaidAccount);
        $ChargesPaidAccount[0] = str_replace(" ", "", $ChargesPaidAccount[0]);

        $OrganizationSettlementAccount = $newAr[4];
        $OrganizationSettlementAccount = explode('|', $OrganizationSettlementAccount);
        $OrganizationSettlementAccount[0] = str_replace(" ", "", $OrganizationSettlementAccount[0]);
        
        # create the array
        $accountBalanceSave = array(
            'OrganizationSettlementAccount' => $OrganizationSettlementAccount[2],
            'ChargesPaidAccount' => $ChargesPaidAccount[2],
            'UtilityAccount' => $UtilityAccount[2],
            'WorkingAccount' => $WorkingAccount[2],
            'FloatAccount' => $FloatAccount[2],
            'BOCompletedTime' => $BOCompletedTime,
        );
        DB::table('accountbalance')->insert($accountBalanceSave);
        

        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["AccountBalanceRequestConfirmationResult"=>"Success"]));
        return $response;
    }


    

    public function TransactionStatus(Request $request)
    {
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'TransactionStatusQuery';
        $PartyA =  '603021';
        $Remarks =  'Remarks';
        $transaction = 'PDE81HISMM';
        $IdentifierType = '4';
        $Occasion =  'Occasion';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/transactionStatusCallBack';
        $ResultURL =  'https://pipdotfx.com/api/v1/transactionStatusCallBack';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'CommandID' => 'TransactionStatusQuery',
            'PartyA' => $PartyA,
            'IdentifierType' => 4,
            'Remarks' => 'Testing API',
            'Initiator' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $QueueTimeOutURL,
            'TransactionID' => $transaction,
            'Occassion' => 'Test'
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function transactionStatusCallBack(Request $request){

        // Log To Laravel LOgs
        activity()->log('Transaction Status Request');
        Log::info($request->getContent());
        // Add To Database
        $content=json_decode($request->getContent(), true);

        $nameArr = [];
        foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
            
            if(empty($row['Value'])){
                continue;
            }
            $nameArr[$row['Key']] = $row['Value'];
        }
        DB::table('transaction_status')->insert($nameArr);
        

        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["TransactionStatusRequestConfirmationResult"=>"Success"]));
        return $response;
    }


    public function reverse_request(Request $request)
    {
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'TransactionReversal';
        $PartyA =  '603021';
        $MSISDN = '254708374149';
        $TrasactionID = 'PDE81HISMM';
        $Amount = '10';
        $Remarks =  'Remarks';
        $IdentifierType = '11';
        $Occasion =  'Occasion';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/reverse/request/callback';
        $ResultURL =  'https://pipdotfx.com/api/v1/reverse/request/callback';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'CommandID' => $CommandID,
            'ReceiverParty' => $PartyA,
            'RecieverIdentifierType' => $IdentifierType, //1=MSISDN, 2=Till_Number, 4=Shortcode
            'Remarks' => 'Testing',
            'Amount' => $Amount,
            'Initiator' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
            'TransactionID' => $TrasactionID,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function reverse_request_callback(Request $request){

        // Log To Laravel LOgs
        activity()->log('Reverse Transaction Request');
        Log::info($request->getContent());
        // Add To Database
        $content=json_decode($request->getContent(), true);
        $nameArr = [];
            foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
                
                // if(empty($row['Value'])){
                //     continue;
                // }
                $nameArr[$row['Key']] = $row['Value'];
            }
            DB::table('reverse_transaction')->insert($nameArr);

        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["ReverseTransactionRequestConfirmationResult"=>"Success"]));
        return $response;
    }

    public function json_do_decodes(){
        $jdata = '{
                    "Result":{
                    "ResultType":0,
                    "ResultCode":0,
                    "ResultDesc":"The service request is processed successfully.",
                    "OriginatorConversationID":"62577-17392968-1",
                    "ConversationID":"AG_20210412_00005d1295e21fd0b3a0",
                    "TransactionID":"PDC0000000",
                    "ResultParameters":{
                        "ResultParameter":[
                            {
                                "Key":"AccountBalance",
                                "Value":"Working Account|KES|1.00|1.00|0.00|0.00&Float Account|KES|0.00|0.00|0.00|0.00&Utility Account|KES|11974737.63|11974737.63|0.00|1116744.00&Charges Paid Account|KES|-153780.00|-164505.00|10725.00|0.00&Organization Settlement Account|KES|0.00|0.00|0.00|0.00"
                            },
                            {
                                "Key":"BOCompletedTime",
                                "Value":20210412134119
                            }
                        ]
                    },
                    "ReferenceData":{
                        "ReferenceItem":{
                            "Key":"QueueTimeoutURL",
                            "Value":"https:\/\/internalsandbox.safaricom.co.ke\/mpesa\/abresults\/v1\/submit"
                        }
                    }
                    }
         }';

            $content=json_decode($jdata, true);

            $nameArr = [];
            foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
                $nameArr[$row['Key']] = $row['Value'];
            }
          

            $AccBalanceValue = $nameArr['AccountBalance'];
            $BOCompletedTime = $nameArr['BOCompletedTime'];
            
            $data[] = 0;
          
            // usable array data = $data;
            $newAr = explode('&', $AccBalanceValue);
            // dd($newAr);
            
            #working arrays

            $WorkingAccount = array();
            $FloatAccount = array();
            $UtilityAccount = array();
            $ChargesPaidAccount = array();
            $OrganizationSettlementAccount = array();

            $WorkingAccount = $newAr[0];
            $WorkingAccount = explode('|', $WorkingAccount);
            $WorkingAccount[0] = str_replace(" ", "", $WorkingAccount[0]);

            $FloatAccount = $newAr[1];
            $FloatAccount = explode('|', $FloatAccount);
            $FloatAccount[0] = str_replace(" ", "", $FloatAccount[0]);

            $UtilityAccount = $newAr[2];
            $UtilityAccount = explode('|', $UtilityAccount);
            $UtilityAccount[0] = str_replace(" ", "", $UtilityAccount[0]);

            $ChargesPaidAccount = $newAr[3];
            $ChargesPaidAccount = explode('|', $ChargesPaidAccount);
            $ChargesPaidAccount[0] = str_replace(" ", "", $ChargesPaidAccount[0]);

            $OrganizationSettlementAccount = $newAr[4];
            $OrganizationSettlementAccount = explode('|', $OrganizationSettlementAccount);
            $OrganizationSettlementAccount[0] = str_replace(" ", "", $OrganizationSettlementAccount[0]);
            
            # create the array
            $accountBalanceSave = array(
                'OrganizationSettlementAccount' => $OrganizationSettlementAccount[2],
                'ChargesPaidAccount' => $ChargesPaidAccount[2],
                'UtilityAccount' => $UtilityAccount[2],
                'WorkingAccount' => $WorkingAccount[2],
                'FloatAccount' => $FloatAccount[2],
                'BOCompletedTime' => $BOCompletedTime,
            );
            DB::table('accountbalance')->insert($accountBalanceSave);
         
    }

    public function json_do_decode(){
        $jdata = 
        '
        {
            "Result":{
               "ResultType":0,
               "ResultCode":0,
               "ResultDesc":"The service request is processed successfully.",
               "OriginatorConversationID":"84950-20304554-1",
               "ConversationID":"AG_20210414_00005be34002fc209700",
               "TransactionID":"PDE0000000",
               "ResultParameters":{
                  "ResultParameter":[
                     {
                        "Key":"DebitPartyName",
                        "Value":"254708374149 - John Doe"
                     },
                     {
                        "Key":"CreditPartyName",
                        "Value":"603021 - Safaricom3044"
                     },
                     {
                        "Key":"OriginatorConversationID",
                        "Value":"30928-20253143-1"
                     },
                     {
                        "Key":"InitiatedTime",
                        "Value":20210414173304
                     },
                     {
                        "Key":"CreditPartyCharges",
                        "Value":"Pay Utility Charge By Organization|KES|55.00"
                     },
                     {
                        "Key":"DebitAccountType",
                        "Value":"MMF Account For Customer"
                     },
                     {
                        "Key":"TransactionReason"
                     },
                     {
                        "Key":"ReasonType",
                        "Value":"Pay Bill Online"
                     },
                     {
                        "Key":"TransactionStatus",
                        "Value":"Completed"
                     },
                     {
                        "Key":"FinalisedTime",
                        "Value":20210414173306
                     },
                     {
                        "Key":"Amount",
                        "Value":5000.00
                     },
                     {
                        "Key":"ConversationID",
                        "Value":"AG_20210414_00007b4af4685369a799"
                     },
                     {
                        "Key":"ReceiptNo",
                        "Value":"PDE81HISMM"
                     }
                  ]
               },
               "ReferenceData":{
                  "ReferenceItem":{
                     "Key":"Occasion"
                  }
               }
            }
         }
        ';

            $content=json_decode($jdata, true);

            $nameArr = [];
            foreach ($content['Result']['ResultParameters']['ResultParameter'] as $row) {
                
                if(empty($row['Value'])){
                    continue;
                }
                $nameArr[$row['Key']] = $row['Value'];
            }
            DB::table('transaction_status')->insert($nameArr);
         
    }


    public function simulateMpesa(Request $request)
    {

        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'ShortCode' => 603021,
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => '5000',
            'Msisdn' => '254708374149',
            'BillRefNumber' => 'This is a reference'
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function checklast($AccID,$table,$curl_response){
        if($table == 'accountbalance'){
            $table == 'accountbalance';
            $TableData = DB::table('accountbalance')->orderBy('accountBalID', 'DESC')->first();
            // 
               $lastRecord =  $TableData->accountBalID;
               if($lastRecord == $AccID){
                sleep(5);
                return $this->checklast($lastRecord,$table,$curl_response);
               }else{
                   $newAccId = $AccID+1;
                   $NewBalance = DB::table('accountbalance')->where('accountBalID',$newAccId)->get();
                   foreach($NewBalance as $new){
                       return $new->WorkingAccount;
                   }
               }
            // 
        }elseif($table == 'lnmo_api_response'){
                $table = 'lnmo_api_response';
                $TableData = DB::table('lnmo_api_response')->where('CheckoutRequestID', $AccID)->where('status','1')->get();
                if($TableData->isEmpty()){
                    sleep(10);
                    return $this->checklast($AccID,$table,$curl_response);
                }else{
                    return $curl_response;
                }
        }else{
            return "Done";
        }
    }


    public function balanceAjaxResponseChecker(Request $request)
    {
        // ProcessTable
        $LastRecord = MpesaTransactionAccountBalance::orderBy('accountBalID','DESC')->first();
        $LastRecordSingle = $LastRecord->accountBalID;
        
        $InitiatorName =  'apiop37';
        $SecurityCredential =  'U2cjXH19jRJCxDKxp6JrNlCqEhtEjNDg7SFl29PQcBZUczt9B/dS75RbJb/u0/8ujGDXApaKuEdYTbJptCRNZhmzMaL9JEvJsimPSYg1yg5qxbmXmu8lJ5L2J7wOeEC7O9BYWc1A6kMEGVP0q8hjxDroMNCNzkfLdXjxkZ0Str45KXt4u35udqiBh/c9AZrcwGtccqO0KwuCC9bHsfZIbovUTPQSN4Z7SCU2K0g+Y1TIUM2P5bUXDNKPbuOy02CAhM1dpwaqbCivm+6dmTx97sdY6ZJgv3LABsEYQDG2Wxle48w3nvFIlbkHLKpEQVFbx138SXsL43dviDFZuFOS0A==';
        $CommandID =  'AccountBalance';
        $PartyA =  '603021';
        $Remarks =  'Remarks';
        $IdentifierType = '4';
        $QueueTimeOutURL =  'https://pipdotfx.com/api/v1/balance/callbacks';
        $ResultURL =  'https://pipdotfx.com/api/v1/balance/callbacks';
        // 
        $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'Initiator' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'IdentifierType' => $IdentifierType,
            'PartyA' => $PartyA,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        $tablename = 'accountbalance';
        return $this->checklast($LastRecordSingle,$tablename,$curl_response);
        // return $curl_response;
    }

    public function customerMpesaVerify(Request $request){
        $Transcode = $request->transcode;
        $GetData = DB::table('mobile_payments')->where('TransID',$Transcode)->where('status','0')->get();
        if($GetData->isEmpty()){
            return 'Fail';
        }else{
            $updateDetails = array(
               'status' => 1,
               'user_id' => $request->user_id,
            );
            DB::table('mobile_payments')->where('TransID',$Transcode)->update($updateDetails);
            return 'Success';
        }

    }
}
