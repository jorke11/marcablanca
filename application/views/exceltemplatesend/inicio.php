<script src="<?php echo base_url() ?>public/js/propias/plugin.js"></script>
<script src="<?php echo base_url() ?>librerias/jquery/toastr.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>librerias/css/toastr.css">


<div class="container-fluid">
    <form id="frmtempĺateSend" action="exceltemplatesend/sendMenssage" method="post">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-3">
                        <button id="btnConsolidate" type="button" class="btn btn-success">Enviar</button>
                    </div>
                    <div class="col-lg-3">
                        <button id="btnClean" type="button" class="btn btn-warning">Limpiar</button>
                    </div>
                </div>
                <div class="espacio"></div>
                <div class="row">
                    <div class="col-lg-12">
                        Clientes
                    </div>
                </div>
                <div class="espacio10"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <select id="client_id" name="client_id" class="form-control">
                            <option value="0">Seleccione</option>
                            <?php
                            foreach ($client as $value) {
                                ?>
                                <option value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="espacio10"></div>
                <div class="row">
                    <div class="col-lg-12">
                        Contenido Mensaje
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <textarea class="form-control" id="message" rows="3" name="message" placeholder="Escribe aqui el Mensaje" style="resize: none"></textarea>
                    </div>   
                </div>   
                <div class="row">
                    <div class="col-lg-12">
                        <span id="contentMessage"></span>
                    </div>
                </div>
                <div class="espacio"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <span id="txtcodigo"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <span id="txtquantity">Contactos filtados:0</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2">
                        Filtro 1
                    </div>
                    <div class="col-lg-2">
                        Filtro 2
                    </div>
                    <div class="col-lg-2">
                        Filtro 3
                    </div>
                    <div class="col-lg-2">
                        Filtro 4
                    </div>
                    <div class="col-lg-2">
                        Filtro 5
                    </div>
                    <div class="col-lg-2">
                        Filtro 6
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-1">
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-2">
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-3">
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-4">
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-5">
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <ul class="list-group" id="list-filter-6">
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="modalSms">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Números Validados<span id="loading" class="hidden"><img src="<?php echo base_url() ?>public/images/loading_circle.gif" width="10%"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p id="txtInformation"></p>
                        <p id="txtMensaje"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cerrar</button>
                <button type="button" class="btn btn-success " id="btnSendMsg" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando..">Enviar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?php echo base_url() ?>public/js/sistema/exceltemplatesend.js"></script>