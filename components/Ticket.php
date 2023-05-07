<?php
namespace app\components;

//use app\models\PaymentVal;
use Yii;
use yii\base\component;
use yii\base\Exception;
use SoapClient;
use app\models\Details;

require_once(Yii::$app->basePath."/components/lib/nusoap.php");

class Ticket extends component
{
    
    public $merchandId; 
    
    public function init()
	{
		$info = Details::findOne(1);
		$this->merchandId = $info->merchand_id;
	}
	
    /*بررسی اعتبار کاربر*/
    public function UserVerify($userId)
	{
        $url = 'https://support.webeto.ir/api/check-validate';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($handle);
        curl_close($handle);
        
        return $result;
	}
	
	/*لیست کاربران مجاز ارسال تیکت*/
    public function SupportTeam($userId)
	{
        $url = 'https://support.webeto.ir/api/all-users';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*لیست تیکت های ارسالی*/
    public function MyTicket($userId)
	{
        $url = 'https://support.webeto.ir/api/all-ticket-customer';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*لیست گروه های ارسال تیکت*/
	public function TicketGroup($userId)
	{
	    $url = 'https://support.webeto.ir/api/all-ticket-group';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result; 
	}
	
    /*دریافت اطلاعات یک گروه تیکت*/  	
	public function GroupTicket($userId,$groupId)
	{
	    // die(var_dump($ticket_id));
	    $url = 'https://support.webeto.ir/api/get-group';
        $data = array(
            'group_id' => $groupId,
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*ارسال تیکت*/
	public function SendTicket($userId,$group_id,$title)
	{
	   // die(var_dump($title));
	    $url = 'https://support.webeto.ir/api/send-ticket';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
            'group_id'=>$group_id,
            'title'=>$title
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result; 
	}
	
	/*دریافت تیکت*/
	public function GetTicket($userId,$ticket_id)
	{
	   // die(var_dump($ticket_id));
	    $url = 'https://support.webeto.ir/api/get-ticket';
        $data = array(
            'ticket_id' => $ticket_id,
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
            // 'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*لیست ساب تیکت های یک تیکت*/
	public function SubTickets($userId,$ticket_id)
	{
	   // die($ticket_id);
	    $url = 'https://support.webeto.ir/api/sub-tickets';
        $data = array(
            'ticket_id' => $ticket_id,
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*ارسال تیکت متنی توسط مشتری*/
	public function SendText($userId,$ticket_id,$text)
	{
	    $url = 'https://support.webeto.ir/api/answer-ticket-text';
	   
        $data = array(
            'ticket_id' => $ticket_id,
            'description' => $text,
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*ارسال تصویر توسط مشتری*/
	public function SendImage($userId,$ticket_id,$path)
	{
	    $url = 'https://support.webeto.ir/api/answer-ticket-image';
	    
	    $data['mobile'] =  $userId;
	    $data['merchandId'] =  $this->merchandId;
	    $data['ticket_id'] =  $ticket_id;
	    $data['file'] =  curl_file_create($path);
      
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*ارسال فایل توسط مشتری */
	public function SendFile($userId,$ticket_id,$path)
	{
	    $url = 'https://support.webeto.ir/api/answer-ticket-file';
	   // die($userId);
	   // $data['mobile'] =  $userId;
	   // $data['merchandId'] =  $this->merchandId;
	   // $data['ticket_id'] =  $ticket_id;
	   // $data['file'] =  curl_file_create($path);
      
       $data = array(
            'ticket_id' => $ticket_id,
            'file' => curl_file_create($path),
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*اضافه کردن کاربر مجاز ارسال تیکت*/
    public function AddUser($userId,$username,$usermobile)
	{
	   // die($username);
        $url = 'https://support.webeto.ir/api/add-customer';
        $data = array(
            'mobile' => $userId,
            'userName' => $username,
            'userMobile' => $usermobile,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
	/*حذف کاربر از لیست کاربران مجاز ارسال تیکت*/
    public function DeleteCustomer($userId,$mobile)
	{
	   // die($username);
        $url = 'https://support.webeto.ir/api/delete-customer';
        $data = array(
            'mobile' => $mobile,
            'customer_mobile'=>$userId,
            'merchandId' => $this->merchandId
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}
	
    /*جستجوی تیکت با ساب میت فرم*/ 	
	public function SearchTicket($userId,$param)
	{
	    $url = 'https://support.webeto.ir/api/search-ticket';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
            'param'=>$param
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        return $result;
	}

    /*جستجوی لحظه ای تیکت*/ 
    public function Search($userId,$param)
    {
        $url = 'https://support.webeto.ir/api/search';
        $data = array(
            'mobile' => $userId,
            'merchandId' => $this->merchandId,
            'param'=>$param
        );
        
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        // return htmlentities($result, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
        return $result;

    }
    
    /*دریافت سه مقاله جدید از سایت وبتو*/ 
    public function GetPosts()
    {
        $url = 'https://webeto.co/api/get-posts';
       $data = array(
            'merchandId' => $this->merchandId,
        );
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        // return htmlentities($result, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
        return $result;

    }
    
    /*دریافت اخرین اطلاعیه ها از سایت وبتو*/ 
    public function GetMessage()
    {
        $url = 'https://webeto.co/api/get-message';
        $data = array(
            'merchandId' => $this->merchandId,
        );
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        // return htmlentities($result, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
        return $result;

    }
    
    /*دریافت تاریخ انقضا سایت*/ 
    public function GetExpireDate()
    {
        $url = 'https://webeto.co/api/get-date';
        $data = array(
            'merchandId' => $this->merchandId,
        );
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode (curl_exec($handle));
        curl_close($handle);
        // echo '<pre>';
        // return htmlentities($result, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
        return $result;
    }
    
    public function CheckExpire()
    {
        $info=Details::findOne(1);
        if(empty($info->update_time) || (time()>$info->update_time) )
        {
            $date=Yii::$app->Ticket->GetExpireDate();
            $now=time();
            $deff=intval($date->expire_date)-$now;
            if($deff>0)
            {
                $info->update_time=strval(intval($info->update_time)+86400);
                $info->save();
            }
            else
            {   
                return 1;
            }
        }
    }
	
	
}