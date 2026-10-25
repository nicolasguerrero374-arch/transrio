<!DOCTYPE html>
<html>

<head>
    <title>Login Admin - TransRio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #0E47A1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial;
            margin: 0
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .3)
        }

        h2 {
            text-align: center;
            color: #0E47A1;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box
        }

        button {
            width: 100%;
            padding: 12px;
            background: #0E47A1;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px
        }

        .error {
            color: red;
            font-size: 13px;
            text-align: center
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>TransRio Admin</h2>
        @if($errors->any()) <p class="error">{{ $errors->first() }}</p> @endif
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <input type="email" name="email" placeholder="admin@transrio.com" value="admin@transrio.com" required>

            <div style="position:relative;">
                <input type="password" name="password" id="password" placeholder="Contraseña" value="TransRio2026" required style="padding-right:40px;">
                <span onclick="verPass()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:#0047A1;">
                    <i id="eyeIcon" class="bi bi-eye-slash" style="font-size:18px;"></i>
                </span>
            </div>

            <button type="submit">Entrar</button>
        </form>
        <div style="margin-top:20px; border-top:1px solid #eee; padding-top:15px;">
            <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
    </div>

    <script>
        function verPass() {
            let input = document.getElementById('password');
            let icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }
    </script>

</body>

</html>
