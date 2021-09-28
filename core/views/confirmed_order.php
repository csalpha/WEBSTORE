<!-- container -->
<!-- ===================================================================================================== -->
    <div class="container">
        <!-- row -->
        <!-- ===================================================================================================== -->
            <div class="row my-5">
                <!-- col -->
                <!-- ===================================================================================================== -->
                    <div class="col text-center">
                        <h3 class="text-center">Encomenda confirmada</h3>
                        <p>Muito obrigado pela sua order.</p>

                        <div class="my-5">
                            <h4>Dados de pagamento</h4>
                            <p>Conta bancária: PT50019300001050349850226</p>
                            <p>Codigo da order: <strong><?= $order_code  ?></strong></p>
                            <p>Total da order: <strong><?= 
                            number_format($total_order, 2, ',', '.'). '€'  ?></strong></p>
                        </div>

                        <p>
                            Vai receber um email com a confrimação da order
                        <br>
                        A sua order só será processada após confirmação do pagamento.
                        </p>

                        <p><small>Por favor verifique se o email aparece na sua conta ou se foi para a pasta do SPAM.</small></p>
                        <div class="my-5"><a href="?a=home_page" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Voltar</a></div>
                    </div>
                <!-- ===================================================================================================== -->
            </div>
        <!-- ===================================================================================================== -->
    </div>
<!-- ===================================================================================================== -->