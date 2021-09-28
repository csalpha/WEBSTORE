<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10">
            <h3>Lista de orders do customer</h3>
            <hr>
                <div class="row">
                    <div class="col">Nome: <strong><?= $customer->full_name ?></strong></div>
                    <div class="col">Email: <strong><?= $customer->email ?></strong></div>
                    <div class="col">telephone: <strong><?= $customer->telephone ?></strong></div>
                </div> 
            <hr>

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
                                <th>address</th>
                                <th>city</th>
                                <th>Email</th>
                                <th>telephone</th>
                                <th>Código</th>
                                <th>Status</th>
                                <th>message</th>
                                <th>Atualizada em</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($orders_list as $order) : ?>
                                <tr>
                                    <td><?= $order->order_date ?></td>
                                    <td><?= $order->address ?></td>
                                    <td><?= $order->city ?></td>
                                    <td><?= $order->email ?></td>
                                    <td><?= $order->telephone ?></td>
                                    <td><?= $order->order_code ?></td>
                                    <td><?= $order->status ?></td>
                                    <td><?= $order->message ?></td>
                                    <td><?= $order->updated_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </small>
                    <?php endif; ?>

        </div>

    </div>
</div>

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

    function definir_filtro(){
        var filtro = document.getElementById("combo-status").value;
        // reload da página com determinado filtro
        window.location.href = window.location.pathname+"?"+$.param({'a':'orders_list','f': filtro});
    }
</script>