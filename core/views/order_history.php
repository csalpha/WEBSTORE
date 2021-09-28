<?php 
    use core\classes\Store;
?>

<!-- container-fluid -->
<!-- ===================================================================================================== -->
    <div class="container">
    
        <!-- row -->
        <!-- ===================================================================================================== -->
            <div class="row my-5">
                <!-- col-12 -->
                <!-- ===================================================================================================== -->
                    <div class="col">

                        <h3 class="text-center">Histórico de orders</h3>
                        <?php if (count($order_history) == 0) : ?>
                            <p class="text-center">Não existem orders registadas.</p>
                        <?php else : ?>
                            <!-- table -->
                            <!-- ===================================================================================================== -->
                                <table class="table table-striped" id="order">
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
                                                        <a href="?a=order_details&id=<?= Store::aes_encrypt($order->id_order) ?>" class="nav-it">Detalhes</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    <!-- ===================================================================================================== -->
                                </table>
                            <!-- ===================================================================================================== -->                            

                        <p class="text-end">Total orders: <strong><?= count($order_history) ?></strong></p>
                        <?php endif; ?>
                        
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
            $('#order').DataTable({
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
