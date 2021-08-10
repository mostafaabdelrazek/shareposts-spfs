
<?php 
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    
    public function register(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Post Form
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
            // Sanitize
         $data = [
             'name'                  => trim($_POST['name']),
             'email'                 => trim($_POST['email']),
             'password'              => trim($_POST['password']),
             'confirm_password'      => trim($_POST['confirm_password']),
             'name_err'              => '',
             'email_err'             => '',
             'password_err'          => '',
             'confirm_password_err'  => '', 
            ];
            
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter Email';
            }else if( $this->userModel->findUserByEmail($data['email']) ){  
                $data['email_err'] = 'Email already taken try to login';
            }
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'password at least must be 6 character';
            }
            
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm Password';
            }else{
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords not match';
                }
            }
            //Make sure Errors Empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) &&empty($data['confirm_password_err'])){
               //Validate

               //Hash Password
               $data['password'] = password_hash($data['password'] , PASSWORD_DEFAULT);
               // Register User
               if($this->userModel->register($data)){
                   flash('register_success' , 'You are registered and can login' );
                   redirect('users/login');
                }else{
                    die('something wrong try again');
                }
            }else{
                $this->view('users/register' , $data);
            }
            
            /*      
            foreach( $data as $key => $val ){
            // check for not an error field
                if($data[$key]){
                    $data["{$key}_err"] = "please enter {$key} ";
                }
           }
            */
     }else{
         //GEt Form
         $data = [
             'name' => '',
             'email' => '',
             'password' => '' ,
             'confirm_passowrd' => '',
             'name_err' => '' ,
             'email_err' => '',
             'password_err' => '',
             'confirm_password_err' => '', 
            ];

        $this->view('users/register' , $data);
        }    
    }

    public function login(){
     
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             //Post Form
             $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

             $data = [
                'email'                 => trim($_POST['email']),
                'password'              => trim($_POST['password']),
                'email_err'             => '',
                'password_err'          => '',
               ];
               
               if(empty($data['email'])){
                   $data['email_err'] = 'Please enter Email';
               } else if(!$this->userModel->findUserByEmail($data['email'])){
                   $data['email_err'] = 'Email not Found';
               }
              
               if(empty($data['password'])){
                   $data['password_err'] = 'Please enter password';
               }

               //Make sure Errors Empty
               if(empty($data['email_err']) && empty($data['password_err']) ){
                   //check and set logged in user
                   $loggedInUser = $this->userModel->login($data['email'] , $data['password']);
                   
                   if($loggedInUser){
                       //flash message
                       flash('logged_in' , "welcome $loggedInUser->name you'r now logged in");
                       //Create SESSION
                        $this->createUserSession($loggedInUser);
                   }else{
                       $data['password_err'] = 'Password incorrect';
                       $this->view('users/login' , $data);
                   }
               }else{
                   $this->view('users/login' , $data);
               }

        }else{
            //GEt Form
            $data = [
                'email' => '',
                'password' => '' ,
                'email_err' => '',
                'password_err' => '',
               ];
   
           $this->view('users/login' , $data);
           }    
       }



       //logout
       public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();
            redirect('users/login');
       }

       //Set user Session 
       protected function createUserSession($user){
           $_SESSION['user_id'] = $user->id;  
           $_SESSION['user_name'] = $user->name;  
           $_SESSION['user_email'] = $user->email;
           redirect('posts');  
       }

     


}