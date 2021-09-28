<?php
    // =================================================================== 
    // carregar classes
        namespace core\controllers;

        use core\classes\Database;
        use core\classes\SendEmail;
        use core\classes\Store;
        use core\classes\PDF;
        use core\models\Customers;
        use core\models\products;
        use core\models\Orders;
        use core\controllers\Cart;
    // =================================================================== 

    // =================================================================== 
    // Classe Main
        class Main
        {
            // ===========================================================
            // index
                public function index()
                {
                    // ===========================================================
                    // apresenta a página da store

                    // ===========================================================
                    // buscar a lista de products disponíveis
                        $products = new products();
                    // ===========================================================                

                    // ===========================================================
                    // analisa que category mostrar
                        $c = 'todos';

                        if(isset($_GET['c']))
                        {
                            $c = $_GET['c'];
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // buscar informação à base de data
                        $products_list = $products->products_list_available($c);
                        $category_list = $products->category_list();
                    // ===========================================================                
                    
                    // ===========================================================
                    // Array data
                        $data = 
                        [
                            'products' => $products_list,
                            'categorys' => $category_list
                        ];
                    // ===========================================================                

                    // ===========================================================
                    // Layout
                        Store::Layout
                        (
                            [
                                'layouts/html_header',
                                'layouts/header',
                                'store',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], 

                            $data

                        );
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // store
                public function store()
                {
                    // ===========================================================
                    // apresenta a página da store

                    // ===========================================================
                    // buscar a lista de products disponíveis
                        $products = new products();
                    // ===========================================================                

                    // ===========================================================
                    // analisa que category mostrar
                        $c = 'todos';

                        if(isset($_GET['c']))
                        {
                            $c = $_GET['c'];
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // buscar informação à base de data
                        $products_list = $products->products_list_available($c);
                        $category_list = $products->category_list();
                    // ===========================================================                
                    
                    // ===========================================================
                    // Array data
                        $data = 
                        [
                            'products' => $products_list,
                            'categorys' => $category_list
                        ];
                    // ===========================================================                

                    // ===========================================================
                    // Layout
                        Store::Layout
                        (
                            [
                                'layouts/html_header',
                                'layouts/header',
                                'store',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], 

                            $data

                        );
                    // ===========================================================
                }
            // ===========================================================  

            // ===========================================================
            // profile
                public function profile_modal()
                {   
                    // ===========================================================
                    // verifica se existe um utilizador logado
                        if(!Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================    

                    // ===========================================================
                    // buscar informações do customer
                        $customer = new Customers();
                        $dtemp = $customer->search_data_customer($_SESSION['customer']);
                    
                        $data_customer = 
                        [
                            'Email' => $dtemp->email,
                            'Full Name' => $dtemp->full_name,
                            'address' => $dtemp->address,
                            'city' => $dtemp->city,
                            'telephone' => $dtemp->telephone
                        ];
                    // ===========================================================

                    // ===========================================================  
                    // Construir msg modal  
                        $msg='';

                        $msg.='<p class="text-center"><a onclick="apresentaModalHistorico()"  class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal">
                        <i class="far fa-list-alt"></i> Histórico de orders</a></p>
                        <table class="table table-striped">';                                   
                            foreach($data_customer as $key=>$value):
                                $msg.='<tr>
                                    <td class="text-end" width="40%">'.$key.':</td>
                                    <td width="60%"><strong>'.$value .'</strong></td>
                                </tr>';
                            endforeach;
                        $msg.='</table>';
                    // ===========================================================
                    
                    // ===========================================================
                    // Mostrar msg modal 
                        echo json_encode($msg);
                    // ===========================================================
                }
            // ===========================================================   
            
            // ===========================================================
            // login
                public function login()
                {
                    // ===========================================================
                    // verifica se já existe um utilizador logado
                        if (Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // apresentação do formulário de login
                        Store::Layout([
                            'layouts/html_header',
                            'layouts/header',
                            'login_form',
                            'layouts/footer',
                            'layouts/html_footer',
                        ]);
                    // ===========================================================    
                }
            // ===========================================================   
            
            // ===========================================================
            //  login submit
                public function login_submit()
                {
                    // ===========================================================
                    // verifica se já existe um utilizador logado
                        if (Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // verifica se foi efetuado o post do formulário de login
                        if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // validar se os campos vieram corretamente preenchidos
                        if (
                            !isset($_POST['text_user']) ||
                            !isset($_POST['text_pass']) ||
                            !filter_var(trim($_POST['text_user']), FILTER_VALIDATE_EMAIL)
                        ) 
                        {
                            // ===========================================================
                            // erro de preenchimento do formulário
                                $_SESSION['erro'] = 'Login inválido';
                                Store::redirect('login');
                                return;
                            // ===========================================================
                        }
                    // ===========================================================                

                    // ===========================================================
                    // prepara os data para o model
                        $user = trim(strtolower($_POST['text_user']));
                        $pass = trim($_POST['text_pass']);
                    // ===========================================================

                    $array = [ $user, $pass  ]; 

                    //Store::printData($array);
                    
                    // ===========================================================
                    // carrega o model e verifica se login é válido
                        $customer = new Customers(); 
                        $resultado = $customer->validate_login($user, $pass); 
                    // ===========================================================

                    //Store::printData($resultado);

                    // ===========================================================
                    // analisa o resultado
                        if(is_bool($resultado))
                        {   
                            echo json_decode('Login inválido');
                            // ===========================================================
                            // login inválido / redirecciona para a pagina login
                                // $_SESSION['erro'] = 'Login inválido';
                                // Store::redirect('login');
                                // return;
                            // ===========================================================
                        } 
                        else 
                        {   
                            // ===========================================================
                            // login válido. Coloca os data na sessão
                                $_SESSION['customer'] = $resultado->id_customer;
                                $_SESSION['user'] = $resultado->email;
                                $_SESSION['nome_customer'] = $resultado->full_name;
                            // ===========================================================  
                            
                            Store::redirect('store');

                            // ===========================================================
                            // redirecionar para o local correto
                                if(isset($_SESSION['tmp_cart']))
                                {
                                    // ===========================================================
                                    // remove a variável temporária da sessão
                                        unset($_SESSION['tmp_cart']);
                                    // =========================================================== 


                                //Cart::finalize_order_summary_modal();

                                    // ===========================================================
                                    // redireciona para resumo da order
                                        //Store::redirect('finalize_order_summary_modal');
                                        Store::redirect('store');
                                    // ===========================================================
                                } 
                                else 
                                {
                                    // ===========================================================
                                    // redirectionamento para a store
                                    Store::redirect('store');
                                    // ===========================================================                                
                                }
                            // ===========================================================                        
                        }
                    // ===========================================================
                }
            // ===========================================================     
            
            // ===========================================================
            // logout
                public function logout()
                {   
                    // ===========================================================
                    // remove as variáveis da sessão
                        unset($_SESSION['customer']);
                        unset($_SESSION['user']);
                        unset($_SESSION['nome_customer']);
                    // ===========================================================

                    // ===========================================================
                    // redireciona para o início da store
                        //Store::redirect('store');
                    // ===========================================================
                }
            // ===========================================================             
        }
    // =================================================================== 





?>


<!-- // =================================================================== 
    // Classe Main
        class Main
        {
            // ===========================================================
            // index
                public function index()
                {
                    // ===========================================================
                    // apresenta a página da store

                    // ===========================================================
                    // buscar a lista de products disponíveis
                        $products = new products();
                    // ===========================================================                

                    // ===========================================================
                    // analisa que category mostrar
                        $c = 'todos';

                        if(isset($_GET['c']))
                        {
                            $c = $_GET['c'];
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // buscar informação à base de data
                        $products_list = $products->products_list_available($c);
                        $category_list = $products->category_list();
                    // ===========================================================                
                    
                    // ===========================================================
                    // Array data
                        $data = 
                        [
                            'products' => $products_list,
                            'categorys' => $category_list
                        ];
                    // ===========================================================                

                    // ===========================================================
                    // Layout
                        Store::Layout
                        (
                            [
                                'layouts/html_header',
                                'layouts/header',
                                'store',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], 

                            $data

                        );
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // index
                // public function index()
                // {
                //     //Store::printData($_SESSION);

                //     // ===========================================================
                //     // Layout
                //         // // Store::Layout
                //         // // (
                //         // //     [
                //         // //         'layouts/html_header',  // [0]
                //         // //         'layouts/header',       // [1]
                //         // //         'home_page',               // [2]
                //         // //         'layouts/footer',       // [3]
                //         // //         'layouts/html_footer',  // [4]
                //         // //     ]
                //         // // );
                //     // ===========================================================
                // }
            // ===========================================================            

            // ===========================================================
            // store
                public function store()
                {
                    // ===========================================================
                    // apresenta a página da store

                    // ===========================================================
                    // buscar a lista de products disponíveis
                        $products = new products();
                    // ===========================================================                

                    // ===========================================================
                    // analisa que category mostrar
                        $c = 'todos';

                        if(isset($_GET['c']))
                        {
                            $c = $_GET['c'];
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // buscar informação à base de data
                        $products_list = $products->products_list_available($c);
                        $category_list = $products->category_list();
                    // ===========================================================                
                    
                    // ===========================================================
                    // Array data
                        $data = 
                        [
                            'products' => $products_list,
                            'categorys' => $category_list
                        ];
                    // ===========================================================                

                    // ===========================================================
                    // Layout
                        Store::Layout
                        (
                            [
                                'layouts/html_header',
                                'layouts/header',
                                'store',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], 

                            $data

                        );
                    // ===========================================================
                }
            // ===========================================================        

            // ===========================================================
            // novo customer / new customer   
                public function new_customer()
                {
                    // ===========================================================
                    // verifica se já existe sessão aberta
                        if (Store::is_customer_logged_in()) {
                            $this->index();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // apresenta o layout para criar um novo utilizador
                           Store::Layout([
                            'layouts/html_header',
                            'layouts/header',
                            'create_customer',
                            'layouts/footer',
                            'layouts/html_footer',
                        ]); 
                    // ===========================================================    
                }
            // ===========================================================        

            // ===========================================================
            // criar customer / create customer   
                public function create_customer()
                {   
                    // ===========================================================
                    // verifica se já existe session
                        if (Store::is_customer_logged_in()) 
                        {
                            $this->index();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // verifica se houve submissão de um formulário
                        if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                        {
                            $this->index();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // verifica se pass 1 = pass 2
                        if ($_POST['text_pass_1'] !== $_POST['text_pass_2']) 
                        {
                            // as passwords são diferentes
                            $_SESSION['erro'] = 'As passs não estão iguais.';
                            $this->new_customer();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // verifica na base de data se existe customer com mesmo email
                        $customer = new Customers();

                        if ($customer->check_email_exists($_POST['text_email'])) 
                        {
                            $_SESSION['erro'] = 'Já existe um customer com o mesmo email.';
                            $this->new_customer();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // inserir novo customer na base de data e devolver o purl
                        $email_customer = strtolower(trim($_POST['text_email']));
                        $purl = $customer->register_customer();
                    // ===========================================================                
                    
                    // ===========================================================
                    // envio do email para o customer
                        $email = new SendEmail();
                        $resultado = $email->send_email_confirmation_new_customer($email_customer, $purl);

                        if ($resultado) 
                        {
                            // apresenta o layout para informar o envio do email
                            Store::Layout([
                                'layouts/html_header',
                                'layouts/header',
                                'create_customer_success',
                                'layouts/footer',
                                'layouts/html_footer',
                            ]);

                          /*  Store::redirect();
                            return;*/

                        } 
                        else 
                        {
                            echo 'Aconteceu um erro';
                        }
                    // ===========================================================                
                }
            // ===========================================================        

            // ===========================================================
            // confirmar email / Confirm Email   
                public function confirm_email()
                {   
                    // ===========================================================
                    // verifica se já existe session
                        if (Store::is_customer_logged_in()) 
                        {
                            $this->index();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // verificar se existe na query string um purl
                        if (!isset($_GET['purl'])) 
                        {
                            $this->index();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // verifica se o purl é válido
                        $purl = $_GET['purl'];
                        if (strlen($purl) != 12) 
                        {
                            $this->index();
                            return;
                        }
                    // ===========================================================                
                    
                    // ===========================================================
                    // validar email
                        $customer = new Customers();
                        $resultado = $customer->validate_email($purl);

                        if ($resultado) 
                        {
                            // ===========================================================
                            // apresenta o layout para informar a conta foi confirmada com sucesso
                                Store::Layout([
                                        'layouts/html_header',
                                        'layouts/header',
                                        'account_confirmed_success',
                                        'layouts/footer',
                                        'layouts/html_footer',
                                    ]
                                );
                            // =========================================================== 

                            return;
                        } 
                        else 
                        {
                            // ===========================================================
                            // redirecionar para a página inicial
                                Store::redirect();
                            // ===========================================================
                        }
                    // ===========================================================    
                }
            // ===========================================================        

            // ===========================================================
            // login
                public function login()
                {
                    // ===========================================================
                    // verifica se já existe um utilizador logado
                        if (Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // apresentação do formulário de login
                        Store::Layout([
                            'layouts/html_header',
                            'layouts/header',
                            'login_form',
                            'layouts/footer',
                            'layouts/html_footer',
                        ]);
                    // ===========================================================    
                }
            // ===========================================================        

            // ===========================================================
            //  login submit
                public function login_submit()
                {
                    // ===========================================================
                    // verifica se já existe um utilizador logado
                        if (Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // verifica se foi efetuado o post do formulário de login
                        if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // validar se os campos vieram corretamente preenchidos
                        if (
                            !isset($_POST['text_user']) ||
                            !isset($_POST['text_pass']) ||
                            !filter_var(trim($_POST['text_user']), FILTER_VALIDATE_EMAIL)
                        ) 
                        {
                            // ===========================================================
                            // erro de preenchimento do formulário
                                $_SESSION['erro'] = 'Login inválido';
                                Store::redirect('login');
                                return;
                            // ===========================================================
                        }
                    // ===========================================================                

                    // ===========================================================
                    // prepara os data para o model
                        $user = trim(strtolower($_POST['text_user']));
                        $pass = trim($_POST['text_pass']);
                    // ===========================================================

                    $array = [ $user, $pass  ]; 

                    //Store::printData($array);
                    
                    // ===========================================================
                    // carrega o model e verifica se login é válido
                        $customer = new Customers(); 
                        $resultado = $customer->validate_login($user, $pass); 
                    // ===========================================================

                    //Store::printData($resultado);

                    // ===========================================================
                    // analisa o resultado
                        if(is_bool($resultado))
                        {   
                            echo json_decode('Login inválido');
                            // ===========================================================
                            // login inválido / redirecciona para a pagina login
                                // $_SESSION['erro'] = 'Login inválido';
                                // Store::redirect('login');
                                // return;
                            // ===========================================================
                        } 
                        else 
                        {   
                            // ===========================================================
                            // login válido. Coloca os data na sessão
                                $_SESSION['customer'] = $resultado->id_customer;
                                $_SESSION['user'] = $resultado->email;
                                $_SESSION['nome_customer'] = $resultado->full_name;
                            // ===========================================================  
                            
                            Store::redirect('store');

                            // ===========================================================
                            // redirecionar para o local correto
                                if(isset($_SESSION['tmp_cart']))
                                {
                                    // ===========================================================
                                    // remove a variável temporária da sessão
                                        unset($_SESSION['tmp_cart']);
                                    // =========================================================== 


                                   //Cart::finalize_order_summary_modal();

                                    // ===========================================================
                                    // redireciona para resumo da order
                                        //Store::redirect('finalize_order_summary_modal');
                                        Store::redirect('store');
                                    // ===========================================================
                                } 
                                else 
                                {
                                    // ===========================================================
                                    // redirectionamento para a store
                                    Store::redirect('store');
                                    // ===========================================================                                
                                }
                            // ===========================================================                        
                        }
                    // ===========================================================
                }
            // ===========================================================        

            // ===========================================================
            // logout
                public function logout()
                {   
                    // ===========================================================
                    // remove as variáveis da sessão
                        unset($_SESSION['customer']);
                        unset($_SESSION['user']);
                        unset($_SESSION['nome_customer']);
                    // ===========================================================

                    // ===========================================================
                    // redireciona para o início da store
                        Store::redirect();
                    // ===========================================================
                }
            // ===========================================================  
            
            // ===========================================================
            // profile DO USER / USER PROFILE
                // ===========================================================
                // profile
                    public function profile()
                    {   
                    // ===========================================================
                    // verifica se existe um utilizador logado
                        if(!Store::is_customer_logged_in()) 
                        {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================    

                    // ===========================================================
                    // buscar informações do customer
                        $customer = new Customers();
                        $dtemp = $customer->search_data_customer($_SESSION['customer']);
                    
                        $data_customer = 
                        [
                            'Email' => $dtemp->email,
                            'Full Name' => $dtemp->full_name,
                            'address' => $dtemp->address,
                            'city' => $dtemp->city,
                            'telephone' => $dtemp->telephone
                        ];

                        $data = 
                        [
                            'data_customer' => $data_customer
                        ];
                    // ===========================================================
                    
                    // ===========================================================
                    // apresentação da página de profile
                        Store::Layout(
                        [
                            'layouts/html_header',
                            'layouts/header',
                            'navigation_profile',
                            'profile',
                            'layouts/footer',
                            'layouts/html_footer',
                        ], $data);
                    // ===========================================================
                    }
                // ===========================================================      
                
                // ===========================================================
                // profile
                    public function profile_modal()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) 
                            {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================    

                        // ===========================================================
                        // buscar informações do customer
                            $customer = new Customers();
                            $dtemp = $customer->search_data_customer($_SESSION['customer']);
                        
                            $data_customer = 
                            [
                                'Email' => $dtemp->email,
                                'Full Name' => $dtemp->full_name,
                                'address' => $dtemp->address,
                                'city' => $dtemp->city,
                                'telephone' => $dtemp->telephone
                            ];
                        // ===========================================================

                        // ===========================================================  
                        // Construir msg modal  
                            $msg='';

                            $msg.='<p class="text-center"><a onclick="apresentaModalHistorico()"  class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal">
                            <i class="far fa-list-alt"></i> Histórico de orders</a></p>
                            <table class="table table-striped">';                                   
                                foreach($data_customer as $key=>$value):
                                    $msg.='<tr>
                                        <td class="text-end" width="40%">'.$key.':</td>
                                        <td width="60%"><strong>'.$value .'</strong></td>
                                    </tr>';
                                endforeach;
                            $msg.='</table>';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================
                    }
                // ===========================================================                 

                // ===========================================================
                // alterar data pessoais / change personal data
                    public function change_personal_data()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais
                            $customer = new Customers();
                            $data = [
                                'data_personal' => $customer->search_data_customer($_SESSION['customer'])
                            ];
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::Layout([
                                'layouts/html_header',
                                'layouts/header',
                                'navigation_profile',
                                'change_personal_data',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], $data);
                        // ===========================================================                
                    }
                // ===========================================================  
                
                // ===========================================================
                // alterar data pessoais submit / change personal data submit
                    public function change_personal_data_submit()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // verifica se existiu submissão de formulário
                            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar data
                            $email = trim(strtolower($_POST['text_email']));
                            $full_name = trim($_POST['text_full_name']);
                            $address = trim($_POST['text_address']);
                            $city = trim($_POST['text_city']);
                            $telephone = trim($_POST['text_telephone']);
                        // ===========================================================

                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $_SESSION['erro'] = "Endereço de email inválido.";
                                $this->change_personal_data();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar os restantes campos
                            if(empty($full_name) || empty($address) || empty($city)){
                                $_SESSION['erro'] = "Preencha corretamente o formulário.";
                                $this->change_personal_data();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar se este email já existe noutra conta de customer
                            $customer = new Customers(); // Carregar model
                            $existe_noutra_conta = $customer->check_if_email_exists_in_another_account($_SESSION['customer'], $email);
                            if($existe_noutra_conta){
                                $_SESSION['erro'] = "O email já pertence a outro customer.";
                                $this->change_personal_data();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // atualizar os data do customer na base de data
                            $customer->update_data_customer($email, $full_name, $address, $city, $telephone);
                        // ===========================================================

                        // ===========================================================
                        // atualizar os data do customer na session
                            $_SESSION['user'] = $email;
                            $_SESSION['nome_customer'] = $full_name; 
                        // ===========================================================

                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('profile');
                        // ===========================================================
                    }
                // ===========================================================                 
                
                // ===================================================================
                // alterar data pessoais modal / change personal data modal
                    public function change_personal_data_modal()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais
                            $customer = new Customers();
                            $data = $customer->search_data_customer($_SESSION['customer']);
                        // ===========================================================

                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            $msg .='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">
                                        <div id="msg_dados">
                                                    
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" maxlength="50" id="text_email" name="text_email" class="form-control" required value="'. $data->email .'">
                                        </div>

                                        <div class="form-group">
                                            <label>Full Name:</label>
                                            <input type="text" maxlength="50" id="text_full_name" name="text_full_name" class="form-control" required value="'. $data->full_name .'">
                                        </div>

                                        <div class="form-group">
                                            <label>address:</label>
                                            <input type="text" maxlength="100" id="text_address" name="text_address" class="form-control" required value="'. $data->address .'">
                                        </div>

                                        <div class="form-group">
                                            <label>city:</label>
                                            <input type="text" maxlength="50" id="text_city" name="text_city" class="form-control" required value="'. $data->city .'">
                                        </div>

                                        <div class="form-group">
                                            <label>telephone:</label>
                                            <input type="text" maxlength="20" id="text_telephone" name="text_telephone" class="form-control" value="'. $data->telephone .'">
                                        </div>

                                    </div>';

                                $msg.='<div class="modal-footer">
                                            <a href="?a=profile" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal">Cancelar</a>
                                            <button  onclick="change_personal_data_submit_modal()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                Salvar
                                            </button>
                                       </div>';

                            echo json_encode($msg);
                        // ===========================================================            
                    }
                // ===================================================================                 

                // ===================================================================
                // alterar data pessoais submit modal / change personal data submit modal
                    public function change_personal_data_submit_modal()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar data
                            $email = trim(strtolower($_POST['text_email']));
                            $full_name = trim($_POST['text_full_name']);
                            $address = trim($_POST['text_address']);
                            $city = trim($_POST['text_city']);
                            $telephone = trim($_POST['text_telephone']);
                        // ===========================================================

                        // ===========================================================
                        // Carregar model
                            $customer = new Customers(); 
                            $existe_noutra_conta = $customer->check_if_email_exists_in_another_account($_SESSION['customer'], $email);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                // // $_SESSION['erro'] = "Endereço de email inválido.";
                                // // $this->change_personal_data();
                                // // return;

                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>Endereço de email inválido.</p>
                                    </div>';
                                    
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar os restantes campos
                            else if(empty($full_name) || empty($address) || empty($city))
                            {
                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>Preencha corretamente o formulário.</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================                                
                            }
                        // ===========================================================

                        // ===========================================================
                        // validar se este email já existe noutra conta de customer
                             else if($existe_noutra_conta)
                             {
                                // ===================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>O email já pertence a outro customer.</p>
                                    </div>';
                                // ===================================================

                                // ===================================================
                                // Mostrar msg modal
                                    echo json_encode($msg);
                                    return;
                                // ===================================================                                   
                             }
                        // ===========================================================
                             else
                             {
                                // // ===========================================================
                                // // atualizar os data do customer na base de data
                                        $customer->update_data_customer($email, $full_name, $address, $city, $telephone);
                                // // ===========================================================

                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
        
                                    $msg .='
                                    <div class="alert alert-success text-center p-2">
                                    <p>Dados actualizados com sucesso!</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal                                  
                                    echo json_encode($msg);
                                // ===========================================================
                             }

                        // // ===========================================================
                        // // atualizar os data do customer na session
                        //     $_SESSION['user'] = $email;
                        //     $_SESSION['nome_customer'] = $full_name; 
                        // // ===========================================================

                        // // ===========================================================
                        // // redirecionar para a página do profile
                        //     Store::redirect('profile');
                        // // ===========================================================
                    }
                // ===================================================================                

                // ===========================================================
                // alterar password / change password
                    public function change_password()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            } 
                        // ===========================================================       
                        
                        // ===========================================================
                        // apresentação da página de alteração da password
                            Store::Layout([
                                'layouts/html_header',
                                'layouts/header',
                                'navigation_profile',
                                'change_password',
                                'layouts/footer',
                                'layouts/html_footer',
                            ]);
                        // ===========================================================
                    }
                // ===========================================================     
                
                // ===========================================================
                // change password submit
                    public function change_password_submit()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // verifica se existiu submissão de formulário
                            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // validar data
                            $pass_atual = trim($_POST['text_pass_atual']);
                            $nova_pass = trim($_POST['text_nova_pass']);
                            $repetir_nova_pass = trim($_POST['text_repetir_nova_pass']);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se a nova pass vem com data
                            if(strlen($nova_pass) < 6){
                                $_SESSION['erro'] = "Indique a nova pass e a repetição da nova pass.";
                                $this->change_password();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a nova pass a a sua repetição coincidem
                            if($nova_pass != $repetir_nova_pass){
                                $_SESSION['erro'] = "A nova pass e a sua repetição não são iguais.";
                                $this->change_password();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a pass atual está correta
                            $customer = new Customers(); // carregar model
                            if(!$customer->check_if_password_is_correct($_SESSION['customer'], $pass_atual)){
                                $_SESSION['erro'] = "A pass atual está errada.";
                                $this->change_password();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // verificar se a nova pass é diferente da pass atual
                            if($pass_atual == $nova_pass){
                                $_SESSION['erro'] = "A nova pass é igual à pass atual.";
                                $this->change_password();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // atualizar a nova pass
                            $customer->update_new_password($_SESSION['customer'], $nova_pass);
                        // ===========================================================
                        
                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('profile');
                        // ===========================================================
                    }
                // ===========================================================  

                // ===========================================================
                // alterar password modal / change password modal
                    public function change_password_modal()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) 
                            {
                                Store::redirect();
                                return;
                            } 
                        // ===========================================================   
                        
                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            $msg .='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">

                                        <div class="form-group">
                                            <label>pass atual:</label>
                                            <input type="password" maxlength="30" id="text_pass_atual" name="text_pass_atual" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nova pass:</label>
                                            <input type="password" maxlength="30" id="text_nova_pass" name="text_nova_pass" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Repetir nova pass:</label>
                                            <input type="password" maxlength="30"  id="text_repetir_nova_pass" name="text_repetir_nova_pass" class="form-control" required>
                                        </div>

                                        <div id="msg">
                                        
                                        </div>

                                    </div>';

                                $msg.='<div class="modal-footer">
                                <a class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal" >Cancelar</a>
                                <button onclick="change_password_submit_modal()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                Save
                                </button>
                                </div>';

                            echo json_encode($msg);
                        // ===========================================================
                    }
                // =========================================================== 
                
                // ===========================================================
                // change password submit_modal
                    public function change_password_submit_modal()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ==========================================================
                        
                        // ===========================================================
                        // validar data
                            $pass_atual = trim(json_decode($_POST['text_pass_atual']));
                            $nova_pass = trim(json_decode($_POST['text_nova_pass']));
                            $repetir_nova_pass = trim(json_decode($_POST['text_repetir_nova_pass']));
                        // ===========================================================
                        
                        // ===========================================================
                        // carregar model
                            $customer = new Customers(); 
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se a nova pass vem com data
                            if(strlen($nova_pass) < 6)
                            {
                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>A nova pass tem de ter mais de 5 caracteres.</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a nova pass a a sua repetição coincidem
                           else if($nova_pass != $repetir_nova_pass)
                           {
                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg .= '<div class="alert alert-danger text-center p-2">
                                    <p>A nova pass e a sua repetição não são iguais.</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal                                 
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================
                           }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a pass atual está correta
                            else if(!$customer->check_if_password_is_correct($_SESSION['customer'], $pass_atual))
                            {
                                // ===========================================================
                                // Construir msg modal                                 
                                    $msg = '';
                                    $msg .= '<div class="alert alert-danger text-center p-2">
                                    <p>A pass atual está errada.</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal 
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // verificar se a nova pass é diferente da pass atual
                            else if($pass_atual == $nova_pass)
                            {
                                // ===========================================================
                                // Construir msg modal                                 
                                    $msg = '';
                                    $msg .='
                                    <div class="alert alert-danger text-center p-2">
                                    <p>A nova pass é igual à pass atual.</p>
                                    </div>';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal                                  
                                    echo json_encode($msg);
                                    return;
                                // ===========================================================
                                
                            }
                        // ===========================================================

                        // ===================================================================
                        // Senão                       
                            else
                            {
                                // ===========================================================
                                // atualizar a nova pass
                                    $customer->update_new_password($_SESSION['customer'], $nova_pass);
                                // ===========================================================
                                
                                // ===========================================================
                                // Construir msg modal                                
                                    $msg = '';
    
                                    $msg .='
                                    <div class="alert alert-success text-center p-2">
                                    <p>Palavra pass actualizada com sucesso!</p>
                                    </div>';
                                // ===========================================================
    
                                // ===========================================================
                                // Mostrar msg modal                                  
                                    echo json_encode($msg);
                                // ===========================================================
                            }
                        // ===================================================================
                    }
                // ===========================================================                 

                // ===========================================================
                // historico orders / order history
                    public function order_history()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // carrega o histórico das orders
                            $orders = new Orders();
                            $order_history = $orders->search_order_history($_SESSION['customer']);
                        
                            $data = [
                                'order_history' => $order_history
                            ];
                        // ===========================================================
                        
                        // ===========================================================
                        // apresentar a view com o histórico das orders
                            Store::Layout([
                                'layouts/html_header',
                                'layouts/header',
                                'navigation_profile',
                                'order_history',
                                'layouts/footer',
                                'layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================   

                // ===========================================================
                // historico orders modal / order history modal
                    public function order_history_modal()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_customer_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // carrega o histórico das orders
                            $orders = new Orders();
                            $order_history = $orders->search_order_history($_SESSION['customer']);
                        // ===========================================================

                        //Store::printData($order_history);
          
                            //$order_history = 0;
                            
                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            if (count($order_history) == 0) : 

                            $msg .='<div class="modal-header">
                                        <h5 class="text-center">Histórico de Encomendas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">
                                        <p class="text-center">Não existem orders registadas.</p>  
                                    </div>';

                            // $msg.='<div class="modal-footer">
                            //                 modal-footer-history
                            //         </div>';
                            else:
                                $msg .='<div class="modal-header">
                                <h5 class="text-center">Histórico de Encomendas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                            
                                $msg .='<div class="modal-body">';

                                $msg .='<table class="table table-striped" id="order">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Data da Encomenda</th>
                                        <th>Código order</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead><tbody>';

                                

                                 foreach ($order_history as $order) : 
                                    $msg .='
                                    <tr>
                                        <td>'.$order->order_date.'</td>
                                        <td>'. $order->order_code.'</td>
                                        <td>'. $order->status .'</td>';
                                    
                                    // //    $id = Store::aes_encrypt($order->id_order);
                                    // //        $msg .='<td><a href="?a=order_details&id='.$id.'" class="nav-it">Detalhes</a>
                                    // //        </td>
                                    // //    </tr>';

                                $id = $order->id_order;

                                 $msg .='<td><a onclick="order_details('.$id.')" data-bs-dismiss="modal" class="nav-it">Detalhes</a>
                                 </td>
                             </tr>';

                                 endforeach;   
                                 $msg .='</tbody> </table> <p class="text-end">Total orders: <strong>'.count($order_history).'</strong></p>';  
                                 
                                
                                   
                                $msg .='</div>';
    
                            endif;

                            echo json_encode($msg);
                        // ===========================================================                        
                        
                        // ===========================================================
                        // apresentar a view com o histórico das orders
                            // // Store::Layout([
                            // //     'layouts/html_header',
                            // //     'layouts/header',
                            // //     'navigation_profile',
                            // //     'order_history',
                            // //     'layouts/footer',
                            // //     'layouts/html_footer',
                            // // ], $data);
                        // ===========================================================
                    }
                // ===========================================================   
                               
            // ===========================================================

            // ===========================================================
            // historico orders detalhe / order history detail
                public function order_history_details()
                {
                    // ===========================================================
                    // verifica se existe um utilizador logado
                        if(!Store::is_customer_logged_in()) {
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // verificar se veio indicado um id_order (encriptado)
                        if(!isset($_GET['id'])){
                            Store::redirect();
                            return;
                        }
                    // ===========================================================

                    
                    // ===========================================================
                    // verifica se o id_order é uma string com 32 caracteres
                        $id_order = null;
                        if(strlen($_GET['id']) != 32){
                            Store::redirect();
                            return;
                        } else {
                            $id_order = Store::aes_decrypt($_GET['id']);
                            if(empty($id_order)){
                                Store::redirect();
                                return;
                            }
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // verifica se a order pertence a este customer
                        $orders = new Orders();
                        $resultado = $orders->check_customer_order($_SESSION['customer'], $id_order);
                        if(!$resultado){
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // vamos buscar os data de detalhe da order.
                        $order_details = $orders->order_details($_SESSION['customer'], $id_order);
                    // ===========================================================
                    
                    // ===========================================================
                    // calcular o valor total da order
                        $total = 0;
                        foreach($order_details['order_products'] as $product){
                            $total += ($product->quantity * $product->unit_price);
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // array com data a apresentar na view
                        $data = [
                            'data_order' => $order_details['data_order'],
                            'order_products' => $order_details['order_products'],
                            'total_order' => $total
                        ];
                    // ===========================================================

                    // ===========================================================
                    // vamos apresentar a nova view com esses data.
                        Store::Layout([
                            'layouts/html_header',
                            'layouts/header',
                            'navigation_profile',
                            'order_detail',
                            'layouts/footer',
                            'layouts/html_footer',
                        ], $data);
                    // ===========================================================
                }
            // ===========================================================    

            // ===========================================================
            // historico orders detalhe / order history detail
                public function order_history_details_modal()
                {

                    // ===========================================================
                    // verifica se existe um utilizador logado
                       if(!Store::is_customer_logged_in()) {
                           Store::redirect();
                           return;
                       }
                    // ===========================================================
                    
                    // ===========================================================
                    // verificar se veio indicado um id_order (encriptado)
                       if(!isset($_POST['id'])){
                           Store::redirect();
                           return;
                       }
                    // ===========================================================

                    // ===========================================================
                    // id order
                        $id_order = $_POST['id'];
                    // ===========================================================
                    
                    // ===========================================================
                    // verifica se a order pertence a este customer
                        $orders = new Orders();
                        $resultado = $orders->check_customer_order($_SESSION['customer'], $id_order);
                        if(!$resultado){
                            Store::redirect();
                            return;
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // vamos buscar os data de detalhe da order.
                        $order_details = $orders->order_details($_SESSION['customer'], $id_order);
                    // ===========================================================
                    
                    // ===========================================================
                    // calcular o valor total da order
                        $total = 0;
                        foreach($order_details['order_products'] as $product){
                            $total += ($product->quantity * $product->unit_price);
                        }
                    // ===========================================================

                    $msg = '';

                    $msg .='<div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalhes Encomenda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>';

                    $msg .='<div class="modal-body">

                                <div class="row">

                                    <div class="col">

                                        <div class="p-2 my-3">
                                        <span><strong>Data da order</strong></span><br>'.
                                        $order_details['data_order']->order_date.
                                        '</div>

                                        <div class="p-2 my-3">
                                            <span><strong>address</strong></span><br>'.
                                            $order_details['data_order']->address.
                                        '</div>  
                                        
                                        <div class="p-2 my-3">
                                            <span><strong>city</strong></span><br>'.
                                            $order_details['data_order']->city.
                                        '</div>   
                                        
                                    </div>

                                    <div class="col">

                                        <div class="p-2 my-3">
                                            <span><strong>Email</strong></span><br>'.
                                            $order_details['data_order']->email.
                                        '</div>';    
                                        
                                        $msg.='<div class="p-2 my-3">
                                            <span><strong>Telephone</strong></span><br>';

                                        $msg.=!empty($order_details['data_order']->telephone) ? $order_details['data_order']->telephone : "&nbsp;"
                                        .'</div>';
                                        
                                        $msg.='<div class="p-2 my-3">
                                            <span><strong>Código da encomenda</strong></span><br>'.
                                            $order_details['data_order']->order_code.
                                        '</div>                                        

                                    </div>

                                    <div class="col align-self-center">
                                        <div class="text-center mb-3">
                                        <strong> Estado da encomenda </strong>
                                       
                                        </div>
                                        <div>
                                            <h4 class="text-center" class="nav-it">'.
                                            $order_details['data_order']->status .'</h4>
                                            <br><br>
                                        </div>
                                    </div>                                    
                                    
                                </div>

                                <div class="row mb-5">

                                    <div class="col">

                                        <table class="table">

                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Price Whithout VAT</th>
                                                    <th class="text-end">Preço / Uni.</th>
                                                </tr>
                                            </thead>

                                            <tbody>';

                                            $total_order = 0; 
                                            $total_quantity = 0; 
                                            $total_whithout_VAT = 0;

                                            foreach($order_details['order_products'] as $product):

                                                $preco = $product->quantity * $product->unit_price;
                                                $price_whithout_VAT = $product->quantity * ($product->unit_price / 1.23);
                                                $total_order += $preco; 
                                                $total_quantity += $product->quantity; 
                                                $total_whithout_VAT += $price_whithout_VAT;                                                 

                                                $msg .='<tr>
                                                            <td>'. $product->product_name .'</td>
                                                            <td class="text-center">'. $product->quantity .'</td>
                                                            <td class="text-center">'. number_format($price_whithout_VAT, 2,',','.') . '€' .'</td>
                                                            <td class="text-end">'. number_format($preco,2,',','.') . ' €' .'</td>
                                                        </tr>';

                                            endforeach;

                                            $msg .='<tr>
                                            <td><strong>all</strong></td>
                                            <td class="text-center"><strong>'. $total_quantity .'</strong></td>
                                            <td class="text-center"><strong>'. number_format($total_whithout_VAT, 2,',','.') . '€' .'</strong></td>
                                            <td colspan="12" class="text-end"><strong>'. number_format($total_order,2,',','.') . ' €' .'</strong></td>
                                        </tr>';

                                            

                                            $msg .='</tbody>

                                        </table>

                                    </div>

                                </div>

                                

                                <div id="msg">
                                
                                </div>

                            </div>
                            </div>';     
                            
                    $msg.='<div class="modal-footer">
                                <a class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal" >Sair</a>
                           </div>';  
                           
                    //Store::printData($msg);

                    echo json_encode($msg);

                }
            // ===========================================================              

            // ===========================================================
            // pagamento / payment
                public function payment()
                {
                    // simulação do webhook do getaway de pagamento

                    /* 
                        verificar se vem o código da order
                        verificar se a order com o código indicado está pendent
                        alterar o estado da order de pendent para em processamento
                    */

                    // verificar se o código da order veio indicado
                    $order_code = '';
                    if(!isset($_GET['cod'])){
                        return;
                    } else {
                        $order_code = $_GET['cod'];
                    }

                    // verificar se existe o código ativo (PENDENT)
                    $order = new Orders();
                    $resultado = $order->make_payment($order_code);

                    echo (int)$resultado;
                }
            // ===========================================================

            // ===========================================================
            // criar pdf / create pdf
                public function generate_pdf()
                {
                    // ===========================================================
                    // Criar um objecto da classe PDF
                        $pdf = new PDF();
                    // ===========================================================

                    // ===========================================================
                    // apresenta pdf
                        $pdf->pdf_show();
                    // ===========================================================

                    // $pdf->set_template(getcwd() . '/assets/templates_pdf/template.pdf');
                } 
            // ===========================================================           
        }
    // ===================================================================  -->





