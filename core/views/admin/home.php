<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php')?>
        </div>
        <!-- HOME -->
        <!-- ===================================================================================================== -->
            <div class="col-md-10">
                <!-- ===================================================================================================== -->
                <!-- apresenta informações sobre o total de orders PENDENTES -->
                    <h4>Orders pendentes</h4>
                    <?php if($total_orders_pending == 0): ?>
                        <p class="text-a1a1a1">Não existem encomendas pendentes.</p>
                    <?php else: ?>                
                        <div class="alert alert-info p-2">
                            <span class="me-3">Existem encomendas pendentes: <strong><?= $total_orders_pending ?></strong></span>
                            <a href="?a=orders_list&f=pendent" class="nav-it">Ver</a>
                        </div>
                    <?php endif; ?>
                <!-- ===================================================================================================== -->

                <hr>
                <!-- ===================================================================================================== -->
                <!-- apresenta informações sobre o total de orders PROCESSING -->
                    <h4>Orders em processamento</h4>
                        <?php if($total_orders_in_processing == 0): ?>
                            <p class="text-a1a1a1">Não existem encomendas em processamento.</p>
                        <?php else: ?>                
                            <div class="alert alert-warning p-2">
                                <span class="me-3">Existem encomendas em processamento: <strong><?= $total_orders_in_processing ?></strong></span>
                                <a href="?a=orders_list&f=processing" class="nav-it">Ver</a>
                            </div>
                        <?php endif; ?>
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
                <hr>
                
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
                
                <!-- chamada grafico -->
                <!-- ===================================================================================================== -->
                    <div id="grafico">      </div>
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
        <!-- FIM HOME -->
    </div>
</div>

<!-- Gráfico -->
<!-- ===================================================================================================== -->
    <script>

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

    </script>
<!-- ===================================================================================================== -->