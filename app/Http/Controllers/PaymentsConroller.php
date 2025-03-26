<?php

namespace App\Http\Controllers;

use App\MPESA;
use App\Models\orders;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ReplyMessage;
use App\Models\Payment;

class PaymentsConroller extends Controller
{

    /** 
    * Define env method similar to laravel's
    *
    * @param String $env_param | Environment Param Name
    * 
    * @return String | Actual Param
    */
    public static function env($env_param){

        $dotenv = new Dotenv();

        $url = url('/');

        $dotenv->load(''.$url.'/.env');

        $env = getenv($env_param);

        return $env; 
    }

    public function verify(Request $request)
    {
        $TransactionID = $request->TransactionID;
        $Invoice = $request->invoice;
        $OrderAmount = $request->amount;
        //Check Database
        $Check = DB::table('mobile_payments')->where('TransID', $TransactionID)->where('TransAmount', '>=', $request->amount)->where('status', '0')->get();
        if ($Check->isEmpty()) {
            //Process Database Results
            $results = 0;
            return $results;

        } else {
            // Insert Order
            $clientsMail = Auth::user()->email;
            $Clientname = DB::table('mobile_payments')->where('TransID', $TransactionID)->where('BillRefNumber', $Invoice)->where('TransAmount', '>=', $request->amount)->where('status','0')->get();
                foreach ($Clientname as $key => $value) {
                    // Create Order
                    $userID = Auth::user()->id;
                    $newStatus = 1;
                    Orders::createOrder();
                    $upadate_user_id = array(
                        'user_id' => $userID,
                        'status' => $newStatus,
                    );
                    DB::table('mobile_payments')->where('TransID', $TransactionID)->update($upadate_user_id);
                    // Email Client
                    ReplyMessage::mailclientt($clientsMail,$value->FirstName,$value->MSISDN);
                    //Clear Cart
                    Cart::destroy();
                    // Email Merchant
                    ReplyMessage::mailmerchant($clientsMail,$value->FirstName,$value->MSISDN);
                }

                $results = 1;
                return $results;
        }

    }

    // MPESA API
   

    public function Balance($AccID)
    {
        //return Redirect::to('https://amanivehiclesounds.co.ke/mpesa/accoutbalance.php');
       
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $CommandID = "AccountBalance";
        $Initiator = $Initiator = env("MPESA_INITIATOR");
        $SecurityCredential = env("MPESA_SECURITY_CREDENTIALS");
        $PartyA = env("MPESA_PARTYA");
        $IdentifierType = "4";
        $Remarks = "Balance";
        $QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';
        $ResultURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';

        $balanceInquiry = $mpesa->accountBalance($CommandID, $Initiator, $SecurityCredential, $PartyA, $IdentifierType, $Remarks, $QueueTimeOutURL, $ResultURL);
        $tablename = "accountbalance";
        return $this->checklast($AccID,$tablename);
       
    }

