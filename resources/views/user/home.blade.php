@extends('layouts.user_layout')

@section('title', 'Dashboard - LA PRIMERA')

@section('styles')
    <style>
        /* Marquee Scroll Style */
        .marquee {
            width: 100%;
            overflow: hidden;
            background: #1E5C4F;
            color: white;
            padding: 12px 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: scroll 25s linear infinite;
            font-weight: 700;
            font-size: 1.125rem;
            letter-spacing: 0.05em;
        }

        @keyframes scroll {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }
    </style>
@endsection

@section('content')
    <!-- ================= HERO SECTION ================= -->
    <section class="relative">
        <img src="{{ asset('images/bannerjans4.jpg') }}"
             class="w-full h-[500px] object-cover">

        <div class="absolute bottom-10 left-10 text-white text-6xl font-bold drop-shadow-lg text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">
            LA PRIMERA Collection.
        </div>
    </section>

    <!-- ================= RUNNING TEXT ================= -->
    <div class="marquee">
        <div class="marquee-content uppercase tracking-widest">
            ✨ TEMUKAN GAYA TERBAIKMU BERSAMA LA PRIMERA! KAMI MENYEDIAKAN BACKPACK BERKUALITAS PREMIUM UNTUK MENEMANI AKTIVITAS HARIANMU. ✨
        </div>
    </div>

    <!-- ================= NEW ARRIVAL ================= -->
    <section class="py-20 text-center">

        <h2 class="text-4xl font-black text-[#1E5C4F] mb-12 italic tracking-tighter">Produk Baru</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 px-6 md:px-24 text-transparent">

            <div class="bg-white p-8 shadow-sm rounded-3xl border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/jansmtf6.jpg') }}"
                     class="mx-auto h-48 object-contain">
            </div>

            <div class="bg-white p-8 shadow-sm rounded-3xl border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/jansmtf8.jpg') }}"
                     class="mx-auto h-48 object-contain">
            </div>

            <div class="bg-white p-8 shadow-sm rounded-3xl border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/jansmtf10.jpg') }}"
                     class="mx-auto h-48 object-contain">
            </div>

            <div class="bg-white p-8 shadow-sm rounded-3xl border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/jansmtf8.jpg') }}"
                     class="mx-auto h-48 object-contain">
            </div>

        </div>
    </section>

    <!-- ================= BEST SELLER ================= -->
    <section class="py-20 text-center bg-gray-50/50">

        <h2 class="text-4xl font-black text-[#1E5C4F] mb-12 italic tracking-tighter">Terlaris</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 px-6 md:px-24">

            <div class="group">
                <img src="{{ asset('images/jansmtf11.jpg') }}"
                     class="mx-auto h-64 object-contain group-hover:scale-110 transition duration-500">
            </div>

            <div class="group">
                <img src="{{ asset('images/jansmtf12.jpg') }}"
                     class="mx-auto h-64 object-contain group-hover:scale-110 transition duration-500">
            </div>

            <div class="group">
                <img src="{{ asset('images/jansmtf13.jpg') }}"
                     class="mx-auto h-64 object-contain group-hover:scale-110 transition duration-500">
            </div>

            <div class="group">
                <img src="{{ asset('images/jansmtf14.jpg') }}"
                     class="mx-auto h-64 object-contain group-hover:scale-110 transition duration-500">
            </div>

        </div>
    </section>

    <!-- ================= FULL BANNER ================= -->
    <section class="relative h-[450px] overflow-hidden">
        <img src="{{ asset('images/bannerjans6.jpg') }}"
             class="w-full h-full object-cover transform hover:scale-105 transition duration-1000">
    </section>

    <!-- ================= STYLE SECTION ================= -->
    <section class="py-24 px-6 md:px-24 grid grid-cols-1 md:grid-cols-2 items-center gap-16">

        <div class="relative group">
            <div class="absolute -inset-4 bg-gradient-to-r from-[#1E5C4F] to-[#4ade80] rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
            <img src="{{ asset('images/bannerjans2.jpg') }}"
                 class="relative w-full rounded-3xl shadow-2xl">
        </div>

        <div>
            <h1 class="text-6xl md:text-7xl font-black text-[#1E5C4F] leading-none italic tracking-tighter">
                “Where <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#1E5C4F] to-[#4ade80]">Style</span> <br>
                Meets <br>
                Daily <br>
                Life”
            </h1>
        </div>

    </section>
@endsection
