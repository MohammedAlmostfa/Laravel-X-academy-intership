<x-app-layout>

    <head>
        <title>View Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{ asset('view.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <div class="container d-flex flex-column align-items-center" style="margin-top: 20px;">
    </div>
    <div class="container d-flex flex-column align-items-center" style="margin-top: 20px;">
    </div>
    <div class="container d-flex flex-column align-items-center" style="margin-top: 20px;">
    </div>
    <div class="container d-flex flex-column align-items-center" style="margin-top: 20px;">
        <h1 class="mb-4">Finished Tasks</h1>
        @foreach ($tasks as $task)
            <div class="card w-75 mb-3 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="content">
                        <h4 class="card-title mb-2 fw-bold">{{ $task->Task_name }}</h4>
                        <p class="card-text text-secondary mb-1"><strong>Description:</strong> {{ $task->Description }}
                        </p>
                        <p class="card-text text-secondary mb-1"><strong>Result:</strong> {{ $task->result }}</p>

                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
