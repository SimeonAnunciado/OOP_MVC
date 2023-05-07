<?php
namespace modules\contact\controllers;
class ContactController extends src\Controller{


    public function runBeforeAction(){

        // $this->resetContactedAlready(); // reset the session submitted

        if($_SESSION['has_submitted_the_form'] ?? 0 == 1){
            $data['title'] = 'You are already Contacted';
            $data['content'] = 'Thankyou Please wait the response after 2 Business Days';
            $this->layout->view('contact/views/static-page',$data);

            return false;
        }

        return true;
    }

    public function resetContactedAlready(){
        $_SESSION['has_submitted_the_form'] = 0;
    }


    public function defaultAction(){

        $data['title'] = 'Contact Page';
        $this->layout->view('contact/views/contact-page',$data);
    }

    public function submitContactFormAction(){
        $_SESSION['has_submitted_the_form'] = 1 ;
        $data['title'] = 'Thankyou';
        $data['content'] = 'For Contacting Us Please wait for 2 business days to to process your request';
        $this->layout->view('contact/views/static-page',$data);
    }

}
