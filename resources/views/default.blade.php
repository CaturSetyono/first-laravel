<!DOCTYPE html>
<html>
<head>
    <title>Rectangle Calculator | Luxe Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #e0e0e0;
        }
        .container {
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid rgba(201, 169, 98, 0.2);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: #c9a962;
        }
        .btn-primary {
            background: linear-gradient(135deg, #c9a962 0%, #b8956f 100%);
            border: none;
            color: #0d0d0d;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #d4b876 0%, #c9a962 100%);
            color: #0d0d0d;
        }
        .form-control {
            background: #252525;
            border: 1px solid rgba(201, 169, 98, 0.2);
            color: #e0e0e0;
        }
        .form-control:focus {
            background: #2d2d2d;
            border-color: #c9a962;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 98, 0.25);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>