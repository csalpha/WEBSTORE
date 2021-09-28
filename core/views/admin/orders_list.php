<?php

    use core\classes\Store;
    use core\models\AdminModel;
    use core\models\Products;

    $admin = new AdminModel();
    $total_orders_in_processing = $admin->total_orders_in_processing();
    $total_orders_pending = $admin->total_orders_pending();

?>

<!-- container-fluid -->
<!-- ===================================================================================================== -->
    <div class="container-fluid">
        <!-- row mt-3 -->
        <!-- ===================================================================================================== -->
            <div class="row mt-3">

                <!-- col-md-2 -->
                <!-- ===================================================================================================== -->
                    <div class="col-md-2">
                        <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
                    </div>
                <!-- ===================================================================================================== -->    

                <!-- col-md-10 -->
                <!-- ===================================================================================================== -->            
                    <div class="col-md-10">
                        <h3>Lista de orders <?= $filtro != '' ? $filtro : '' ?></h3>
                        <hr>

                        <!-- row -->
                        <!-- ===================================================================================================== -->                        
                            <div class="row">

                                <!-- col -->
                                <!-- ===================================================================================================== -->
                                <div class="col">
                                    <a href="?a=new_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a>
                                    </div>
                                <!-- ===================================================================================================== -->                            

                                <!-- col -->
                                <!-- ===================================================================================================== -->
                                    <div class="col">
                                    <a href="?a=orders_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                    </div>
                                <!-- ===================================================================================================== -->

                                <!-- col -->
                                <!-- ===================================================================================================== -->                            
                                    <div class="col">
                                    <?php
                                    $f = '';
                                    if (isset($_GET['f'])) {
                                        $f = $_GET['f'];
                                    }
                                    ?>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                        <div class="col-sm-8">
                                            <select id="combo-status" class="form-control" onchange="definir_filtro()">
                                                <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                <option value="pendent" <?= $f == 'pendent' ? 'selected' : '' ?> class="nav-it">Pendent</option>
                                                <option value="processing" <?= $f == 'processing' ? 'selected' : '' ?> class="nav-it">Processing</option>
                                                <option value="sent" <?= $f == 'sent' ? 'selected' : '' ?> class="nav-it">Sent</option>
                                                <option value="canceled" <?= $f == 'canceled' ? 'selected' : '' ?> class="nav-it">Canceled</option>
                                                <option value="completed" <?= $f == 'completed' ? 'selected' : '' ?> class="nav-it">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                <!-- ===================================================================================================== -->

                            </div>
                        <!-- ===================================================================================================== -->
                        
                        <!-- tabela -->
                        <!-- ===================================================================================================== -->                                    
                            <?php if (count($orders_list) == 0) : ?>
                                <hr>
                                <p>Não existem orders registadas.</p>
                                <hr>
                            <?php else : ?>
                                <small>
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
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orders_list as $order) : ?>
                                                <tr>
                                                    <td><?= $order->order_date ?></td>
                                                    <td><?= $order->order_code ?></td>
                                                    <td><?= $order->full_name ?></td>
                                                    <td><?= $order->email ?></td>
                                                    <td><?= $order->telephone ?></td>
                                                    <td>
                                                        <a href="?a=order_details&e=<?= Store::aes_encrypt($order->id_order) ?>" class="nav-it"><?= $order->status ?></a>
                                                    </td>
                                                    <td><?= $order->updated_at ?></td>
                                                <!-- Ver -->
                                                <td class="text-center">
                                                <a href="?a=order_details&e=<?= Store::aes_encrypt($order->id_order) ?>" class="btn btn-primary btn-xs update"><i class="fas fa-eye"></i></a>
                                                </td>                                                        
                                                <!-- update -->
                                                <td class="text-center">
                                                    <a href="?a=change_order_data&c=<?= Store::aes_encrypt($order->id_order) ?>" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <!-- delete -->
                                                <td class="text-center">
                                                <a href="?a=delete_order&id_order=<?= Store::aes_encrypt($order->id_order) ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>
                                                </td>                                                        
                                                </tr>
                                            <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </small>
                            <?php endif; ?>
                        <!-- ===================================================================================================== -->                            

                        <hr>
                        <!-- espaco -->
                        <!-- ===================================================================================================== -->                        
                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="mb-3 row">
                                    </div>
                                </div>
                            </div>
                        <!-- ===================================================================================================== -->    

                        <!-- grafico -->
                        <!-- ===================================================================================================== -->
                            <div id="grafico"> </div>
                        <!-- ===================================================================================================== -->

                        <!-- espaco -->
                        <!-- ===================================================================================================== -->                        
                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="mb-3 row">
                                    </div>
                                </div>
                            </div>
                        <!-- ===================================================================================================== -->    
                    </div>
                <!-- ===================================================================================================== -->    

            </div>
        <!-- ===================================================================================================== -->        
    </div> 
<!-- ===================================================================================================== -->

<!-- tabela-orders script -->
<!-- ===================================================================================================== -->
    <script>
        $(document).ready(function() {
            $('#tabela-orders').DataTable({
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
    </script>
<!-- ===================================================================================================== -->

<!-- ApexCharts script -->
<!-- ===================================================================================================== -->
    <script>
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
    </script>
<!-- ===================================================================================================== -->