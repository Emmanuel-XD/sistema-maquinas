<?php
include "../includes/header.php";
?>

<style>
  .centered-img {
    display: block;
    margin: 0 auto;
    margin-top: 60PX;
  }
</style>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->

  <center>
    <h1 class="h3 mb-0 text-gray-800">Bienvenido <?php echo $usuario; ?> al Sistema De Control De Maquinas</h1>

  </center>
  <br>
  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="../views/operadores.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Operadores</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                require_once("../includes/db.php");

                $SQL = "SELECT id FROM operadores ORDER BY id";
                $dato = mysqli_query($conexion, $SQL);
                $fila = mysqli_num_rows($dato);

                echo ($fila); ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-male fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="../views/maquinas.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Maquinas</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                require_once("../includes/db.php");

                $SQL = "SELECT id FROM maquinas ORDER BY id";
                $dato = mysqli_query($conexion, $SQL);
                $fila = mysqli_num_rows($dato);

                echo ($fila); ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fa fa-cogs fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="../views/inventario.php" class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Reporte General</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                require_once("../includes/db.php");

                $SQL = "SELECT id FROM inventario ORDER BY id";
                $dato = mysqli_query($conexion, $SQL);
                $fila = mysqli_num_rows($dato);

                echo ($fila); ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="../views/usuarios.php" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Usuarios</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                require_once("../includes/db.php");

                $SQL = "SELECT id FROM users ORDER BY id";
                $dato = mysqli_query($conexion, $SQL);
                $fila = mysqli_num_rows($dato);

                echo ($fila); ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <center>
    <br>
    <a href="form_descarga.php" class="btn btn-success btn-lg">Agregar Acarreo <i class="fa fa-plus"></i></a>
    <img src="Logo-Primario (1).png" style="max-height: 170px;" class="centered-img">
  </center>
</div>
</div>

<!-- End of Main Content -->
<?php include "../includes/footer.php";
?>