<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\Otp;
use \App\Models\SuperModel;
use \App\Models\FunctionModel;
use \App\Models\CartModel;
use Illuminate\Http\Request;
use Mail;
use Cart;
use Session;
class HomeController extends Controller
{
    /**
     * Checks if the user is accessing the website from a mobile device.
     *
     * @return array An array with code 200 and device "web" if the user is not on a mobile device,
     *               or code 201 and device "mobile" if the user is on a mobile device.
     */
    public function is_mobile(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $iPod = stripos($useragent, "iPod");
        $iPad = stripos($useragent, "iPad");
        $iPhone = stripos($useragent, "iPhone");
        $Android = stripos($useragent, "Android");
        $iOS = stripos($useragent, "iOS");
        //-- You can add billion devices

        $DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);

        if ($DEVICE !=true) {
            return  array('code' =>200 ,'device' =>'web' );
        }else{
            return  array('code' =>201 ,'device' =>'mobile' );
        }
    }
    /**
     * index function description.
     *
     * @return view
     */



    public function Index(){
        $model = new SuperModel();

        $data['type'] = $this->is_mobile();
        return view('index', $data);
    }


    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function About(){

        $data['nav'] = "about";
        $data['type'] = $this->is_mobile();
        return view('about', $data);
    }
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */


    public function Gallery(){

        $data['nav'] = "contact";
        $data['type'] = $this->is_mobile();
        return view('gallery', $data);
    }
    /**
     * Contact function for displaying the Contact Us page with makeup services information and navigation settings.
     *
     * @return view
     */
    public function Contact(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "contact";
        $data['type'] = $this->is_mobile();
        return view('contact', $data);
    }

    public function shippingpolicy(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('shipping-policy', $data);
    }
    public function privacypolicy(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('privacy-policy', $data);
    }
    public function refundpolicy(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('refund-policy', $data);
    }
    public function returnpolicy(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('return-policy', $data);
    }
    public function termsconditions(){

        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('terms-conditions', $data);
    }

    public function companypolicy(){
        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav'] = "policy";
        $data['type'] = $this->is_mobile();
        return view('company-policy', $data);
    }

    /**
     * A PHP function that sets up the data and returns the view for the "Thankyou" page.
     *
     * @return view The "Thankyou" page view with the specified data.
     */
    public function Thankyou(){
        $data['title'] = "Buy Earbuds, Headphones, Earphones at India’s No.1 Earwear Brand: Grooves Life Style ";
        $data['description'] = "Check out the breathtaking collection of Earbuds, Headphones, Earphones &amp; Wireless Speakers with contemporary designs and best features from India’s No.1 Earwear Audio Brand - Grooves Lifestyle.";
        $data['nav']='blog-detail';
        $data['type'] = $this->is_mobile();
        return view('thankyou',$data);
    }


    public function sendmail(Request $request)
    {

    }

    public function sendRegistermail($client){
        $model = new FunctionModel();
        $to_name = $client['first_name'].' '.$client['last_name'];
        $to_email = $client['email'];
        $data['client'] = $model->getData('tbl_client', array('id'=> $client['id']), 'first');
        $mail = Mail::send('mail.register-mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject(' Grooves Life Style || Register');
            $message->from('infiniarcinnovation@gmail.com',' Grooves Life Style || Registration');
        });

    }

    public function sendConfirmOrder($order_id) {
        $model = new SuperModel();
        $data['order'] = $model->orders(array('tbl_order.order_id' => $order_id), 'first');
        $data['profile'] = $model->getData('tbl_client', array('id' => $data['order']->client_id), 'first');
        $to_name = $data['profile']->first_name.' '.$data['profile']->last_name;
        $to_email = $data['profile']->email;
        Mail::send('mail.confirm_order', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Thank You for Your Order with  Grooves Life Style!');
            $message->from('infiniarcinnovation@gmail.com', ' Grooves Life Style ||  Confirm Order');
        });
        return array('code' => 200, 'message' => 'Email sent successfully!', 'order_id' => $order_id);
    }




}
