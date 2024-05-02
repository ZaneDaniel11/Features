<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="./Code/loginCode.php" method="POST">
        <div class="modal-body">
            
            <div class="form-group">
            <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Email">
            </div>

            <div class="form-group">
            <label for="">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="login_btn">Login</button>
        </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade" id="Create-Content" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Username</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="../Code/Content.php" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="mb-3">
              <label for="text" class="form-label">Content Name</label>
              <input type="text" class="form-control" name="content" id="content">
          </div>
          <div class="mb-3">
              <div class="input-group">
                  <input type="file" class="form-control fileImg" name="fileImg[]" accept=".jpg, .jpeg, .png" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required multiple>
              </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
</form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#"><?php if (isset($_SESSION['authuser_name'])) {
      echo $_SESSION['authuser_name'];
    } else {
      echo 'fail';
    } ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
        <?php if(!isset($_SESSION['auth_user_id']))
         { 
            ?> <li> <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal" href="#">Login</a></li> <?php
       
            }
            else
            { 
                ?> <li><a class="nav-link" href="../Code/logout.php">Logout</a></li> <?php 
            }
        ?>
         
        </li>
        <li><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create-Content">Create Post</button></li>
      </ul>

    </div>
  </div>
</nav>


