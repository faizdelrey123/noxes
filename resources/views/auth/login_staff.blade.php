<!DOCTYPE html>
<html>
<head>
    <title>Login Staff - LA PRIMERA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-cover bg-center bg-fixed bg-no-repeat relative selection:bg-[#4ade80] selection:text-[#0f342b]" style="background-image: url('{{ asset('images/login-bg.jpg') }}');">
    <!-- Dark Glass Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0a2e26]/90 via-[#1E5C4F]/80 to-[#113a30]/95 backdrop-blur-[4px] z-0 pointer-events-none"></div>

<div class="bg-white/95 backdrop-blur-xl border border-white/50 w-[500px] p-12 shadow-2xl rounded-2xl text-center relative z-10 transform transition-all duration-300 hover:-translate-y-1">

    <h1 class="text-5xl font-black tracking-tighter italic mb-8 flex items-center justify-center gap-1 drop-shadow-sm cursor-default hover:scale-105 transition-transform duration-500">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80]">LA PRIMERA</span>
            <div class="w-2.5 h-2.5 rounded-full bg-[#4ade80] self-end mb-1.5 animate-pulse"></div>
        </h1>
    <h2 class="text-3xl mb-8 font-semibold text-gray-800">Masuk <span class="text-[#1E5C4F]">Admin / Petugas</span></h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/staff/login">
        @csrf

        <input type="text" name="username"
            placeholder="Nama Pengguna"
            class="w-full border rounded-lg p-3 mb-6">

        <input type="password" name="password"
            placeholder="Kata Sandi"
            class="w-full border rounded-lg p-3 mb-6">

        <button class="w-full bg-green-800 text-white py-3 rounded-lg shadow-md">
            Login
        </button>
    </form>

</div>

</body>
</html>
