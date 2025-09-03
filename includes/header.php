<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Produtos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d1117 0%, #161b22 100%);
            color: #f0f0f0;
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(22, 27, 34, 0.9);
            border-radius: 15px;
            backdrop-filter: blur(12px);
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 1s ease-in-out;
        }
        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(106, 17, 203, 0.4);
        }
        nav.navbar {
            background: rgba(22, 27, 34, 0.95) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        nav .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg,#6a11cb,#2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-grad {
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-grad:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 30px rgba(37,117,252,0.7);
            color: white;
        }
        h1, h2 { font-weight: 700; }
        .action-icons i {
            cursor: pointer; transition: transform 0.2s ease;
        }
        .action-icons i:hover { transform: scale(1.2); }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.25);
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(40px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Sistema de Produtos</a>
    <div class="d-flex gap-2">
      <a href="cadastro.php" class="btn btn-grad btn-sm">Cadastrar</a>
      <a href="consulta.php" class="btn btn-light btn-sm">Consultar</a>
      <a href="procurar.php" class="btn btn-outline-light btn-sm">
        <i class="fa-solid fa-magnifying-glass me-1"></i> Procurar
      </a>
    </div>
  </div>
</nav>
<div class="container" style="padding-top: 100px;">