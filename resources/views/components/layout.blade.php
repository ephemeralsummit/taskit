<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskIt!</title>
    @vite(['resources/css/fonts.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>

    .blog-card {
            background-color: #8a2ae0;
            border-radius: 8px;
            box-shadow: 0px 2px 15px 10px rgba(64, 4, 85, 0.595);
            overflow: hidden;
        }
    
    .blog-card-welcome {
            background-color: #8a2ae0;
            border-radius: 8px;
            box-shadow: 0px 2px 15px 10px rgba(64, 4, 85, 0.595);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

    .blog-card-welcome:hover{
        transform: scale(1.05);
    }
    .blog-content {
            padding: 15px;
        }

    .blog-content p {
            font-size: 14px;
            color: #6c757d;
        }
        
    .search-pad {
        margin-top: 10px;
        padding: 8px 20px;
    }
    .read-more-btn {
                display: inline-block;
                margin-top: 10px;
                padding: 8px 20px;
                background-color: #da6fd5;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                font-family: Lexend;
                font-style: normal;
                font-weight: 300;
            }

    .read-more-btn-danger {
                display: inline-block;
                margin-top: 10px;
                padding: 8px 20px;
                background-color: #ff0000;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                font-family: Lexend;
                font-style: normal;
                font-weight: 300;
            }

    .read-more-btn-danger:hover {
                background-color: #e7e2e5;
                color: #ff0000;
            }
    .read-more-btn:hover {
                background-color: #e7e2e5;
                color: #de39d6;
            }

    .table_custom { 
        --bs-table-bg: transparent !important;
    }

    .task-input {
        background: transparent;
        border: none;
        color: white;
        padding: 0;
        font-size: inherit;
        font-family: inherit;
        height: auto;
        width: 100%;
    }

    .task-input:focus {
        background: transparent;
        color: white;
        outline: none;
        border-bottom: 1px solid #ccc;
    }

    .task-text {
        display: inline-block;
        width: 100%;
    }

    td {
        vertical-align: middle;
    }

    .input-custom::placeholder {
    color: white;
    }

    input:focus {
        outline: none;
    }


    body {
        background-color: #4b0081 !important;
    }

    p, h1, a, td, input::placeholder, input, label, .btn-sm, button {
        font-family: Lexend;
        font-style: normal;
        font-weight: 300;
    }

</style>


<body>
    {{-- admin doang, kalau ga admin navbar nya hilang&nonfunctional --}}
    <x-permission>
        <x-slot:admin>
        <div class="position-fixed blog-card blog-content py-3 w-100">
            <nav class="navbar navbar-expand-lg navbar-dark w-100">
                <div class="container-fluid px-4">
                        <h1 class="text-light">Admin Mode</h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav h4">
                            @auth
                            <li class="nav-item">
                            <a href="/dashboard" class  ="nav-link active text-light h5">Dashboard</a>
                            </li>
                            <li class="nav-item">
                            <a href="/tasks" class="nav-link active text-light h5">Tasks</a>
                            </li>
                            <li class="nav-item">
                            <a href="/users" class="nav-link active text-light h5">Users</a>
                            </li>
                            <li class="nav-item">
                            <a href="/roles" class="nav-link active text-light h5">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link active text-light h5">Logout</a>
                            </li>
                            @endauth  
                        </ul>
                    </div>
                </div>
            </nav>
        </div><br>
        </x-slot:admin>
    </x-permission>

@if (session('success'))
    <div class="position-fixed alert alert-success top-0 start-50 translate-middle-x mt-lg-5" role="alert" id="success-alert" style="width: fit-content; max-width: 90%">
        {{ session("success") }}
    </div>
@endif


    {{ $slot }}

    <div class="fixed-bottom d-flex justify-content-center align-items-center pt-lg-2" style="margin-bottom:2vh;">
        <p class="h6" style="color:#a590ac">
            TaskIt! by sat, 2025
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.remove();
                }, 1500);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>