    public function checklast($AccID,$table){
        if($table == 'accountbalance'){
            $table == 'accountbalance';
            $TableData = DB::table('accountbalance')->orderBy('accountBalID', 'DESC')->first();
            // 
               $lastRecord =  $TableData->accountBalID;
               if($lastRecord == $AccID){
                return $this->checklast($lastRecord,$table);
               }else{
                   $newAccId = $AccID+1;
                   $NewBalance = DB::table('accountbalance')->where('accountBalID',$newAccId)->get();
                   foreach($NewBalance as $new){
                       return $new->WorkingAccount;
                   }

               }
            // 
        }else if($table == 'b2b_api_response'){
            $table == 'b2b_api_response';
            $TableData = DB::table('b2b_api_response')->orderBy('b2bTransactionID', 'DESC')->first();
            // 
               $lastRecord =  $TableData->b2bTransactionID;
               if($lastRecord == $AccID){
                   return $this->checklast($lastRecord,$table);
               }else{
                   $newAccId = $lastRecord+1;
                   $NewBalance = DB::table('b2b_api_response')->orderBy('b2bTransactionID', 'DESC')->first();
                   return "Transaction Completed Successfully";
                }
            // 

        }else if($table == 'b2c_api_response'){
            $table == 'b2c_api_response';
            $TableData = DB::table('b2c_api_response')->orderBy('b2bID', 'DESC')->first();
            // 
               $lastRecord =  $TableData->b2bID;
               if($lastRecord == $AccID){
                   return $this->checklast($lastRecord,$table);
               }else{
                   $NewBalance = DB::table('b2c_api_response')->orderBy('b2bID', 'DESC')->first();
                   return "Transaction Completed Successfully";
                }
            // 

        }else if($table == 'reverse_transaction'){
            $table == 'reverse_transaction';
            $TableData = DB::table('reverse_transaction')->orderBy('transactionstatusID', 'DESC')->first();
            // 
               $lastRecord =  $TableData->transactionstatusID;
               if($lastRecord == $AccID){
                   return $this->checklast($lastRecord,$table);
                   return "No records Yet";
               }else{
                   $NewBalance = DB::table('reverse_transaction')->orderBy('transactionstatusID', 'DESC')->first();
                   return "Transaction Completed Successfully";
                }
            // 

        }else if($table == 'transaction_status'){
            $table == 'transaction_status';
            $TableData = DB::table('transaction_status')->orderBy('transactionStatusID', 'DESC')->first();
            // 
                $lastRecord =  $TableData->transactionStatusID;
                if($lastRecord == $AccID){
                    return $this->checklast($lastRecord,$table);
                }else{
                    $NewBalance = DB::table('transaction_status')->orderBy('transactionStatusID', 'DESC')->first();
                    return "Transaction Completed Successfully";
                }
            // 
                
        }else{
            return "Error Processing Your Request";
        }
    }

    

    
    public function C2B(Request $request)
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $ShortCode = '600613';
        $CommandID = 'CustomerPayBillOnline';
        $Amount = '15000';
        $Msisdn = '254708374149';
        $BillRefNumber = 'AVS001';
       
