<!DOCTYPE html>
<html>

<head>
    <title>View Page</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('view.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>>

<body>
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@mdo">
                <i class="bi bi-plus-circle-fill me-2"></i>
                Add Task
            </a>


            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="cc offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3">

            <div id="welcomeToast" class="toast align-items-center text-bg-primary border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>

        </div>
    @endif



    <div class="container d-flex flex-column align-items-center" style="margin-top: 120px;">
        @for ($i = 0; $i < 10; $i++)
            <div class="card w-75 mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="content">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                    <div class="buttons">
                        <a href="#" class="bi bi-x-circle mx-1"></a>
                        <a href="#" class="bi bi-check-circle mx-1"></a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('task.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Task Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="Task_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Task Description:</label>
                            <textarea class="form-control" id="message-text" name="Description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due-time" class="col-form-label">Due Time:</label>
                            <input type="datetime-local" class="form-control" id="due-time" name="Due_time"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Task</button>
                </div>
                </form>
            </div>
        </div>
    </div>








    <script>
        // Initialize the toast
        var toastEl = document.getElementById('welcomeToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            // Show the toast
            toast.show();
            // Auto-hide toast after 10 seconds
            setTimeout(function() {
                toast.hide();
            }, 10000); // 10000 milliseconds = 10 seconds
        }
    </script>
</body>

</html>
