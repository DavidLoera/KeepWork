<!DOCTYPE html>
<html lang="es">
<?php include("include/head.php")?>
<body>
<?php include("include/header.php")?>
            <!-- Header-->
            
            <header class="bg-dark py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2" style="text-align: justify;">Busca tu primer empleo ahora</h1>
                                <p class="lead fw-normal text-white-50 mb-4" style="text-align: justify;">Si tienes un titulo universitario o eres recién egresado esta es tu oportunidad de buscar empleo de una manera fácil, ingresa ahora ¡ya!</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                     <?php
                                    session_start();
                                    if($_SESSION["rol"] == null){
                                       
                                        echo "<a class='btn btn-primary btn-lg px-4 me-sm-3' href='signup.php' style='background-color:#353854; border-color: #ffffff; '>Inicia ahora</a>";
                                        
                                    }else{
                                        if($_SESSION['rol'] == 1){
                                        echo "<a class='btn btn-primary btn-lg px-4 me-sm-3' href='empresa.php' style='background-color:#353854; border-color: #ffffff; '>Inicia ahora</a>";
                                        }elseif($_SESSION['rol'] == 2){
                                        echo "<a class='btn btn-primary btn-lg px-4 me-sm-3' href='empresa.php' style='background-color:#353854; border-color: #ffffff; '>Inicia ahora</a>";
                                        }
                                    }
                                    
                                     ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="public/img/egresado.jpg" alt="..." /></div>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <section class="py-5" id="features">
                <div class="container px-5 my-5">
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0" style="padding-top:9px; padding-left: 5.5px; font-size:27px;">La mejor manera para empezar a construir tu futuro</h2></div>
                        <div class="col-lg-8">
                            <div class="row gx-5 row-cols-1 row-cols-md-2">
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                                    <h2 class="h5">Registro gratis</h2>
                                    <p class="mb-0">Unete a nosotros tan llenando un formulario con tu información</p>
                                </div>
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                                    <h2 class="h5">Contacto directo</h2>
                                    <p class="mb-0">Las empresas podrán contactar contigo directamente sin necesidad de enviar tu Curriculum</p>
                                </div>
                                <div class="col mb-5 mb-md-0 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5" style="font-size:19.4px;">Perfil profesional</h2>
                                    <p class="mb-0">Completa un formulario con tu información academicá para empezar a obtener posibilidades de empleos</p>
                                </div>
                                <div class="col h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5" style="font-size:18.8px;">Empresas activas</h2>
                                    <p class="mb-0">Las empresas verificarán tu Curriculum, ellos podrán seleccionar y contactar a través de un mensaje directo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Testimonial section-->
            <div class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-10 col-xl-7">
                            <div class="text-center">
                                <div class="fs-4 mb-4 fst-italic">"No hay problema que no podamos resolver juntos, y muy pocos que podamos resolver por nosotros mismos"</div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <img class="rounded-circle me-3" src="public/img/2.png" alt="Keep work" /><span style="opacity:0;">S</span>
                                    <div class="fw-bold">
                                        Lyndon Johnson.
                                        <span class="fw-bold text-primary mx-1">/</span>
                                        Expresidente de Estados Unidos
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">Acerca de nosotros</h2>
                                <p class="lead fw-normal text-muted mb-5">Desarrollar una aplicación web para la empresa TrNetowrk el  cual  brinde  una  nueva  oportunidad  de  empleo  a  los  jóvenes  recién egresados dentro de su perfil académico.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="public/img/image1.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <a class="text-decoration-none link-dark stretched-link" href="#!"><h5 class="card-title mb-3">Nuevas oportunidades</h5></a>
                                    <p class="card-text mb-0">Si deseas una nueva oportunidad registrate con nosotros</p>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-3" src="public/img/2.png" alt="..." /><span style="opacity:0;">S</span>
                                            <div class="small">
                                                <div class="fw-bold">Keep Work</div>
                                                <div class="text-muted">24 Junio, 2021 &middot; </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="public/img/image2.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <a class="text-decoration-none link-dark stretched-link" href="#!"><h5 class="card-title mb-3">Inicia sesión</h5></a>
                                    <p class="card-text mb-0">Si ya estas registrado es hora se ser hisotorio, solo te queda un paso más :D</p>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-3" src="public/img/2.png" alt="..." /><span style="opacity:0;">S</span>
                                            <div class="small">
                                                <div class="fw-bold">Keep Work</div>
                                                <div class="text-muted">24 Junio, 2021 &middot; </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="public/img/image3.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <a class="text-decoration-none link-dark stretched-link" href="#!"><h5 class="card-title mb-3">El futuro es hoy</h5></a>
                                    <p class="card-text mb-0">No lo pienses más, puedes encontrar tu empleo solo con un clic</p>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-3" src="public/img/2.png" alt="..." /><span style="opacity:0;">S</span>
                                            <div class="small">
                                                <div class="fw-bold">Keep Work</div>
                                                <div class="text-muted">24 Junio, 2021 &middot; </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </section>
        </main>
    <?php include("include/footer.php")?>
    <?php include("include/js.php")?>
</body>
</html>