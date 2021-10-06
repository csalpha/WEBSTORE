
                        <!-- admin menu -->
                        <!-- ===================================================================================================== -->
                            <div>
                                <!-- Home btn -->
                                <!-- ===================================================================================================== -->
                                    <div >
                                        <!-- <a class="mb-3 btn btn-black text-uppercase filter-btn m-2" href="?a=home_page">Home</a> -->
                                        <a onclick="home_page_admin()" class="nav-link">Home</a>
                                    </div>
                                <!-- ===================================================================================================== -->

                                <!-- Customers btn -->
                                <!-- ===================================================================================================== -->
                                    <div >
                                        <!-- <a class="mb-3 btn btn-black text-uppercase filter-btn m-2" href="?a=customers_list">Customers</a> -->
                                        <a onclick="customers_list()" class="nav-link">Customers</a>
                                    </div>
                                <!-- ===================================================================================================== -->

                                <!-- Orders btn -->
                                <!-- ===================================================================================================== -->
                                    <div >
                                        <!-- <a class="mb-3 btn btn-black text-uppercase filter-btn m-2" href="?a=orders_list">Orders</a> -->
                                        <a onclick="orders_list()" class="nav-link">Orders</a>

                                    </div>
                                <!-- ===================================================================================================== -->

                                <!-- Products btn -->
                                <!-- ===================================================================================================== -->
                                    <div >
                                        <!-- <a class="mb-3 btn btn-black text-uppercase filter-btn m-2" href="?a=products_list">Products</a> -->
                                        <a onclick="products_list()" class="nav-link" >Products</a>
                                    </div>
                                <!-- ===================================================================================================== --> 

                                <!-- Admins btn -->
                                <!-- ===================================================================================================== -->
                                    <div >
                                        <!-- <a class="mb-3 btn btn-black text-uppercase filter-btn m-2" href="?a=admins_list">Admins</a> -->
                                        <a onclick="admins_list()" class="nav-link">Admins</a>

                                    </div>   
                                <!-- ===================================================================================================== -->

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
                
</script>

        