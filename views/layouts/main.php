<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>SIGEPSI</title>
    <!-- JavaScript -->
    <?php $this->head() ?>
</head>
<body class="sb-nav-fixed">
<?php $this->beginBody() ?>


<?php

//Si el usuario es invitado se mostrara el contenido siguiente
///////////////////////////////////////////////////////////////
if (Yii::$app->user->isGuest)
{
    echo $content;
}
else //Si no es invitado se mostrara el contenido siguiente
{

?>
<!-- Contenedor de la interfaz del framework -->
<!-- /////////////////////////////////////// -->
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
<!-- MENU LATERAL --> 
        <!-- ///////////  -->
        <div class="profile">
        <div class="img-usuario">
        <?php echo Html::img('@web/imagenes/logo-iutoms2.png', ['width' => '19%']); ?>
    </div>
    <div class="rol">
        <p>
            <a href="<?= Url::toRoute('site/dashboard');?>">
                Sistema de Gestión de Proyectos Socio-integradores
            </a>
        </p>
    </div>
</div>

<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <div class="sb-sidenav-menu-heading">Proyectos</div>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Gestión de proyectos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= Url::toRoute('site/dashboard');?>">Panel de proyectos</a>
                    <a class="nav-link" href="<?= Url::toRoute('site/contact');?>">Formularios</a>
                </nav>
            </div>


            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Comunidades</div>
            <a class="nav-link" href="<?= Url::toRoute('comunidades/index');?>">
                <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                Comunidades
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a>


            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstudiantes" aria-expanded="false" aria-controls="collapseEstudiantes">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Gestión estudiantil
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseEstudiantes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= Url::toRoute('estudiantes/index');?>">Estudiantes</a>
                </nav>
            </div>

            <!--CERRAR SESIÓN -->
            <!-- ------------ -->
            <?=
            $menuItems[] = '<li class="logout-form">'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="fas fa-power-off"></i> Cerrar sesión',
                ['class' => 'btn btn logout', 'style' => 'color:#fff; margin-left:3px;']
            )
            . Html::endForm()
            . '</li>';
            ?>
            <!--CERRAR SESIÓN -->
            <!-- ------------ -->
        </div>
    </div>
</nav>
<!-- FIN MENU LATERAL --> 
<!-- ///////////////  -->
</div>

<!-- Contenedor del contenido principal del framework -->
<!-- //////////////////////////////////////////////// -->
<div id="layoutSidenav_content">
    <header class="header">
        <div class="cont-btns-menu">
            <div class="btn-menu-primary">
                <div class="btn-bars">
                    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                </div>
            </div>

            <div class="btn-menu-secondary">
                <div class="dropdown">
                    <div class="chip" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <?php echo Html::img('@web/imagenes/jesus.jpg', ['width' => '96%', 'height' => '96%']); ?>
                     <?= Yii::$app->user->identity->username; ?> <i class="fas fa-chevron-down"></i>
                  </div>

                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li><a style="color: rgba(0,0,0,.7);" class="btn" href="#"><i class="fas fa-id-badge"></i> Perfil</a></li>
                        <li><a style="color: rgba(0,0,0,.7);" class="btn" href="#"><i class="fas fa-tools"></i> Configuración</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <?=
                            $menuItems[] = '<li class="logout-form">'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '<i class="fas fa-power-off"></i> Cerrar sesión',
                                ['class' => 'btn', 'style' => 'color: rgba(0,0,0,.7)']
                            )
                            . Html::endForm()
                            . '</li>';
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h5 style="text-align: center; color: #fff;">Universidad Politécnica Territorial de Caracas "Mariscal Sucre"</h5>
    </header>
    <div class="contenido-principal">
        <!-- Esta variable contiene el contenido principal del framework -->
        <!-- /////////////////////////////////////////////////////////// -->
        <?= $content ?>
    </div>

<!-- <footer class="py-4 bg-light mt-auto footer">
    <div class="container-fluid">
        <div>
            <p>Universidad Politécnica Territorial de Caracas Mariscal Scucre</p>
        </div>
    </div>
</footer> -->
</div>
<!-- Contenedor del contenido principal del framework -->
<!-- //////////////////////////////////////////////// -->
</div>
<!-- Contenedor de la interfaz del framework -->
<!-- /////////////////////////////////////// -->
<?php
}


?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

