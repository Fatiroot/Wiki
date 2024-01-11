<?php 
require_once __DIR__ . '/../../../vendor/autoload.php';
use app\dao\UserDao;

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: login');
    exit();
}


// var_dump($_SESSION['role_id']);



$user = new UserDao();
$Id = $_SESSION['user_id'];
$users = $user->getUserById($Id);
// print_r($user);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Bootstrap Dashboard and Admin Template - ByteWebster</title>
  <link rel="stylesheet" href="/wiki/app/routes/../../public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<!-- bytewebster.com -->
<!-- bytewebster.com -->
<!-- bytewebster.com -->
<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                <h3 class="text-success"><img src="https://bytewebster.com/img/logo.png" width="40"><span class="text-info">Wiki</span></h3> 
            </a>
            <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle -->
                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-parent-child">
                            <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                            <span class="avatar-child avatar-badge bg-success"></span>
                        </div>
                    </a>
                    <span ><?= $users['username'];?></span>
                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <hr class="dropdown-divider">
                        <a href="login" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category">
                            <i class="bi bi-bookmarks"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wiki">
                            <i class="bi bi-globe-americas"></i> Wikis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tag">
                            <i class="bi bi-file-text"></i> Tags
                        </a>
                    </li>
                </ul>
                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-square"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login" onclick="return confirm('Are you sure you want to logout?')">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">      
                    </div>   
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary"> 
            <div class="card shadow border-0 mb-7">
               <div class="container mt-5">
                <h2>Update Tag</h2>
                <form method="post" action="updateTag">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="tagId" name="id" value="<?= $tag['id'] ?>" required>
                        <label for="tagName" class="form-label">Tag Name</label>
                        <input type="text" class="form-control" id="tagName" name="tagName" value="<?= $tag['name'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">
                        Update Tag
                    </button>
                </form>

               </div>
            </div>
        </main>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
