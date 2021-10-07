<?php
    use core\classes\Store;  
?>


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a  class="navbar-brand" onclick="home_page_admin()"><img src="../assets/images/icon/logo.svg" alt="main icon"></a><div class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href=""><i class="fas fa-bars"></i></div
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
         <!--       <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>-->
            </form>

            <div class="navbar-nav ml-auto ml-md-0">
                
              
                    <a onclick="apresentarModalProfileAdmin()" class="nav-link dropdown" id="userDropdown"><i class="fas fa-user fa-fw"></i> <span><?php echo $_SESSION['admin_full_name']; ?></span></a>
                   <a href="?a=admin_logout" class="nav-link dropdown" ><i class="fas fa-sign-out-alt me-2"></i></a>
                
            </div>


                
                
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Store</div>
                            <a type="button" class="nav-link" onclick="home_page_admin()"
                                ><div class="sb-nav-link-icon"><i class="far fa-address-card"></i></div>
                                Home</a  >
                            <a type="button" class="nav-link" onclick="customers_list()" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Customers</a >
                            <a type="button" class="nav-link" onclick="orders_list()">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                              Orders</a >
                            <a type="button" class="nav-link" onclick="products_list()" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-medkit"></i></div>
                                Products</a>
                                <a type="button" class="nav-link" onclick="admins_list()"
                                ><div class="sb-nav-link-icon"><i class="fas fa-medkit"></i></div>
                                Admins</a>
                                <a type="button" class="nav-link" onclick="agendar_encomenda()" 
                                ><div class="sb-nav-link-icon"><i class="far fa-calendar-alt"></i></div>
                                Agendar Encomendas</a>
                                <div class="sb-sidenav-menu-heading">Estatísticas</div>
                            <a type="button" class="nav-link" href=""
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Gráficos</a
                            >
                                
                        </div>


                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado  como:</div>
                    <?php
                        echo $_SESSION['admin_full_name'];
                    ?>
                    </div>
                </nav>

                
            </div>
   
        





    <!-- container-fluid -->
    <!-- ===================================================================================================== -->

                  <!-- <div class="row">
                      <div class="col-6 p-3 ">
                          <a  class="navbar-brand" onclick="home_page_admin()">
                              <img src="../assets/images/icon/logo.svg" alt="main icon">
                          </a>
                      </div>
                      
                      <div class="col-6 p-3 text-end align-self-center nav-item">
                      <?php if (Store::is_admin_logged_in()) : ?>
                                  <a onclick="apresentarModalProfileAdmin()" class="nav-item">
                                      <i class="fas fa-user me-2"></i>
                                      <?= $_SESSION['admin_user'] ?>
                                  </a>
                              <span class="mx-2 nav-item"></span>
                                  <a href="?a=admin_logout" class="mx-2 nav-item-inv">
                                      <i class="fas fa-sign-out-alt me-2 nav-item-inv"></i>
                                  </a>
                          <?php endif; ?>
                      </div>
                  </div> -->
    <!-- ===================================================================================================== -->


    	<!-- modal Profile -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalProfileAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div id="corpo_profile_admin_modal"  class="modal-content">

								
                        </div>
					</div>
			</div>
		<!-- ===================================================================================================== -->	 
        
		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalAlterarPassAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

					  <div class="modal-dialog modal-dialog-centered">
					  
						  <div id="corpo_modal_pass_admin" class="modal-content">
								

								
						  
						  </div>
						  



					  </div>

			</div>

		<!-- ===================================================================================================== --> 

		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
            <div class="modal fade" id="modalAlterarPassAdminAlfa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div id="corpo_modal_pass_admin_alfa" class="modal-content">
                    
                    </div>

                </div>

            </div>

<!-- ===================================================================================================== -->         
        
		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
            <div class="modal fade" id="modalAlterarDadosAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div id="corpo_modal_dados_admin" class="modal-content">
            

            
        
                        </div>
        



                    </div>

            </div>
        <!-- ===================================================================================================== -->  


