<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./STYLE/style.css">
    <title>Document</title>
</head>
<body>
  <div style="height: 20px;"></div>
  <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                  <a class="nav-link" href="./login.php">Inicio de sesión</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./register.php">Registro</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="./password-recover.php">Recuperar contraseña</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="./about-us.php">Sobre nosotros</a>
                  </li>
              </ul>
             
            </div>
          </nav>
    </header>

    <main style="height: 100vh;">
      <!-- Button trigger modal -->
      <div class="p-md-5 d-flex justify-content-between">
        <button type="button" class="btn btn-primary m-auto green-primary-bg" data-toggle="modal" data-target="#exampleModal">
          Modal succes
        </button>

        <button type="button" class="btn btn-primary m-auto red-primary-bg" data-toggle="modal" data-target="#exampleModal">
          Modal no succes
        </button>
      </div>

      <!-- Modal -->
      <div class="modal text-white fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content container-border-radius">
            <div class="modal-header border-0 d-flex justify-content-between">
              <h5 class="modal-title" id="exampleModalLabel">Succes Modal</h5>
              <button type="button" 
                class="close text-white" 
                data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo et autem enim pariatur expedita? Itaque quas sed nostrum eaque veniam aliquam nemo nobis incidunt dolor, aspernatur, labore suscipit est animi!
            </div>
            <div class="modal-footer border-0 d-flex justify-content-between">
              <button type="button" class="font-weight-bold text-white container-border-radius btn border-0 green-primary-bg" data-dismiss="modal">Cerrar</button>
              <button type="button" class="container-border-radius btn border-0 shadow-sm bg-white rounded green-primary-text">Confirmar</button>
            </div>
          </div>
        </div>
      </div>

      
      <div class="w-100 p-md-5 d-flex justify-content-around">
        <button class="button-mine d-flex justify-content-center gradient text-white">Botón</button>
        <button class="button-mine d-flex justify-content-center normal text-white">Botón</button>
        <button class="button-mine d-flex justify-content-center neon text-white">Botón</button>
        <button class="button-mine d-flex justify-content-center double">Botón</button>
        <button class="button-mine d-flex justify-content-center agua">Botón</button>
      </div>

      <div class="w-100 d-flex justify-content-around">
        <div class="card box-shadow-cards border-radius-30" style="width: 18rem;">
          <img class="card-img-top border-radius-30" src="https://images.pexels.com/photos/5926184/pexels-photo-5926184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-card-style">Go somewhere</a>
          </div>
        </div>

        <div class="card box-shadow-cards border-radius-30" style="width: 18rem;">
          <img class="card-img-top border-radius-30" src="https://images.pexels.com/photos/5926184/pexels-photo-5926184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-card-style">Go somewhere</a>
          </div>
        </div>
        
        <div class="card box-shadow-cards border-radius-30" style="width: 18rem;">
          <img class="card-img-top border-radius-30" src="https://images.pexels.com/photos/5926184/pexels-photo-5926184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-card-style">Go somewhere</a>
          </div>
        </div>
      </div>


      <div class="p-md-5 w-100 d-flex justify-content-around mx-1">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>

        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
      </div>
      
    </main>


    <!-- jquery scripts -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
</body>
</html>