        $b2bTransaction = $mpesa->c2b($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber);
    }

    public function reversal(Request $request)
    {
        $MPESA_INITIATOR = \Config::get('values.MPESA_INITIATOR');
        $MPESA_SECURITY_CREDENTIALS = \Config::get('values.MPESA_SECURITY_CREDENTIALS');
        $MPESA_PARTYA = \Config::get('values.MPESA_PARTYA');

     

        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $CommandID = "TransactionReversal";
        $Initiator = $MPESA_INITIATOR;
        $SecurityCredential = $MPESA_SECURITY_CREDENTIALS;
        $TransactionID = $request->TransactionID;
        $Amount = $request->Amount;
        $ReceiverParty = $request->PartyA;
        $RecieverIdentifierType = "11";
        $Remarks = "Reversal";
        $Occasion = $request->Remark;
        $ResultURL = 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php';
        $QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php';
    
        
        $reversal = $mpesa->reversal($CommandID, $Initiator, $SecurityCredential, $TransactionID, $Amount, $ReceiverParty, $RecieverIdentifierType, $ResultURL, $QueueTimeOutURL, $Remarks, $Occasion);
        
        $tablename = 'reverse_transaction';
        return $this->checklast($AccID,$tablename);
    } 


    public function TransactionStatus(Request $request,$AccID)
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $Initiator = env("MPESA_INITIATOR");
        $SecurityCredential = env("MPESA_SECURITY_CREDENTIALS");
        $CommandID = "TransactionStatusQuery";
        $TransactionID = $request->TransactionID;
        $PartyA = env("MPESA_PARTYA");
        $IdentifierType = "4";
        $Remarks = $request->Remarks;
        $Occasion = "AVS";
        $QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/transactionstatus_callback_url.php';
        $ResultURL = 'https://amanivehiclesounds.co.ke/payments/transactionstatus_callback_url.php';
        
        $trasactionStatus = $mpesa->transactionStatus($Initiator, $SecurityCredential, $CommandID, $TransactionID, $PartyA, $IdentifierType, $ResultURL, $QueueTimeOutURL, $Remarks, $Occasion);
        $tablename = 'transaction_status';
        return $this->checklast($AccID,$tablename);
    }

    public function B2C(Request $request,$AccID)
    {
        $MPESA_INITIATOR = \Config::get('values.MPESA_INITIATOR');
        $MPESA_SECURITY_CREDENTIALS = \Config::get('values.MPESA_SECURITY_CREDENTIALS');
        $MPESA_PARTYA = \Config::get('values.MPESA_PARTYA');
        
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        // Variables
        $InitiatorName = $MPESA_INITIATOR;
        $SecurityCredential = $MPESA_SECURITY_CREDENTIALS;
        $CommandID = "SalaryPayment";
        $PartyA = $MPESA_PARTYA;
        $Amount = $request->Amount;
        $PartyB = $request->PartyB;
        $Remarks = $request->Remarks;
        $Occasion = $request->Occasion;

        $QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/b2c_callback_url.php';
        $ResultURL = 'https://amanivehiclesounds.co.ke/payments/b2c_callback_url.php';

        $b2cTransaction = $mpesa->b2c($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion);
        $tablename = 'b2c_api_response';
        return $this->checklast($AccID,$tablename);
    }

    public function B2B(Request $request,$AccID)
    {
        $MPESA_INITIATOR = \Config::get('values.MPESA_INITIATOR');
        $MPESA_SECURITY_CREDENTIALS = \Config::get('values.MPESA_SECURITY_CREDENTIALS');
        $MPESA_PARTYB = \Config::get('values.MPESA_PARTYB');
        
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        // Variables
        $Initiator = $MPESA_INITIATOR;
        $SecurityCredential = $MPESA_SECURITY_CREDENTIALS;
        $commandID = "BusinessToBusinessTransfer";
        $PartyA = $MPESA_PARTYA;
        $Amount = $request->Amount;
        $PartyB = $MPESA_PARTYB;
        $AccountReference = $request->Remarks;
        $Remarks = $request->Remarks;
        $Occasion = $request->Occasion;
        $RecieverIdentifierType = '4';
        $SenderIdentifierType = '4';

        $QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/b2b_callback_url.php';
        $ResultURL = 'https://amanivehiclesounds.co.ke/payments/b2b_callback_url.php';

        $b2bTransaction = $mpesa->b2b($Initiator, $SecurityCredential, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $AccountReference, $commandID, $SenderIdentifierType, $RecieverIdentifierType);
        $tablename = 'b2b_api_response';
        return $this->checklast($AccID,$tablename);

    }

    public function stk(Request $request)
    {
        $Mobile = $request->phone;
        $InvoiceNumber = $request->Reff;
        $TransactionDescription = $request->desc;
        $TotalAmount = $request->Amount;
        // Values Env
        $MPESA_LIPA_ONLINE_SHORT_CODE = \Config::get('values.MPESA_LIPA_ONLINE_SHORT_CODE');


        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode = $MPESA_LIPA_ONLINE_SHORT_CODE;
        $TransactionType = 'CustomerPayBillOnline';
        $Timestamp = date('YmdHis');
        $CallBackURL = 'https://amanivehiclesounds.co.ke/payments/callback_url.php';
        //Party A and Phone Number
        $PartyA = $Mobile;
        $PhoneNumber = $Mobile;
        //Invoice Number
        $AccountReference = "$InvoiceNumber;";
        //Trasaction Description
        $TransactionDesc = "Amani vehicle Sounds";
        //Amount
        $Amount = $TotalAmount;
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $Password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $Timestamp);
        $PartyB = $BusinessShortCode;
        $Remarks = 'STK';
       
        $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        return $this->check($PhoneNumber); 

    }

    public function check($PhoneNumber)
    {
        $Check = DB::table('lnmo_api_response')->where('PhoneNumber', $PhoneNumber)->where('status','0')->get();
        $countChecks = count($Check);
        if ($countChecks > 0) {
            $res = 1;
            return $res;
        } else {
            return $this->check($PhoneNumber);
        }
    }

    public function getDetails($id){
        $data = Payment::where('TransID',$id)->first();
        echo json_encode($data);
        exit;
    }

}
