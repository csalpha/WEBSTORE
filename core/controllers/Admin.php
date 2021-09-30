<?php

    // ===========================================================
    // classes carregadas
        namespace core\controllers;
        use core\classes\Database;
        use core\classes\SendEmail;
        use core\classes\PDF;
        use core\classes\Store;
        use core\models\AdminModel;
        use core\models\Products;
        use core\models\Customers;
        use core\models\Orders;
    // ===========================================================

    // ===========================================================
    // class Admin
        class admin
        {
            // ===============================================================
            // index
                public function index()
                {   
                    //Store::printData($_SESSION['admin']);

                    // ===========================================================
                    // verifica se não existe um admin logado /redireccionamento
                        if (!Store::is_admin_logged_in()) 
                        {
                            // ===========================================================
                            // redireciona para a página de admin do backoffice
                                Store::redirect('admin_login', true);
                                return;
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // verificar se existem orders em estado PENDENT
                        $ADMIN = new AdminModel();
                        $total_orders_pending = $ADMIN->total_orders_pending();
                        $total_orders_in_processing = $ADMIN->total_orders_in_processing();
                    // ===========================================================
                    
                    // ===========================================================
                    // já existe um admin logado / apresenta a pagina inicial
                        $data = [
                            'total_orders_pending' => $total_orders_pending,
                            'total_orders_in_processing' => $total_orders_in_processing
                        ];

                        Store::admin_layout([
                            'admin/layouts/html_header',
                            'admin/layouts/header',
                            'admin/home_admin',
                            'admin/layouts/footer',
                            'admin/layouts/html_footer',
                        ], $data);
                    // ===========================================================
                }
            // =============================================================== 

            // ===============================================================
            // HOME / ENCOMENDAS
                public function home_page_admin()
                {   
                            // ===========================================================
                            // verifica se não existe um admin logado /redireccionamento
                                if (!Store::is_admin_logged_in()) 
                                {
                                    // ===========================================================
                                    // redireciona para a página de admin do backoffice
                                        Store::redirect('admin_login', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // verificar se existem orders em estado PENDENT
                                $ADMIN = new AdminModel();
                                $total_orders_pending = $ADMIN->total_orders_pending();
                                $total_orders_in_processing = $ADMIN->total_orders_in_processing();
                            // ===========================================================

                            // ===========================================================
                            // já existe um admin logado / apresenta a pagina inicial
                                $data = [
                                    'total_orders_pending' => $total_orders_pending,
                                    'total_orders_in_processing' => $total_orders_in_processing
                                ];

                                $msg = '';

                                $msg .= '<div class="col-md-10">
                                <h4>Orders pendentes</h4>';
                                if($total_orders_pending == 0): 
                                    $msg .= '<p class="text-a1a1a1">Não existem encomendas pendentes.</p>';
                                else:              
                                    $msg .= '<div class="alert alert-info p-2">
                                        <span class="me-3">Existem encomendas pendentes: <strong>'.$total_orders_pending.'</strong></span>
                                        <a href="?a=orders_list&f=pendent" class="nav-it">Ver</a>
                                    </div>';
                                endif; 

                                $msg .= '<hr>
                                <h4>Orders em processamento</h4>';
                                    if($total_orders_in_processing == 0): 

                                        $msg .= '<p class="text-a1a1a1">Não existem encomendas em processamento.</p>';
                                    else:               
                                        $msg .= '<div class="alert alert-warning p-2">
                                            <span class="me-3">Existem encomendas em processamento: <strong>'. $total_orders_in_processing .'</strong></span>
                                            <a href="?a=orders_list&f=processing" class="nav-it">Ver</a>
                                        </div>';
                                    endif; 
                        
                                    $msg .= '<div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>  
                            <hr>
                            
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div> 
                            
                                <div id="grafico">      </div>

                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>
                        </div>';

                        

                        echo json_encode($msg);


                }
            // =============================================================== 

            // =============================================================== 
            // CRUD CLIENTES 

                // =========================================================== 
                // Criar tabela customer 
                    public function criar_tabela_customer()
                    {
                                                
                                $filtro = "";

                                $ADMIN = new AdminModel(); // criar admin
                                $customers = $ADMIN->customers_list($filtro);
                                

                                foreach ($customers as $customer) : 
                                        $sub_array = array();
                                        $sub_array[] = '<img src="../assets/images/customers/'. $customer->image .'" class="img-fluid" width="50px">';
                                        $sub_array[] = '<a onclick="apresentarModalVerAdmin('. $customer->id_customer .')" class="nav-it">'. $customer->email .'</a>';
                                        $sub_array[] = $customer->full_name;
                                        $sub_array[] = $customer->telephone;

                                        if ($customer->total_orders == 0) : 
                                            $sub_array[] ='-';
                                        else : 
                                            $sub_array[] = $customer->total_orders;
                                        endif;  

                                        if ($customer->active == 1) : 
                                            $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                        else : 
                                            $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                        endif;  

                                        if ($customer->deleted_at == null) : 
                                            $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                        else : 
                                            $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                        endif;    

                                        $sub_array[] = '<button onclick="apresentarModalVerCustomer('. $customer->id_customer .')" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                        ';
                                        $sub_array[] = '<button id="botao_update" onclick="apresentarModalUpdateCustomer('. $customer->id_customer .')" value="'. $customer->id_customer .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                        $sub_array[] = '<button id="botao_delete" onclick="customer_delete('. $customer->id_customer .')" class="btn btn-danger btn-xs delete" name="delete"><i class="fa fa-trash"></i></button>';

                                        $data[] = $sub_array;                           
                                endforeach; 

                                    $output = array(
                                        "data"				=>	$data
                                    );

                                echo json_encode($output);
                        
                    }
                // ===========================================================              
                
                // ===========================================================
                // lista customers / customers list
                    public function customers_list()
                    {

                        $msg = '';

                            if (!Store::is_admin_logged_in()) 
                            {
                                    Store::redirect('home_page', true);
                                    return;
                            }

                            $filtros = [
                                'activo' => '1',
                                'inactivo' => '0',
                            ];

                            $filtro = '';
                            if (isset($_GET['f'])) 
                            {
                                    if (key_exists($_GET['f'], $filtros)) 
                                    {
                                        $filtro = $filtros[$_GET['f']];
                                    }
                            }

                            $ADMIN = new AdminModel();
                            $customers = $ADMIN->customers_list($filtro);
                            $total_customers_masc = $ADMIN->total_customers_masc();
                            $total_customers_femi = $ADMIN->total_customers_femi();



                            $msg .= '
                                <h3>Lista de Clientes';
                                // //  $msg .= $filtro != " " ? ($filtro  == 1 ? 'Activos' : 'Inactivos') : " ";
                                ////onclick="apresentarModalAdd()"
                                $msg .= '</h3>
                                <hr>                      
                                <div class="row">
                                        <div class="col">
                                        <input id="total_customers_masc"  type="hidden" value="'. $total_customers_masc.'"> 
                                        <input id="total_customers_femi" type="hidden" value="'. $total_customers_femi.'"> 
                                            <button id="botao_adicionar_cliente"  class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                            <a href="?a=customers_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                        </div>                        
                                        <div class="col">';
                                        
                                        $f = '';
                                        if (isset($_GET['f'])) {
                                            $f = $_GET['f'];
                                        }
                                
                                        $msg .= '<div class="mb-3 row">';
                                            // <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                            // <div class="col-sm-8">

                                            //     $msg .= '<select id="combo-status" class="form-control" onchange="definir_filtro()">';
                                            //     $msg .= '<option value=""'; 
                                            //     $msg .= $f == " " ? "selected" : " ";
                                            //     $msg .= 'class="nav-it"></option>';
                                            //     $msg .= '<option value="activo"';
                                            //     $msg .= $f == "activo" ? "selected" : "";
                                            //     $msg .= 'class="nav-it">Activo</option>';
                                            //     $msg .= '<option value="inactivo"'; 
                                            //     $msg .= $f == "inactivo" ? "selected" : "";
                                            //     $msg .= 'class="nav-it">Inactivo</option>
                                            //     </select>
                                            // </div>
                                            $msg .= '</div>
                                        </div>
                                </div>';

                                    $msg .= '<small>
                                            <table class="table table-sm" id="tabela-customers">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Imagem</th>
                                                        <th>Nome</th>
                                                        <th>Email</th>
                                                        <th>telephone</th>
                                                        <th class="text-center">Orders</th>
                                                        <th class="text-center">Ativo</th>
                                                        <th class="text-center">Eliminado</th>
                                                        <th class="text-center">Ver modal</th>
                                                        <th class="text-center">Editar</th>
                                                        <th class="text-center">Apagar</th>
                                                    </tr>
                                                </thead>';
                                    $msg .='<tfoot class="table-dark">
                                            <tr>
                                            <th>Imagem</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>telephone</th>
                                            <th class="text-center">Orders</th>
                                            <th class="text-center">Ativo</th>
                                            <th class="text-center">Eliminado</th>
                                            <th class="text-center">Ver modal</th>
                                            <th class="text-center">Editar</th>
                                            <th class="text-center">Apagar</th>
                                            </tr>
                                        </tfoot>'; 
                                                $msg .= '</table>
                                                </small>';
                                            
                
                                            $msg .= '<hr>
                                            <div class="row">
                                                <div class="col">
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                    </div>
                                                </div>
                                            </div>';
                
                                            $msg .= '<div id="grafico"> </div>
                                            <div class="row">
                                                <div class="col">
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>';                        
                
                                        echo json_encode($msg);
                    }
                // ===========================================================  

                // ===========================================================
                // cria conteúdo - modal ver customer
                    public function create_modal_ver_customer()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_customer = $_POST['id_customer'];
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                $ADMIN->search_customer($_POST['id_customer'])
                            ];

                        // Store::printData($data[0]->user);

                            $data_customer =
                            [
                                'Email' => $data[0]->email,
                                'pass' => $data[0]->pass,
                                'id_customer' => $data[0]->id_customer,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone,
                                'active' => $data[0]->active,
                                'gender' => $data[0]->gender,
                                'image' => $data[0]->image

                            ];

                           // Store::printData($data_customer);

                            // ===========================================================  
                            // Construir msg modal 
                            
                            $msg = '';
                            
                            $msg.='<div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>';

                            $msg.='<div class="modal-body">
                                        <br>
                                        <table class="table table-striped">
                                        <input  type="hidden" value="'. $data[0]->id_customer.'"> '; 
                                            foreach($data_customer as $key=>$value):
                                                $msg.='<tr>
                                                    <td class="text-end" width="40%">'.$key.':</td>
                                                    <td width="60%"><strong>'.$value .'</strong></td>
                                                </tr>';
                                            endforeach;
                                            $msg.='<tr>
                                                    <td class="text-end" width="40%">Image:</td>
                                                    <td width="60%"><img src="../assets/images/products/'.$data[0]->image .'"/></td>
                                                </tr>';
                                        $msg.='</table>
                                </div>';

                                $msg.='<div class="modal-footer">
                                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                          
                        
                        
                    }
                // =========================================================== 
                
                // ===========================================================
                // criar customer / create customer
                    public function create_customer()
                    {   
                        // dados admin
                        // ===========================================================
                            $text_email_customer = $_POST['text_email_customer_add'];
                            $text_pass_1_customer = $_POST['text_pass_1_customer_add'];
                            $text_pass_2_customer = $_POST['text_pass_2_customer_add'];
                            $text_full_name_customer = $_POST['text_full_name_customer_add'];
                            $text_address_customer = $_POST['text_address_customer_add'];
                            $text_city_customer = $_POST['text_city_customer_add'];
                            $text_telephone_customer = $_POST['text_telephone_customer_add'];
                            $text_activo_customer = $_POST['text_activo_customer_add'];
                            $text_gender_customer = $_POST['text_gender_customer_add'];
                            $customer_image = $_FILES["customer_image_add"]["name"]; 
                        // ===========================================================



                        // ===========================================================
                        // Carregar model
                            $customer = new Customers(); 
                            $existe_noutra_conta = $customer->check_if_email_exists_in_another_account_alfa($text_email_customer);
                        // ===========================================================  
                            
                            if($existe_noutra_conta)
                            {
                                // ===================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>O email já pertence a outro Customer.</p>
                                    </div>';
                                // ===================================================

                                // ===================================================
                                // Mostrar msg modal
                                echo json_encode($msg);
                                return;
                                // ===================================================                                   
                            }
                            // ===========================================================
                            // validar se a nova pass vem com data                         
                                else if(strlen($text_pass_1_customer) < 6)
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
                            // verificar se a nova pass é diferente da pass atual
                                else if($text_pass_1_customer != $text_pass_2_customer)
                                {
                                    // ===========================================================
                                    // Construir msg modal                                 
                                        $msg = '';
                                        $msg .='
                                        <div class="alert alert-danger text-center p-2">
                                        <p>As passes não coincidem.</p>
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
                            // inserir novo admin na base de data e devolver o purl                    
                                else
                                {
                                $customer->register_customer_alfa( $text_email_customer ,
                                $text_pass_1_customer ,
                                $text_full_name_customer ,
                                $text_address_customer ,
                                $text_city_customer ,
                                $text_telephone_customer,
                                $text_activo_customer,
                                $text_gender_customer,
                                $customer_image);
                                // ===========================================================                
                                
                                // ===========================================================
                                // envio do email para o admin
                                $email = new SendEmail();
                                $resultado = $email->send_email_confirmation_new_admin($text_email_customer, $purl = null);
                                // ===========================================================     
                                
                                    // ===========================================================
                                    // Construir msg modal                                
                                        $msg = '';

                                        $msg .='
                                        <div class="alert alert-success text-center p-2">
                                        <p>Customer criado com sucesso!</p>
                                        </div>';
                                    // ===========================================================

                                    // $this->admins_list();

                                    // ===========================================================
                                    // Mostrar msg modal                                  
                                        //echo json_encode($msg);
                                    // ===========================================================                        
                                }
                            
                    }
                // ===========================================================  
                
                // ===========================================================
                // criar conteudo - modal update admin  
                    public function create_modal_update_customer()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_customer = $_POST['id_customer'];
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                                $ADMIN = new AdminModel();
                                $data = [
                                    $ADMIN->search_customer($id_customer)
                                ];

                                $data_admin =
                                [
                                    'id_customer' => $data[0]->id_customer,
                                    'email' => $data[0]->email,
                                    'pass' => $data[0]->pass,
                                    'full_name' => $data[0]->full_name,
                                    'address' => $data[0]->address,
                                    'city' => $data[0]->city,
                                    'telephone' => $data[0]->telephone,
                                    'active' => $data[0]->active,
                                    'gender' => $data[0]->gender,
                                    'image' => $data[0]->image
                                ];

                                echo json_encode($data_admin);
                        // ===========================================================                       
                        
                        
                    }
                // ===========================================================      
                
                // ===========================================================
                // update / atualizar customer
                    public function update_customer()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                        if(!Store::is_admin_logged_in()) {
                            Store::redirect();
                            return;
                        }
                        // ===========================================================

                        // ===========================================================
                        // validar data
                            $id_customer = trim(strtolower($_POST['text_id_customer']));
                            $email_customer = trim(strtolower($_POST['text_email_customer']));
                            $pass_1_customer = trim(strtolower($_POST['text_pass_1_customer']));
                            $pass_2_customer = trim(strtolower($_POST['text_pass_2_customer']));
                            $full_name_customer = trim($_POST['text_full_name_customer']);
                            $address_customer = trim($_POST['text_address_customer']);
                            $city_customer = trim($_POST['text_city_customer']);
                            $telephone_customer = trim($_POST['text_telephone_customer']);
                            $activo_customer = trim($_POST['text_activo_customer']);
                            $gender_customer = trim($_POST['text_gender_customer']);
                            $image_customer = trim($_GET['c']);   
                        // ===========================================================

                        //Store::printData($image_customer);


                        // ===========================================================
                        // Carregar model
                            $customer = new Customers(); 
                            $existe_noutra_conta = $customer->check_if_email_exists_in_another_account($id_customer, $email_customer);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email_customer, FILTER_VALIDATE_EMAIL))
                            {

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
                        else if($pass_1_customer != $pass_2_customer)
                        {
                            // ===========================================================
                            // Construir msg modal                                
                                $msg = '';
                                $msg.= '<div class="alert alert-danger text-center p-2">
                                <p>A palavra pass e a sua repetição tem de ser iguais.</p>
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
                            else if(empty($full_name_customer) || empty($address_customer) || empty($city_customer))
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
                                        $customer->update_customer_alfa(
                                        $id_customer, $email_customer, $pass_1_customer, 
                                        $full_name_customer, $address_customer, $city_customer, 
                                        $telephone_customer, $activo_customer, $gender_customer,  $image_customer);
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
                    }
                // ===========================================================                   

                // ===========================================================
                // apagar customer / delete customer   
                    public function delete_customer()
                    {   
                        $id_customer = $_POST['id_customer'];
                        $adminModel = new AdminModel();
                        $adminModel->delete_customer($id_customer);                
                    }
                // ===========================================================                   

            // =============================================================== 

            // ===============================================================
            // CRUD ADMINS

                // =========================================================== 
                // Criar tabela admin 
                    public function criar_tabela_admin()
                    {
                        $filtro = "";
                        $ADMIN = new AdminModel(); // criar admin
                        $admins = $ADMIN->admins_list($filtro);
                        foreach ($admins as $admin) : 
                                $sub_array = array();
                                $sub_array[] = '<img src="../assets/images/customers/'. $admin->image .'" class="img-fluid" width="50px">';
                                $sub_array[] = '<a onclick="apresentarModalVerAdmin('. $admin->id_admin .')" class="nav-it">'. $admin->user .'</a>';
                                $sub_array[] = $admin->pass;
                                $sub_array[] = $admin->created_at;
                                $sub_array[] = $admin->updated_at;
                                if ($admin->active == 1) : 
                                    $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                else : 
                                    $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                endif;                                                
                            
                            if ($admin->deleted_at == null) : 
                                    $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                else : 
                                    $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                endif;                                                
                                
                                $sub_array[] = '<button onclick="apresentarModalVerAdmin('. $admin->id_admin .')" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                ';
                                $sub_array[] = '<button id="botao_update" onclick="apresentarModalUpdateAdmin('. $admin->id_admin .')"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                $sub_array[] = '<button id="botao_delete" onclick="admin_delete('. $admin->id_admin .')" class="btn btn-danger btn-xs delete" name="delete"><i class="fa fa-trash"></i></button>';
                                $data[] = $sub_array;
                        endforeach; 
                            $output = array(
                                "data"				=>	$data
                            );
                        echo json_encode($output);
                    
                    }
                // ===========================================================

                // ===========================================================
                // lista admins / admins list   
                    public function admins_list()
                    {
                                $msg = '';

                            // ===========================================================
                            // verifica se existe um admin logado
                                if (!Store::is_admin_logged_in()) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // apresenta a lista de orders (usando filtro se for o caso)
                            // verifica se existe um filtro da query string
                                $filtros = [
                                    'activo' => '1',
                                    'inactivo' => '0',
                                ];
                            // ===========================================================

                            // ===========================================================
                            // verifica se existe um filtro da query string
                                $filtro = '';
                                if (isset($_GET['f'])) 
                                {
                                    // ===========================================================
                                    // verifica se a variável é uma key dos filtros
                                        if (key_exists($_GET['f'], $filtros)) 
                                        {
                                            $filtro = $filtros[$_GET['f']];
                                        }
                                    // ===========================================================
                                }
                            // ===========================================================  

                            // ===========================================================
                            // vai buscar a lista de admins
                                $ADMIN = new AdminModel(); // criar admin
                                $admins = $ADMIN->admins_list($filtro);
                                $total_admins_masc = $ADMIN->total_admins_masc();
                                $total_admins_femi = $ADMIN->total_admins_femi();
                            // ===========================================================

                            // ===========================================================
                            // apresenta a página da lista de admins
                                $data = [
                                    'admins' => $admins,
                                    'total_admins_masc' =>  $total_admins_masc,
                                    'total_admins_femi' =>  $total_admins_femi
                                ];


                                $msg = '';
                                $msg .='<h3>Lista de admins</h3>
                                <hr>';
                                   // <div class="row">
                                   $msg .=' <div class="col">
                                            <input id="tot_masc"  type="hidden" value="'. $total_admins_masc.'"> 
                                            <input id="tot_femi" type="hidden" value="'. $total_admins_femi.'"> 
                                            <button type="button" id="botao_adicionar" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>

                                        </div>';
                                            // <div class="col">';
                                            
                                            // $f = '';
                                            // if (isset($_GET['f'])) 
                                            // {
                                            //     $f = $_GET['f'];
                                            // }
                                        
                                            // $msg .='<div class="mb-3 row">';
                                            // //     <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                            // //     <div class="col-sm-8">';

                                            // //     $msg .='<select id="combo-status" class="form-control" onchange="definir_filtro()">';

                                            // //     $msg .='<option value=""';
                                            // //     $msg .= $f == " " ? "selected" : " ";
                                            // //     $msg .='class="nav-it"></option>';

                                            // //     $msg .='<option value="activo"';
                                            // //     $msg .= $f == "activo" ? "selected" : " ";
                                            // //     $msg .='class="nav-it">Activo</option>';

                                            // //     $msg .='<option value="inactivo"';
                                            // //     $msg .= $f == "inactivo" ? "selected" : " "; 
                                            // //     $msg .='class="nav-it">Inactivo</option>
                                            // // </select>';
                                            // //     $msg .='</div>
                                            // // </div>
                                            // // </div>
                                        // $msg .='</div>';                          

                                $msg .='<small><table class="table table-sm" id="tabela-admins">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Picture</th>
                                                    <th>User</th>
                                                    <th>Pass</th>
                                                    <th>Created at</th>
                                                    <th class="text-center">Updated at</th>
                                                    <th class="text-center">Ativo</th>
                                                    <th class="text-center">Eliminado</th>
                                                    <th class="text-center">Ver</th>
                                                    <th class="text-center">Editar</th>
                                                    <th class="text-center">Apagar</th>
                                                </tr>
                                            </thead>';
                                            $msg .='<tfoot class="table-dark">
                                                <tr>
                                                    <th>Picture</th>
                                                    <th>User</th>
                                                    <th>Pass</th>
                                                    <th>Created at</th>
                                                    <th class="text-center">Updated at</th>
                                                    <th class="text-center">Ativo</th>
                                                    <th class="text-center">Eliminado</th>
                                                    <th class="text-center">Ver</th>
                                                    <th class="text-center">Editar</th>
                                                    <th class="text-center">Apagar</th>
                                                </tr>
                                            </tfoot>';                                        
                                        $msg .='</table></small>';

                                        $msg .='<div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 row">
                                            </div>
                                        </div>
                                    </div>
                                <hr>

                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 row">
                                            </div>
                                        </div>
                                    </div>
                                <div id="grafico2"> </div>
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>'; 
                            // ===========================================================                               

                                echo json_encode($msg);

                    }
                // =========================================================== 

                // ===========================================================
                // cria conteúdo - modal ver admin
                    public function create_modal_ver_admin()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_admin = $_POST['id_admin'];
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                $ADMIN->search_admin($_POST['id_admin'])
                            ];

                        // Store::printData($data[0]->user);

                            $data_admin =
                            [
                                'Email' => $data[0]->user,
                                'pass' => $data[0]->pass,
                                'id_admin' => $data[0]->id_admin,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone,
                                'active' => $data[0]->active,
                                'gender' => $data[0]->gender
                            // 'image' => $data[0]->image

                            ];

                            // ===========================================================  
                            // Construir msg modal 
                            
                            $msg = '';
                            
                            $msg.='<div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>';

                            $msg.='<div class="modal-body">
                                        <br>
                                        <table class="table table-striped">
                                        <input  type="hidden" value="'. $data[0]->id_admin.'"> '; 
                                            foreach($data_admin as $key=>$value):
                                                $msg.='<tr>
                                                    <td class="text-end" width="40%">'.$key.':</td>
                                                    <td width="60%"><strong>'.$value .'</strong></td>
                                                </tr>';
                                            endforeach;
                                            $msg.='<tr>
                                                    <td class="text-end" width="40%">Image:</td>
                                                    <td width="60%"><img src="../assets/images/products/'.$data[0]->image .'"/></td>
                                                </tr>';
                                        $msg.='</table>
                                </div>';

                                $msg.='<div class="modal-footer">
                                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                          
                        
                        
                    }
                // ===========================================================                  

                // ===========================================================
                // criar admin / create admin
                    public function create_admin()
                    {   
                        // dados admin
                        // ===========================================================
                            $text_email_admin = $_POST['text_email_admin_add'];
                            $text_pass_1_admin = $_POST['text_pass_1_admin_add'];
                            $text_pass_2_admin = $_POST['text_pass_2_admin_add'];
                            $text_full_name_admin = $_POST['text_full_name_admin_add'];
                            $text_address_admin = $_POST['text_address_admin_add'];
                            $text_city_admin = $_POST['text_city_admin_add'];
                            $text_telephone_admin = $_POST['text_telephone_admin_add'];
                            $text_activo_admin = $_POST['text_activo_admin_add'];
                            $text_gender_admin = $_POST['text_gender_admin_add'];
                            $user_image = $_FILES["user_image_add"]["name"]; 
                        // ===========================================================


                        // ===========================================================
                        // Carregar model
                            $ADMIN = new AdminModel(); 
                            $existe_noutra_conta = $ADMIN->check_if_email_exists_in_another_account_admin_alfa($text_email_admin);
                        // ===========================================================  
                            
                            if($existe_noutra_conta)
                            {
                                // ===================================================
                                // Construir msg modal                                
                                    $msg = '';
                                    $msg.= '<div class="alert alert-danger text-center p-2">
                                    <p>O email já pertence a outro Admin.</p>
                                    </div>';
                                // ===================================================

                                // ===================================================
                                // Mostrar msg modal
                                echo json_encode($msg);
                                return;
                                // ===================================================                                   
                            }
                            // ===========================================================
                            // validar se a nova pass vem com data                         
                                else if(strlen($text_pass_1_admin) < 6)
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
                            // verificar se a nova pass é diferente da pass atual
                                else if($text_pass_1_admin != $text_pass_2_admin)
                                {
                                    // ===========================================================
                                    // Construir msg modal                                 
                                        $msg = '';
                                        $msg .='
                                        <div class="alert alert-danger text-center p-2">
                                        <p>As passes não coincidem.</p>
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
                            // inserir novo admin na base de data e devolver o purl                    
                                else
                                {
                                $ADMIN->register_admin_modal( $text_email_admin ,
                                $text_pass_1_admin ,
                                $text_full_name_admin ,
                                $text_address_admin ,
                                $text_city_admin ,
                                $text_telephone_admin,
                                $text_activo_admin,
                                $text_gender_admin,
                                $user_image);
                                // ===========================================================                
                                
                                // ===========================================================
                                // envio do email para o admin
                                $email = new SendEmail();
                                $resultado = $email->send_email_confirmation_new_admin($text_email_admin, $purl = null);
                                // ===========================================================     
                                
                                    // ===========================================================
                                    // Construir msg modal                                
                                        $msg = '';

                                        $msg .='
                                        <div class="alert alert-success text-center p-2">
                                        <p>Admin criado com sucesso!</p>
                                        </div>';
                                    // ===========================================================

                                    // $this->admins_list();

                                    // ===========================================================
                                    // Mostrar msg modal                                  
                                        //echo json_encode($msg);
                                    // ===========================================================                        
                                }
                            
                    }
                // ===========================================================  
                
                // ===========================================================
                // criar conteudo - modal update admin  
                    public function create_modal_update_admin()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_admin = $_POST['id_admin'];
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                                $ADMIN = new AdminModel();
                                $data = [
                                    $ADMIN->search_admin($id_admin)
                                ];

                                $data_admin =
                                [
                                    'id_admin' => $data[0]->id_admin,
                                    'user' => $data[0]->user,
                                    'pass' => $data[0]->pass,
                                    'full_name' => $data[0]->full_name,
                                    'address' => $data[0]->address,
                                    'city' => $data[0]->city,
                                    'telephone' => $data[0]->telephone,
                                    'active' => $data[0]->active,
                                    'gender' => $data[0]->gender,
                                    'image' => $data[0]->image
                                ];

                                echo json_encode($data_admin);
                        // ===========================================================                       
                        
                        
                    }
                // ===========================================================                 
                 
                // ===========================================================
                // update / atualizar admin 
                    public function update_admin()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                        if(!Store::is_admin_logged_in()) {
                            Store::redirect();
                            return;
                        }
                        // ===========================================================

                        // ===========================================================
                        // validar data
                            $id_admin = trim(strtolower($_POST['text_id_admin']));
                            $email_admin = trim(strtolower($_POST['text_email_admin']));
                            $pass_1_admin = trim(strtolower($_POST['text_pass_1_admin']));
                            $pass_2_admin = trim(strtolower($_POST['text_pass_2_admin']));
                            $full_name_admin = trim($_POST['text_full_name_admin']);
                            $address_admin = trim($_POST['text_address_admin']);
                            $city_admin = trim($_POST['text_city_admin']);
                            $telephone_admin = trim($_POST['text_telephone_admin']);
                            $activo_admin = trim($_POST['text_activo_admin']);
                            $gender_admin = trim($_POST['text_gender_admin']);
                            $image_admin = trim($_GET['c']);   
                        // ===========================================================


                        // ===========================================================
                        // Carregar model
                            $ADMIN = new AdminModel(); 
                            $existe_noutra_conta = $ADMIN->check_if_email_exists_in_another_account_admin($id_admin, $email_admin);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email_admin, FILTER_VALIDATE_EMAIL))
                            {

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
                        else if($pass_1_admin != $pass_2_admin)
                        {
                            // ===========================================================
                            // Construir msg modal                                
                                $msg = '';
                                $msg.= '<div class="alert alert-danger text-center p-2">
                                <p>A palavra pass e a sua repetição tem de ser iguais.</p>
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
                            else if(empty($full_name_admin) || empty($address_admin) || empty($city_admin))
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
                                        $ADMIN->update_admin($id_admin, $email_admin, $pass_1_admin, $full_name_admin, $address_admin, $city_admin, $telephone_admin, $activo_admin, $gender_admin,  $image_admin);
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
                    }
                // ===========================================================                  
                 
                // ===========================================================
                // apagar admin / delete admin   
                    public function delete_admin()
                    {   
                        $id_admin = $_POST['id_admin'];
                        $adminModel = new AdminModel();
                        $adminModel->delete_admin($id_admin);                
                    }
                // ===========================================================                 

            // ===============================================================
        
            // ===============================================================
            // CRUD PRODUTOS

                // =========================================================== 
                // Criar tabela produtos 
                        public function criar_tabela_products()
                        {
                            // ===========================================================
                            // verifica se existe um admin logado
                                if (!Store::is_admin_logged_in()) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                                $adminModel = new AdminModel();

                                $p = new Products();
                                $tot_cat = $p->count_category();
                                
                                $categorys = $p->category_list();
                                
                                foreach ($categorys as $category) {
                                    $nomes[] = "'$category'";
                                    $quantity[] = $adminModel->count_products_category($category);
                                }
                                
                                $quantity = implode(',', $quantity);
                                $nomes = implode(',', $nomes);  
                            // ===========================================================                       

                            // ===========================================================
                            // apresenta a lista de orders (usando filtro se for o caso)
                            // verifica se existe um filtro da query string
                                $filtros = [
                                    'activo' => '1',
                                    'inactivo' => '0',
                                ];
                            // ===========================================================

                            // ===========================================================
                            // verifica se existe um filtro da query string
                                $filtro = '';
                                if (isset($_GET['f'])) 
                                {
                                    // ===========================================================
                                    // verifica se a variável é uma key dos filtros
                                        if (key_exists($_GET['f'], $filtros)) 
                                        {
                                            $filtro = $filtros[$_GET['f']];
                                        }
                                    // ===========================================================
                                }
                            // =========================================================== 

                            // ===========================================================
                            // vai buscar a lista de products
                                $ADMIN = new AdminModel(); // criar admin model
                                $products = $ADMIN->products_list($filtro);
                            // ===========================================================

                                foreach ($products as $product) : 

                                        $price_whithout_VAT = ($product->price / 1.23);
                                        $vat = $product->price - $price_whithout_VAT;
                                        $perc_iva = $product->VAT * 100;

                                        $sub_array = array();
                                        $sub_array[] = '<img src="../assets/images/products/'. $product->image .'" class="img-fluid" width="50px">';
                                        $sub_array[] = $product->id_product;
                                        $sub_array[] = '<a href="?a=products_details&c='. Store::aes_encrypt($product->id_product) .'" class="nav-it">'. $product->product_name .'</a>';
                                        $sub_array[] = $product->category;
                                        $sub_array[] = $product->price .' €';
                                        $sub_array[] = number_format($price_whithout_VAT, 2,',','.') .' €';
                                        $sub_array[] = number_format($vat, 2,',','.') .' €';
                                        $sub_array[] = number_format($perc_iva, 0,',','.') .' %';
                                        $sub_array[] = $product->stock;

                                        if ($product->active == 1) : 
                                            $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                        else : 
                                            $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                        endif;  
                                        
                                        $sub_array[] = $product->updated_at;
                                        $sub_array[] = '<button onclick="apresentarModalVerProduto('. $product->id_product .')" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                        ';
                                        $sub_array[] = '<button id="botao_update" onclick="apresentarModalUpdateProduct('. $product->id_product .')"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                        $sub_array[] = '<button id="botao_delete" onclick="product_delete('. $product->id_product .')"  class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>';                                    
                                        $data[] = $sub_array;
                                endforeach; 

                                $output = array(
                                    "data"				=>	$data
                                );

                                echo json_encode($output);
                            
                        }
                // ===========================================================                

                // ===========================================================
                // lista products / products list
                    public function products_list()
                    {
                            // ===========================================================
                            // verifica se existe um admin logado
                                if (!Store::is_admin_logged_in()) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            $adminModel = new AdminModel();

                            $p = new Products();
                            $tot_cat = $p->count_category();
                            
                            $categorys = $p->category_list();
                            
                            
                            foreach ($categorys as $category) {
                                $nomes[] = "'$category'";
                                $quantity[] = $adminModel->count_products_category($category);
                            }
                            
                            $quantity = implode(',', $quantity);
                            $nomes = implode(',', $nomes);                         

                            // ===========================================================
                            // apresenta a lista de orders (usando filtro se for o caso)
                            // verifica se existe um filtro da query string
                                $filtros = [
                                    'activo' => '1',
                                    'inactivo' => '0',
                                ];
                            // ===========================================================

                            // ===========================================================
                            // verifica se existe um filtro da query string
                                $filtro = '';
                                if (isset($_GET['f'])) 
                                {
                                    // ===========================================================
                                    // verifica se a variável é uma key dos filtros
                                        if (key_exists($_GET['f'], $filtros)) 
                                        {
                                            $filtro = $filtros[$_GET['f']];
                                        }
                                    // ===========================================================
                                }
                            // =========================================================== 

                            // ===========================================================
                            // vai buscar a lista de products
                                $ADMIN = new AdminModel(); // criar admin model
                                $products = $ADMIN->products_list($filtro);
                            // ===========================================================

                            $msg = '';

                            $msg .= '<h3>Lista de products</h3>
                            <hr> 
                            <div class="row">
                                    <div class="col">
                                        <button id="botao_adicionar_produto" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                    </div>                          
                                    <div class="col">';
                                
                                    $f = '';
                                    if (isset($_GET['f'])) {
                                        $f = $_GET['f'];
                                    }
                                
                                    $msg .= '<div class="mb-3 row">';
                                        $msg .= '</div>
                                    </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="mb-3 row">
                                    </div>
                                </div>
                            </div>';

                                $msg .= '<small>
                                    <table class="table table-striped" id="tabela-products">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Picture</th>
                                                <th>Código</th>
                                                <th>Nome product</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Price whithout VAT</th>
                                                <th>VAT Price</th>
                                                <th>VAT </th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Atualizado em</th>
                                                <th class="text-center">Ver</th>
                                                <th class="text-center">Editar</th>
                                                <th class="text-center">Apagar</th>                                    
                                            </tr>
                                        </thead>';

                                        $msg .= '<tfoot class="table-dark">
                                            <tr>
                                                <th>Picture</th>
                                                <th>Código</th>
                                                <th>Nome product</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Price whithout VAT</th>
                                                <th>VAT Price</th>
                                                <th>VAT </th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Atualizado em</th>
                                                <th class="text-center">Ver</th>
                                                <th class="text-center">Editar</th>
                                                <th class="text-center">Apagar</th>                                    
                                            </tr>
                                        </tfoot>';                                    
                                            $msg .='</table>
                                </small>';
                            $msg .='<div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="mb-3 row">
                                    </div>
                                </div>
                            </div>
                            <hr>

                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>

                                <div id="grafico"> </div>
                    
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>';
                            

                            echo json_encode($msg);
                    }
                // =========================================================== 

                // ===========================================================
                // cria conteúdo - modal ver products
                    public function create_modal_ver_product()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_product = $_POST['id_product'];
                        // ===========================================================
                        
                        // // ===========================================================
                        // // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                $ADMIN->search_product($id_product)
                            ];

                            $data_product =
                            [
                                'id_product' => $data[0]->id_product,
                                'category' => $data[0]->category,
                                'product_name' => $data[0]->product_name,
                                'description' => $data[0]->description,
                                'price' => $data[0]->price,
                                'stock' => $data[0]->stock,
                                'visible' => $data[0]->visible,
                                'active' => $data[0]->active,
                                'price_without_VAT' => $data[0]->price_without_VAT,
                                'VAT' => $data[0]->VAT,
                            ];

                            // Store::printData($data_customer);
                            // ===========================================================  
                            // Construir msg modal 
                        
                            $msg = '';
                        
                            $msg.='<div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>';
                            $msg.='<div class="modal-body">
                                        <br>
                                        <table class="table table-striped">
                                        <input  type="hidden" value="'. $data[0]->id_product.'"> '; 
                                            foreach($data_product as $key=>$value):
                                                $msg.='<tr>
                                                    <td class="text-end" width="40%">'.$key.':</td>
                                                    <td width="60%"><strong>'.$value .'</strong></td>
                                                </tr>';
                                            endforeach;
                                            $msg.='<tr>
                                                    <td class="text-end" width="40%">Image:</td>
                                                    <td width="60%"><img src="../assets/images/products/'.$data[0]->image .'"/></td>
                                                </tr>';
                                        $msg.='</table>
                                </div>';
                                $msg.='<div class="modal-footer">
                                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div> ';
                        // ===========================================================

                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                          
                        
                        
                    }
                // ===========================================================    
                
                // ===========================================================
                // criar product / create product
                    public function create_product()
                    {   
                        // dados product
                        // ===========================================================
                            $text_product_name = $_POST['text_product_name'];
                            $text_price = $_POST['text_price'];
                            $text_VAT = $_POST['text_VAT'];
                            $text_stock = $_POST['text_stock'];
                            $text_description = $_POST['text_description'];
                            $text_category_product = $_POST['text_category_product'];
                            $text_visible_product = $_POST['text_visible_product'];
                            $text_active_product = $_POST['text_active_product'];
                            $product_image = $_FILES["product_image"]["name"]; 
                        // ===========================================================


                        // ===========================================================
                        // Carregar model
                            $product = new Products(); 
                        // ===========================================================

                        // ===========================================================
                        // Registar produto
                            $product->register_product( 
                            $text_product_name ,
                            $text_price ,
                            $text_VAT ,
                            $text_stock ,
                            $text_description ,
                            $text_category_product,
                            $text_visible_product,
                            $text_active_product,
                            $product_image
                            ); 
                        // ===========================================================                          
                    }
                // ===========================================================  
                
                // ===========================================================
                // criar conteudo - modal update product
                    public function create_modal_update_product()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_product = $_POST['id_product'];
                        // // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                                $product = new Products();
                                $data = [
                                    $product->search_product($id_product)
                                ];

                                //Store::printData($data);

                                 $data_product =
                                 [
                                     'id_product' => $data[0]->id_product,
                                     'category' => $data[0]->category,
                                     'product_name' => $data[0]->product_name,
                                     'description' => $data[0]->description,
                                     'image' => $data[0]->image,
                                     'price' => $data[0]->price,
                                     'stock' => $data[0]->stock,
                                     'visible' => $data[0]->visible,
                                     'active' => $data[0]->active,
                                     'VAT' => $data[0]->VAT
                                 ]; 

                                echo json_encode($data_product);
                        // ===========================================================                       
                        
                        
                    }
                // =========================================================== 
                
                // ===========================================================
                // update / atualizar produto
                    public function update_product()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                        if(!Store::is_admin_logged_in()) {
                            Store::redirect();
                            return;
                        }
                        // ===========================================================

                        // // // ===========================================================
                        // // // validar data
                                $text_id_product = trim(strtolower($_POST['text_id_product']));
                                $text_product_name = trim(strtolower($_POST['text_product_name']));
                                $text_product_price = trim(strtolower($_POST['text_product_price']));
                                $text_VAT_product = trim(strtolower($_POST['text_VAT_product']));
                                $text_stock_product = trim($_POST['text_stock_product']);
                                $text_description_product = trim($_POST['text_description_product']);
                                $text_visible_product = trim($_POST['text_visible_product']);
                                $text_active_product = trim($_POST['text_active_product']);
                                $text_category_product = trim($_POST['text_category_product']);
                                $image = trim($_GET['c']);   
                        // // // ===========================================================

                        // ===========================================================
                        // Carregar model
                            $product = new Products(); 
                        // ===========================================================

                        // ===========================================================
                        // Registar produto
                            $product->update_product( 
                            $text_id_product,
                            $text_product_name ,
                            $text_product_price ,
                            $text_VAT_product ,
                            $text_stock_product ,
                            $text_description_product ,
                            $text_category_product,
                            $text_visible_product,
                            $text_active_product,
                            $image
                            ); 
                        // ===========================================================  
                    }
                // ===========================================================                  
                    
                // ===========================================================
                // apagar product / delete product   
                    public function delete_product()
                    {   
                        $id_product = $_POST['id_product'];
                        $adminModel = new AdminModel();
                        $adminModel->delete_product($id_product);                
                    }
                // ===========================================================                   

            // ===============================================================

            // ===============================================================
            // CRUD ENCOMENDAS  
            
                // =========================================================== 
                // Criar tabela encomendas 
                    public function criar_tabela_orders()
                    {
                        $admin = new AdminModel();
                        $total_orders_in_processing = $admin->total_orders_in_processing();
                        $total_orders_pending = $admin->total_orders_pending();

                        $msg = '';

                        // ===========================================================
                        // verifica se existe um admin logado
                            if (!Store::is_admin_logged_in()) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                    
                        // ===========================================================
                        // apresenta a lista de orders (usando filtro se for o caso)
                        // verifica se existe um filtro da query string
                            $filtros = [
                                'pendent' => 'PENDENT',
                                'processing' => 'PROCESSING',
                                'canceled' => 'CANCELED',
                                'sent' => 'SENT',
                                'completed' => 'COMPLETED',
                            ];
                        // ===========================================================

                        // ===========================================================
                        // verifica se existe um filtro da query string
                            $filtro = '';
                            if (isset($_GET['f'])) 
                            {
                                // ===========================================================
                                // verifica se a variável é uma key dos filtros
                                    if (key_exists($_GET['f'], $filtros)) 
                                    {
                                        $filtro = $filtros[$_GET['f']];
                                    }
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // vai buscar o id customer se existir na query string
                            $id_customer = null;
                            if(isset($_GET['c']))
                            {
                                // ===========================================================
                                // define id do customer desencriptado
                                    $id_customer = Store::aes_decrypt($_GET['c']);
                                // ===========================================================
                            }
                        // ===========================================================
                    
                        // ===========================================================
                        // carregar a lista de orders // criar admin model
                            $admin_model = new AdminModel();
                            $orders_list = $admin_model->orders_list($filtro, $id_customer);
                        // ===========================================================
                    
                        // ===========================================================
                        // apresenta a página das orders
                            foreach ($orders_list as $order) : 

                                $sub_array = array();
                                $sub_array[] = $order->order_date;
                                $sub_array[] = $order->order_code;
                                $sub_array[] = $order->full_name;
                                $sub_array[] = $order->email;
                                $sub_array[] = $order->telephone;
                                $sub_array[] = '<a href="?a=order_details&e='. Store::aes_encrypt($order->id_order) .'" class="nav-it">'. $order->status .'</a>';
                                $sub_array[] = $order->updated_at;
                                $sub_array[] = '<button onclick="apresentarModalVerEncomenda('. $order->id_order .')" class="btn btn-primary btn-xs update"><i class="fas fa-eye"></i></button>';
                               // $sub_array[] = '<button onclick="apresentarModalUpdateOrder('. $order->id_order.','. $order->id_customer .')" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                $sub_array[] = '<button onclick="order_delete('.$order->id_order.')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>';
                                $data[] = $sub_array;
                            endforeach; 

                            $output = array(
                                "data"				=>	$data
                            );

                        echo json_encode($output);
                    
                    }
                // ===========================================================                

                // ===========================================================
                // orders list
                    public function orders_list()
                    {
                        $msg = '';

                        // carregar model
                        // ===========================================================
                            $admin = new AdminModel();
                        // ===========================================================

                        // total orders in processing / pending
                        // ===========================================================
                            $total_orders_in_processing = $admin->total_orders_in_processing();
                            $total_orders_pending = $admin->total_orders_pending();
                        // ===========================================================

                        // ===========================================================
                        // verifica se existe um admin logado
                            if (!Store::is_admin_logged_in()) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                    
                        // ===========================================================
                        // apresenta a lista de orders (usando filtro se for o caso)
                        // verifica se existe um filtro da query string
                            $filtros = [
                                'pendent' => 'PENDENT',
                                'processing' => 'PROCESSING',
                                'canceled' => 'CANCELED',
                                'sent' => 'SENT',
                                'completed' => 'COMPLETED',
                            ];
                        // ===========================================================
                        // ===========================================================
                        // verifica se existe um filtro da query string
                            $filtro = '';
                            if (isset($_GET['f'])) 
                            {
                                // ===========================================================
                                // verifica se a variável é uma key dos filtros
                                    if (key_exists($_GET['f'], $filtros)) 
                                    {
                                        $filtro = $filtros[$_GET['f']];
                                    }
                                // ===========================================================
                            }
                        // ===========================================================
                        // ===========================================================
                        // vai buscar o id customer se existir na query string
                            $id_customer = null;
                            if(isset($_GET['c']))
                            {
                                // ===========================================================
                                // define id do customer desencriptado
                                    $id_customer = Store::aes_decrypt($_GET['c']);
                                // ===========================================================
                            }
                        // ===========================================================
                    
                        // ===========================================================
                        // carregar a lista de orders // criar admin model
                            $admin_model = new AdminModel();
                            $orders_list = $admin_model->orders_list($filtro, $id_customer);
                        // ===========================================================
                    
                        // ===========================================================
                        // apresenta a página das orders
                                $data = [
                                    'orders_list' => $orders_list,
                                    'filtro' => $filtro
                                ];                        

                            $msg .= '
                            <h3>Lista de orders '; 
                            $msg .= $filtro != " " ? $filtro : " ";
                            
                            $msg .= '</h3>
                            <hr>
                                <div class="row">
                                    <div class="col">
                                        
                                    </div>

                                    <div class="col">
                                        
                                    </div>
                                        
                                    <div class="col">';

                                        $f = '';
                                        if (isset($_GET['f'])) {
                                            $f = $_GET['f'];
                                        }

                                        $msg .= '<div class="mb-3 row">';
                                            $msg .='</div>
                                            </div>
                                        </div>';
                            
                                    $msg .= '<small>
                                        <table class="table table-striped" id="tabela-orders">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Código</th>
                                                    <th>Nome Cliente</th>
                                                    <th>Email</th>
                                                    <th>telephone</th>
                                                    <th>Status</th>
                                                    <th>Atualizado em</th>
                                                    <th class="text-center">Ver</th>
                                                    <th class="text-center">Apagar</th>                                                
                                                </tr>
                                            </thead>';

                                            $msg .= '<tfoot class="table-dark">
                                            <tr>
                                                <th>Data</th>
                                                <th>Código</th>
                                                <th>Nome Cliente</th>
                                                <th>Email</th>
                                                <th>telephone</th>
                                                <th>Status</th>
                                                <th>Atualizado em</th>
                                                <th class="text-center">Ver</th>
                                                <th class="text-center">Apagar</th>                                                
                                            </tr>
                                        </tfoot>';
                                    $msg .= '</table>
                                    </small>';
                            

                                $msg .= '<hr>
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>';

                                $msg .= '<div id="grafico"> </div>
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                        </div>
                                    </div>
                                </div>
                            </div>';                        

                            echo json_encode($msg);
                        // ===========================================================
                    }
                // ===========================================================  

                // ===========================================================
                // cria conteúdo - modal ver orders
                    public function create_modal_ver_order()
                    {
                            // ===========================================================
                            // id vem por POST
                                $id_order = $_POST['id_order'];
                            // ===========================================================
                            
                            // ===========================================================
                            // vai buscar os dados da encomenda
                                $ADMIN = new AdminModel();
                                $data = [ 
                                    $ADMIN->search_order($id_order) 
                                ];
                            // ===========================================================
                                
                                // Dados da encomenda
                                // ===========================================================
                                    $data_order =
                                    [
                                        'id_order' => $data[0][0]->id_order,
                                        'order_code' => $data[0][0]->order_code,
                                        'id_customer' => $data[0][0]->id_customer,
                                        'full_name' => $data[0][0]->full_name,
                                        'order_date' => $data[0][0]->order_date,
                                        'address' => $data[0][0]->address,
                                        'city' => $data[0][0]->city,
                                        'email' => $data[0][0]->email,
                                        'telephone' => $data[0][0]->telephone,
                                        'status' => $data[0][0]->status,
                                    ];
                                // ===========================================================

                                // ===========================================================  
                                // Construir msg modal 
                            
                                    $msg = '';
                                
                                    $msg.='<div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ver Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                                    $msg.='<div class="modal-body">
                                            <br>
                                            <table class="table table-striped">
                                            <input  type="hidden" value="'. $data[0][0]->id_order.'"> '; 
                                                    foreach($data_order as $key=>$value):
                                                        $msg.='<tr>
                                                            <td class="text-end" width="40%">'.$key.':</td>
                                                            <td width="60%"><strong>'.$value .'</strong></td>
                                                        </tr>';
                                                    endforeach;
                                            $msg.='</table>
                                        </div>';
                                        $msg.='<div class="modal-footer">
                                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div> ';
                                // ===========================================================

                                // ===========================================================
                                // Mostrar msg modal 
                                    echo json_encode($msg);
                                // ========================================================                      
                    }
                // ===========================================================  
                
                // ===========================================================
                // criar conteudo - modal update product
                    public function create_modal_update_order()
                    {
                        // ===========================================================
                        // id vem por POST
                            $id_order = $_POST['id_order'];
                        // ===========================================================                        
                    
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                                $order = new Orders();
                                $data_order = [
                                    $order->search_order($id_order)
                                ];

                            Store::printData($data_order);

                                $data_order =
                                [
                                    'id_order' => $data_order[0]->id_order,
                                    'id_customer' => $data_order[0]->id_customer,
                                    'order_date' => $data_order[0]->order_date,
                                    'address' => $data_order[0]->address,
                                    'city' => $data_order[0]->city,
                                    'email' => $data_order[0]->email,
                                    'telephone' => $data_order[0]->telephone,
                                    'order_code' => $data_order[0]->order_code,
                                    'status' => $data_order[0]->status,
                                    'VAT' => $data_order[0]->VAT
                                ]; 

                        // //         echo json_encode($data_product);
                        // // // ===========================================================      
                        // // echo json_encode($data);                 
                    }
                // ===========================================================                 
                
                // ===========================================================
                // apagar order / delete order   
                    public function delete_order()
                    {   
                        $id_order = $_POST['id_order'];
                        $adminModel = new AdminModel();
                        $adminModel->delete_order($id_order);                
                    }
                // ===========================================================    
                
                // ===========================================================
                // detalhe da order /  details orders
                public function order_details()
                {
                    // ===========================================================
                    // verifica se existe um admin logado
                        if (!Store::is_admin_logged_in()) 
                        {
                            // ===========================================================
                            // redireciona para a página inicial do backoffice
                                Store::redirect('home_page', true);
                                return;
                            // ===========================================================
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // buscar o id_order passado na url
                        $id_order = null;
                        if (isset($_GET['e'])) 
                        {
                            // ===========================================================
                            // definir o id da order desencriptado
                                $id_order = Store::aes_decrypt($_GET['e']);
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // avaliar tipo de dados do id da encoemnda
                        if (gettype($id_order) != 'string') 
                        {
                            // ===========================================================
                            // redireciona para a página inicial do backoffice
                                Store::redirect('home_page', true);
                                return;
                            // ===========================================================
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    //carregar os dados da order selecionada
                        $admin_model = new AdminModel(); // criar admin model
                        $order = $admin_model->search_order_details($id_order);
                    // ===========================================================
                    
                    // ===========================================================
                    //apresentar os dados por forma a poder ver os detalhes e alterar o seu status
                        $data = $order;
                        Store::admin_layout([
                            'admin/layouts/html_header',
                            'admin/layouts/header',
                            'admin/order_detail',
                            'admin/layouts/footer',
                            'admin/layouts/html_footer',
                        ], $data);
                    // ===========================================================
                }
            // ===========================================================                
            
            // ===============================================================

            // ===============================================================
            // CRUD PROFILE ADMIN

                // ===========================================================
                // modal profile ADMIN
                    public function profile_admin_modal()
                    {   
                        //Store::printData($_SESSION['admin']);

                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_Admin_logged_in()) 
                            {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================    

                        // ===========================================================
                        // buscar informações do Admin
                            $adminModel = new AdminModel();
                            $dtemp = $adminModel->search_admin($_SESSION['admin']);

                            //echo json_encode($dtemp);

                            //Store::printData($dtemp);
                        
                            $data_admin = 
                            [
                                'Email' => $dtemp->user,
                                'pass' => $dtemp->pass,
                                'Nome completo' => $dtemp->full_name,
                                'Morada' => $dtemp->address,
                                'City' => $dtemp->city,
                                'Telephone' => $dtemp->telephone,
                                'active' => $dtemp->active,
                                'gender' => $dtemp->gender                                
                            ];

                            // ===========================================================  
                            // Construir msg modal 
                            
                            $msg = '';
                            
                            $msg.='<div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Profile Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>';

                            $msg.='<div class="modal-body">
                                        <br>
                                        <table class="table table-striped">';                                   
                                            foreach($data_admin as $key=>$value):
                                                $msg.='<tr>
                                                    <td class="text-end" width="40%">'.$key.':</td>
                                                    <td width="60%"><strong>'.$value .'</strong></td>
                                                </tr>';
                                            endforeach;
                                            $msg.='<tr>
                                            <td class="text-end" width="40%">Image:</td>
                                            <td width="60%"><img src="../assets/images/products/'.$dtemp->image .'"/></td>
                                        </tr>';
                                        $msg.='</table>
                                </div>';

                                $msg.='<div class="modal-footer">
                                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                        

                    }
                // =========================================================== 

                // ===========================================================
                // AUTENTICAÇÃO 
                    // ===========================================================
                    // admin login
                        public function admin_login()
                        {
                            // ===========================================================
                            // verifica se já existe um admin logado /redireccionamento
                                if (Store::is_admin_logged_in()) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // apresenta a pag. de login
                                Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    'admin/login_form',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer',
                                ]);
                            // ===========================================================

                        }
                    // ===========================================================

                    // ===========================================================
                    // admin login submit
                        public function admin_login_submit()
                        {
                            // ===========================================================
                            // verifica se já existe um admin logado /redireccionamento
                                if (Store::is_admin_logged_in()) {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice                    
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================    
                            
                            // ===========================================================
                            // verifica se foi efetuado o post do formulário de login do admin
                                if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                                    Store::redirect('home_page', true);
                                    return;
                                }
                            // ===========================================================
                            
                            // ===========================================================
                            // validar se os campos vieram corretamente preenchidos
                                if (
                                    !isset($_POST['text_admin']) ||
                                    !isset($_POST['text_pass']) ||
                                    !filter_var(trim($_POST['text_admin']), FILTER_VALIDATE_EMAIL)
                                ) 
                                {   
                                    // ===========================================================
                                    // erro de preenchimento do formulário / redireccionamento
                                        $_SESSION['erro'] = 'Login inválido';
                                        Store::redirect('admin_login', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // prepara os dados para o model
                                $admin = trim(strtolower($_POST['text_admin']));
                                $pass = trim($_POST['text_pass']);
                            // ===========================================================
                            
                            // ===========================================================
                            // carrega o model e verifica se login é válido
                                $admin_model = new AdminModel();
                                $resultado = $admin_model->validate_login($admin, $pass);
                            // ===========================================================

                            // ===========================================================
                            // analisa o resultado
                                if (is_bool($resultado)) 
                                {
                                    // ===========================================================
                                    // login inválido / redireciona para a pagina de login
                                        $_SESSION['erro'] = 'Login inválido';
                                        Store::redirect('login', true);
                                        return;
                                    // ===========================================================
                                } 
                                else 
                                {
                                    // ===========================================================
                                    // login válido. Coloca os dados na sessão do admin
                                        $_SESSION['admin'] = $resultado->id_admin;
                                        $_SESSION['admin_user'] = $resultado->user;
                                        $_SESSION['admin_full_name'] = $resultado->full_name;

                                    // ===========================================================

                                    // ===========================================================
                                    // redirecionar para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                    // ===========================================================
                                }
                        }
                    // ===========================================================

                    // ===========================================================
                    // admin logout
                        public function admin_logout()
                        {
                            // ===========================================================
                            // faz o logout do admin da sessão
                                unset($_SESSION['admin']);
                                unset($_SESSION['admin_user']);
                            // ===========================================================

                            // ===========================================================
                            // redireciona para a página inicial do backoffice
                                Store::redirect('home_page', true);
                            // ===========================================================
                        }
                    // ===========================================================
                // ===========================================================
    
            // ===============================================================      
            
        }
    // ===========================================================




