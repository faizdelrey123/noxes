<?php

function updateAuthPage($path, $isStaff = false) {
    if (!file_exists($path)) return;
    $content = file_get_contents($path);
    
    // Normalize newlines
    $content = preg_replace('/\r\n/', "\n", $content);
    
    if (!$isStaff) {
        // Upgrade Body tag
        $searchBody = '<body class="bg-gray-100 bg-cover bg-center bg-no-repeat" style="background-image: url(\'{{ asset(\'images/login-bg.jpg\') }}\');">';
        $replaceBody = '<body class="bg-gray-100 bg-cover bg-center bg-fixed bg-no-repeat relative selection:bg-[#4ade80] selection:text-[#0f342b]" style="background-image: url(\'{{ asset(\'images/login-bg.jpg\') }}\');">
    <!-- Dark Glass Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0a2e26]/90 via-[#1E5C4F]/80 to-[#113a30]/95 backdrop-blur-[4px] z-0 pointer-events-none"></div>';
        $content = str_replace($searchBody, $replaceBody, $content);
        
        // Upgrade Navbar
        $searchNav = '<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">';
        $replaceNav = '<nav class="bg-white/95 backdrop-blur-md px-16 py-6 flex justify-between items-center shadow-sm relative z-30 border-b border-white/20">';
        $content = str_replace($searchNav, $replaceNav, $content);
        
        // Upgrade Content wrapper
        $searchContent = '<div class="grid grid-cols-2 min-h-[70vh]">';
        $replaceContent = '<div class="grid grid-cols-2 min-h-[70vh] relative z-10">';
        $content = str_replace($searchContent, $replaceContent, $content);

        // Upgrade Left Side text
        $searchText = '<p class="text-3xl">Tas Ransel Terbaik <br> Gaya Bersamamu</p>';
        $replaceText = '<p class="text-3xl text-white font-light drop-shadow-lg tracking-wide leading-relaxed">Tas Ransel Terbaik <br> <span class="font-extrabold text-[#4ade80]">Gaya Bersamamu</span></p>';
        $content = str_replace($searchText, $replaceText, $content);

        // Upgrade Right Side Card
        $searchCard = '<div class="bg-white w-[420px] p-10 shadow-lg">';
        $replaceCard = '<div class="bg-white/95 backdrop-blur-xl border border-white/50 w-[420px] p-10 shadow-2xl rounded-2xl transform transition-all duration-300 hover:-translate-y-1">';
        $content = str_replace($searchCard, $replaceCard, $content);
        
    } else {
        // Staff Login
        $searchBody = '<body class="bg-gray-100 flex items-center justify-center min-h-screen">';
        $replaceBody = '<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-cover bg-center bg-fixed bg-no-repeat relative selection:bg-[#4ade80] selection:text-[#0f342b]" style="background-image: url(\'{{ asset(\'images/login-bg.jpg\') }}\');">
    <!-- Dark Glass Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0a2e26]/90 via-[#1E5C4F]/80 to-[#113a30]/95 backdrop-blur-[4px] z-0 pointer-events-none"></div>';
        $content = str_replace($searchBody, $replaceBody, $content);
        
        $searchCard = '<div class="bg-white w-[500px] p-12 shadow-lg text-center">';
        $replaceCard = '<div class="bg-white/95 backdrop-blur-xl border border-white/50 w-[500px] p-12 shadow-2xl rounded-2xl text-center relative z-10 transform transition-all duration-300 hover:-translate-y-1">';
        $content = str_replace($searchCard, $replaceCard, $content);
        
        $searchTitle = '<h2 class="text-3xl mb-8">Masuk Admin / Petugas</h2>';
        $replaceTitle = '<h2 class="text-3xl mb-8 font-semibold text-gray-800">Masuk <span class="text-[#1E5C4F]">Admin / Petugas</span></h2>';
        $content = str_replace($searchTitle, $replaceTitle, $content);
    }
    
    // Write back
    $content = str_replace("\n", "\r\n", $content);
    file_put_contents($path, $content);
    echo "Updated $path\n";
}

updateAuthPage('C:/xampp/htdocs/noxes/resources/views/auth/login.blade.php', false);
updateAuthPage('C:/xampp/htdocs/noxes/resources/views/auth/register.blade.php', false);
updateAuthPage('C:/xampp/htdocs/noxes/resources/views/auth/login_staff.blade.php', true);
?>
