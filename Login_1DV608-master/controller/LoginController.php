<?php




class LoginController {
   

    	private $loginView;
        private $loginModel;


  		public function __construct(LoginView $loginView, model\Login $loginModel){
            $this->loginView = $loginView;
            $this->loginModel = $loginModel;
        }



        public function tryToLogin(){

            if ($this->loginView->userWantsToLogin() && !$this->loginModel->isLoggedIn()) {
                $userNameInput = $this->loginView->getUsername();
                $passwordNameInput = $this->loginView->getPassword();

                $this->loginModel->validateLogin($userNameInput, $passwordNameInput);
                $this->loginView->setMessage($this->loginModel->getMessage());

            }
            else if($this->loginView->userWantsToLogout() && $this->loginModel->isLoggedIn()){
                $this->loginModel->logout();
                $this->loginView->setMessage($this->loginModel->getMessage());

            }



	}

}