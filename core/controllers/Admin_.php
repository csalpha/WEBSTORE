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
            // ===========================================================
            // usuário admin: admin@admin.com
            // pass:         123456
            // ===========================================================



            // ===========================================================
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
            // ===========================================================   
            
            // ===========================================================
            // index
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


                    // // ===========================================================
                    // // verifica se não existe um admin logado /redireccionamento
                    //     if (!Store::is_admin_logged_in()) 
                    //     {
                    //         // ===========================================================
                    //         // redireciona para a página de admin do backoffice
                    //             Store::redirect('admin_login', true);
                    //             return;
                    //         // ===========================================================
                    //     }
                    // // ===========================================================

                    // // ===========================================================
                    // // verificar se existem orders em estado PENDENT
                    //     $ADMIN = new AdminModel();
                    //     $total_orders_pending = $ADMIN->total_orders_pending();
                    //     $total_orders_in_processing = $ADMIN->total_orders_in_processing();
                    // // ===========================================================
                    
                    // // ===========================================================
                    // // já existe um admin logado / apresenta a pagina inicial
                    //     $data = [
                    //         'total_orders_pending' => $total_orders_pending,
                    //         'total_orders_in_processing' => $total_orders_in_processing
                    //     ];

                    //     Store::admin_layout([
                    //         'admin/layouts/html_header',
                    //         'admin/layouts/header',
                    //         'admin/home_admin',
                    //         'admin/layouts/footer',
                    //         'admin/layouts/html_footer',
                    //     ], $data);
                    // // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // ADMIN

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
                                $sub_array[] = '<button id="botao_delete" onclick="admin_dalete('. $admin->id_admin .')" class="btn btn-danger btn-xs delete" name="delete"><i class="fa fa-trash"></i></button>';
                                //$sub_array[] = '<button id="botao_update" value="'. $admin->id_admin .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                //$sub_array[] = '<a href="?a=delete_admin&id_admin='. Store::aes_encrypt($admin->id_admin) .'" 
                                //class="btn btn-danger btn-xs delete" name="delete" id="'. $admin->id_admin .'"><i class="fa fa-trash"></i></a>';
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
                                <hr>
                                    <div class="row">
                                        <div class="col">
                                        <!-- <button id="add_button_admin" onclick="apresentarModalAddAdmin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  -->
                                            <button type="button" id="botao_adicionar" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>

                                        </div>
                                            <div class="col">';
                                            
                                            $f = '';
                                            if (isset($_GET['f'])) 
                                            {
                                                $f = $_GET['f'];
                                            }
                                        
                                            $msg .='<div class="mb-3 row">
                                                <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                                <div class="col-sm-8">';

                                                $msg .='<select id="combo-status" class="form-control" onchange="definir_filtro()">';

                                                $msg .='<option value=""';
                                                $msg .= $f == " " ? "selected" : " ";
                                                $msg .='class="nav-it"></option>';

                                                $msg .='<option value="activo"';
                                                $msg .= $f == "activo" ? "selected" : " ";
                                                $msg .='class="nav-it">Activo</option>';

                                                $msg .='<option value="inactivo"';
                                                $msg .= $f == "inactivo" ? "selected" : " "; 
                                                $msg .='class="nav-it">Inactivo</option>
                                            </select>';
                                                $msg .='</div>
                                            </div>
                                            </div>
                                    </div>';                          

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
                
                // ===========================================================
                // lista admins / admins list   
                    public function admins_list_sem_ajax()
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
                        <hr>
                            <div class="row">
                                <div class="col">
                                <!-- <button id="add_button_admin" onclick="apresentarModalAddAdmin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  -->
                                    <button type="button" id="botao_adicionar" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>

                                </div>
                                    <div class="col">';
                                    
                                    $f = '';
                                    if (isset($_GET['f'])) 
                                    {
                                        $f = $_GET['f'];
                                    }
                                
                                    $msg .='<div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                        <div class="col-sm-8">';

                                        $msg .='<select id="combo-status" class="form-control" onchange="definir_filtro()">';

                                        $msg .='<option value=""';
                                        $msg .= $f == " " ? "selected" : " ";
                                        $msg .='class="nav-it"></option>';

                                        $msg .='<option value="activo"';
                                        $msg .= $f == "activo" ? "selected" : " ";
                                        $msg .='class="nav-it">Activo</option>';

                                        $msg .='<option value="inactivo"';
                                        $msg .= $f == "inactivo" ? "selected" : " "; 
                                        $msg .='class="nav-it">Inactivo</option>
                                    </select>';
                                        $msg .='</div>
                                    </div>
                                    </div>
                            </div>';  

                        if (count($admins) == 0) : 
                            $msg .='<p class="text-center text-muted">Não existem customer registados.</p>';
                        else : 
                            $msg .='<small>
                                    <table class="table table-sm" id="tabela-admins">
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
                                                <!-- <th class="text-center">Ver Admin</th> -->
                                                <th class="text-center">Editar</th>
                                                <th class="text-center">Apagar</th>
                                            </tr>
                                        </thead>';
        
                                                $msg .='</table>
                                                    </small>';
                                                endif;  

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

                        echo json_encode($msg);

                    }
                // ===========================================================
            
                // ===========================================================
                // detalhe admin / admin detail
                    public function admin_details()
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
                        // verifica se existe um id_customer na query string
                            if (!isset($_GET['c'])) 
                            {   
                                // ===========================================================
                                // redireciona para a página inicial do backoffice                   
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // Desencriptar id do admin
                            $id_admin = Store::aes_decrypt($_GET['c']);
                        // ===========================================================
                        
                        // ===========================================================
                        // verifica se o id_admin é válido
                            if (empty($id_admin)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // criar Admin
                            $ADMIN = new AdminModel();
                        // ===========================================================

                        // ===========================================================
                        // apresenta a página das orders
                            $data = [
                                // ===========================================================
                                // buscar os dados do customer
                                    'data_admin' => $ADMIN->search_admin($id_admin),
                                    /*'total_orders' => $ADMIN->total_orders_customer($id_admin)*/
                                // ===========================================================
                            ];

                            $_SESSION['admin_temp'] = $id_admin;

                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                //'admin/navigation_profile',
                                'admin/admin_details',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================
                
                // ===========================================================
                // admin alterar estado / admin change status
                    public function admin_change_status()
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
                        //buscar o id do admin
                            $id_customer = null;
                            if (isset($_GET['e'])) 
                            {
                                // ===========================================================
                                // Desencriptar o id do admin
                                    $id_admin = Store::aes_decrypt($_GET['e']);
                                // ===========================================================
                            }
                        // ===========================================================    

                        // ===========================================================
                        // Avaliar o tipo de dados do id do admin
                            if (gettype($id_admin) != 'string') 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // buscar o novo estado
                            $estado = null;
                            if (isset($_GET['s'])) 
                            {
                                $estado = $_GET['s'];
                            }

                            if (!in_array($estado, active)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // regras de negócio para gerir a order (novo estado)
                        
                        // ===========================================================
                        // atualizar o estado da order na base de dados
                            $admin_model = new AdminModel(); // criar admin model
                            $admin_model->update_status_admin($id_admin, $estado);
                        // ===========================================================

                        // ===========================================================
                        // redireciona para a página da própria order
                            Store::redirect('admins_list&e='.$_GET['e'], true);
                        // ===========================================================
                    }
                // ===========================================================

                // ===========================================================
                // alterar dados admin  / change admin data 
                    public function change_admin_data()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                            // ===========================================================
                            // Desencriptar id
                                $id_admin = Store::aes_decrypt($_GET['c']);
                            // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                'data_admin' => $ADMIN->search_admin($id_admin)
                            ];

                            

                            //Store::printData($data);
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    'admin/change_admin_data',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer', 
                            ], $data);
                        // ===========================================================                
                    }
                // =========================================================== 

                // ===========================================================
                // alterar dados admin modal  / change admin data modal
                    public function change_admin_data_modal()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

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

                        //    Store::printData($data);

                            echo json_encode($data[0]);               
                    }
                // ===========================================================   
                
                // ===========================================================
                // ver dados admin modal  / change admin data modal
                    public function change_admin_data_modal_admin()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            // // if(!Store::is_admin_logged_in()) {
                            // //     Store::redirect();
                            // //     return;
                            // // }
                        // ===========================================================

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
                                //'pass' => $dtemp->pass,
                                'id_admin' => $data[0]->id_admin,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone,
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
                                            <div class="col">
                                                <a onclick="apresentarModalUpdateAdmin('. $data[0]->id_admin.')" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-edit"></i>Alterar Dados</a>
                                            </div>
                                            
                                            <div class="col">
                                                <a onclick="apresentaModalAlterarPassAdmin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-key"></i>Alterar Password</a>
                                            </div>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                          
                         
                         
                    }
                // ===========================================================    

                // ===========================================================
                // ver dados admin modal  / change admin data modal
                    public function change_customer_data_modal_admin()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            // // if(!Store::is_admin_logged_in()) {
                            // //     Store::redirect();
                            // //     return;
                            // // }
                        // ===========================================================

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

                        //Store::printData($data[0]->email);

                            $data_customer =
                            [
                                'Email' => $data[0]->email,
                                //'pass' => $dtemp->pass,
                                'id_customer' => $data[0]->id_customer,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone,
                                //'image' => $data[0]->image

                            ];

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
                                            <div class="col">
                                                <a onclick="apresentarModalUpdateAdmin('. $data[0]->id_customer.')" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-edit"></i>Alterar Dados</a>
                                            </div>
                                            
                                            <div class="col">
                                                <a onclick="apresentaModalAlterarPassAdminAlfa('. $data[0]->id_customer.') " class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-key"></i>Alterar Password</a>
                                            </div>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                          
                        
                        
                    }
                // ===========================================================                  
                
                // ===========================================================
                // alterar dados admin modal  / change admin data modal
                    public function change_admin_data_modal_admin_alfa()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            // // if(!Store::is_admin_logged_in()) {
                            // //     Store::redirect();
                            // //     return;
                            // // }
                        // ===========================================================

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
                                'id_admin' => $data[0]->id_admin,
                                'Email' => $data[0]->user,
                                //'pass' => $dtemp->pass,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone

                            ];

                            // ===========================================================
                            // Construir modal       
                                $msg = '';

                                $msg .='<div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                            
                                $msg .='<div class="modal-body">
                                            <div id="msg_dados">
                                                        
                                            </div>
                                            
                                            <form enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="email" maxlength="50" id="text_email_admin" name="text_email_admin" class="form-control" required value="'. $data[0]->user .'">
                                                    <input type="text" maxlength="50" id="text_id_admin" name="text_id_admin" class="form-control" required value="'. $_POST['id_admin'] .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>Full Name:</label>
                                                    <input type="text" maxlength="50" id="text_full_name_admin" name="text_full_name_admin" class="form-control" required value="'. $data[0]->full_name .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>address:</label>
                                                    <input type="text" maxlength="100" id="text_address_admin" name="text_address_admin" class="form-control" required value="'. $data[0]->address .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>city:</label>
                                                    <input type="text" maxlength="50" id="text_city_admin" name="text_city_admin" class="form-control" required value="'. $data[0]->city .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>telephone:</label>
                                                    <input type="text" maxlength="20" id="text_telephone_admin" name="text_telephone_admin" class="form-control" value="'. $data[0]->telephone .'">
                                                </div>

                                                <div class="form-group">    
                                                    <label>Foto</label>
                                                    <input type="file" name="text_image_admin" id="text_image_admin" value="'. $data[0]->image .'" />
                                                    <span id="text_image_admin" name="text_image_admin"></span>
                                                    <div class="col-9"><img src="../assets/images/products/'. $data[0]->image .'" class="img-fluid" width="40px"></div>
                                                </div> 

                                            </form>
                                            
                                        </div>';

                                    /* https://www.youtube.com/watch?v=r-6OJgNNa3s&list=PLXik_5Br-zO9Z8l3CE8zaIBkVWjHOboeL&index=84&ab_channel=Jo%C3%A3oRibeiro

                                        upload de imagens */

                                    $msg.='<div class="modal-footer">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>';

                                echo json_encode($msg);
                        // ===========================================================                       
                        
                        
                    }
                // ===========================================================      
            
                // ===========================================================
                // alterar dados admin modal  / change admin data modal
                    public function change_customer_data_modal_admin_alfa()
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
                                'id_customer' => $data[0]->id_customer,
                                'Email' => $data[0]->email,
                                //'pass' => $dtemp->pass,
                                'Nome completo' => $data[0]->full_name,
                                'Morada' => $data[0]->address,
                                'City' => $data[0]->city,
                                'Telephone' => $data[0]->telephone

                            ];

                            // ===========================================================
                            // Construir modal       
                                $msg = '';

                                $msg .='<div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                            
                                $msg .='<div class="modal-body">
                                            <div id="msg_dados">
                                                        
                                            </div>
                                            
                                            <form enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="email" maxlength="50" id="text_email_admin_add" name="text_email_admin_add" class="form-control" required value="'. $data[0]->user .'">
                                                    <input type="text" maxlength="50" id="text_id_admin" name="text_id_admin" class="form-control" required value="'. $_POST['id_admin'] .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>Full Name:</label>
                                                    <input type="text" maxlength="50" id="text_full_name_admin_add" name="text_full_name_admin_add" class="form-control" required value="'. $data[0]->full_name .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>address:</label>
                                                    <input type="text" maxlength="100" id="text_address_admin_add" name="text_address_admin_add" class="form-control" required value="'. $data[0]->address .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>city:</label>
                                                    <input type="text" maxlength="50" id="text_city_admin_add" name="text_city_admin_add" class="form-control" required value="'. $data[0]->city .'">
                                                </div>

                                                <div class="form-group">
                                                    <label>telephone:</label>
                                                    <input type="text" maxlength="20" id="text_telephone_admin_add" name="text_telephone_admin_add" class="form-control" value="'. $data[0]->telephone .'">
                                                </div>

                                                

                                                <div class="form-group">    
                                                    <label>Foto</label>
                                                    <input type="file" name="user_image_add" id="user_image_add" value="'. $data[0]->image .'" />
                                                    <span id="text_image_admin" name="user_uploaded_image"></span>
                                                    <div class="col-9"><img src="../assets/images/products/'. $data[0]->image .'" class="img-fluid" width="40px"></div>
                                                </div> 

                                            
                                            
                                        </div>';


                                    $msg.='<div class="modal-footer">
                                                <input type="hidden" name="user_id" id="user_id" />
                                                <input type="hidden" name="operation" id="operation" />
                                                <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                                <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                           </div>';

                               // echo json_encode($msg);
                        // ===========================================================                       
                        
                        
                    }
                // ===========================================================             
            

                
                // ===========================================================
                // alterar dados pessoais submit / change personal data submit
                    // // public function change_admin_data_submit_modal()
                    // // {
                    // //     // ===========================================================
                    // //     // verifica se existe um utilizador logado
                    // //         if(!Store::is_admin_logged_in()) {
                    // //             Store::redirect();
                    // //             return;
                    // //         }
                    // //     // ===========================================================  
                        
                    // //     // ===========================================================
                    // //     // verifica se existiu submissão de formulário
                    // //         if($_SERVER['REQUEST_METHOD'] != 'POST'){
                    // //            Store::redirect();
                    // //            return;
                    // //         }
                    // //     // ===========================================================    
                        
                    // //     // ===========================================================
                    // //     // validar data
                    // //         $id_admin = trim(strtolower($_POST['text_id_admin_update']));
                    // //         $email = trim(strtolower($_POST['text_email_update']));
                    // //         $full_name = trim($_POST['text_full_name_update']);
                    // //         $address = trim($_POST['text_address_update']);
                    // //         $city = trim($_POST['text_city_update']);
                    // //         $telephone = trim($_POST['text_telephone_update']);
                    // //         $image = trim($_POST['user_image']);
                    // //     // =========================================================== 

                    // //     // ===========================================================
                    // //     // validar se é email válido
                    // //        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    // //             $_SESSION['erro'] = "Endereço de email inválido.";
                    // //             $this->change_admin_data();
                    // //             return;
                    // //         }
                    // //     // ===========================================================   
                        
                    // //     // ===========================================================
                    // //     // validar os restantes campos
                    // //         if(empty($full_name) || empty($address) || empty($city) ){
                    // //             $_SESSION['erro'] = "Preencha corretamente o formulário.";
                    // //             $this->change_admin_data();
                    // //             return;
                    // //         }
                    // //     // ===========================================================                      
                        
                    // //     // ===========================================================
                    // //     // validar se este email já existe noutra conta de customer
                    // //         $admin = new AdminModel(); // Carregar model
                    // //     // ===========================================================                        
                        
                    // //     // ===========================================================
                    // //     // atualizar os data do customer na base de data
                    // //         $admin->update_admin($id_admin, $email, $full_name, $address, $city, $telephone, $image);
                    // //     // ===========================================================                        
                
                    // //     // ===========================================================
                    // //     // redirecionar para a página do profile
                    // //         Store::redirect('admins_list', true);
                    // //     // ===========================================================                   
                    // // }
                // ===========================================================                 
                
                // ===========================================================
                // alterar password / change password
                    // // public function change_password_admin()
                    // // {   
                    // //     // ===========================================================
                    // //     // verifica se existe um utilizador logado
                    // //         if(!Store::is_admin_logged_in()) {
                    // //             Store::redirect();
                    // //             return;
                    // //         } 
                    // //     // ===========================================================   
                        
                    // //     // ===========================================================
                    // //     // verifica se existe um id_customer na query string
                    // //      /*   if (!isset($_GET['c'])) 
                    // //         {   
                    // //             // ===========================================================
                    // //             // redireciona para a página inicial do backoffice                   
                    // //                 Store::redirect('home_page', true);
                    // //                 return;
                    // //             // ===========================================================
                    // //         }*/
                    // //     // ===========================================================
                    
                    // //     // ===========================================================
                    // //     // Desencriptar id do admin
                    // //         $id_admin = $_SESSION['admin_temp'];
                    // //     // ===========================================================    
                        
                    // //     // ===========================================================
                    // //     // vai buscar os data pessoais do Admin
                    // //         $ADMIN = new AdminModel();
                    // //         $data = [
                    // //             'data_admin' => $id_admin
                    // //         ];

                    // //         //Store::printData($data);
                    // //     // ===========================================================                        
                        
                    // //     // ===========================================================
                    // //     // apresentação da página de alteração da password
                    // //         Store::admin_layout([
                    // //             'admin/layouts/html_header',
                    // //             'admin/layouts/header',
                    // //             'admin/change_password_admin',
                    // //             'admin/layouts/footer',
                    // //             'admin/layouts/html_footer',
                    // //         ], $data);
                    // //     // ===========================================================
                    // // }
                // ===========================================================         

                // ===========================================================
                // criar admin modal / create admin modal  
                    public function create_admin_modal()
                    {   
                        
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
                // apagar admin / delete admin   
                    public function delete_admin()
                    {   

                       $id_admin = $_POST['id_admin'];

                       //Store::printData($id_admin);
                    
                        // ===========================================================
                        // verifica na base de data se existe admin com mesmo email
                            $adminModel = new AdminModel();

                            $adminModel->delete_admin($id_admin);                
                    }
                // ===========================================================                

            // ===========================================================

            // ===========================================================
            // profile DO Admin / Admin PROFILE
                // ===========================================================
                // profile
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
                                //'pass' => $dtemp->pass,
                                'Nome completo' => $dtemp->full_name,
                                'Morada' => $dtemp->address,
                                'City' => $dtemp->city,
                                'Telephone' => $dtemp->telephone

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
                                            <div class="col">
                                                <a onclick="apresentarModalUpdateAdmin('.$dtemp->id_admin .')" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-edit"></i>Alterar Dados</a>
                                            </div>
                                            
                                            <div class="col">
                                                <a onclick="apresentaModalAlterarPassAdmin() " class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-key"></i>Alterar Password</a>
                                            </div>
                                        </div> ';
                        // ===========================================================
                        
                        // ===========================================================
                        // Mostrar msg modal 
                            echo json_encode($msg);
                        // ===========================================================                        

                            // // $data = 
                            // // [
                            // //     'data_admin' => $data_admin
                            // // ];
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            // // Store::admin_layout(
                            // // [
                            // //     'admin/layouts/html_header',
                            // //     'admin/layouts/header',
                            // //     'admin/profile_admin',
                            // //     'admin/layouts/footer',
                            // //     'admin/layouts/html_footer',
                            // // ], $data);
                        // ===========================================================
                    }
                // ===========================================================      
                
                // ===========================================================
                // alterar password modal / change password modal
                    public function change_password_admin_modal()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================  
                        
                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            $msg .='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar password Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">

                                        <form enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label>pass atual:</label>
                                                <input type="password" maxlength="30" id="text_pass_atual_admin" name="text_pass_atual_admin" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Nova pass:</label>
                                                <input type="password" maxlength="30" id="text_nova_pass_admin" name="text_nova_pass_admin" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Repetir nova pass:</label>
                                                <input type="password" maxlength="30"  id="text_repetir_nova_pass_admin" name="text_repetir_nova_pass_admin" class="form-control" required>
                                            </div>

                                        </form>

                                        <div id="msg">
                                        
                                        </div>

                                    </div>';

                                $msg.='<div class="modal-footer">
                                <a class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal" >Cancelar</a>
                                <button onclick="change_password_submit_modal_admin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                Save
                                </button>
                                </div>';

                            echo json_encode($msg);
                        // ===========================================================
                    }
                // ===========================================================  
                
                // ===========================================================
                // alterar password modal / change password modal
                    public function change_password_admin_modal_alfa()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================  
                        
                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            $msg .='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar password Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">

                                    <form enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>pass atual:</label>
                                            <input type="password" maxlength="30" id="text_pass_atual_admin" name="text_pass_atual_admin" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nova pass:</label>
                                            <input type="password" maxlength="30" id="text_nova_pass_admin" name="text_nova_pass_admin" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Repetir nova pass:</label>
                                            <input type="password" maxlength="30"  id="text_repetir_nova_pass_admin" name="text_repetir_nova_pass_admin" class="form-control" required>
                                        </div>
                                    
                                    </form>

                                        <div id="msg">
                                        
                                        </div>

                                    </div>';

                                $msg.='<div class="modal-footer">
                                <a class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal" >Cancelar</a>
                                <button onclick="change_password_submit_modal_admin_alfa('.$_POST['id_admin'].')" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                Save
                                </button>
                                </div>';

                            echo json_encode($msg);
                        // ===========================================================
                    }
                // ===========================================================                   
                
                // ===========================================================
                // change password submit_modal admin
                    public function change_password_submit_modal_admin()
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
                            $pass_atual_admin = trim(json_decode($_POST['text_pass_atual_admin']));
                            $nova_pass_admin = trim(json_decode($_POST['text_nova_pass_admin']));
                            $repetir_nova_pass_admin = trim(json_decode($_POST['text_repetir_nova_pass_admin']));
                        // ===========================================================
                        
                        // ===========================================================
                        // carregar model
                            $ADMIN = new AdminModel();
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se a nova pass vem com dados
                            if(strlen($nova_pass_admin) < 6)
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
                        else if($nova_pass_admin != $repetir_nova_pass_admin)
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
                            else if(!$ADMIN->check_if_password_is_correct_admin($_SESSION['admin'], $pass_atual_admin))
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
                            else if($pass_atual_admin == $nova_pass_admin)
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
                                    $ADMIN->update_new_password_admin($_SESSION['admin'], $nova_pass_admin);
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
                // change password submit_modal admin
                    public function change_password_submit_modal_admin_alfa()
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
                            $pass_atual_admin = trim(json_decode($_POST['text_pass_atual_admin']));
                            $nova_pass_admin = trim(json_decode($_POST['text_nova_pass_admin']));
                            $repetir_nova_pass_admin = trim(json_decode($_POST['text_repetir_nova_pass_admin']));
                        // ===========================================================
                        
                        // ===========================================================
                        // carregar model
                            $ADMIN = new AdminModel();
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se a nova pass vem com data
                            if(strlen($nova_pass_admin) < 6)
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
                        else if($nova_pass_admin != $repetir_nova_pass_admin)
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
                            else if(!$ADMIN->check_if_password_is_correct_admin($_SESSION['admin'], $pass_atual_admin))
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
                            else if($pass_atual_admin == $nova_pass_admin)
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
                                    $ADMIN->update_new_password_admin($_SESSION['admin'], $nova_pass_admin);
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

                // ===================================================================
                // alterar data pessoais modal / change personal data modal
                    public function change_personal_data_modal_admin()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais
                            $ADMIN = new AdminModel();
                            $data = $ADMIN->search_admin($_SESSION['admin']);
                        // ===========================================================

                        //Store::printData($data);

                        // ===========================================================
                        // Construir modal       
                            $msg = '';

                            $msg .='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>';
                        
                            $msg .='<div class="modal-body">

                                        <div id="msg_dados">
                                        </div>

                                        <form enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input type="email" maxlength="50" id="text_email_admin" name="text_email_admin" class="form-control" required value="'. $data->user .'">
                                            </div>

                                            <div class="form-group">
                                                <label>Full Name:</label>
                                                <input type="text" maxlength="50" id="text_full_name_admin" name="text_full_name_admin" class="form-control" required value="'. $data->full_name .'">
                                            </div>

                                            <div class="form-group">
                                                <label>address:</label>
                                                <input type="text" maxlength="100" id="text_address_admin" name="text_address_admin" class="form-control" required value="'. $data->address .'">
                                            </div>

                                            <div class="form-group">
                                                <label>city:</label>
                                                <input type="text" maxlength="50" id="text_city_admin" name="text_city_admin" class="form-control" required value="'. $data->city .'">
                                            </div>

                                            <div class="form-group">
                                                <label>telephone:</label>
                                                <input type="text" maxlength="20" id="text_telephone_admin" name="text_telephone_admin" class="form-control" value="'. $data->telephone .'">
                                            </div>

                                            <div class="form-group">    
                                                <label>Foto</label>
                                                <input type="file" name="text_image_admin" id="text_image_admin" value="'. $data->image .'" />
                                                <span id="text_image_admin" name="text_image_admin"></span>
                                                <div class="col-9"><img src="../assets/images/costumers/'. $data->image .'" class="img-fluid" width="40px"></div>
                                            </div>                                         
                                        </form>
                                    </div>';

                                $msg.='<div class="modal-footer">
                                            <a href="" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100" data-bs-dismiss="modal">Cancelar</a>
                                            <button  onclick="change_personal_data_submit_modal_admin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                Salvar
                                            </button>
                                    </div>
                                   ';

                            echo json_encode($msg);
                        // ===========================================================            
                    }
                // =================================================================== 

                // ===================================================================
                // alterar data pessoais submit modal / change personal data submit modal
                    public function change_personal_data_submit_modal_admin()
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
                            $email_admin = trim(strtolower($_POST['text_email_admin']));
                            $full_name_admin = trim($_POST['text_full_name_admin']);
                            $address_admin = trim($_POST['text_address_admin']);
                            $city_admin = trim($_POST['text_city_admin']);
                            $telephone_admin = trim($_POST['text_telephone_admin']);
                            $image_admin = '';
                        // ===========================================================

                        // ===========================================================
                        // Carregar model
                            $ADMIN = new AdminModel(); 
                            $existe_noutra_conta = $ADMIN->check_if_email_exists_in_another_account_admin($_SESSION['admin'], $email_admin);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email_admin, FILTER_VALIDATE_EMAIL))
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
                                        $ADMIN->update_admin($_SESSION['admin'],$email_admin, $full_name_admin, $address_admin, $city_admin, $telephone_admin, $image_admin);
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
                // ===================================================================     
                
                // ===================================================================
                // alterar data pessoais submit modal / change personal data submit modal
                    public function change_personal_data_submit_modal_admin_alfa()
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
                            $full_name_admin = trim($_POST['text_full_name_admin']);
                            $address_admin = trim($_POST['text_address_admin']);
                            $city_admin = trim($_POST['text_city_admin']);
                            $telephone_admin = trim($_POST['text_telephone_admin']);
                            $image_admin = trim($_GET['c']);

                            
                        // ===========================================================

                        //Store::printData($image_admin);

                        //print_r($image_admin);

                        // ===========================================================
                        // Carregar model
                            $ADMIN = new AdminModel(); 
                            $existe_noutra_conta = $ADMIN->check_if_email_exists_in_another_account_admin($id_admin, $email_admin);
                        // ===========================================================
                        
                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email_admin, FILTER_VALIDATE_EMAIL))
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
                                        $ADMIN->update_admin($id_admin,$email_admin, $full_name_admin, $address_admin, $city_admin, $telephone_admin, $image_admin);
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
                // ===================================================================                   

            // ===========================================================            

            // ===========================================================
            // CLIENTES / customers

                // =========================================================== 
                // Criar tabela admin 
                    public function criar_tabela_customer()
                    {
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
                                    $sub_array[] = '<button id="botao_update" value="'. $customer->id_customer .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                    $sub_array[] = '<a href="?a=delete_admin&id_admin='. Store::aes_encrypt($customer->id_customer) .'" 
                                    class="btn btn-danger btn-xs delete" name="delete" id="'. $customer->id_customer .'"><i class="fa fa-trash"></i></a>';
                                                                                                                                                            

                                    $data[] = $sub_array;                           
                                /* $sub_array = array();
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
                                    //$sub_array[] = '<button id="botao_update" value="'. $admin->id_admin .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                    $sub_array[] = '<a href="?a=delete_admin&id_admin='. Store::aes_encrypt($admin->id_admin) .'" 
                                    class="btn btn-danger btn-xs delete" name="delete" id="'. $admin->id_admin .'"><i class="fa fa-trash"></i></a>';
                                    $data[] = $sub_array;*/
                            endforeach; 

                                $output = array(
                                    "data"				=>	$data
                                );

                            echo json_encode($output);
                        
                        }
                    
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
                                             <button id="botao_adicionar_cliente"  class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                             <a href="?a=customers_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                         </div>                        
                                         <div class="col">';
                                        
                                        $f = '';
                                        if (isset($_GET['f'])) {
                                            $f = $_GET['f'];
                                        }
                                 
                                        $msg .= '<div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                            <div class="col-sm-8">';

                                                $msg .= '<select id="combo-status" class="form-control" onchange="definir_filtro()">';
                                                $msg .= '<option value=""'; 
                                                $msg .= $f == " " ? "selected" : " ";
                                                $msg .= 'class="nav-it"></option>';
                                                $msg .= '<option value="activo"';
                                                $msg .= $f == "activo" ? "selected" : "";
                                                $msg .= 'class="nav-it">Activo</option>';
                                                $msg .= '<option value="inactivo"'; 
                                                $msg .= $f == "inactivo" ? "selected" : "";
                                                $msg .= 'class="nav-it">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
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

                // ==========================================================
                // buscar data customer
                    public function search_data_customer($id_customer)
                    {
                        // ===========================================================
                        // vai buscar data do admin com o id indicado
                            $parameters = [
                                'id_customer' => $id_customer
                            ];

                            $bd = new Database();
                            $resultados = $bd->select("
                                SELECT 
                               *
                                FROM customer 
                                WHERE id_customer = :id_customer
                            ", $parameters);
                        // ===========================================================

                        // ===========================================================
                        // devolve resultados
                            return $resultados[0];
                        // ===========================================================
                    }
                // =========================================================== 

                // ===========================================================
                // detalhe customer / customer detail
                    public function customer_detail()
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
                        // verifica se existe um id do customer na query string
                            if (!isset($_GET['c'])) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // Desencriptar id
                            $id_customer = Store::aes_decrypt($_GET['c']);
                        // ===========================================================

                            $_SESSION['customer_temp'] = $id_customer;

                        // ===========================================================
                        // verifica se o id customer é válido
                            if (empty($id_customer)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // criar admin model / buscar os dados do customer
                            $ADMIN = new AdminModel();
                            $data = [
                                'data_customer' => $ADMIN->search_customer($id_customer),
                                'total_orders' => $ADMIN->total_orders_customer($id_customer)
                            ];
                        // ===========================================================
                        
                        // ===========================================================
                        // apresenta a página das orders do customer
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                //'admin/navigation_profile',
                                'admin/customer_detail',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================

                // ===========================================================
                // customer historico orders / historical customer orders
                    public function customer_order_history()
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
                        // verifica se existe o id customer encriptado
                            if (!isset($_GET['c'])) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // definir o id do customer / criar admin model
                            $id_customer = Store::aes_decrypt($_GET['c']);
                            $ADMIN = new AdminModel();
                        // ===========================================================
                        
                        // ===========================================================
                        // buscar os dados do customer
                            $data = [
                                'customer' => $ADMIN->search_customer($id_customer),
                                'orders_list' => $ADMIN->search_orders_customer($id_customer)
                            ];
                        // ===========================================================

                        // ===========================================================
                        // apresenta a página das orders do customer
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/orders_list_customer',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================

                // ===========================================================
                // customer alterar estado / client change status
                    public function customer_change_status()
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
                        //buscar o id do customer
                            $id_customer = null;
                            if (isset($_GET['e'])) 
                            {
                                // ===========================================================
                                // definir id customer desencriptado
                                    $id_customer = Store::aes_decrypt($_GET['e']);
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // avaliar tipo de dados do id do customer
                            if (gettype($id_customer) != 'string') 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // buscar o novo estado
                            $estado = null;
                            if (isset($_GET['s'])) 
                            {
                                // ===========================================================
                                // definir estado
                                    $estado = $_GET['s'];
                                // ===========================================================
                            }
                        // ===========================================================    
                        
                        // ===========================================================
                        // avaliar se estado 'active' esta no array 'estado'
                            if (!in_array($estado, active)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // regras de negócio para gerir a order (novo estado)

                        // ===========================================================
                        // atualizar o estado da order na base de dados
                            $admin_model = new AdminModel(); // criar admin model
                            $admin_model->update_customer_status($id_customer, $estado);
                        // ===========================================================

                        // ===========================================================
                        // redireciona para a página da própria order
                            Store::redirect('lista_customer&e='.$_GET['e'], true);
                        // ===========================================================
                    }
                // ===========================================================  
                
                // ===========================================================
                // alterar data pessoais / change personal data
                    public function change_customer_data()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                            // ===========================================================
                            // Desencriptar id
                                $id_customer = Store::aes_decrypt($_GET['c']);
                            // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                'data_customer' => $ADMIN->search_customer($id_customer)
                            ];

                            //Store::printData($data);
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    //'admin/navigation_profile',
                                    'admin/change_customer_data',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer', 
                            ], $data);
                        // ===========================================================                
                    }
                // ===========================================================  

                // ===========================================================
                // alterar data pessoais modal / change personal data modal
                    public function change_customer_data_admin()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                            // ===========================================================
                            // id vem por POST
                                $id_customer = $_POST['id_customer'];
                            // ===========================================================
                            
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                 $ADMIN->search_customer_admin($id_customer)
                            ];

                           // Store::printData($data);

                           echo json_encode($data[0]);               
                    }
                // ===========================================================  
                
                // ===========================================================
                // alterar dados pessoais submit / change personal data submit
                    public function change_customer_data_submit()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                             if(!Store::is_admin_logged_in()) {
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
                             $id_customer = trim(strtolower($_POST['text_id_customer']));
                             $email = trim(strtolower($_POST['text_email']));
                             $full_name = trim($_POST['text_full_name']);
                             $address = trim($_POST['text_address']);
                             $city = trim($_POST['text_city']);
                             $telephone = trim($_POST['text_telephone']);
                             $image = '';
                        // =========================================================== 

                        // ===========================================================
                        // validar se é email válido
                             if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                 $_SESSION['erro'] = "Endereço de email inválido.";
                                 $this->change_customer_data();
                                 return;
                             }
                        // ===========================================================   
                         
                        // ===========================================================
                        // validar os restantes campos
                             if(empty($full_name) || empty($address) || empty($city) ){
                                 $_SESSION['erro'] = "Preencha corretamente o formulário.";
                                 $this->change_customer_data();
                                 return;
                             }
                        // ===========================================================                      
                        
                        // ===========================================================
                        // validar se este email já existe noutra conta de customer
                            $customer = new Customers(); // Carregar model
                        // ===========================================================                        
                        
                        // ===========================================================
                        // atualizar os data do customer na base de data
                            $customer->update_customer($id_customer, $email, $full_name, $address, $city, $telephone, $image);
                        // ===========================================================                        
                   
                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('home_page', true);
                        // ===========================================================                   
                    }
                // ===========================================================  

                // ===========================================================
                // alterar dados pessoais submit modal / change personal data submit modal
                    public function change_customer_data_submit_modal()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
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
                            $id_customer = trim(strtolower($_POST['text_id_customer_update']));
                            $email = trim(strtolower($_POST['text_email_update']));
                            $full_name = trim($_POST['text_full_name_update']);
                            $address = trim($_POST['text_address_update']);
                            $city = trim($_POST['text_city_update']);
                            $telephone = trim($_POST['text_telephone_update']);
                            $image = trim($_POST['user_image']);

                        // =========================================================== 

                        // ===========================================================
                        // validar se é email válido
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $_SESSION['erro'] = "Endereço de email inválido.";
                                $this->change_customer_data();
                                return;
                            }
                        // ===========================================================   
                        
                        // ===========================================================
                        // validar os restantes campos
                            if(empty($full_name) || empty($address) || empty($city) ){
                                $_SESSION['erro'] = "Preencha corretamente o formulário.";
                                $this->change_customer_data();
                                return;
                            }
                        // ===========================================================                      
                        
                        // ===========================================================
                        // validar se este email já existe noutra conta de customer
                            $customer = new Customers(); // Carregar model
                        // ===========================================================                        
                        
                        // ===========================================================
                        // atualizar os data do customer na base de data
                            $customer->update_customer($id_customer, $email, $full_name, $address, $city, $telephone, $image);
                        // ===========================================================                        
                
                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('customers_list', true);
                        // ===========================================================                   
                    }
                // =========================================================== 
                           
                // ===========================================================
                // historico orders / order history
                    public function order_history_customer()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // carrega o histórico das orders
                            $orders = new Orders();
                           
                            $order_history = $orders->search_order_history($_SESSION['customer_temp']);
                        
                            $data = [
                                
                                'order_history' => $order_history
                            ];
                        // ===========================================================
                        
                        // ===========================================================
                        // apresentar a view com o histórico das orders
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/order_history_customer',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================  

                // ===========================================================
                // historico orders detalhe / order history detail
                    public function order_history_details_customer()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
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
                            } 
                            else {
                                $id_order = Store::aes_decrypt($_GET['id']);
                                if(empty($id_order)){
                                    Store::redirect();
                                    return;
                                }
                            }

                            $ADMIN = new AdminModel();

                            $_SESSION['id_order_temp'] = $id_order;

                           // echo 'customer_temp:'.$_SESSION['customer_temp'];
                           // echo '<br>id_order_temp:'; Store::printData($_SESSION['id_order_temp']);

                        // ===========================================================
                    
                        // ===========================================================
                        // verifica se a order pertence a este customer
                            $orders = new Orders();
                            $resultado = $orders->check_customer_order($_SESSION['customer_temp'], $id_order);
                            if(!$resultado){
                                Store::redirect();
                                return;
                            }
                        // ===========================================================
                    
                        // ===========================================================
                        // vamos buscar os data de detalhe da order.
                            $order_details = $orders->order_details($_SESSION['customer_temp'], $id_order);
                        // ===========================================================
                        //Store::printData($order_details);
                        // ===========================================================
                        // calcular o valor total da order
                            $total = 0;
                            foreach($order_details['order_products'] as $product){
                                $total += ($product->quantity * $product->unit_price);
                            }
                        // ===========================================================

                        $customer = $ADMIN->search_customer($_SESSION['customer_temp']);
                        $customer = $customer->full_name;
                    
                        // ===========================================================
                        // array com data a apresentar na view
                            $data = [
                                'data_order' => $order_details['data_order'],
                                'order_products' => $order_details['order_products'],
                                'total_order' => $total,
                                'customer' =>  $customer,
                            ];
                        // ===========================================================

                        // ===========================================================
                        // vamos apresentar a nova view com esses data.
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                //'admin/navigation_profile',
                                'admin/order_history_details_customer',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================                 
                
                // ===========================================================
                // alterar password / change password
                    public function change_password_customer()
                    {   
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                            // Store::redirect();
                            // return;
                            } 
                        // ===========================================================   
                        
                        // ===========================================================
                        // verifica se existe um id_customer na query string
                        /*   if (!isset($_GET['c'])) 
                            {   
                                // ===========================================================
                                // redireciona para a página inicial do backoffice                   
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }*/
                        // ===========================================================
                    
                        // ===========================================================
                        // Desencriptar id do admin
                            $id_customer = $_SESSION['customer_temp'];
                        // ===========================================================    
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                'data_customer' => $id_customer
                            ];

                        // Store::printData($data);
                        // ===========================================================                        
                        
                        // ===========================================================
                        // apresentação da página de alteração da password
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/change_password_customer',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // ===========================================================        

                // ===========================================================
                // change password submit
                    public function change_password_customer_submit()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
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
                        // verifica se existe um id_customer na query string
                            // if (!isset($_GET['c'])) 
                            // {   
                            //     // ===========================================================
                            //     // redireciona para a página inicial do backoffice                   
                            //          Store::redirect('home_page', true);
                            //          return;
                            //     // ===========================================================
                            // }
                        // ===========================================================
                        
                        // ===========================================================
                        // Desencriptar id do admin
                            $id_customer = trim($_POST['text_id_customer']); 
                        // ===========================================================    
                                        
                        // ===========================================================
                        // validar data
                            $pass_atual_customer = trim($_POST['text_pass_atual_customer']);
                            $nova_pass_customer = trim($_POST['text_nova_pass_customer']);
                            $repetir_nova_pass_customer = trim($_POST['text_repetir_nova_pass_customer']);
                        // ===========================================================

                        $data = [];

                        $data ['id_customer'] =  $id_customer;
                        $data ['pass_atual_customer'] =  $pass_atual_customer;
                        $data ['nova_pass_customer'] =  $nova_pass_customer;
                        $data ['repetir_nova_pass_customer'] =  $repetir_nova_pass_customer;

                        //Store::printData($data);
                        
                        // ===========================================================
                        // validar se a nova pass vem com data
                            if(strlen($nova_pass_customer) < 6){
                                $_SESSION['erro'] = "Indique a nova pass e a repetição da nova pass.";
                                $this->change_password_customer();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a nova pass a a sua repetição coincidem
                            if($nova_pass_customer != $repetir_nova_pass_customer){
                                $_SESSION['erro'] = "A nova pass e a sua repetição não são iguais.";
                                $this->change_password_customer();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // verificar se a pass atual está correta
                            $adminModel = new AdminModel(); // carregar model
                            if(!$adminModel->check_if_password_is_correct_customer($id_customer, $pass_atual_customer)){
                                $_SESSION['erro'] = "A pass atual está errada.";
                                $this->change_password_customer();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // verificar se a nova pass é diferente da pass atual
                            if($pass_atual_customer == $nova_pass_customer){
                                $_SESSION['erro'] = "A nova pass é igual à pass atual.";
                                $this->change_password_customer();
                                return;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // atualizar a nova pass
                            $adminModel->update_new_password_customer($id_customer, $nova_pass_customer);
                        // ===========================================================
                        
                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('home_page', true);
                        // ===========================================================
                    }
                // ===========================================================   
                
                // ===========================================================
                // novo customer / new customer   
                    public function new_customer()
                    {
                        // ===========================================================
                        // verifica se já existe sessão aberta
                         /*   if (Store::is_customer_logged_in()) {
                                $this->index();
                                return;
                            }*/
                        // ===========================================================
                        
                        // ===========================================================
                        // apresenta o layout para criar um novo utilizador
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/create_customer',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ]);
                        // ===========================================================    
                    }
                // ===========================================================        

                // ===========================================================
                // criar customer / create customer   
                    public function create_customer()
                    {  
                            $purl = null; 
                        // ===========================================================
                        // verifica se já existe session
                            // // if (Store::is_customer_logged_in()) 
                            // // {
                            // //     $this->index();
                            // //     return;
                            // // }
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
                                $_SESSION['erro'] = 'As passes não estão iguais.';
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
                            $customer->register_customer_admin();
                        // ===========================================================                
                        
                        // ===========================================================
                        // envio do email para o customer
                            $email = new SendEmail();
                            $resultado = $email->send_email_confirmation_new_customer($email_customer, $purl);

                            if ($resultado) 
                            {
                                // ===========================================================
                                // redirecionar para a página do profile
                                    Store::redirect('home_page', true);
                                // =========================================================== 
                            } 
                            else 
                            {
                                echo 'Aconteceu um erro';
                            }   
                        // ===========================================================                
                    }
                // =========================================================== 

                // ===========================================================
                // criar customer modal / create customer modal   
                    public function create_customer_modal()
                    {  
                        // ===========================================================
                        // receber os data via AJAX(axios)
                           //$post = json_decode(file_get_contents('php://input'), true);

                          // Store::printData($post['text_email']);
                        // ===========================================================
                        
                        // ===========================================================            
                        // adiciona ou altera na sessão a variável (coleção / array) data_alternative
                                $_SESSION['data_customer'] = [
                                'text_email' => $_POST['text_email'],
                                'text_pass_1' =>$_POST['text_pass_1'],
                                'text_pass_2' => $_POST['text_pass_2'],
                                'text_full_name' => $_POST['text_full_name'],
                                'text_address' => $_POST['text_address'],
                                'text_city' => $_POST['text_city'],
                                'text_telephone' => $_POST['text_telephone'], 
                                'text_activo' => $_POST['text_activo'],
                                'text_gender' => $_POST['text_gender'],
                                'user_image' => $_POST['user_image'], 
                            ];
                        // ===========================================================

                            // Store::printData($_SESSION['data_customer']['user']);

                            $purl = null; 
                        // ===========================================================
                        // verifica se já existe session
                            // // if (Store::is_customer_logged_in()) 
                            // // {
                            // //     $this->index();
                            // //     return;
                            // // }
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
                                //$_SESSION['erro'] = 'As passes não estão iguais.';
                                $this->new_customer();
                                return;
                            }
                        // ===========================================================                
                    
                        // ===========================================================
                        // verifica na base de data se existe customer com mesmo email
                            $customer = new Customers();

                            if ($customer->check_email_exists(trim($_POST['text_email'])))
                            {
                                $_SESSION['erro'] = 'Já existe um customer com o mesmo email.';
                                //$this->new_customer();
                                return;
                            }
                        // ===========================================================                
                        
                        // ===========================================================
                        // inserir novo customer na base de data e devolver o purl
                            $email_customer = strtolower(trim($_POST['text_email']));
                            $customer->register_customer_admin_modal();

                            
                        // ===========================================================                
                        
                        // ===========================================================
                        // envio do email para o customer
                            $email = new SendEmail();
                            $resultado = $email->send_email_confirmation_new_customer($email_customer, $purl);
                            //Store::printData('Aqui');
                            if ($resultado) 
                            {
                                // ===========================================================
                                // redirecionar para a página do profile
                                  Store::redirect('customers_list', true);
                                // =========================================================== 
                            } 
                            else 
                            {
                                echo 'Aconteceu um erro';
                            }   
                        // ===========================================================                
                    }
                // ===========================================================   
                
                // ===========================================================
                // criar customer modal ajax / create customer modal ajax
                    public function create_customer_modal_ajax()
                    {
                        $purl = "";

                        $text_email_customer = $_POST['text_email_customer_add'];
                        $text_pass_1_customer = $_POST['text_pass_1_customer_add'];
                        $text_pass_2_customer = $_POST['text_pass_2_customer_add'];
                        $text_full_name_customer = $_POST['text_full_name_customer_add'];
                        $text_address_customer = $_POST['text_address_customer_add'];
                        $text_city_customer = $_POST['text_city_customer_add'];
                        $text_telephone_customer = $_POST['text_telephone_customer_add'];
                        $text_activo_customer = $_POST['text_activo_customer_add'];
                        $text_gender_customer = $_POST['text_gender_customer_add'];
                        $user_image = $_FILES["customer_image_add"]["name"]; 

                        // ===========================================================
                            // Carregar model
                            $customer = new Customers(); 
                            $existe_noutra_conta = $customer->check_email_exists($text_email_customer);
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
                            else
                            {
                                // ===========================================================
                                // inserir novo customer na base de data e devolver o purl
                                    $email_customer = strtolower(trim($text_email_customer));
                                    $customer->register_customer_admin_modal_ajax(
                                            $text_email_customer, 
                                            $text_pass_1_customer,
                                            $text_full_name_customer,
                                            $text_address_customer,
                                            $text_city_customer,
                                            $text_telephone_customer,
                                            $text_activo_customer,
                                            $text_gender_customer,
                                            $user_image
                                    );
                                // =========================================================== 

                            // ===========================================================
                            // envio do email para o customer
                            $email = new SendEmail();
                            $resultado = $email->send_email_confirmation_new_customer($email_customer, $purl);
                            //Store::printData('Aqui');
                            // if ($resultado) 
                            // {
                            //     // ===========================================================
                            //     // redirecionar para a página do profile
                            //      // Store::redirect('customers_list', true);
                            //     // =========================================================== 
                            // } 
                            // else 
                            // {
                            //     echo 'Aconteceu um erro';
                            // }   
                        // ===========================================================                              
                                

                            }

                        //echo $existe_noutra_conta;
                    }
                // ===========================================================                 

                // ===========================================================
                // apagar admin / delete admin   
                    public function delete_customer()
                    {   
                        $id_customer = Store::aes_decrypt($_GET['id_customer']);
                        // Store::printData( $id_admin);
                        // ===========================================================
                        // apresenta o layout para criar um novo utilizador
                            // // Store::admin_layout([
                            // //     'admin/layouts/html_header',
                            // //     'admin/layouts/header',
                            // //    // 'admin/create_admin',
                            // //     'admin/layouts/footer',
                            // //     'admin/layouts/html_footer',
                        //// ]);
                        // ===========================================================  
                        // $purl = null;     

                        // ===========================================================
                        // verifica se já existe session
                        /* if (Store::is_admin_logged_in()) 
                            {
                                echo 'aqui';
                            // $this->index();
                            //  return;
                            } */
                        // ===========================================================                
                    
                        // ===========================================================
                        // verifica se houve submissão de um formulário
                        /*    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                            {
                                $this->index();
                                return;
                            } */
                        // ===========================================================
                    
                        // ===========================================================
                        // verifica se pass 1 = pass 2
                            // // if ($_POST['text_pass_1'] !== $_POST['text_pass_2']) 
                            // // {
                            // //     // as passwords são diferentes
                            // //     $_SESSION['erro'] = 'As passs não estão iguais.';
                            // //     $this->new_admin();
                            // //     return;
                            // // }
                        // ===========================================================                
                    
                        // ===========================================================
                        // verifica na base de data se existe admin com mesmo email
                            $adminModel = new AdminModel();

                        

                            // // if ($adminModel->check_email_exists_admin($_POST['text_email'])) 
                            // // {
                            // //     $_SESSION['erro'] = 'Já existe um Admin com o mesmo email.';
                            // //     $this->new_admin();
                            // //     return;
                            // // }
                        // ===========================================================                
                        
                        // ===========================================================
                        // inserir novo admin na base de data e devolver o purl
                        //    $email_admin = strtolower(trim($_POST['text_email']));
                            $adminModel->delete_customer($id_customer); 

                            //Store::printData($email_admin);
                        // ===========================================================                
                        
                        // ===========================================================
                        // envio do email para o admin
                        /*    $email = new SendEmail();
                            $resultado = $email->send_email_confirmation_new_admin($email_admin, $purl); */

                        /*      if ($resultado) 
                            { */
                                // ===========================================================
                                // redirecionar para a página do profile
                                    Store::redirect('customers_list', true);
                                // ===========================================================
                        /* } 
                            else 
                            {
                                echo 'Aconteceu um erro';
                            } */
                        // ===========================================================                
                    }
                // ===========================================================                  

            // =========================================================== 

            // ===========================================================
            // ENCOMENDAS

                // =========================================================== 
                // Criar tabela admin 
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
                            //  $data = [
                            //      'orders_list' => $orders_list,
                            //      'filtro' => $filtro
                            //  ];                        

                            foreach ($orders_list as $order) : 

                                $sub_array = array();
                                $sub_array[] = $order->order_date;
                                $sub_array[] = $order->order_code;
                                $sub_array[] = $order->full_name;
                                $sub_array[] = $order->email;
                                $sub_array[] = $order->telephone;
                                $sub_array[] = '<a href="?a=order_details&e='. Store::aes_encrypt($order->id_order) .'" class="nav-it">'. $order->status .'</a>';
                                $sub_array[] = $order->updated_at;
                                $sub_array[] = '<a href="?a=order_details&e='. Store::aes_encrypt($order->id_order) .'" class="btn btn-primary btn-xs update"><i class="fas fa-eye"></i></a>';
                                $sub_array[] = '<a href="?a=change_order_data&c='. Store::aes_encrypt($order->id_order) .'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>';
                                //$sub_array[] = '<button id="botao_update" value="'. $admin->id_admin .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                $sub_array[] = '<a href="?a=delete_order&id_order='. Store::aes_encrypt($order->id_order) .'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>';
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
                             $data = [
                                 'orders_list' => $orders_list,
                                 'filtro' => $filtro
                             ];                        

                        //$msg .= 'orders list';

                        $msg .= '
                        <h3>Lista de orders '; 
                        $msg .= $filtro != " " ? $filtro : " ";
                        
                        $msg .= '</h3>
                        <hr>
                            <div class="row">
                                <div class="col">
                                    <a href="?a=new_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="col">
                                    <a href="?a=orders_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="col">';

                                    $f = '';
                                    if (isset($_GET['f'])) {
                                        $f = $_GET['f'];
                                    }

                                    $msg .= '<div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                        <div class="col-sm-8">
                                            <select id="combo-status" class="form-control" onchange="definir_filtro()">';

                                                $msg .= '<option value=" "';
                                                $msg .= $f == " " ? 'selected' : " "; 
                                                $msg .= 'class="nav-it"></option>';
                                                $msg .= '<option value="pendent"';  
                                                $msg .= $f == "pendent" ? "selected" : " " ; 
                                                $msg .= 'class="nav-it">Pendent</option>
                                                <option value="processing"';  
                                                $msg .= $f == "processing" ? "selected" : " "; 
                                                $msg .= 'class="nav-it">Processing</option>
                                                <option value="sent"';  
                                                $msg .= $f == "sent" ? "selected" : " ";
                                                $msg .= 'class="nav-it">Sent</option>
                                                <option value="canceled"';  
                                                $msg .= $f == "canceled" ? "selected" : " ";
                                                $msg .= 'class="nav-it">Canceled</option>
                                                <option value="completed"';  
                                                $msg .= $f == "completed" ? "selected" : " ";
                                                $msg .= 'class="nav-it">Completed</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>';
                        
                            // //  if (count($orders_list) == 0) : 
                            // //     $msg .= '<hr>
                            // //     <p>Não existem orders registadas.</p>
                            // //     <hr>';
                            // //  else : 
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
                                                <th class="text-center">Editar</th>
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
                                            <th class="text-center">Editar</th>
                                            <th class="text-center">Apagar</th>                                                
                                        </tr>
                                    </tfoot>';
                                       // <tbody>';
                                         /*    foreach ($orders_list as $order) : 
                                                $msg .= '<tr>
                                                    <td>'. $order->order_date .'</td>
                                                    <td>'. $order->order_code .'</td>
                                                    <td>'. $order->full_name .'</td>
                                                    <td>'. $order->email .'</td>
                                                    <td>'. $order->telephone .'</td>
                                                    <td>
                                                        <a href="?a=order_details&e='. Store::aes_encrypt($order->id_order) .'" class="nav-it">'. $order->status .'</a>
                                                    </td>
                                                    <td>'. $order->updated_at .'</td>
                                                <td class="text-center">
                                                <a href="?a=order_details&e='. Store::aes_encrypt($order->id_order) .'" class="btn btn-primary btn-xs update"><i class="fas fa-eye"></i></a>
                                                </td>                                                        
                                                <td class="text-center">
                                                    <a href="?a=change_order_data&c='. Store::aes_encrypt($order->id_order) .'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td class="text-center">
                                                <a href="?a=delete_order&id_order='. Store::aes_encrypt($order->id_order) .'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>
                                                </td>                                                        
                                                </tr>';
                                             endforeach; */
                                            
                                            // $msg .= '</tbody>
                                             $msg .= '</table>
                                </small>';
                            // //  endif; 

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

                // ===========================================================
                // alterar dados order / change order data
                    public function change_order_data()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    //'admin/navigation_profile',
                                    //'admin/change_order_data',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer', 
                            ]/*, $data*/);
                        // ===========================================================                
                    }
                // ===========================================================        
                
                // ===========================================================
                // alterar dados order submit / change order data submit
                    public function change_order_data_submit()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    //'admin/navigation_profile',
                                    //'admin/change_order_data',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer', 
                            ]/*, $data*/);
                        // ===========================================================                
                    }
                // =========================================================== 

                // ===========================================================
                // novo encomenda / new order   
                    public function new_order()
                    {
                        // ===========================================================
                        // verifica se já existe sessão aberta
                         /*   if (Store::is_customer_logged_in()) {
                                $this->index();
                                return;
                            }*/
                        // ===========================================================
                        
                        // ===========================================================
                        // apresenta o layout para criar um novo utilizador
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/create_order',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ]);
                        // ===========================================================    
                    }
                // ===========================================================        

                // ===========================================================
                // criar encomenda / create order   
                    public function create_order()
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
                                return;
                            } 
                            else 
                            {
                                echo 'Aconteceu um erro';
                            }
                        // ===========================================================  
                    }
                // =========================================================== 

                // ===========================================================
                // apagar product / delete product   
                    public function delete_order()
                    {   
                        $id_order = Store::aes_decrypt($_GET['id_order']);
                        // Store::printData( $id_admin);
                            // ===========================================================
                            // apresenta o layout para criar um novo utilizador
                                // // Store::admin_layout([
                                // //     'admin/layouts/html_header',
                                // //     'admin/layouts/header',
                                // //    // 'admin/create_admin',
                                // //     'admin/layouts/footer',
                                // //     'admin/layouts/html_footer',
                            //// ]);
                            // ===========================================================  
                        // $purl = null;     

                            // ===========================================================
                            // verifica se já existe session
                            /* if (Store::is_admin_logged_in()) 
                                {
                                    echo 'aqui';
                                // $this->index();
                                //  return;
                                } */
                            // ===========================================================                
                        
                            // ===========================================================
                            // verifica se houve submissão de um formulário
                            /*    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                                {
                                    $this->index();
                                    return;
                                } */
                            // ===========================================================
                        
                            // ===========================================================
                            // verifica se pass 1 = pass 2
                                // // if ($_POST['text_pass_1'] !== $_POST['text_pass_2']) 
                                // // {
                                // //     // as passwords são diferentes
                                // //     $_SESSION['erro'] = 'As passs não estão iguais.';
                                // //     $this->new_admin();
                                // //     return;
                                // // }
                            // ===========================================================                
                        
                            // ===========================================================
                            // verifica na base de data se existe admin com mesmo email
                                $adminModel = new AdminModel();

                                // // if ($adminModel->check_email_exists_admin($_POST['text_email'])) 
                                // // {
                                // //     $_SESSION['erro'] = 'Já existe um Admin com o mesmo email.';
                                // //     $this->new_admin();
                                // //     return;
                                // // }
                            // ===========================================================                
                            
                            // ===========================================================
                            // inserir novo admin na base de data e devolver o purl
                            //    $email_admin = strtolower(trim($_POST['text_email']));
                                $adminModel->delete_order($id_order); 

                                //Store::printData($email_admin);
                            // ===========================================================                
                            
                            // ===========================================================
                            // envio do email para o admin
                            /*    $email = new SendEmail();
                                $resultado = $email->send_email_confirmation_new_admin($email_admin, $purl); */

                        /*      if ($resultado) 
                                { */
                                    // ===========================================================
                                    // redirecionar para a página do profile
                                        Store::redirect('orders_list', true);
                                    // ===========================================================
                            /* } 
                                else 
                                {
                                    echo 'Aconteceu um erro';
                                } */
                            // ===========================================================                
                    }
                // ===========================================================                  

            // ===========================================================

            // ===========================================================
            // OPERAÇÕES APÓS MUDANÇA DE ESTADO
                // ===========================================================
                // order alterar estado / order change status
                    public function order_change_status()
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
                        //buscar o id_order
                            $id_order = null;
                            if (isset($_GET['e'])) {
                                $id_order = Store::aes_decrypt($_GET['e']);
                            }
                        // ===========================================================

                        // ===========================================================
                        // Avaliar o tipo de dados do id encoemnda
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
                        // buscar o novo estado
                        
                        // ===========================================================
                        // avaliar se o estado foi enviado na query string
                            $estado = null;
                            if (isset($_GET['s'])) 
                            {
                                // ===========================================================
                                // definir estado
                                    $estado = $_GET['s'];
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // avaliar se estado existe no array STATUS
                            if (!in_array($estado, STATUS)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // regras de negócio para gerir a order (novo estado)
                        
                        // ===========================================================
                        // atualizar o estado da order na base de dados
                            $admin_model = new AdminModel(); // criar admin model
                            $admin_model->update_order_status($id_order, $estado);
                        // ===========================================================

                        // ===========================================================
                        // executar operações baseadas no novo estado
                            switch ($estado) 
                            {
                                case 'PENDENT':
                                    // não existem ações
                                    $this->operation_notify_customer_change_status($id_order);
                                    break;

                                case 'PROCESSING':
                                    // não existem ações
                                    break;

                                case 'SENT':
                                    // enviar um email com a notificação ao customer sobre o envio da order
                                    $this->operation_notify_customer_change_status($id_order);
                                    $this->operation_send_email_order_sent($id_order);
                                    break;

                                case 'CANCELED':
                                    $this->operation_notify_customer_change_status($id_order);
                                    break;

                                case 'COMPLETED':
                                    $this->operation_notify_customer_change_status($id_order);
                                    break;
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // redireciona para a página da própria order
                            Store::redirect('order_details&e='.$_GET['e'], true);
                        // ===========================================================
                    }
                // ===========================================================            
                
                // ===========================================================
                // operacao notificar customer mudanca estado /  operation notify customer change status
                    public function operation_notify_customer_change_status($id_order)
                    {
                        // vai enviar um email para o customer indicando que a order sofreu alterações
                    }
                // ===========================================================
            // ===========================================================

            // ===========================================================
            // operacao enviar email order sent / operation send email order sent
                private function operation_send_email_order_sent($id_order)
                {
                    // executar as operações para enviar email ao customer.
                }
            // ===========================================================

            // ===========================================================
            // criar pdf order / generate pdf order
                public function generate_pdf_order()
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
                    //buscar o id_order
                    // ===========================================================
                    
                    // ===========================================================
                    // avaliar se o id da order esta confugurado
                        $id_order = null;
                        if (isset($_GET['e'])) 
                        {
                            // ===========================================================
                            // definir id order
                                $id_order = Store::aes_decrypt($_GET['e']);
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // avaliar o tipo de dados do id da order
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
                    // vai buscar os dados da order
                        $id_order = Store::aes_decrypt($_GET['e']); // desencripta id da order
                        $admin_model = new AdminModel(); // cria admin model
                        $order = $admin_model->search_order_details($id_order);
                    // ===========================================================
                    
                    // buscar dados do customer
                    // Store::printData($order);

                    // ===========================================================
                    // cria PDF
                        $pdf = new PDF();
                    // ===========================================================

                    // ===========================================================
                    // configurar template do pdf
                        $pdf->set_template(getcwd() . '/assets/templates_pdf/template.pdf');
                    // ===========================================================
                    
                    // ===========================================================
                    // criar o PDF com os detalhes da order
                    
                    // ===========================================================
                    // preparar opcoes base do pdf (letra)
                        $pdf->set_font_family('Arial');
                        $pdf->set_font_size('14px');
                        $pdf->set_font('bold');
                    // ===========================================================

                    // ===========================================================
                    // data order
                        $pdf->position_dimension(225,204,165,22);
                        $pdf->write($order['order']->order_date);
                    // ===========================================================

                    // ===========================================================
                    // codigo order
                        $pdf->position_dimension(550,203,165,22);
                        $pdf->write($order['order']->order_code);
                    // ===========================================================
                    
                    // ===========================================================
                    // dados do customer
                    // ===========================================================

                    // ===========================================================
                    // nome
                        $pdf->position_dimension(70,260,600,22);
                        $pdf->write($order['order']->full_name);
                    // ===========================================================

                    // ===========================================================
                    // address - city
                        $pdf->position_dimension(75,284,600,22);
                        $pdf->write($order['order']->address .' - '
                        .$order['order']->city);  
                    // ===========================================================      
                    
                    // ===========================================================  
                    // email - telephone
                        $pdf->position_dimension(75,308,600,22);
                        $telephone = empty($order['order']->telephone) ? '':
                        ' - '.$order['order']->telephone;
                        $pdf->write($order['order']->email .$telephone);   
                    // =========================================================== 
                    
                    // ===========================================================
                    //  configuracao do tipo de letra
                        $y = 400;
                        $pdf->set_font('regular');
                    // ===========================================================

                    // ===========================================================  
                    // lista dos products orderdos            
                        $total_order = 0;
                        foreach( $order['products_list'] as $product)
                        {
                            // ===========================================================
                            // localizacao da apresentacao da quantidade x product
                                $pdf->set_alignment('left');
                                $pdf->position_dimension(75,$y,480,22);
                                $pdf->write($product->quantity. ' x ' .$product->unit_price);
                            // =========================================================== 

                            // ===========================================================
                            // localizacao da apresentacao do preco do product
                                $pdf->set_alignment('right');
                                $pdf->position_dimension(560,$y,160,22);
                                $preco = $product->quantity * $product->unit_price;
                                $total_order += $preco;
                                $pdf->write(number_format($preco,2,',','.') . ' €');
                            // ===========================================================
                            
                            // ===========================================================
                            // para cada product a coordenada da position 'y' varia 25pts
                                $y += 25;
                            // ===========================================================
                        
                        }
                    // ===========================================================

                    // ===========================================================
                    // apresenta o preco do total configurado
                        $pdf->set_alignment('right');
                        $pdf->set_font_size('22px');
                        $pdf->set_font('bold');

                        $pdf->set_color('white');
                        $pdf->position_dimension(470,851,250,28);
                        $pdf->write('Total: ' . number_format($total_order,2,',','.') . ' €');
                    // ===========================================================

                    //Store::printData($pdf);

                    // ===========================================================
                    // apresenta o pdf criado
                        $pdf->pdf_show();
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // enviar pdf order
                public function send_pdf_order()
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
                    //buscar o id_order
                        // ===========================================================
                        // avaliar se id da order esta configurado
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
                        // avaliar o tipo de dados do id da order
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

                    // ===========================================================
                    // vai buscar os dados da order
                        $id_order = Store::aes_decrypt($_GET['e']); // definir id da order
                        $admin_model = new AdminModel(); // criar admin model
                        $order = $admin_model->search_order_details($id_order);
                    // ===========================================================
                    
                    // buscar dados do customer
                    // Store::printData($order);

                    // ===========================================================
                    // criar pdf com template
                        $pdf = new PDF();
                        $pdf->set_template(getcwd() . '/assets/templates_pdf/template.pdf');
                    // ===========================================================
                    
                    // ===========================================================
                    // criar o PDF com os detalhes da order
                    // ===========================================================

                    // ===========================================================
                    // preparar opcoes base do pdf
                        $pdf->set_font_family('Arial');
                        $pdf->set_font_size('14px');
                        $pdf->set_font('bold');
                    // ===========================================================

                    // ===========================================================                    
                    // data order
                        $pdf->position_dimension(225,204,165,22);
                        $pdf->write($order['order']->data_order);
                    // ===========================================================

                    // ===========================================================
                    // codigo order
                        $pdf->position_dimension(550,203,165,22);
                        $pdf->write($order['order']->codigo_order);
                    // ===========================================================    

                    // ===========================================================
                    // dados do customer
                    // ===========================================================

                    // ===========================================================
                    // nome
                        $pdf->position_dimension(70,260,600,22);
                        $pdf->write($order['order']->full_name);
                    // ===========================================================
                    
                    // ===========================================================
                    // address - city
                        $pdf->position_dimension(75,284,600,22);
                        $pdf->write($order['order']->address .' - '.$order['order']->city);  
                    // ===========================================================      
                    
                    // ===========================================================  
                    // email - telephone
                        $pdf->position_dimension(75,308,600,22);
                        $telephone = empty($order['order']->telephone) ? '': ' - '.$order['order']->telephone;
                        $pdf->write($order['order']->email .$telephone);   
                    // ===========================================================    
                    
                    // ===========================================================
                    // definicao da coordenada y
                        $y = 400;
                    // ===========================================================

                    // ===========================================================
                    // formata o tipo de letra do pdf
                        $pdf->set_font('regular');
                    // ===========================================================
                    
                    // ===========================================================
                    // lista dos products orderdos
                        $total_order = 0;
                        foreach( $order['products_list'] as $product)
                        {
                            // ===========================================================
                            // localizacao da apresentacao da quantidade x product
                                $pdf->set_alignment('left');
                                $pdf->position_dimension(75,$y,480,22);
                                $pdf->write($product->quantidade. ' x ' .$product->preco_unidade); 
                            // ===========================================================

                            // ===========================================================
                            // preco do product
                                $pdf->set_alignment('right');
                                $pdf->position_dimension(560,$y,160,22);
                                $preco = $product->quantidade * $product->preco_unidade;
                                $total_order += $preco;
                                $pdf->write(number_format($preco,2,',','.') . ' €');
                            // ===========================================================

                            // ===========================================================
                            // 
                            $y += 25;
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // formata as caracteristicas da fonte do pdf
                        $pdf->set_alignment('right');
                        $pdf->set_font_size('22px');
                        $pdf->set_font('bold');
                    // ===========================================================

                    // ===========================================================
                    // formata e apresenta o preco do total da order
                        $pdf->set_color('white');
                        $pdf->position_dimension(470,851,250,28);
                        $pdf->write('Total: ' . number_format($total_order,2,',','.') . ' $');
                    // ===========================================================
                    
                    // ===========================================================
                    // permissoes
                        $permissoes = [
                            // 'copy',
                            'print',
                            // 'modify',
                            // 'annot-forms',
                            // 'fill-forms',
                            // 'extract',
                            // 'assemble',
                            // 'print-highres',
                        ];
                    // ===========================================================

                    // ===========================================================
                    // Definir permissoes e proteccoes
                        $pdf->set_permissions([], '123456');
                    // ===========================================================

                    // ===========================================================
                    // Guardar o pdf criado
                        $ficheiro = $order['order']->codigo_order . '-' . date('Ymdmis').'.pdf';
                        $pdf->save_pdf($ficheiro);     
                    // ===========================================================
                    
                    // ===========================================================
                    // enviar o email para o customer com o ficheiro em anexo
                        $email = new SendEmail(); // enviar email
                        $resultado = $email->send_pdf_order_to_customer($order['order']->email, $ficheiro); 
                    // ===========================================================     
                    
                    // ===========================================================
                    // eliminar ficheiro pdf enviado por email
                        unlink(PDF_PATH . $ficheiro);
                        echo 'OK';
                    // ===========================================================

                    // ===========================================================
                    //reecaminhar para a pagina da order
                        Store::redirect('order_details&e='.$_GET['e'], true);
                    // ===========================================================

                }
            // ===========================================================    

            // ===========================================================
            // Produtos 
  
                // =========================================================== 
                // Criar tabela produtos 
                    public function criar_tabela_products()
                    {
                            //// ===========================================================
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
                                
                            /* if ($product->deleted_at == null) : 
                                        $sub_array[] ='<i class="text-danger fas fa-times-circle"></i></span>';
                                    else : 
                                        $sub_array[] ='<i class="text-success fas fa-check-circle"></i></span>';
                                    endif;  */                                              
                                    
                                    $sub_array[] = '<button onclick="apresentarModalVerAdmin('. $product->id_product .')" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                    ';
                                    $sub_array[] = '<button id="botao_update" onclick="apresentarModalUpdateAdmin('. $product->id_product .')"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                    //$sub_array[] = '<button id="botao_update" value="'. $admin->id_admin .'"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
                                    $sub_array[] = '<a href="?a=delete_admin&id_admin='. Store::aes_encrypt($product->id_product) .'" 
                                    class="btn btn-danger btn-xs delete" name="delete" id="'. $product->id_product .'"><i class="fa fa-trash"></i></a>';
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
                                            //     // ===========================================================
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
                                    <a href="?a=new_product" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a>
                                    <button id="add_button" onclick="apresentarModalAdd()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                    <a href="?a=products_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                </div>                          
                                <div class="col">';
                               
                                $f = '';
                                if (isset($_GET['f'])) {
                                    $f = $_GET['f'];
                                }
                               
                                $msg .= '<div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                    <div class="col-sm-8">';

                                    $msg .= '<select id="combo-status" class="form-control" onchange="definir_filtro()">';

                                    $msg .= '<option value=" "'; 
                                    $msg .= $f == " " ? "selected" : " ";
                                    $msg .= 'class="nav-it"></option>
                                            <option value="activo"'; 
                                    $msg .= $f == "activo" ? "selected" : " ";
                                    $msg .= 'class="nav-it">Activo</option>
                                            <option value="inactivo"';
                                    $msg .= $f == "inactivo" ? "selected" : " "; 
                                    $msg .= 'class="nav-it">Inactivo</option>
                                        </select>
                                    </div>
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
        
                        //  if (count($products) == 0) : 
                        //     $msg .= '<hr>
                        //     <p>Não existem products registados.</p>
                        //     <hr>';
                        // else : 
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
                                    
                                   // <tbody>';

                                        // foreach ($products as $product) : 
                                        //     $msg .= '<tr>';
                                            
                                        //     $price_whithout_VAT = ($product->price / 1.23);
                                        //     $vat = $product->price - $price_whithout_VAT;
                                        //     $perc_iva = $product->VAT * 100;
        
                                        //     $msg .='<td><img src="../assets/images/products/'. $product->image .'" class="img-fluid" width="50px"></td>
                                        //         <td>'. $product->id_product .'</td>
                                        //         <td><a href="?a=products_details&c='. Store::aes_encrypt($product->id_product) .'" class="nav-it">'. $product->product_name .'</a></td>
                                        //         <td>'. $product->category .'</td>
                                        //         <td>'. $product->price .' €</td>
                                        //         <td>'. number_format($price_whithout_VAT, 2,',','.') .' €</td>
                                        //         <td>'. number_format($vat, 2,',','.') .' €</td> 
                                        //         <td>'. number_format($perc_iva, 0,',','.') .' %</td>
                                        //         <td>'. $product->stock .'</td>
                                                
                                        //         <td class="text-center">';
                                        //              if ($product->active == 1) : 
                                        //                 $msg .='<i class="text-success fas fa-check-circle"></i></span></a>';
                                        //              else :
                                        //                 $msg .='<i class="text-danger fas fa-times-circle"></i></span></a>';
                                        //              endif; 
                                        //              $msg .='</td>
                                        //                 <td>'.$product->updated_at .'</td>
                                        //         <td class="text-center">
                                        //         <a href="?a=products_details&c='. Store::aes_encrypt($product->id_product) .'" class="btn btn-primary btn-xs ver"><i class="fas fa-eye"></i></a>
                                        //         </td>                                              
                                        //         <td class="text-center">';
                                        //         $msg .='<a href="?a=change_product_data&c='. Store::aes_encrypt($product->id_product) .'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>
                                        //         </td>';
                                                
                                        //         $msg .='<td class="text-center">
                                        //             <a href="?a=delete_product&id_product='. Store::aes_encrypt($product->id_product) .'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
                                        //         </td>                                          
                                        //     </tr>';
                                        // endforeach; 
                                        //$msg .='</tbody>
                                        $msg .='</table>
                            </small>';
                        // // endif; 
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
                // product alterar estado / product change status
                    public function product_change_status()
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
                        //avaliar se id product esta configurado
                            $id_product = null;
                            if (isset($_GET['e'])) 
                            {
                                // ===========================================================
                                // definir o id do product desencriptado
                                    $id_product = Store::aes_decrypt($_GET['e']);
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        //  avalia tipo de dados do id do product
                            if (gettype($id_product) != 'string') 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // buscar o novo estado
                            // ===========================================================
                            // avaliar se estado foi passado pela url
                                $estado = null;
                                if (isset($_GET['s'])) 
                                {
                                    // ===========================================================
                                    // definir estado
                                        $estado = $_GET['s'];
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // avaliar se o 'estado' existe no array 
                                if (!in_array($estado, active)) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================
                        // ===========================================================
                        
                        // ===========================================================
                        // regras de negócio para gerir a product (novo estado)
                        // ===========================================================

                        // ===========================================================
                        // atualizar o estado da product na base de dados
                            $admin_model = new AdminModel(); // criar admin model
                            $admin_model->update_product_status($id_product, $estado);
                        // ===========================================================

                        // ===========================================================
                        // redireciona para a página do próprio product
                            Store::redirect('products_list&e='.$_GET['e'], true);
                        // ===========================================================
                    }
                // ===========================================================    

                // ===========================================================
                // product alterar estado / product change status
                    public function product_change_category()
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
                        //avaliar se id product esta configurado
                            $id_product = null;
                            if (isset($_GET['e'])) 
                            {
                                // ===========================================================
                                // definir o id do product desencriptado
                                    $id_product = Store::aes_decrypt($_GET['e']);
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        //  avalia tipo de dados do id do product
                            if (gettype($id_product) != 'string') 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================
                        
                        // ===========================================================
                        // buscar o novo estado
                            // ===========================================================
                            // avaliar se estado foi passado pela url
                                $estado = null;
                                if (isset($_GET['s'])) 
                                {
                                    // ===========================================================
                                    // definir estado
                                        $estado = $_GET['s'];
                                    // ===========================================================
                                }
                            // ===========================================================

                            // ===========================================================
                            // avaliar se o 'estado' existe no array 
                                if (!in_array($estado, active)) 
                                {
                                    // ===========================================================
                                    // redireciona para a página inicial do backoffice
                                        Store::redirect('home_page', true);
                                        return;
                                    // ===========================================================
                                }
                            // ===========================================================
                        // ===========================================================
                        
                        // ===========================================================
                        // regras de negócio para gerir a product (novo estado)
                        // ===========================================================

                        // ===========================================================
                        // atualizar o estado da product na base de dados
                            $admin_model = new AdminModel(); // criar admin model
                            $admin_model->update_product_category($id_product, $estado);
                        // ===========================================================

                        // ===========================================================
                        // redireciona para a página do próprio product
                            Store::redirect('products_list&e='.$_GET['e'], true);
                        // ===========================================================
                    }
                // ===========================================================

                // ===========================================================
                // detalhe product / product details
                    public function products_details()
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
                        // verifica se existe um id customer na query string
                            if (!isset($_GET['c'])) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================

                            }
                        // ===========================================================

                        // ===========================================================
                        // verifica se o id product é válido
                            $id_product = Store::aes_decrypt($_GET['c']);
                            if (empty($id_product)) 
                            {
                                // ===========================================================
                                // redireciona para a página inicial do backoffice
                                    Store::redirect('home_page', true);
                                    return;
                                // ===========================================================
                            }
                        // ===========================================================

                        // ===========================================================
                        // buscar os dados do product
                            $ADMIN = new AdminModel(); // criar admin model
                            $data = [
                                'data_products' => $ADMIN->search_product($id_product),
                                /*'total_orders' => $ADMIN->total_orders_customer($id_admin)*/
                            ];
                        // ===========================================================

                        // ===========================================================
                        // apresenta a página das orders
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                //'admin/navigation_profile',
                                'admin/products_details',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ], $data);
                        // ===========================================================
                    }
                // =========================================================== 

                // ===========================================================
                // alterar dados produtos / change product data
                    public function change_product_data()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                            if(!Store::is_admin_logged_in()) {
                                Store::redirect();
                                return;
                            }
                        // ===========================================================

                            // ===========================================================
                            // Desencriptar id
                                $id_product = Store::aes_decrypt($_GET['c']);
                            // ===========================================================
                        
                        // ===========================================================
                        // vai buscar os data pessoais do Admin
                            $ADMIN = new AdminModel();
                            $data = [
                                'data_product' => $ADMIN->search_product($id_product)
                            ];

                            //Store::printData($data);
                        // ===========================================================

                        // ===========================================================
                        // apresentação da página de profile
                            Store::admin_layout([
                                    'admin/layouts/html_header',
                                    'admin/layouts/header',
                                    'admin/change_product_data',
                                    'admin/layouts/footer',
                                    'admin/layouts/html_footer', 
                            ], $data);
                        // ===========================================================                
                    }
                // =========================================================== 
                                            
                // ===========================================================
                // alterar dados produtos submit / change product data submit
                    public function change_product_data_submit()
                    {
                        // ===========================================================
                        // verifica se existe um utilizador logado
                             if(!Store::is_admin_logged_in()) {
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
                             $id_product   = trim(strtolower($_POST['text_id_product']));
                             $product_name = trim(strtolower($_POST['text_product_name']));
                             $category     = trim($_POST['text_category']);
                             $price        = trim($_POST['text_price']);
                             $stock        = trim($_POST['text_stock']);
                             $description  = trim($_POST['text_description']);
                        // =========================================================== 

                        //$arr_temp  =  $id_admin . ' ' . $email . ' '  .$full_name .' '  .$address .' ' . $telephone;

                        //Store::printData($arr_temp);

                        // ===========================================================
                        // validar se é email válido
                            /* if(!filter_var($user , FILTER_VALIDATE_EMAIL)){
                                 $_SESSION['erro'] = "Endereço de email inválido.";
                                 $this->change_admin_data();
                                 return;
                             }*/
                        // ===========================================================   
                         
                        // ===========================================================
                        // validar os restantes campos
                             if(empty($product_name) || empty($category) || empty($price) ){
                                 $_SESSION['erro'] = "Preencha corretamente o formulário.";
                                 $this->change_admin_data();
                                 return;
                             }
                        // ===========================================================                      
                        
                        // ===========================================================
                        // validar se este email já existe noutra conta de customer
                            $product = new Products(); // Carregar model
                        // ===========================================================                        
                        
                        // ===========================================================
                        // atualizar os data do customer na base de data
                            $product->update_product(
                            $id_product  ,
                            $product_name,
                            $category    ,
                            $price       ,
                            $stock       ,
                            $description 
                        );
                        // ===========================================================                        
                   
                        // ===========================================================
                        // redirecionar para a página do profile
                            Store::redirect('home_page', true);
                        // ===========================================================                   
                    }
                // ===========================================================

                // ===========================================================
                // novo produto / new product   
                    public function new_product()
                    {
                        // ===========================================================
                        // verifica se já existe sessão aberta
                        /*  if (Store::is_customer_logged_in()) {
                                $this->index();
                                return;
                            } */
                        // ===========================================================
                        
                        // ===========================================================
                        // apresenta o layout para criar um novo utilizador
                            Store::admin_layout([
                                'admin/layouts/html_header',
                                'admin/layouts/header',
                                'admin/create_product',
                                'admin/layouts/footer',
                                'admin/layouts/html_footer',
                            ]);
                        // ===========================================================    
                    }
                // ===========================================================        

                // ===========================================================
                // criar produto / create product   
                    public function create_product()
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
                                return;
                            } 
                            else 
                            {
                                echo 'Aconteceu um erro';
                            }
                        // ===========================================================  
                    }
                // ===========================================================    
                
                // ===========================================================
                // apagar product / delete product   
                    public function delete_product()
                    {   
                        $id_product = Store::aes_decrypt($_GET['id_product']);
                        // Store::printData( $id_admin);
                            // ===========================================================
                            // apresenta o layout para criar um novo utilizador
                                // // Store::admin_layout([
                                // //     'admin/layouts/html_header',
                                // //     'admin/layouts/header',
                                // //    // 'admin/create_admin',
                                // //     'admin/layouts/footer',
                                // //     'admin/layouts/html_footer',
                            //// ]);
                            // ===========================================================  
                        // $purl = null;     

                            // ===========================================================
                            // verifica se já existe session
                            /* if (Store::is_admin_logged_in()) 
                                {
                                    echo 'aqui';
                                // $this->index();
                                //  return;
                                } */
                            // ===========================================================                
                        
                            // ===========================================================
                            // verifica se houve submissão de um formulário
                            /*    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                                {
                                    $this->index();
                                    return;
                                } */
                            // ===========================================================
                        
                            // ===========================================================
                            // verifica se pass 1 = pass 2
                                // // if ($_POST['text_pass_1'] !== $_POST['text_pass_2']) 
                                // // {
                                // //     // as passwords são diferentes
                                // //     $_SESSION['erro'] = 'As passs não estão iguais.';
                                // //     $this->new_admin();
                                // //     return;
                                // // }
                            // ===========================================================                
                        
                            // ===========================================================
                            // verifica na base de data se existe admin com mesmo email
                                $adminModel = new AdminModel();

                            

                                // // if ($adminModel->check_email_exists_admin($_POST['text_email'])) 
                                // // {
                                // //     $_SESSION['erro'] = 'Já existe um Admin com o mesmo email.';
                                // //     $this->new_admin();
                                // //     return;
                                // // }
                            // ===========================================================                
                            
                            // ===========================================================
                            // inserir novo admin na base de data e devolver o purl
                            //    $email_admin = strtolower(trim($_POST['text_email']));
                                $adminModel->delete_product($id_product); 

                                //Store::printData($email_admin);
                            // ===========================================================                
                            
                            // ===========================================================
                            // envio do email para o admin
                            /*    $email = new SendEmail();
                                $resultado = $email->send_email_confirmation_new_admin($email_admin, $purl); */

                        /*      if ($resultado) 
                                { */
                                    // ===========================================================
                                    // redirecionar para a página do profile
                                        Store::redirect('products_list', true);
                                    // ===========================================================
                            /* } 
                                else 
                                {
                                    echo 'Aconteceu um erro';
                                } */
                            // ===========================================================                
                    }
                // ===========================================================                    

            // ===========================================================   
        }
    // ===========================================================




