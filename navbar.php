
<nav class="navbar navbar-inverse navbar-expand-sm bg-dark navbar-dark>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
         
    </div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="nav-item" style="margin:auto;" >
          <p><img src="img/utp.jpg" alt="logo"  style="width:45px; height:45px;padding-top:10px;"></p> 
        </li>
        <li class="nav-item" style="margin:auto;" >
          <a class="nav-link active" href="home.php" >Inicio</a>
        </li>
        <li class="nav-item dropdowndropdown" style="margin:auto;" >
          <a class="nav-link" href="edicion.php">Edición</a><br>
        </li>
        <li class="nav-item dropdowndropdown" style="margin:auto;" >
          <a class="nav-link" href="subir_reporte.php">Subir</a><br>
        </li>
        <li class="nav-item" style="margin:auto;" data-toggle="modal" data-target="#myModal" >
          <a class="nav-link" href="#" >Salir</a>
          <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                
                <div class="modal-header">
                  <h4 class="modal-title">¿Desea Salir?</h4>
                  <button type="button" class="hidden, modal fade" data-dismiss="modal">&times;</button>
                </div>
                
                
                <div class="modal-body">
                <a href="cerrar_session.php" alt="Salir"><button type="button" class="btn btn-info">ACEPTAR</button></a>
                <a><button type="button" class="btn btn-danger">CANCELAR</button></a>
                </div>
                
                
                <div class="modal-footer">          
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="tooltip" data-placement="bottom" title="Usuario activo">
          <span class="dot"></span>  Bienvenido: 
          <?php echo $_SESSION['u_usuario'];?>
        </a>
      </li>
    </ul>
    </div>
  </div>
</nav>
  