<script>
            // admins list
            // =====================================================================================================
                function admins_list()
                {
                // alert('admins_list');

                        $.ajax(
                        {
                                method: 'post',
                                url: '?a=admins_list',

                                success:function(data)
                                {
                                // alert(data);
                                    const obj = JSON.parse(data);
                                    document.getElementById("home_admin").innerHTML = obj;
                                    
                                    let el = document.getElementById("grafico2");

                                    let options = {
                                        chart: {
                                            type: 'bar',
                                            height: 500,
                                            width: 600

                                        },

                                        series:[
                                            {
                                                name: 'Gender',
                                                data: [ document.getElementById("tot_masc").value  , document.getElementById("tot_femi").value ]
                                            }
                                        ],

                                        xaxis: {
                                            categories: ['M', 'F']
                                        },

                                        title: {
                                            text: "Gender"
                                        }
                                    };

                                    let chart = new ApexCharts(el, options);
                                    chart.render();


                                    $(document).ready(function() {
                                        
                                    $('#tabela-admins').DataTable({
                                        // "processing":true,
                                        // "serverSide":true,
                                        // "order":[],
                                        "ajax":{
                                            url:"?a=criar_tabela_admin",
                                            type:"POST",
                                        },

                                        language: {
                                            "decimal": "",
                                            "emptyTable": "No data available in table",
                                            "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                                            "infoEmpty": "Não existme admins disponiveis",
                                            "infoFiltered": "(Filtrado de um total de _MAX_ admins)",
                                            "infoPostFix": "",
                                            "thousands": ",",
                                            "lengthMenu": "Apresenta _MENU_ admins por página",
                                            "loadingRecords": "Carregando...",
                                            "processing": "Processando...",
                                            "search": "Procurar:",
                                            "zeroRecords": "Não existem admins disponiveis",
                                            "paginate": {
                                                "first": "Primeira",
                                                "last": "Última",
                                                "next": "Seguinte",
                                                "previous": "Anterior"
                                            },
                                            "aria": {
                                                "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                                                "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                                            }
                                        }
                                        });


                                        

                                        
                                    });

                                    //alert(dataTable);

                                    

                                    function definir_filtro() 
                                    {
                                        var filtro = document.getElementById("combo-status").value;

                                        console.log(filtro);
                                        // reload da página com determinado filtro
                                        window.location.href = window.location.pathname + "?" + $.param({
                                        'a': 'admins_list',
                                        'f': filtro
                                    }

                                    
                        
                        );   
                        
                        
                        }

                                    
                                    
                                },
                                error:function(data)
                                {
                                    alert('error');
                                }
                            });
                }
            // =====================================================================================================

            // products list
            // =====================================================================================================
                function products_list()
                {

                    $.ajax(
                    {
                        method: 'post',
                        url: '?a=products_list',

                        success:function(data)
                        {
                    
                            const obj = JSON.parse(data);
                            document.getElementById("home_admin").innerHTML = obj;

                            let el = document.getElementById("grafico");

                            let options = {
                                chart: {
                                    type: 'bar',
                                    height: 500,
                                    width: 600

                                },

                                series:[
                                    {
                                        name: 'status',
                                        data: [ <?= $total_orders_pending ?>, <?= $total_orders_in_processing ?> ]
                                    }
                                ],

                                xaxis: {
                                    categories: ['Pendentes', 'Em Processamento']
                                },

                                title: {
                                    text: "Estado das Encomendas"
                                }
                            };

                            let chart = new ApexCharts(el, options);
                            chart.render();                        



                            $(document).ready(function() 
                            {
                                $('#tabela-products').DataTable({
                                    "ajax":{
                                            url:"?a=criar_tabela_products",
                                            type:"POST",
                                    },                                   
                                    language: {
                                        "decimal": "",
                                        "emptyTable": "No data available in table",
                                        "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                                        "infoEmpty": "Não existem orders disponíveis",
                                        "infoFiltered": "(Filtrado de um total de _MAX_ products)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Apresenta _MENU_ products por página",
                                        "loadingRecords": "Carregando...",
                                        "processing": "Processando...",
                                        "search": "Procurar:",
                                        "zeroRecords": "Não foram encontrados products",
                                        "paginate": {
                                            "first": "Primeira",
                                            "last": "Última",
                                            "next": "Seguinte",
                                            "previous": "Anterior"
                                        },
                                        "aria": {
                                            "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                                            "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                                        }
                                    }
                                });
                            });


                        function definir_filtro() {
                            var filtro = document.getElementById("combo-status").value;
                            // reload da página com determinado filtro
                            window.location.href = window.location.pathname + "?" + $.param({
                                'a': 'products_list',
                                'f': filtro
                            });
                        }


                            
                        },
                        error:function(data)
                        {
                            alert('error');
                        }
                    });
                }
            // =====================================================================================================
            
            // orders list
            // =====================================================================================================
                function orders_list()
                {
                // alert('orders_list');

                    $.ajax(
                    {
                        method: 'post',
                        url: '?a=orders_list',

                        success:function(data)
                        {
                            
                            const obj = JSON.parse(data);
                            //alert(obj);
                            document.getElementById("home_admin").innerHTML = obj;

                            $(document).ready(function() {

    

                                $('#tabela-orders').DataTable({
                                    "ajax":{
                                            url:"?a=criar_tabela_orders",
                                            type:"POST",
                                    }, 

                                    language: {
                                        "decimal": "",
                                        "emptyTable": "No data available in table",
                                        "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                                        "infoEmpty": "Não existem orders disponíveis",
                                        "infoFiltered": "(Filtrado de um total de _MAX_ orders)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Apresenta _MENU_ orders por página",
                                        "loadingRecords": "Carregando...",
                                        "processing": "Processando...",
                                        "search": "Procurar:",
                                        "zeroRecords": "Não foram encontradas orders",
                                        "paginate": {
                                            "first": "Primeira",
                                            "last": "Última",
                                            "next": "Seguinte",
                                            "previous": "Anterior"
                                        },
                                        "aria": {
                                            "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                                            "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                                        }
                                    }
                                });

                            });

                        function definir_filtro() {
                            var filtro = document.getElementById("combo-status").value;
                            // reload da página com determinado filtro
                            window.location.href = window.location.pathname + "?" + $.param({
                                'a': 'orders_list',
                                'f': filtro
                            });
                        }

                        let el = document.getElementById("grafico");

                        let options = {
                            chart: {
                                type: 'bar',
                                height: 500,
                                width: 600

                            },

                            series: [{
                                name: 'status',
                                data: [<?= $total_orders_pending ?>, <?= $total_orders_in_processing ?>]
                            }],

                            xaxis: {
                                categories: ['Pendentes', 'Em Processamento']
                            },

                            title: {
                                text: "Estado da encomenda"
                            }
                        };

                        let chart = new ApexCharts(el, options);
                        chart.render();                    
                            
                        },
                        error:function(data)
                        {
                            alert('error');
                        }
                    });
                }
            // =====================================================================================================
            
            // customers list
            // =====================================================================================================
                function customers_list()
                {
                    //alert('aqui');

                    $.ajax(
                    {
                        method: 'post',
                        url: '?a=customers_list',

                        success:function(data)
                        {
                        
                            const obj = JSON.parse(data);
                            //alert(obj);
                            document.getElementById("home_admin").innerHTML = obj;

                            let el = document.getElementById("grafico");

                            let options = {
                                chart: {
                                    type: 'bar',
                                    height: 500,
                                    width: 600

                                },

                                series:[
                                    {
                                        name: 'Gender',
                                        data: [ document.getElementById("total_customers_masc").value  , document.getElementById("total_customers_femi").value ]
                                    }
                                ],

                                xaxis: {
                                    categories: ['M', 'F']
                                },

                                title: {
                                    text: "Gender"
                                }
                            };

                            let chart = new ApexCharts(el, options);
                            chart.render();

                            $(document).ready(function() 
                            {
                                $('#tabela-customers').DataTable({
                                    "ajax":{
                                            url:"?a=criar_tabela_customer",
                                            type:"POST",
                                        },                                
                                    // "ajax":{
                                    //         url:"?a=criar_tabela_customer",
                                    //         type:"POST",
                                    //     },
                                    language: {
                                        "decimal": "",
                                        "emptyTable": "No data available in table",
                                        "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                                        "infoEmpty": "Não existem clientes disponíveis",
                                        "infoFiltered": "(Filtrado de um total de _MAX_ clientes)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Apresenta _MENU_ clientes por página",
                                        "loadingRecords": "Carregando...",
                                        "processing": "Processando...",
                                        "search": "Procurar:",
                                        "zeroRecords": "Não foram encontrados clientes",
                                        "paginate": {
                                            "first": "Primeira",
                                            "last": "Última",
                                            "next": "Seguinte",
                                            "previous": "Anterior"
                                        },
                                        "aria": {
                                            "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                                            "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                                        }
                                    }
                                });

                            });

                                function definir_filtro() 
                                {
                                        var filtro = document.getElementById("combo-status").value;

                                        console.log(filtro);
                                        // reload da página com determinado filtro
                                        window.location.href = window.location.pathname + "?" + $.param({
                                        'a': 'customers_list',
                                        'f': filtro
                                        });
                                }                           
                            
                        },
                        error:function(data)
                        {
                            alert('error');
                        }
                    });
                }
            // =====================================================================================================
            
            // home page admin
            // =====================================================================================================
                function home_page_admin()
                {
                // alert('aqui');

                    $.ajax(
                    {
                        method: 'post',
                        url: '?a=home_page_admin',

                        success:function(data)
                        {
                        //  alert(data);
                            const obj = JSON.parse(data);
                            document.getElementById("home_admin").innerHTML = obj;

                            let el = document.getElementById("grafico");

                            let options = {
                                chart: {
                                    type: 'bar',
                                    height: 500,
                                    width: 600

                                },

                                series:[
                                    {
                                        name: 'status',
                                        data: [ <?= $total_orders_pending ?>, <?= $total_orders_in_processing ?> ]
                                    }
                                ],

                                xaxis: {
                                    categories: ['Pendentes', 'Em Processamento']
                                },

                                title: {
                                    text: "Estado das Encomendas"
                                }
                            };

                            let chart = new ApexCharts(el, options);
                            chart.render();
                            
                        },
                        error:function(data)
                        {
                            alert('error');
                        }
                    });
                }
            // =====================================================================================================

            // admins list
            // =====================================================================================================
                function agendar_encomenda()
                {
                // alert('admins_list');

                        $.ajax(
                        {
                                method: 'post',
                                url: '?a=agendar_encomenda',

                                success:function(data)
                                {
                                    alert(data);
                                    
                                    const obj = JSON.parse(data);
                                    document.getElementById("home_admin").innerHTML = '<div id="calendar"></div>';


                                    var calendarEl = document.getElementById('calendar');

                     
                    
                                    
                                    // // let el = document.getElementById("grafico2");

                                    // // let options = {
                                    // //     chart: {
                                    // //         type: 'bar',
                                    // //         height: 500,
                                    // //         width: 600

                                    // //     },

                                    // //     series:[
                                    // //         {
                                    // //             name: 'Gender',
                                    // //             data: [ document.getElementById("tot_masc").value  , document.getElementById("tot_femi").value ]
                                    // //         }
                                    // //     ],

                                    // //     xaxis: {
                                    // //         categories: ['M', 'F']
                                    // //     },

                                    // //     title: {
                                    // //         text: "Gender"
                                    // //     }
                                    // // };

                                    // // let chart = new ApexCharts(el, options);
                                    // // chart.render();


                                    $(document).ready(function() {
                                        
                                    // // $('#tabela-admins').DataTable({
                                    // //     // "processing":true,
                                    // //     // "serverSide":true,
                                    // //     // "order":[],
                                    // //     "ajax":{
                                    // //         url:"?a=criar_tabela_admin",
                                    // //         type:"POST",
                                    // //     },

                                    // //     language: {
                                    // //         "decimal": "",
                                    // //         "emptyTable": "No data available in table",
                                    // //         "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                                    // //         "infoEmpty": "Não existme admins disponiveis",
                                    // //         "infoFiltered": "(Filtrado de um total de _MAX_ admins)",
                                    // //         "infoPostFix": "",
                                    // //         "thousands": ",",
                                    // //         "lengthMenu": "Apresenta _MENU_ admins por página",
                                    // //         "loadingRecords": "Carregando...",
                                    // //         "processing": "Processando...",
                                    // //         "search": "Procurar:",
                                    // //         "zeroRecords": "Não existem admins disponiveis",
                                    // //         "paginate": {
                                    // //             "first": "Primeira",
                                    // //             "last": "Última",
                                    // //             "next": "Seguinte",
                                    // //             "previous": "Anterior"
                                    // //         },
                                    // //         "aria": {
                                    // //             "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                                    // //             "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                                    // //         }
                                    // //     }
                                    // //     });


                                        

                                        
                                    });

                                    //alert(dataTable);

                                    

                                    function definir_filtro() 
                                    {
                                        var filtro = document.getElementById("combo-status").value;

                                        console.log(filtro);
                                        // reload da página com determinado filtro
                                        window.location.href = window.location.pathname + "?" + $.param({
                                        'a': 'admins_list',
                                        'f': filtro
                                    }

                                    
                        
                        );   
                        
                        
                        }

                                    
                                    
                                },
                                error:function(data)
                                {
                                    alert('error');
                                }
                            });
                }
            // =====================================================================================================            
                
