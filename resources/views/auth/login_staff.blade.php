<!DOCTYPE html>
<html>
<head>
    <title>Login Staff - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white w-[500px] p-12 shadow-lg text-center">

    <h1 class="text-4xl font-bold text-green-800 mb-6">NOXÉS</h1>
    <h2 class="text-3xl mb-8">Login Admin / Petugas</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/staff/login">
        @csrf

        <input type="text" name="username"
            placeholder="Username"
            class="w-full border rounded-lg p-3 mb-6">

        <input type="password" name="password"
            placeholder="Password"
            class="w-full border rounded-lg p-3 mb-6">

        <button class="w-full bg-green-800 text-white py-3 rounded-lg shadow-md">
            Login
        </button>
    </form>

</div>

</body>
</html>
