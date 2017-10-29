<div class="container-fluid"> 
    <div class="row">

        <div class="col-lg-6">
            <table class="table table-condensed table-bordered" id="tableMarca">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Contacto</th>
                        <th>Celular</th>
                        <th>Mensaje</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-header">
                    <button class="btn btn-primary" type="button" id="btnNew">Nuevo</button>
                    <button class="btn btn-success" type="button" id="btnSave">Guardar</button>
                </div>
                <form id="frm" enctype="multipart/form-data">
                    <div class="panel-body">
                        <input id="id" name="id" class="input-master" type="hidden">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Nombre</label>
                                    <input type="text" class="form-control input-master" id="nombre" name='nombre' required="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Nit</label>
                                    <input type="text" class="form-control input-master" id="nit" name='nit' required="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Contacto</label>
                                    <input type="text" class="form-control input-master" id="contacto" name='contacto' required="" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Celular 1</label>
                                    <input type="text" class="form-control input-master" id="celular1" name='celular1' >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Celular 2</label>
                                    <input type="text" class="form-control input-master" id="celular2" name='celular2' >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="text" class="form-control input-master" id="correo" name='correo' >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Mensaje</label>
                                    <input type="text" class="form-control input-master" id="mensaje" name='mensaje' >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Preferencias</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select name="idcarries[]" id="idcarries" class="form-control ">
                                                <option value="1" >Claro</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="idcanal[]" id="canal_0" class="form-control registro preferencias" obligatorio="numero">
                                                <?php foreach ($canales as $i => $value) { ?>
                                                    <option value="<?php echo $value["id"] ?>"  ><?php echo $value["nombre"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Cupo Total</label>
                                    <input type="text" class="form-control input-master" id="cupototal" name='cupototal' >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select name="idcarries[]" id="idcarries" class="form-control ">
                                                <option value="2" >Movistar</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="idcanal[]" id="canal_1" class="form-control registro preferencias" obligatorio="numero">
                                                <?php foreach ($canales as $i => $value) { ?>
                                                    <option value="<?php echo $value["id"] ?>" ><?php echo $value["nombre"] ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Maximo Servicio</label>
                                    <input type="text" class="form-control input-master" id="maximo_servicio" name='maximo_servicio' >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select name="idcarries[]" id="idcarries" class="form-control ">
                                                <option value="3" >Tigo</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="idcanal[]" id="canal_2" class="form-control registro preferencias" obligatorio="numero" >
                                                <?php foreach ($canales as $i => $value) { ?>
                                                    <option value="<?php echo $value["id"] ?>" ><?php echo $value["nombre"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Titulo Principal</label>
                                    <input type="text" class="form-control input-master" id="titulologin" name='titulologin' >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select name="idcarries[]" id="idcarries" class="form-control ">
                                                <option value="4" >Avantel</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="idcanal[]" id="canal_3" class="form-control registro preferencias registro" obligatorio="numero">
                                                <?php
                                                foreach ($canales as $value) {
                                                    ?>
                                                    <option value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Logo</label>
                                    <input type="file" class="form-control input-master" id="url" name='url'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <img id="preview" width="50%">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