</script>

    <!-- ADMIN  MODALS -->
    <!-- ===================================================================================================== -->

        <!-- modal - ver admin -->
        <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalVerAdmin" name="modalVerAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id="corpo_modal_ver_admin">
                    </div>
                </div>
            </div>
        <!-- ===================================================================================================== -->  

        <!-- modal - update admin -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalUpdateAdmin" name="modalUpdateAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <form method="post"  id="admin_form" enctype="multipart/form-data">
                            <div class="modal-content" id='corpo_modal_update_admin'>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                        <div class="modal-body">

                                            <div id="msg_dados">
                                                        
                                            </div>

                                            <form enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="email" maxlength="50" id="text_email_admin" name="text_email_admin" class="form-control" required value="">
                                                    <input type="hidden" maxlength="50" id="text_id_admin" name="text_id_admin" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_1_admin" id="text_pass_1_admin" placeholder="Pass" required>
                                                    <br/>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Repetir Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_2_admin" id="text_pass_2_admin"  placeholder="Repetir Pass" required>
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Full Name:</label>
                                                    <input type="text" maxlength="50" id="text_full_name_admin" name="text_full_name_admin" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>address:</label>
                                                    <input type="text" maxlength="100" id="text_address_admin" name="text_address_admin" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>city:</label>
                                                    <input type="text" maxlength="50" id="text_city_admin" name="text_city_admin" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>telephone:</label>
                                                    <input type="text" maxlength="20" id="text_telephone_admin" name="text_telephone_admin" class="form-control" value="">
                                                    <br/>
                                                </div>

                                                <label>Estado:</label>
                                                <select id="text_activo_admin" name="text_activo_admin"  class="form-control" onchange="" value="">
                                                    <option value="">Escolha</option>
                                                    <option value="0">Inactivo</option>
                                                    <option value="1">Activo</option>';
                                                </select>	
                                                <br/>

                                                <label>Gender</label>
                                                <select id="text_gender_admin" name="text_gender_admin" class="form-control" onchange="" value=""> 
                                                    <option value="">Escolha</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Feminino</option>'; 
                                                </select>
                                                <br/>
                                                

                                                <div class="form-group">    
                                                    <label>Foto</label>
                                                    <input type="file" name="text_image_admin" id="text_image_admin" value="" />
                                                    <span id="upload_image_admin" name="upload_image_admin"></span>
                                                    <!-- <div class="col-9"><img src="../assets/images/products/" class="img-fluid" width="40px"></div> -->
                                                </div> 

                                            </form>

                                        </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                    </form>                 
                    </div>
            </div>
        <!-- ===================================================================================================== -->    

        <!-- modal - add admin -->
        <!-- ===================================================================================================== -->
            <div id="userModal" name="userModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <form method="post"  id="user_form" enctype="multipart/form-data">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="corpo_modal">

                                <!-- Email -->
                                <!-- ===================================================================================================== -->				
                                    <label>Email</label>
                                        <input type="email" class="form-control" name="text_email_admin_add" id="text_email_admin_add" placeholder="Email" required>
                                        <br/>
                                <!-- ===================================================================================================== -->					
                                
                                <!-- pass_1 -->
                                <!-- ===================================================================================================== -->					
                                    <label>Pass</label>
                                    <input type="password" class="form-control" name="text_pass_1_admin_add" id="text_pass_1_admin_add" placeholder="Pass" required>
                                    <br/>
                                <!-- ===================================================================================================== -->					
                                <!-- pass_2 -->
                                <!-- ===================================================================================================== -->					
                                    <label>Repetir Pass</label>
                                    <input type="password" class="form-control" name="text_pass_2_admin_add" id="text_pass_2_admin_add"  placeholder="Repetir Pass" required>
                                    <br/>
                                <!-- ===================================================================================================== -->					
                                <!-- Full Name -->
                                <!-- ===================================================================================================== -->					
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="text_full_name_admin_add"  id="text_full_name_admin_add"  placeholder="Full Name" required>
                                    <br/>
                                <!-- ===================================================================================================== -->					
                                <!-- address -->
                                <!-- ===================================================================================================== -->					
                                    <label>address</label>
                                    <input type="text" class="form-control" name="text_address_admin_add" id="text_address_admin_add" placeholder="address" required>
                                    <br/>
                                <!-- ===================================================================================================== -->					
                                <!-- city -->
                                <!-- ===================================================================================================== -->					
                                    <label>city</label>
                                    <input type="text" class="form-control" name="text_city_admin_add" id="text_city_admin_add"  placeholder="city" required>
                                    <br/>
                                <!-- ===================================================================================================== -->					
                                <!-- telephone -->
                                <!-- ===================================================================================================== -->					
                                    <label>telephone</label>
                                    <input type="text" class="form-control" name="text_telephone_admin_add" id="text_telephone_admin_add" placeholder="telephone">
                                    <br/>
                                <!-- ===================================================================================================== -->	
                                
                                <!-- Estado -->
                                <!-- ===================================================================================================== -->					
                                    <label>Estado:</label>
                                    <select id="text_activo_admin_add" name="text_activo_admin_add"  class="form-control" onchange="">
                                                        <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                        <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                                        <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                    </select>	
                                    <br/>
                                <!-- ===================================================================================================== -->									
                                <!-- Género -->
                                <!-- ===================================================================================================== -->					
                                    <label>Gender</label>
                                    <select id="text_gender_admin_add" name="text_gender_admin_add" class="form-control" onchange=""> 
                                                                    <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                                    <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                                    <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                    </select>
                                    <br/>
                                <!-- ===================================================================================================== -->	
                                <!-- Picture -->
                                <!-- ===================================================================================================== -->					
                                    <input type="file" name="user_image_add" id="user_image_add" />
                                    <span id="user_uploaded_image"></span>
                                <!-- ===================================================================================================== -->		                        

                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="user_id" id="user_id" />
                                <input type="hidden" name="operation" id="operation" />
                                <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
        <!-- ===================================================================================================== -->  

    <!-- ===================================================================================================== -->       
    
    <!-- CUSTOMER MODALS -->
    <!-- ===================================================================================================== -->

        <!-- modal - ver customer -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalVerCustomer" name="modalVerCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id="corpo_modal_ver_customer">
                    </div>
                </div>
            </div>
        <!-- ===================================================================================================== -->  

        <!-- modal - update Customer -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalUpdateCustomer" name="modalUpdateCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <form method="post"  id="customer_form_update" enctype="multipart/form-data">
                            <div class="modal-content" id='corpo_modal_update_admin'>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alterar dados pessoais Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                        <div class="modal-body">

                                            <div id="msg_dados">
                                                        
                                            </div>

                                            <form enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="email" maxlength="50" id="text_email_customer" name="text_email_customer" class="form-control" required value="">
                                                    <input type="hidden" maxlength="50" id="text_id_customer" name="text_id_customer" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_1_customer" id="text_pass_1_customer" placeholder="Pass" required>
                                                    <br/>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Repetir Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_2_customer" id="text_pass_2_customer"  placeholder="Repetir Pass" required>
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Full Name:</label>
                                                    <input type="text" maxlength="50" id="text_full_name_customer" name="text_full_name_customer" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>address:</label>
                                                    <input type="text" maxlength="100" id="text_address_customer" name="text_address_customer" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>city:</label>
                                                    <input type="text" maxlength="50" id="text_city_customer" name="text_city_customer" class="form-control" required value="">
                                                    <br/>
                                                </div>

                                                <div class="form-group">
                                                    <label>telephone:</label>
                                                    <input type="text" maxlength="20" id="text_telephone_customer" name="text_telephone_customer" class="form-control" value="">
                                                    <br/>
                                                </div>

                                                <label>Estado:</label>
                                                <select id="text_activo_customer" name="text_activo_customer"  class="form-control" onchange="" value="">
                                                    <option value="">Escolha</option>
                                                    <option value="0">Inactivo</option>
                                                    <option value="1">Activo</option>';
                                                </select>	
                                                <br/>

                                                <label>Gender</label>
                                                <select id="text_gender_customer" name="text_gender_customer" class="form-control" onchange="" value=""> 
                                                    <option value="">Escolha</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Feminino</option>'; 
                                                </select>
                                                <br/>
                                                

                                                <div class="form-group">    
                                                    <label>Foto</label>
                                                    <input type="file" name="text_image_customer" id="text_image_customer" value="" />
                                                    <span id="upload_image_customer" name="upload_image_customer"></span>
                                                    <!-- <div class="col-9"><img src="../assets/images/products/" class="img-fluid" width="40px"></div> -->
                                                </div> 

                                            </form>

                                        </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                    </form>                 
                    </div>
            </div>
        <!-- ===================================================================================================== -->   

        <!-- modal - add customer -->
        <!-- ===================================================================================================== -->
            <div id="customerModal" name="customerModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form method="post"  id="customer_form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body" id="corpo_modal_customer">

                                            <div id="msg_dados_admin">
                                                </div>

                                                <!-- Email -->
                                                <!-- ===================================================================================================== -->				
                                                <label>Email</label>
                                                    <input type="email" class="form-control" name="text_email_customer_add" id="text_email_customer_add" placeholder="Email" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					
                                                
                                                <!-- pass_1 -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_1_customer_add" id="text_pass_1_customer_add" placeholder="Pass" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					

                                                <!-- pass_2 -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>Repetir Pass</label>
                                                    <input type="password" class="form-control" name="text_pass_2_customer_add" id="text_pass_2_customer_add"  placeholder="Repetir Pass" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					

                                                <!-- Full Name -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name="text_full_name_customer_add"  id="text_full_name_customer_add"  placeholder="Full Name" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					

                                                <!-- address -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>address</label>
                                                    <input type="text" class="form-control" name="text_address_customer_add" id="text_address_customer_add" placeholder="address" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					

                                                <!-- city -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>city</label>
                                                    <input type="text" class="form-control" name="text_city_customer_add" id="text_city_customer_add"  placeholder="city" required>
                                                    <br/>
                                                <!-- ===================================================================================================== -->					

                                                <!-- telephone -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>telephone</label>
                                                    <input type="text" class="form-control" name="text_telephone_customer_add" id="text_telephone_customer_add" placeholder="telephone">
                                                    <br/>
                                                <!-- ===================================================================================================== -->	
                                                
                                                <!-- Estado -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>Estado:</label>
                                                    <select id="text_activo_customer_add" name="text_activo_customer_add"  class="form-control" onchange="">
                                                        <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                        <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                                        <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                                    </select>	
                                                    <br/>
                                                <!-- ===================================================================================================== -->									

                                                <!-- Género -->
                                                <!-- ===================================================================================================== -->					
                                                    <label>Gender</label>
                                                    <select id="text_gender_customer_add" name="text_gender_customer_add" class="form-control" onchange=""> 
                                                                    <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                                    <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                                    <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                                    </select>
                                                    <br/>
                                                <!-- ===================================================================================================== -->	

                                                <!-- Picture -->
                                                <!-- ===================================================================================================== -->					
                                                    <input type="file" name="customer_image_add" id="customer_image_add" />
                                                    <span id="customer_uploaded_image"></span>
                                                <!-- ===================================================================================================== -->		                        

                                </div>
                            <div class="modal-footer">
                                <input type="hidden" name="customer_id" id="customer_id" />
                                <input type="hidden" name="operation" id="operation" />
                                <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- ===================================================================================================== -->  

    <!-- ===================================================================================================== -->

    <!-- PRODUCT MODALS -->
    <!-- ===================================================================================================== -->

        <!-- modal - ver product -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalVerProduct" name="modalVerProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id="corpo_modal_ver_product">
                    </div>
                </div>
            </div>
        <!-- ===================================================================================================== -->  

        <!-- modal - update product -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalUpdateProduct" name="modalUpdateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <form method="post"  id="product_form_update" enctype="multipart/form-data">
                            <div class="modal-content" id='corpo_modal_update_product'>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alterar dados do produto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body" id="corpo_modal_product">

                                    <!-- Product name -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>ID product</label>
                                            <input type="text" class="form-control" id="text_id_product"  name="text_id_product"  placeholder="product name" required>
                                        </div>
                                    <!-- ===================================================================================================== -->	                                

                                    <!-- Category -->
                                    <!-- ===================================================================================================== -->				
                                        <div class="my-3">
                                            <label>Category</label>
                                            <select id="text_category_product" name="text_category_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= CATEGORY[0] ?>"  class="nav-it"><?= CATEGORY[0] ?></option>
                                                <option value="<?= CATEGORY[1] ?>"  class="nav-it"><?= CATEGORY[1] ?></option>
                                                <option value="<?= CATEGORY[2] ?>"  class="nav-it"><?= CATEGORY[2] ?></option>
                                            </select>	
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Product name -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Product name</label>
                                            <input type="text" class="form-control" id="text_product_name"  name="text_product_name"  placeholder="product name" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Price -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Price</label>
                                            <input type="text" class="form-control" id="text_product_price" name="text_product_price"  placeholder="price" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- VAT -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>VAT</label>
                                            <input type="text" class="form-control" id="text_VAT_product" name="text_VAT_product"  placeholder="VAT" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Stock -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Stock</label>
                                            <input type="text" class="form-control" id="text_stock_product" name="text_stock_product"  placeholder="Stock" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Description -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>description</label>
                                            <input type="text" class="form-control" id="text_description_product" name="text_description_product"  placeholder="description" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- visible -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Visible</label>
                                            <select id="text_visible_product" name="text_visible_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= active[0] ?>"  class="nav-it">escondido</option>
                                                <option value="<?= active[1] ?>"  class="nav-it">visivel</option>
                                            </select>
                                        </div>
                                    <!-- ===================================================================================================== -->	

                                    <!-- active -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Activo</label>
                                            <select id="text_active_product" name="text_active_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= active[0] ?>"  class="nav-it">inactivo</option>
                                                <option value="<?= active[1] ?>"  class="nav-it">activo</option>
                                            </select>
                                        </div>
                                    <!-- ===================================================================================================== -->                                    

                                    <!-- Picture -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Picture</label>
                                            <input type="file" class="form-control" name="product_image" id="product_image">
                                            <span id="product_uploaded_image" name="product_uploaded_image"></span>
                                        </div>
                                    <!-- ===================================================================================================== -->	

                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                    </form>                 
                    </div>
            </div>
        <!-- ===================================================================================================== -->           


        <!-- modal - add product -->
        <!-- ===================================================================================================== -->
            <div id="productModal" name="productModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <form method="post"  id="product_form" enctype="multipart/form-data">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="corpo_modal_product">

                                    <!-- Category -->
                                    <!-- ===================================================================================================== -->				
                                        <div class="my-3">
                                            <label>Category</label>
                                            <select id="text_category_product" name="text_category_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= CATEGORY[0] ?>"  class="nav-it"><?= CATEGORY[0] ?></option>
                                                <option value="<?= CATEGORY[1] ?>"  class="nav-it"><?= CATEGORY[1] ?></option>
                                                <option value="<?= CATEGORY[2] ?>"  class="nav-it"><?= CATEGORY[2] ?></option>
                                            </select>	
                                        </div>
                                    <!-- ===================================================================================================== -->					
                                    
                                    <!-- Product name -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Product name</label>
                                            <input type="text" class="form-control" id="text_product_name"  name="text_product_name"  placeholder="product name" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Price -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Price</label>
                                            <input type="text" class="form-control" id="text_price" name="text_price"  placeholder="text_price" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- VAT -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>VAT</label>
                                            <input type="text" class="form-control" id="text_VAT" name="text_VAT"  placeholder="VAT" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Stock -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Stock</label>
                                            <input type="text" class="form-control" id="text_stock" name="text_stock"  placeholder="Stock" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Description -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>description</label>
                                            <input type="text" class="form-control" id="text_description" name="text_description"  placeholder="description" required>
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                    <!-- visible -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Visible</label>
                                            <select id="text_visible_product" name="text_visible_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= active[0] ?>"  class="nav-it">escondido</option>
                                                <option value="<?= active[1] ?>"  class="nav-it">visivel</option>
                                            </select>
                                        </div>
                                    <!-- ===================================================================================================== -->	

                                    <!-- active -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                            <label>Activo</label>
                                            <select id="text_active_product" name="text_active_product"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= active[0] ?>"  class="nav-it">inactivo</option>
                                                <option value="<?= active[1] ?>"  class="nav-it">activo</option>
                                            </select>
                                        </div>
                                    <!-- ===================================================================================================== -->                                    
                                    
                                    <!-- Picture -->
                                    <!-- ===================================================================================================== -->					
                                        <div class="my-3">
                                                    <label>Picture</label>
                                                    <input type="file" class="form-control" name="product_image" id="product_image">
                                        </div>
                                    <!-- ===================================================================================================== -->		                        
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="product_id" id="product_id" />
                                <input type="hidden" name="operation" id="operation" />
                                <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
        <!-- ===================================================================================================== -->   

    <!-- ===================================================================================================== -->

    <!-- ORDER MODALS -->
    <!-- ===================================================================================================== -->

        <!-- modal - ver order -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalVerOrder" name="modalVerOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id="corpo_modal_ver_order">
                    </div>
                </div>
            </div>
        <!-- ===================================================================================================== -->  
        
        <!-- modal - update order -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalUpdateOrder" name="modalUpdateOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <form method="post"  id="order_form_update" enctype="multipart/form-data">
                            <div class="modal-content" id='corpo_modal_update_product'>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alterar dados da encomenda</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body" id="corpo_modal_product">

                                                                        <!-- Status -->
                                    <!-- ===================================================================================================== -->				
                                    <div class="my-3">
                                        <input type="hidden" id="update_id_order" name="update_id_order">
                                    </div>
                                    <!-- ===================================================================================================== -->		
                                    <!-- Status -->
                                    <!-- ===================================================================================================== -->				
                                        <div class="my-3">
                                            <label>Status</label>
                                            <select id="update_status_order" name="update_status_order"  class="form-control" onchange="">
                                                <option value="" selected class="nav-it"></option>
                                                <option value="<?= STATUS[0] ?>"  class="nav-it"><?= STATUS[0] ?></option>
                                                <option value="<?= STATUS[1] ?>"  class="nav-it"><?= STATUS[1] ?></option>
                                                <option value="<?= STATUS[2] ?>"  class="nav-it"><?= STATUS[2] ?></option>
                                                <option value="<?= STATUS[3] ?>"  class="nav-it"><?= STATUS[3] ?></option>
                                                <option value="<?= STATUS[4] ?>"  class="nav-it"><?= STATUS[4] ?></option>
                                            </select>	
                                        </div>
                                    <!-- ===================================================================================================== -->					

                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                    </form>                 
                    </div>
            </div>
        <!-- ===================================================================================================== --> 
       
        
		<!-- Modal order detail -->
		<!-- ===================================================================================================== -->
		    <div class="modal fade" id="modalOrderDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_order_detail" class="modal-content">

						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->   
        


    <!-- ===================================================================================================== -->    

    <script>

        // ADMIN
        // =================================================================================================

            // Apresentar Modal - ver admin
            // =============================================================================================
                function apresentarModalVerAdmin(id_admin) 
                {
                    $.ajax(
                    {
                        url:"?a=create_modal_ver_admin",
                        method:"POST",
                        data:{id_admin:id_admin},
                        success:function(data)
                        {
                            const obj = JSON.parse(data);
                            var modalVerAdmin = new bootstrap.Modal(document.getElementById('modalVerAdmin'));
                            modalVerAdmin.show();
                            document.getElementById("corpo_modal_ver_admin").innerHTML = obj;
                        },
                        error:function(data)
                        {
                            //$('#modalUpdate').modal('hide');
                        }
                    });
                }     
            // ============================================================================================= 

            // Apresentar Modal - actualizar admin
            // =============================================================================================
                function apresentarModalUpdateAdmin(id_admin) 
                {
                    $('#upload_image_admin').html('');

                    $.ajax({
                        url:"?a=create_modal_update_admin&c=" + id_admin,
                        method:"POST",
                        data:{id_admin:id_admin},
                        success:function(data)
                        {
                           const obj = JSON.parse(data);
                           $('#modalUpdateAdmin').modal('show');
                           $('#text_email_admin').val(obj.user);
                           $('#text_id_admin').val(obj.id_admin);
                           $('#text_pass_1_admin').val(obj.pass);
                           $('#text_pass_2_admin').val(obj.pass);
                           $('#text_full_name_admin').val(obj.full_name);
                           $('#text_address_admin').val(obj.address);
                           $('#text_city_admin').val(obj.city);
                           $('#text_telephone_admin').val(obj.telephone);
                           $('#text_activo_admin').val(obj.active);
                           $('#text_gender_admin').val(obj.gender);
                           $('#upload_image_admin').html(obj.image);
                        },
                        error:function(data)
                        {
                        alert('Error');
                        }
                    });
                }
            // =============================================================================================           

            // Apresenta Modal - adiconar admin 
            // =============================================================================================
                $(document).on('click', '#botao_adicionar', function(event)
                {
                    $('#user_form')[0].reset();
                    $('.modal-title').text("Adicionar Admin");
                    $('#action').val("Add");
		            $('#operation').val("Add");
                    $('#upload_image_admin').html('');
                    $('#userModal').modal('show');
                });
            // =============================================================================================

            // Submeter dados - adicionar admin
            // =============================================================================================
                $(document).on('submit', '#user_form', function(event)
                {
                    event.preventDefault();

                    var text_email_admin = $('#text_email_admin_add').val();
                    var text_pass_1_admin = $('#text_pass_1_admin_add').val();
                    var text_pass_2_admin = $('#text_pass_2_admin_add').val();
                    var text_full_name_admin = $('#text_full_name_admin_add').val();
                    var text_address_admin = $('#text_address_admin_add').val();
                    var text_city_admin = $('#text_city_admin_add').val();
                    var text_telephone_admin = $('#text_telephone_admin_add').val();
                    var text_activo_admin = '';
                    var text_gender_admin = ''; 

                    $("#text_activo_admin_add option:selected").each(function() 
                    {
                        text_activo_admin = $(this).val();
                    }); 

                    $("#text_gender_admin_add option:selected").each(function() 
                    {
                        text_gender_admin = $(this).val();
                    });    
                    
                    var image = $('#user_image_add').val().split('\\').pop().toLowerCase();
                    var extension = $('#user_image_add').val().split('.').pop().toLowerCase();  
                    
                    if(extension != '')
                    {
                        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                        {
                            alert("Invalid Image File");
                            $('#user_image_add').val('');
                            return false;
                        }
                    }	        
                    
                    array = [ text_email_admin,
                        text_pass_1_admin,
                        text_pass_2_admin ,
                        text_full_name_admin,
                        text_address_admin ,
                        text_city_admin ,
                        text_telephone_admin ,
                        image,
                        text_activo_admin ,
                        text_gender_admin 
                        ];
                        
                    //alert(array);

                    if(text_email_admin != '' && text_pass_1_admin != '' && text_pass_2_admin != '' && text_full_name_admin !='' 
                        && text_address_admin != '' && text_city_admin != '' && text_telephone_admin != '' && text_activo_admin != ''
                        && text_gender_admin != '' && image != '')
                    {
                        //alert('success');
                        $.ajax(
                            {
                                    method: 'post',
                                    url: '?a=create_admin',
                                    data:new FormData(this),
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        alert("Admin adicionado com successo!!");
                                        $('#tabela-admins').DataTable().ajax.reload();
                                        $('#userModal').modal('hide');
                                        
                                        
                                    },
                                    error:function(data)
                                    {
                                    
                                        alert('ajax error');
                                    
                                    }
                                    
                            });            

                    }
                    else
                    {
                        alert("Both Fields are Required");
                    }
                    
                   
                });
            // =============================================================================================   

            // Submeter dados - atualizar admin
            // =============================================================================================
                $(document).on('submit', '#admin_form', function(event)
                {
                        event.preventDefault();

                        var text_id_admin = $('#text_id_admin').val();
                        var text_email_admin = $('#text_email_admin').val();
                        
                        var text_pass_1_admin = $('#text_pass_1_admin').val();
                        var text_pass_2_admin = $('#text_pass_2_admin').val();
                        var text_full_name_admin = $('#text_full_name_admin').val();
                        var text_address_admin = $('#text_address_admin').val();
                        var text_city_admin = $('#text_city_admin').val();
                        var text_telephone_admin = $('#text_telephone_admin').val();
                        var text_activo_admin = '';
                        var text_gender_admin = ''; 

                        $("#text_activo_admin option:selected").each(function() 
                        {
                            text_activo_admin = $(this).val();
                        }); 

                        $("#text_gender_admin option:selected").each(function() 
                        {
                            text_gender_admin = $(this).val();
                        });    
                        
                        var image = $('#text_image_admin').val().split('\\').pop().toLowerCase();
                        var extension = $('#text_image_admin').val().split('.').pop().toLowerCase();  
                        
                        if(extension != '')
                        {
                            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                            {
                                alert("Invalid Image File");
                                $('#text_image_admin').val('');
                                return false;
                            }
                        }	  
                        
                         array = [ 
                             text_id_admin,
                             text_email_admin,
                             text_pass_1_admin,
                             text_full_name_admin,
                             text_address_admin ,
                             text_city_admin ,
                             text_telephone_admin ,
                             text_activo_admin ,
                             text_gender_admin ,
                             image,
                             ];

                             alert(array);
                            
                        if( text_id_admin != '' && text_pass_1_admin != '' && text_email_admin != '' && text_full_name_admin !='' 
                            && text_address_admin != '' && text_city_admin != '' && text_telephone_admin != '' 
                            && text_activo_admin != '' && text_gender_admin != ''&& image != '')
                        {
                            
                            $.ajax(
                            {
                                method: 'post',
                                url: '?a=update_admin&c=' + image,
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                    $('#modalUpdateAdmin').modal('hide');
                                    alert(data);
                                    //document.getElementById('msg_admin').innerHTML = data;
                                    //alert(data);
                                    // // alert("Admin adicionado com successo!!");
                                    $('#tabela-admins').DataTable().ajax.reload();
                                   
                                                    
                                                    
                                },
                                error:function(data)
                                {
                                                
                                    alert('ajax error');
                                                
                                }
                                                
                            });            

                        }
                        else
                        {
                            alert("Both Fields are Required");
                        }


                });
            // =============================================================================================    
            
            // apagar dados - admin
            // =================================================================================================
                function admin_delete(id_admin)
                {
                    var id_admin = id_admin;
                    // if(confirm("Are you sure you want to delete this?"))
                    // {
                        $.ajax({
                            url:"?a=delete_admin",
                            method:"POST",
                            data:{id_admin:id_admin},
                            success:function(data)
                            {
                               // alert("Admin apagado com successo!!");
                                $('#tabela-admins').DataTable().ajax.reload();
                            }
                        });
                    // }
                    // else
                    // {
                    //     return false;	
                    // }
                };
	        // =================================================================================================
            
        // =================================================================================================

        // CUSTOMER
        // =================================================================================================

            // Apresentar Modal - ver cliente
            // =============================================================================================
                function apresentarModalVerCustomer(id_customer) 
                {
                        $.ajax(
                        {
                               url:"?a=create_modal_ver_customer",
                               method:"POST",
                               data:{id_customer:id_customer},
                                success:function(data)
                                {
                                    const obj = JSON.parse(data);
                                    var modalVerCustomer = new bootstrap.Modal(document.getElementById('modalVerCustomer'));
                                    modalVerCustomer.show();
                                    document.getElementById("corpo_modal_ver_customer").innerHTML = obj;
                               },
                               error:function(data)
                               {

                               }
                        });
                }     
            // ============================================================================================= 
  
            // Apresenta Modal - adiconar cliente
            // =============================================================================================
                $(document).on('click', '#botao_adicionar_cliente', function(event)
                {
                    //alert('Adicionar cliente');
                    $('#customer_form')[0].reset();
                    $('.modal-title').text("Adicionar Cliente");
                    $('#action').val("Add");
                    $('#operation').val("Add");
                    //  $('#user_uploaded_image').html('');
                    $('#customerModal').modal('show');
                });
            // =============================================================================================

            // Submeter dados - adicionar cliente
            // =============================================================================================
                $(document).on('submit', '#customer_form', function(event)
                {
                    alert('submit');
                    //event.preventDefault();
                    // // //alert('submit');

                    var text_email_customer = $('#text_email_customer_add').val();
                    var text_pass_1_customer = $('#text_pass_1_customer_add').val();
                    var text_pass_2_customer = $('#text_pass_2_customer_add').val();
                    var text_full_name_customer = $('#text_full_name_customer_add').val();
                    var text_address_customer = $('#text_address_customer_add').val();
                    var text_city_customer = $('#text_city_customer_add').val();
                    var text_telephone_customer = $('#text_telephone_customer_add').val();
                    var text_activo_customer = '';
                    var text_gender_customer = ''; 

                    $("#text_activo_customer_add option:selected").each(function() 
                    {
                        text_activo_customer = $(this).val();
                    }); 

                    $("#text_gender_customer_add option:selected").each(function() 
                    {
                        text_gender_customer = $(this).val();
                    });    
                    
                    var image = $('#customer_image_add').val().split('\\').pop().toLowerCase();
                    var extension = $('#customer_image_add').val().split('.').pop().toLowerCase();  
                    
                    if(extension != '')
                    {
                        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                        {
                            alert("Invalid Image File");
                            $('#customer_image_add').val('');
                            return false;
                        }
                    }	        
                    
                    array = [ text_email_customer,
                        text_pass_1_customer,
                        text_pass_2_customer ,
                        text_full_name_customer,
                        text_address_customer ,
                        text_city_customer ,
                        text_telephone_customer ,
                        image,
                        text_activo_customer ,
                        text_gender_customer 
                        ];
                        
                   alert(array);

                     if(text_email_customer != '' && text_pass_1_customer != '' && text_pass_2_customer != '' && text_full_name_customer !='' 
                         && text_address_customer != '' && text_city_customer != '' && text_telephone_customer != '' && text_activo_customer != ''
                         && text_gender_customer != '' && image != '')
                        {
                           // alert('success');

                            $.ajax(
                             {
                                     method: 'post',
                                     url: '?a=create_customer',
                                     data:new FormData(this),
                                     contentType:false,
                                     processData:false,
                                     success:function(data)
                                     {
                                         //alert(data);
                                        alert("Cliente adicionado com successo!!");
                                         $('#tabela-customers').DataTable().ajax.reload();
                                         $('#customerModal').modal('hide');

                                         
                                        
                                        
                                     },
                                     error:function(data)
                                     {
                                    
                                       // alert(data);
                  
                                     }
                  
                             });            

                    }
                    else
                    {
                        alert('error');
                        alert("Both Fields are Required");
                    }


                });
            // ============================================================================================= 
 
            // Apresentar Modal - actualizar cliente
            // =============================================================================================
                function apresentarModalUpdateCustomer(id_customer) 
                {
                    $('#upload_image_admin').html('');

                    $.ajax({
                        url:"?a=create_modal_update_customer&c=" + id_customer,
                        method:"POST",
                        data:{id_customer:id_customer},
                        success:function(data)
                        {
                            const obj = JSON.parse(data);
                           // alert(obj);
                           $('#modalUpdateCustomer').modal('show');
                           $('#text_email_customer').val(obj.email);
                           $('#text_id_customer').val(obj.id_customer);
                           $('#text_pass_1_customer').val(obj.pass);
                           $('#text_pass_2_customer').val(obj.pass);
                           $('#text_full_name_customer').val(obj.full_name);
                           $('#text_address_customer').val(obj.address);
                           $('#text_city_customer').val(obj.city);
                           $('#text_telephone_customer').val(obj.telephone);
                           $('#text_activo_customer').val(obj.active);
                           $('#text_gender_customer').val(obj.gender);
                           $('#upload_image_customer').html(obj.image);

                           
                           //document.getElementById('corpo_modal_update_admin').innerHTML = obj;

                        //    estado = document.getElementById('text_activo_admin').value;
                        //    genero = document.getElementById('text_gender_admin').value;

                        //    alert(estado);
                        //    alert(genero);

                        // //    $('#text_activo_admin').val('0');
                        // //    $('#text_gender_admin').val('M');
                        },
                        error:function(data)
                        {
                        alert('Error');
                        }
                    });
                }
            // =============================================================================================   
            
            // Submeter dados - atualizar cliente
            // =============================================================================================
                $(document).on('submit', '#customer_form_update', function(event)
                {
                        event.preventDefault();

                        var text_id_customer = $('#text_id_customer').val();
                        var text_email_customer = $('#text_email_customer').val();
                        
                        var text_pass_1_customer = $('#text_pass_1_customer').val();
                        var text_pass_2_customer = $('#text_pass_2_customer').val();
                        var text_full_name_customer = $('#text_full_name_customer').val();
                        var text_address_customer = $('#text_address_customer').val();
                        var text_city_customer = $('#text_city_customer').val();
                        var text_telephone_customer = $('#text_telephone_customer').val();
                        var text_activo_customer = '';
                        var text_gender_customer = ''; 

                        $("#text_activo_customer option:selected").each(function() 
                        {
                            text_activo_customer = $(this).val();
                        }); 

                        $("#text_gender_customer option:selected").each(function() 
                        {
                            text_gender_customer = $(this).val();
                        });    
                        
                        var image = $('#text_image_customer').val().split('\\').pop().toLowerCase();
                        var extension = $('#text_image_customer').val().split('.').pop().toLowerCase();  
                        
                        if(extension != '')
                        {
                            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                            {
                                alert("Invalid Image File");
                                $('#text_image_customer').val('');
                                return false;
                            }
                        }	  
                        
                         array = [ 
                             text_id_customer,
                             text_email_customer,
                             text_pass_1_customer,
                             text_full_name_customer,
                             text_address_customer ,
                             text_city_customer ,
                             text_telephone_customer ,
                             text_activo_customer ,
                             text_gender_customer ,
                             image,
                             ];

                             alert(array);
                            
                        if( text_id_customer != '' && text_pass_1_customer != '' && text_email_customer != '' && text_full_name_customer !='' 
                            && text_address_customer != '' && text_city_customer != '' && text_telephone_customer != '' 
                            && text_activo_customer != '' && text_gender_customer != ''&& image != '')
                        {
                            
                            $.ajax(
                            {
                                method: 'post',
                                url: '?a=update_customer&c=' + image,
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                    $('#modalUpdateCustomer').modal('hide');
                                    alert(data);
                                    //document.getElementById('msg_admin').innerHTML = data;
                                    //alert(data);
                                    // // alert("Admin adicionado com successo!!");
                                    $('#tabela-customers').DataTable().ajax.reload();
                                   
                                                    
                                                    
                                },
                                error:function(data)
                                {
                                                
                                    alert('ajax error');
                                                
                                }
                                                
                            });            

                        }
                        else
                        {
                            alert("Both Fields are Required");
                        }


                });
            // =============================================================================================               

            // apagar dados - customer
            // =================================================================================================
                function customer_delete(id_customer)
                {
                    var id_customer = id_customer;
                    if(confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            url:"?a=delete_customer",
                            method:"POST",
                            data:{id_customer:id_customer},
                            success:function(data)
                            {
                                alert("customer apagado com successo!!");
                                $('#tabela-customers').DataTable().ajax.reload();
                            }
                        });
                    }
                    else
                    {
                        return false;	
                    }
                };
	        // =================================================================================================            

        // =================================================================================================  
        
        // PRODUCT
        // =================================================================================================

            // Apresentar Modal - ver produto
            // =============================================================================================
                function apresentarModalVerProduto(id_product) 
                {
                    $.ajax(
                    {
                        url:"?a=create_modal_ver_product",
                        method:"POST",
                        data:{id_product:id_product},
                            success:function(data)
                            {
                                const obj = JSON.parse(data);
                                var modalVerProduct = new bootstrap.Modal(document.getElementById('modalVerProduct'));
                                modalVerProduct.show();
                                document.getElementById("corpo_modal_ver_product").innerHTML = obj;
                        },
                        error:function(data)
                        {
                        }
                    });
                }     
            // =============================================================================================  
            
            // Apresenta Modal - adiconar produto
            // =============================================================================================
                $(document).on('click', '#botao_adicionar_produto', function(event)
                {
                   // alert('Adicionar produto');
                    $('#product_form')[0].reset();
                    $('.modal-title').text("Adicionar Produto");
                    $('#action').val("Add");
                    $('#operation').val("Add");
                    $('#product_uploaded_image').html('');
                    $('#productModal').modal('show');
                });
            // ============================================================================================= 
            
            // Submeter dados - adicionar produto
            // =============================================================================================
                $(document).on('submit', '#product_form', function(event)
                {
                   // alert('Submeter dados - adicionar produto');
                    event.preventDefault();

                    var text_product_name = $('#text_product_name').val();
                    var text_price = $('#text_price').val();
                    var text_VAT = $('#text_VAT').val();
                    var text_stock = $('#text_stock').val();
                    var text_description = $('#text_description').val();
                    var text_category_product = '';
                    var text_visible_product = '';
                    var text_active_product = ''; 

                    $("#text_category_product option:selected").each(function() 
                    {
                        text_category_product = $(this).val();
                    }); 

                    $("#text_visible_product option:selected").each(function() 
                    {
                        text_visible_product = $(this).val();
                    });    

                    $("#text_active_product option:selected").each(function() 
                    {
                        text_active_product = $(this).val();
                    });                     
                    
                    var image = $('#product_image').val().split('\\').pop().toLowerCase();
                    var extension = $('#product_image').val().split('.').pop().toLowerCase();  
                    
                    if(extension != '')
                    {
                        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                        {
                            alert("Invalid Image File");
                            $('#product_image').val('');
                            return false;
                        }
                    }	        
                    
                    array = [   text_product_name,
                                text_price,
                                text_VAT ,
                                text_stock,
                                text_description ,
                                text_category_product ,
                                text_visible_product ,
                                image,
                                text_active_product ,
                                extension 
                            ];
                        
                   // alert(array);

                    if(text_product_name != '' && text_price != '' && text_VAT != '' && text_stock !='' 
                        && text_description != '' && text_category_product != '' && text_visible_product != '' && image != ''
                        && text_active_product )
                    {
                    
                        //alert('Campos preenchidos');
                    $.ajax(
                    {
                        method: 'post',
                        url: '?a=create_product',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            //alert(data);
                            //alert("Produto adicionado com successo!!");
                            $('#tabela-products').DataTable().ajax.reload();
                            $('#productModal').modal('hide');
                        },
                        error:function(data)
                        {
                            alert('ajax error');
                        }
                                
                        });            

                        }
                        else
                        {
                            alert("Both Fields are Required");
                        }
                    });
            // ============================================================================================= 
            
            // Apresentar Modal - actualizar produto
            // =============================================================================================
                function apresentarModalUpdateProduct(id_product) 
                {
                    $('#modalUpdateProduct').modal('show');
                    $('#product_uploaded_image').html('');

                     $.ajax({
                         url:"?a=create_modal_update_product&c=" + id_product,
                         method:"POST",
                         data:{id_product:id_product},
                         success:function(data)
                         {
                            const obj = JSON.parse(data);
                            $('#modalUpdateProduct').modal('show');
                            $('#text_id_product').val(obj.id_product);
                            $('#text_category_product').val(obj.category);
                            $('#text_product_name').val(obj.product_name);
                            $('#text_product_price').val(obj.price);
                            $('#text_visible_product').val(obj.visible);
                            $('#text_description_product').val(obj.description);
                            $('#text_VAT_product').val(obj.VAT);
                            $('#text_stock_product').val(obj.stock);
                            $('#text_active_product').val(obj.active);
                            $('#product_uploaded_image').html(obj.image);
                        },
                        error:function(data)
                        {
                            alert('Error');
                        }
                    });
                }            
            // =============================================================================================    
            
            // Submeter dados - atualizar produto
            // =============================================================================================
                $(document).on('submit', '#product_form_update', function(event)
                {
                        event.preventDefault();

                        var text_id_product = $('#text_id_product').val();
                        var text_product_name = $('#text_product_name').val();
                        var text_product_price = $('#text_product_price').val();
                        var text_VAT_product = $('#text_VAT_product').val();
                        var text_stock_product = $('#text_stock_product').val();
                        var text_description_product = $('#text_description_product').val();
                        var text_visible_product = '';
                        var text_active_product = ''; 
                        var text_category_product = '';

                        $("#text_category_product option:selected").each(function() 
                        {
                            text_category_product = $(this).val();
                        }); 

                        $("#text_visible_product option:selected").each(function() 
                        {
                            text_visible_product = $(this).val();
                        });   
                        
                        $("#text_active_product option:selected").each(function() 
                        {
                            text_active_product = $(this).val();
                        });                         
                        
                        var image = $('#product_image').val().split('\\').pop().toLowerCase();
                        var extension = $('#product_image').val().split('.').pop().toLowerCase();  
                        
                        if(extension != '')
                        {
                            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                            {
                                alert("Invalid Image File");
                                $('#product_image').val('');
                                return false;
                            }
                        }	  
                        
                         array = [ 
                             text_id_product,
                             text_product_name,
                             text_product_price,
                             text_VAT_product,
                             text_stock_product ,
                             text_description_product ,
                             text_visible_product ,
                             text_active_product ,
                             text_category_product ,
                             image
                             ];

                         alert(array);
                            
                        if( text_id_product != '' && text_product_name != '' && text_product_price != '' && text_VAT_product !='' 
                            && text_stock_product != '' && text_description_product != '' && text_visible_product != '' 
                            && text_active_product != '' && text_category_product != ''&& image != '')
                        {
                            alert('success');
                            $.ajax(
                            {
                                method: 'post',
                                url: '?a=update_product&c=' + image,
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data)
                                {
                                    alert('update product');
                                    $('#modalUpdateProduct').modal('hide');
                                    $('#tabela-products').DataTable().ajax.reload();
                                },
                                error:function(data)
                                {
                                    alert('ajax error');
                                }
                                                
                            });            

                         }
                         else
                         {
                             alert("Both Fields are Required");
                         }


                });
            // =============================================================================================               
        
            // apagar dados - produto
            // =================================================================================================
                    function product_delete(id_product)
                    {
                        var id_product = id_product;
                        if(confirm("Are you sure you want to delete this?"))
                        {
                            $.ajax({
                                url:"?a=delete_product",
                                method:"POST",
                                data:{id_product:id_product},
                                success:function(data)
                                {
                                    alert("produto apagado com successo!!");
                                    $('#tabela-products').DataTable().ajax.reload();
                                }
                            });
                        }
                        else
                        {
                            return false;	
                        }
                    };
            // =================================================================================================  

        // =================================================================================================

        // ORDER
        // =================================================================================================

            // Apresentar Modal - ver Encomenda
            // =============================================================================================
                function apresentarModalVerEncomenda(id_order) 
                {
                    $.ajax(
                    {
                        url:"?a=create_modal_ver_order",
                        method:"POST",
                        data:{id_order:id_order},
                        success:function(data)
                        {
                           //// alert(data);

                            const obj = JSON.parse(data);
                            var modalVerOrder = new bootstrap.Modal(document.getElementById('modalVerOrder'));
                            modalVerOrder.show();
                            document.getElementById("corpo_modal_ver_order").innerHTML = obj;
                        },
                        error:function(data)
                        {
                        }
                    });
                }     
            // =============================================================================================   
            
            // Apresentar Modal - actualizar produto
            // =============================================================================================
                function apresentarModalUpdateOrder(id_order) 
                {
                    $.ajax({
                        url:"?a=create_modal_update_order&c=" + id_order,
                        method:"POST",
                        data:{id_order:id_order},
                        success:function(data)
                        {
                           const obj = JSON.parse(data);
                           $('#modalUpdateOrder').modal('show');
                           $('#update_id_order').val(obj.id_order);
                           $('#update_status_order').val(obj.status);
                        },
                        error:function(data)
                        {
                        alert('Error');
                        }
                    });
                }            
            // =============================================================================================    
            
            // Submeter dados - adicionar admin
            // =============================================================================================
                $(document).on('submit', '#order_form_update', function(event)
                {
                    event.preventDefault();

                    var update_status_order = '';
                    var update_id_order = $('#update_id_order').val();

                    $("#update_status_order option:selected").each(function() 
                    {
                        update_status_order = $(this).val();
                    });         
                    
                    array = [ update_status_order  ];
                        
                    //alert(array);

                    if(update_status_order != '' )
                    {
                        //alert('success');
                        $.ajax(
                            {
                                    method: 'post',
                                    url: '?a=update_order',
                                    data:new FormData(this),
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        $('#tabela-orders').DataTable().ajax.reload();
                                        $('#modalUpdateOrder').modal('hide');
                                    },
                                    error:function(data)
                                    {
                                    
                                        alert('ajax error');
                                    
                                    }
                                    
                            });            

                    }
                    else
                    {
                        alert("Both Fields are Required");
                    }
                    
                   
                });
            // =============================================================================================             
        
            // apagar dados - order
            // =================================================================================================
                function order_delete(id_order)
                {
                        var id_order = id_order;
                        if(confirm("Are you sure you want to delete this?"))
                        {
                            $.ajax({
                                url:"?a=delete_order",
                                method:"POST",
                                data:{id_order:id_order},
                                success:function(data)
                                {
                                    alert("Encomenda apagada com successo!!");
                                    $('#tabela-orders').DataTable().ajax.reload();
                                }
                            });
                        }
                        else
                        {
                            return false;	
                        }
                };
	        // ================================================================================================= 
            
            function generate_pdf_order(id_order){

                alert('pdf');

                $.ajax({
                        url:"?a=generate_pdf_order",
                        method:"POST",
                        data:{id_order:id_order},
                        success:function(data)
                        {
                            alert(data);
                        // //    const obj = JSON.parse(data);
                        // //    $('#modalUpdateOrder').modal('show');
                        // //    $('#update_id_order').val(obj.id_order);
                        // //    $('#update_status_order').val(obj.status);
                        },
                        error:function(data)
                        {
                        alert('Error');
                        }
                    });

            }

            // // function admin_logout()
            // // {
            // //     $.ajax({
            // //             url:"?a=admin_logout",
            // //             method:"POST",
            // //             data:{},
            // //             success:function(data)
            // //             {
        
            // //             },
            // //             error:function(data)
            // //             {
            // //             alert('Error');
            // //             }
            // //         }); 
            // // }


   

    </script>