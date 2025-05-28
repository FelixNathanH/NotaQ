<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sidebar Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .main-sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
            border-right: 1px solid #dee2e6;
        }

        .sidebar-menu {
            flex-grow: 1;
        }

        .logout-button {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="main-sidebar">
        <div class="sidebar-menu">
            <h5 class="text-center">Store Name</h5>
            <input type="search" class="form-control my-2" placeholder="Search">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nota</a>
                </li>
            </ul>
        </div>
        <div class="logout-button">
            <a href="#" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</body>

</html>