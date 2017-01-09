    <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Mensalidades</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Parcela</th>
                                <th>Data de Pagamento</th>
                                <th>Data de Vencimento</th>
                                <th>Desconto</th>
                                <th>Multa</th>
                                <th>Valor</th>
                                <th>Valor Pago</th>
                            </tr>
                            </thead>
                            <tbody id="m">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



<script>
           $(document).ready(function() {
                    $.ajax({
                              url: "../controller.php?action=lista&model=mensalidade&id="+$("#uid").val()                             
                            }).done(function(data) {
                                $("#m").html("");
                                $("#m").html(data);
                            });



            });


        </script>