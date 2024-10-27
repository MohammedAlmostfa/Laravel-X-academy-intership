<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <head>
        <title>View Page</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('view.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

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
    @if (session('error'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="welcomeToast" class="toast align-items-center text-bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif


    <div class="container d-flex flex-column align-items-center" style="margin-top: 120px;">
        <!-- زر فتح النموذج -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button>

        <!-- نموذج جديد -->
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

        <!-- قائمة المهام -->
        <div class="container d-flex flex-column align-items-center" style="margin-top: 120px;">
            @foreach ($tasks as $task)
                <div class="card w-75 mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="content">
                            <h5 class="card-title">{{ $task->Task_name }}</h5>
                            <p class="card-text">{{ $task->Description }}</p>
                            <p class="card-text"><small class="text-body-secondary">Due_time
                                    {{ $task->Due_time }}</small></p>
                        </div>
                        <div class="buttons">
                            <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1"
                                    onclick="return confirm('Are you sure you want to delete this task?');">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            <a href="#" class="bi bi-check-circle mx-1"></a>
                        </div>
                    </div>
                </div>
            @endforeach
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
</x-app-layout>
