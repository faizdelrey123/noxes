<!DOCTYPE html>
<html>
<head>
    <title>Profile - LA PRIMERA</title>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        @keyframes pop-in {
            0% { transform: scale(0.85); opacity: 0; }
            70% { transform: scale(1.04); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-pop { animation: pop-in 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</head>

<body class="bg-[#F5F5F5]">

{{-- ===== SUCCESS POPUP ===== --}}
@if(session('success'))
<div id="successPopup" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white p-10 rounded-3xl text-center max-w-sm w-full mx-4 shadow-2xl animate-pop">
        <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 ring-4 ring-green-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-[#1E5C4F] mb-3">Berhasil!</h2>
        <p class="mb-8 text-gray-500 leading-relaxed text-lg">{{ session('success') }}</p>
        <button onclick="document.getElementById('successPopup').style.display='none'"
            class="w-full bg-[#1E5C4F] text-white px-6 py-3.5 rounded-xl font-bold text-lg hover:bg-[#15463b] transition">
            Tutup
        </button>
    </div>
</div>
@endif

{{-- ===== NAVBAR ===== --}}
<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">
    <h1 class="text-4xl font-black tracking-tighter italic">
        <a href="{{ route('home') }}" class="flex items-center gap-1 group">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80] group-hover:from-[#15463b] group-hover:to-[#22c55e] transition-all duration-500 drop-shadow-md">LA PRIMERA</span>
            <div class="w-2 h-2 rounded-full bg-[#4ade80] self-end mb-1.5 group-hover:animate-bounce"></div>
        </a>
    </h1>

    <div class="space-x-10 text-[#1E5C4F] font-medium text-lg">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('product.index') }}">Produk</a>
        <a href="{{ route('about') }}">Tentang Kami</a>
        <a href="{{ route('contact') }}">Hubungi Kami</a>
    </div>

    <div class="flex items-center space-x-6">
        @auth
            <a href="{{ route('cart.index') }}" class="relative">
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-8 h-8 object-contain hover:scale-110 transition">
                @if(session('cart'))
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
            <a href="{{ route('profile') }}" class="relative">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
                @php
                    $unreadOrders = \App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->count();
                @endphp
                @if($unreadOrders > 0)
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                @endif
            </a>
        @else
            <a href="{{ route('login') }}" class="relative">
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-8 h-8 object-contain hover:scale-110 transition">
            </a>
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/profile.png') }}" alt="Login" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
            </a>
        @endauth
    </div>
</nav>


<div class="max-w-5xl mx-auto px-6 py-12">

    {{-- ===== PROFILE HERO CARD ===== --}}
    <div class="bg-gradient-to-br from-[#15463b] to-[#1E5C4F] p-8 rounded-3xl flex flex-col md:flex-row justify-between items-start shadow-lg text-white mb-10 overflow-hidden relative">
        {{-- Dekorasi --}}
        <div class="absolute -right-10 -top-20 w-64 h-64 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute left-1/2 bottom-0 w-40 h-40 bg-black opacity-10 rounded-full blur-xl"></div>

        {{-- Kiri: Avatar + Info --}}
        <div class="flex items-start gap-6 relative z-10 w-full md:w-auto mb-6 md:mb-0">
            @php $initial = strtoupper(substr(Auth::user()->name, 0, 1)); @endphp
            <div class="w-20 h-20 bg-white text-[#1E5C4F] rounded-full flex items-center justify-center text-4xl font-extrabold shadow-md border-4 border-white/20 select-none flex-shrink-0 mt-1">
                {{ $initial }}
            </div>
            <div class="flex-1">
                <p class="text-xs text-[#a8d5c8] mb-1 font-bold tracking-widest uppercase">Member LA PRIMERA</p>
                <h2 class="text-3xl md:text-4xl font-bold mb-2">
                    Hi, {{ Auth::user()->name }} 👋
                </h2>

                {{-- Detail akun --}}
                <div class="flex flex-col gap-1.5 mt-1">
                    <div class="flex items-center gap-2 text-[#8cc6b7] text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ '@' . Auth::user()->username }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-[#8cc6b7] text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ Auth::user()->email ?? 'Belum diisi' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-[#8cc6b7] text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ Auth::user()->phone ?? 'Belum diisi' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan: Tombol --}}
        <div class="flex flex-col gap-3 relative z-10 w-full md:w-auto md:min-w-[160px]">
            <button onclick="openEditModal()"
                class="w-full bg-white text-[#1E5C4F] px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition flex items-center justify-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profil
            </button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-white/10 hover:bg-white/20 border border-white/30 text-white px-6 py-3 rounded-xl font-semibold backdrop-blur-sm transition flex items-center justify-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>


    {{-- ===== TITLE PESANAN ===== --}}
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-[#1E5C4F]">Pesanan Saya</h3>
        <a href="{{ route('orders.index') }}" class="bg-[#1E5C4F] text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-[#15463b] transition shadow-sm">
            Riwayat Pesanan
        </a>
    </div>


    {{-- ===== TAB STATUS ===== --}}
    <div class="grid grid-cols-4 rounded-xl overflow-hidden bg-white border shadow-sm">
        <a href="?status=tertunda"
           class="flex flex-col items-center justify-center py-4 transition {{ $status=='tertunda' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">
            <span class="font-semibold">Tertunda</span>
            <span class="mt-1 text-xs px-2 py-0.5 rounded-full {{ $status=='tertunda' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">{{ $counts['tertunda'] }}</span>
        </a>
        <a href="?status=packed"
           class="flex flex-col items-center justify-center py-4 transition {{ $status=='packed' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">
            <span class="font-semibold">Dikemas</span>
            <span class="mt-1 text-xs px-2 py-0.5 rounded-full {{ $status=='packed' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">{{ $counts['packed'] }}</span>
        </a>
        <a href="?status=shipped"
           class="flex flex-col items-center justify-center py-4 transition {{ $status=='shipped' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">
            <span class="font-semibold">Dikirim</span>
            <span class="mt-1 text-xs px-2 py-0.5 rounded-full {{ $status=='shipped' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">{{ $counts['shipped'] }}</span>
        </a>
        <a href="?status=done"
           class="flex flex-col items-center justify-center py-4 transition {{ $status=='done' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">
            <span class="font-semibold">Selesai</span>
            <span class="mt-1 text-xs px-2 py-0.5 rounded-full {{ $status=='done' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">{{ $counts['done'] }}</span>
        </a>
    </div>


    {{-- ===== ORDER LIST ===== --}}
    <div class="mt-8 space-y-8">
        @forelse($orders as $order)
        <div class="bg-white p-8 rounded-xl shadow-sm">

            @foreach($order->items as $item)
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-6">
                    <img src="{{ asset('products/'.$item->product->image) }}" class="w-24 h-24 object-cover rounded-lg">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-gray-500">x{{ $item->quantity }}</p>
                    </div>
                </div>
                <div class="font-semibold">Rp {{ number_format($item->price,0,',','.') }}</div>
            </div>
            @endforeach

            <div class="flex justify-between items-center mb-4">
                <p class="font-medium">Status Pesanan :</p>
                <span class="px-4 py-1 rounded-full text-white text-sm
                    @if($order->status == 'tertunda') bg-gray-500
                    @elseif($order->status == 'dikemas') bg-yellow-500
                    @elseif($order->status == 'dikirim') bg-blue-500
                    @else bg-green-600 @endif">
                    @if($order->status == 'tertunda') Menunggu Konfirmasi
                    @elseif($order->status == 'dikemas') Dikemas
                    @elseif($order->status == 'dikirim') Dikirim
                    @else Selesai @endif
                </span>
            </div>

            <div class="flex justify-between mt-4">
                <p class="font-medium">Subtotal order :</p>
                <p class="text-[#1E5C4F] font-semibold">Rp {{ number_format($order->total,0,',','.') }}</p>
            </div>

            <div class="text-right mt-6 flex flex-wrap justify-end gap-3">
                @if($order->status != 'tertunda')
                    <button type="button" onclick="document.getElementById('track-{{ $order->id }}').classList.toggle('hidden')"
                        class="bg-blue-50 text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-100 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lacak Pesanan
                    </button>
                @endif
                @if($order->status == 'selesai' && !$order->is_received)
                    <form action="{{ route('orders.receive', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Pesanan Diterima
                        </button>
                    </form>
                @endif
                <a href="{{ route('orders.show', $order->id) }}"
                   class="bg-white border-2 border-[#1E5C4F] text-[#1E5C4F] hover:bg-[#1E5C4F] hover:text-white transition px-6 py-2 rounded-lg font-semibold flex items-center gap-2">
                    Detail
                </a>
            </div>

            @if($order->status != 'tertunda')
                <div id="track-{{ $order->id }}" class="hidden mt-6 bg-gray-50 rounded-xl p-6 border-2 border-gray-100">
                    <h4 class="font-bold text-[#1E5C4F] mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                        </svg>
                        Status Pengiriman
                    </h4>
                    <div class="relative border-l-4 border-gray-200 ml-4 space-y-6">
                        @php
                            $steps = [1=>'Menyiapkan pengiriman',2=>'Paket sedang di pick up',3=>'Sedang transit',4=>'Sedang dalam pengiriman',5=>'Diterima'];
                            $currentLvl = $order->tracking_level ?? 0;
                            if($order->is_received) $currentLvl = 5;
                        @endphp
                        @foreach($steps as $lvl => $desc)
                        <div class="relative pl-8">
                            <div class="absolute -left-[11px] top-0 w-5 h-5 rounded-full border-4 {{ $currentLvl >= $lvl ? 'bg-[#1E5C4F] border-[#1E5C4F] ring-4 ring-green-50' : 'bg-white border-gray-200' }} transition-colors duration-300"></div>
                            <p class="text-[15px] font-bold {{ $currentLvl >= $lvl ? 'text-gray-800' : 'text-gray-400' }}">{{ $desc }}</p>
                            @if($currentLvl == $lvl)
                                <p class="text-xs font-semibold text-green-600 mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    Posisi saat ini
                                </p>
                            @endif
                            @if($currentLvl > $lvl)
                                <p class="text-xs text-gray-400 mt-1">Selesai</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
        @empty
        <div class="text-center text-gray-400 mt-12 py-16 bg-white rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="font-semibold text-lg">Belum ada pesanan di kategori ini</p>
        </div>
        @endforelse
    </div>

</div>


{{-- ============================================================ --}}
{{-- MODAL EDIT PROFIL (+ GANTI PASSWORD) --}}
{{-- ============================================================ --}}
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg animate-pop max-h-[92vh] overflow-y-auto">
        <div class="p-8">

            {{-- Header modal --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <div class="w-9 h-9 bg-[#e8f5f1] rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#1E5C4F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    Edit Profil
                </h2>
                <button onclick="closeEditModal()" class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Error umum (edit profil) --}}
            @if($errors->hasAny(['name','username','email','phone']))
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4 text-sm text-red-600">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->only(['name','username','email','phone']) as $e)
                        <li>{{ is_array($e) ? $e[0] : $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- FORM EDIT PROFIL --}}
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                        placeholder="Nama lengkap" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Username</label>
                    <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                        placeholder="Username unik" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                        placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                        placeholder="08xxxxxxxxxx">
                </div>
                <button type="submit"
                    class="w-full bg-[#1E5C4F] text-white py-3 rounded-xl font-semibold hover:bg-[#15463b] transition shadow-sm">
                    Simpan Perubahan
                </button>
            </form>

            {{-- DIVIDER --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-gray-400 font-medium">Ganti Password</span>
                </div>
            </div>

            {{-- Error password --}}
            @if($errors->hasAny(['current_password','new_password']))
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4 text-sm text-red-600">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->only(['current_password','new_password']) as $e)
                        <li>{{ is_array($e) ? $e[0] : $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- FORM GANTI PASSWORD --}}
            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Password Lama</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="currentPwd"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                            placeholder="Masukkan password lama">
                        <button type="button" onclick="togglePwd('currentPwd')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password" id="newPwd"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                            placeholder="Minimal 6 karakter">
                        <button type="button" onclick="togglePwd('newPwd')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password_confirmation" id="confirmPwd"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]/30 focus:border-[#1E5C4F] bg-gray-50 transition"
                            placeholder="Ulangi password baru">
                        <button type="button" onclick="togglePwd('confirmPwd')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-gray-700 text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition shadow-sm">
                    Ganti Password
                </button>
            </form>

        </div>
    </div>
</div>


{{-- ===== FOOTER ===== --}}
<footer class="bg-white border-t border-gray-200 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-2">
                <h2 class="text-3xl font-bold text-[#1E5C4F] mb-4">LA PRIMERA</h2>
                <p class="text-gray-600 leading-relaxed mb-6 max-w-sm">
                    Di mana Gaya Bertemu Kehidupan Sehari-hari. Menyediakan koleksi backpack eksklusif dan kebutuhan fashion harian terbaik untuk gaya aktifmu.
                </p>
                <div class="text-gray-500 font-medium">
                    <p>Jl. Tanah Baru Jl. Kemiri Jaya No.99,</p>
                    <p>Beji, Kecamatan Beji, Kota Depok,</p>
                    <p>Jawa Barat 16421</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase tracking-wider">Ikuti Kami</h3>
                <div class="flex items-center gap-4">
                    <a href="#" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 01-122.77-39.25v178.72A162.55 162.55 0 11185 188.31v89.89a74.62 74.62 0 1052.23 71.18V0l88 0a121.18 121.18 0 001.86 22.17h0A122.18 122.18 0 00381 102.39a121.43 121.43 0 0067 20.14z"/></svg>
                    </a>
                    <a href="#" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-pink-500 hover:to-purple-600 hover:text-white transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </a>
                    <a href="#" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-[#FF0000] hover:text-white transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
                    </a>
                    <a href="#" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500">© {{ date('Y') }} LA PRIMERA Apparel Corp. Hak cipta dilindungi.</p>
            <div class="flex gap-4 mt-4 md:mt-0 text-sm text-gray-500">
                <a href="#" class="hover:text-[#1E5C4F]">Kebijakan Privasi</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-[#1E5C4F]">Syarat Ketentuan</a>
            </div>
        </div>
    </div>
</footer>


<script>
    function openEditModal() {
        const m = document.getElementById('editModal');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function closeEditModal() {
        const m = document.getElementById('editModal');
        m.classList.add('hidden');
        m.classList.remove('flex');
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    function togglePwd(id) {
        const el = document.getElementById(id);
        el.type = el.type === 'password' ? 'text' : 'password';
    }

    // Auto-buka modal jika ada error validasi
    @if($errors->any())
        openEditModal();
    @endif
</script>

</body>
</html>