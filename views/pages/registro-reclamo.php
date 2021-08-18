<div class="container">
    <form action="" method="post" id="formReclamo">
        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title m-0 font-weight-bold">1. Identificación del Usuario o Tercero legitimado. </h5>&nbsp;&nbsp;<i class="fas fa-users"></i>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <label>Tipo de Documento:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select class="form-control" name="tDocUsuario" id="tDocUsuario">
                                    <option value="0" selected>Seleccione tipo Doc</option>
                                    <?php
                                    $itemTDocUsuario = null;
                                    $valorTDocUsuario  = null;
                                    $TDocUsuario = ControladorTipoDoc::ctrListarTipoDocUsuario($itemTDocUsuario, $valorTDocUsuario);
                                    foreach ($TDocUsuario as $key => $value) {
                                        echo '<option value="' . $value["idtipoDoc"] . '">' . $value["desctipoDoc"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <label>Número de Documento:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese N° de documento" autocomplete="off" name="nDocUsuario" id="nDocUsuario">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none" id="btnDNIUsuario">
                        <div class="form-group">
                            <label>Consulta:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <button type="button" class="btn btn-block btn-primary" id="btnDNIU"><i class="fas fa-search"></i>&nbsp;Buscar con DNI</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Nombre:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese nombres" autocomplete="off" id="nomUsuario" name="nomUsuario">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Apellido Paterno:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese apellido paterno" autocomplete="off" id="APUsuario" name="APUsuario">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Apellido Materno:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese apellido paterno" autocomplete="off" id="AMUsuario" name="AMUsuario">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <label>Sexo:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                </div>
                                <select class="form-control" name="sexUsuario" id="sexUsuario">
                                    <option value="0">Seleccione su sexo</option>
                                    <?php
                                    $itemsexUsuario = null;
                                    $valorsexUsuario  = null;
                                    $sexUsuario = ControladorSexo::ctrListarSexo($itemsexUsuario, $valorsexUsuario);
                                    foreach ($sexUsuario as $key => $value) {
                                        echo '<option value="' . $value["idsexoUsuario"] . '">' . $value["descsexoUsuario"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Correo Electrónico:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Ingrese su correo electrónico" autocomplete="off" id="emailUsuario" name="emailUsuario">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Teléfono || Celular:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese N°teléfono o celular" autocomplete="off" name="telefUsuario" id="telefUsuario">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Departamento:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <select class="form-control" id="DepUsuario" name="DepUsuario">
                                    <option value="0">Seleccione Departamento</option>
                                    <?php
                                    $itemDepUsuario = null;
                                    $valorDepUsuario  = null;
                                    $DepUsuario = ControladorUbigeo::ctrListarDepartamentos($itemDepUsuario, $valorDepUsuario);
                                    foreach ($DepUsuario as $key => $value) {
                                        echo '<option value="' . $value["idDepa"] . '">' . $value["descDepartamento"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Provincia:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <select class="form-control" id="ProvUsuario" name="ProvUsuario">
                                    <option value="0">Seleccione Provincia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Distrito:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <select class="form-control" id="DistUsuario" name="DistUsuario">
                                    <option value="0">Seleccione Distrito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Domicilio:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese su domicilio" autocomplete="off" id="DomUsuario" name="DomUsuario">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title m-0 font-weight-bold">2. Identificación de quién presenta el reclamo (En caso de ser usuario afectado no es necesario su llenado). </h5>&nbsp;&nbsp;<i class="fas fa-hands-helping"></i>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                        <label>¿Es el familiar o representante del usuario afectado el quien presenta el reclamo?</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="input-group">
                            <div class="icheck-dark d-inline">
                                <input type="radio" id="radiorep1" name="repCon">
                                <label for="radiorep1"> SI
                                </label>&nbsp;&nbsp;
                            </div>
                            <div class="icheck-dark d-inline">
                                <input type="radio" id="radiorep2" name="repCon">
                                <label for="radiorep2"> NO
                                </label>
                            </div>
                            <input type="hidden" name="representante" id="representante">
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="bloqueRep1">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <label>Tipo de Documento:<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select class="form-control" id="tDocRep" name="tDocRep">
                                    <option value="0">Seleccione Documento</option>
                                    <?php
                                    $itemTDocRep = null;
                                    $valorTDocRep  = null;
                                    $TDocRep = ControladorTipoDoc::ctrListarTipoDocRep($itemTDocRep, $valorTDocRep);
                                    foreach ($TDocRep as $key => $value) {
                                        echo '<option value="' . $value["idtipoDoc"] . '">' . $value["desctipoDoc"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Número de Documento:<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese N° de documento o RUC" autocomplete="off" id="nDocRep" name="nDocRep">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none" id="btnDNIRepresentante">
                        <div class="form-group">
                            <label>Consulta:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <button type="button" class="btn btn-block btn-primary" id="btnDNIRep"><i class="fas fa-search"></i>&nbsp;Buscar con DNI</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none" id="btnRUCRepresentante">
                        <div class="form-group">
                            <label>Consulta:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <button type="button" class="btn btn-block btn-primary" id="btnRUCRep"><i class="fas fa-search"></i>&nbsp;Buscar con RUC</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row d-none" id="bloqueRep2">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Nombres o Razón Social del Representante:<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hands-helping"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese nombres o razón social del representante" autocomplete="off" id="nomRep" name="nomRep">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Correo Electrónico<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Ingrese correo electrónico" autocomplete="off" id="emailRep" name="emailRep">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Teléfono || Celular<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                </div>
                                <input type="tel" class="form-control" placeholder="Ingrese teléfono o celular" autocomplete="off" id="telefRep" name="telefRep">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="bloqueRep3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Domicilio:<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese su dirección" autocomplete="off" id="DomRep" name="DomRep">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title m-0 font-weight-bold">3. Datos del reclamo. </h5>&nbsp;&nbsp;<i class="fas fa-users"></i>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Tipo de Usuario:<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                                </div>
                                <select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                    <option value="0">Seleccione tipo de usuario</option>
                                    <?php
                                    $itemTipUsuario = null;
                                    $valorTipUsuario  = null;
                                    $TipUsuario = ControladorTipoUsuario::ctrListarTipoUsuario($itemTipUsuario, $valorTipUsuario);
                                    foreach ($TipUsuario as $key => $value) {
                                        echo '<option value="' . $value["idtipoUsuario"] . '">' . $value["desctipoUsuario"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <label>Fecha de Ocurrencia:<span class="text-danger">&nbsp;*</span></label>

                            <div class="input-group date" id="fechaOcu" data-target-input="nearest">
                                <div class="input-group-append" data-target="#fechaOcu" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" id="cajaFecha" name="cajaFecha" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label>Derecho en Salud afectado :<span class="text-danger">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-resolving"></i></span>
                                </div>
                                <select class="form-control" id="recCG" name="recCG">
                                    <option value="0">Seleccione el derecho afectado</option>
                                    <?php
                                    $itemCGeneral = null;
                                    $valorCGeneral  = null;
                                    $CGeneral = ControladorCausas::ctrListarCausasGenerales($itemCGeneral, $valorCGeneral);
                                    foreach ($CGeneral as $key => $value) {
                                        echo '<option value="' . $value["id_causaGeneral"] . '">' . $value["desc_causaGeneral"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <div class="form-group">
                            <label>Causa específica del reclamo:<span class="text-danger font-weight-bolder">&nbsp;*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-resolving"></i></span>
                                </div>
                                <select class="form-control" id="recCE" name="recCE">
                                    <option value="0">Seleccione la causa específica del reclamo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Detalle del Reclamo:<span class="text-danger">&nbsp;* (3500 caracteres permitidos)</span></label>
                            <textarea class="form-control" rows="3" placeholder="Ingrese el detalle textual de su reclamo." id="detReclamo" name="detReclamo" maxlength="3500"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title m-0 font-weight-bold">4. Autorizo notificación del resultado del reclamo al e-mail consignado. (Marcar) </h5>&nbsp;&nbsp;<i class="fas fa-at"></i>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="input-group">
                            <div class="icheck-dark d-inline">
                                <input type="radio" id="radioauto1" name="repAuto" value="SI" checked>
                                <label for="radioauto1"> SI
                                </label>&nbsp;&nbsp;
                            </div>
                            <div class="icheck-dark d-inline">
                                <input type="radio" id="radioauto2" name="repAuto" value="NO">
                                <label for="radioauto2"> NO
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center>
            <button type="btn" class="btn btn-primary btn-lg mb-3" id="btnEnviar">REGISTRAR</button>
        </center>
    </form>
</div>