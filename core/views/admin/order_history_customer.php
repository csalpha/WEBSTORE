<?php 
    use core\classes\Store;
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

                            <div class="col text-center">
                                <a href="?a=change_customer_data&c=<?= Store::aes_encrypt($_SESSION['customer_temp']) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados pessoais</a>
                                <a href="?a=change_password_customer&c=<?= Store::aes_encrypt($_SESSION['customer_temp']) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar Password</a>
                                <a href="?a=order_history_customer&c=<?= Store::aes_encrypt($_SESSION['customer_temp']) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de Encomendas</a>
                            </div>  

                        <!-- row mt-3 -->
                        <!-- ===================================================================================================== -->
                                <div class="row mt-3">
                                    <h3 class="text-center">Histórico de Encomedas</h3>
                                    <?php if (count($order_history) == 0) : ?>
                                        <p class="text-center">Não existem encomedas registadas.</p>
                                    <?php else : ?>
                                        <!-- table -->
                                        <!-- ===================================================================================================== -->
                                        <small>
                                            <table class="table table-striped" id="tabela-history-customers">
                                                <!-- thead -->
                                                <!-- ===================================================================================================== -->                            
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Data da Encomenda</th>
                                                            <th>Código order</th>
                                                            <th>Estado</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                <!-- ===================================================================================================== -->

                                                <!-- tbody -->
                                                <!-- ===================================================================================================== -->
                                                    <tbody>
                                                        <?php foreach ($order_history as $order) : ?>
                                                            <tr>
                                                                <td><?= $order->order_date ?></td>
                                                                <td><?= $order->order_code ?></td>
                                                                <td><?= $order->status ?></td>
                                                                <td>
                                                                    <a href="?a=order_history_details_customer&id=<?= Store::aes_encrypt($order->id_order) ?>" class="nav-it">Detalhes</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                <!-- ===================================================================================================== -->
                                            </table>
                                        </small>
                                        <!-- ===================================================================================================== -->                            

                                    <p class="text-end">Total orders: <strong><?= count($order_history) ?></strong></p>
                                    <?php endif; ?>
                                </div>
                        <!-- ===================================================================================================== -->                            
                    </div>
                <!-- ===================================================================================================== -->
            
                <!-- espaco em branco -->
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

<!-- DataTable -->
<!-- ===================================================================================================== -->
    <script>
        $(document).ready(function() {
            $('#tabela-history-customers').DataTable({
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
    </script>
<!-- ===================================================================================================== -->
