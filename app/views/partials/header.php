<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResearchHub | <?= htmlspecialchars($title ?? 'Welcome') ?></title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes shimmer { 0% { background-position: -1000px 0; } 100% { background-position: 1000px 0; } }
        @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); } 50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.5); } }
        
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out; }
        .gradient-text { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); }
        .btn-shimmer { background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%); background-size: 200% 100%; transition: all 0.3s; }
        .btn-shimmer:hover { background-position: 100% 0; transform: translateY(-2px); box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4); }
    </style>
</head>
<body class="bg-slate-50 antialiased">
    <!-- Navigation with glass effect -->
    <nav class="fixed w-full top-0 z-50 glass border-b border-white/20 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo with glow -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="relative w-10 h-10 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110" style="animation: pulse-glow 2s infinite;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">ResearchHub</span>
                </a>
                
                <!-- Center Nav -->
                <?php if (isset($_SESSION['user'])): ?>
                <div class="hidden md:flex items-center gap-2">
                    <a href="/" class="relative px-4 py-2 text-sm font-medium text-slate-700 hover:text-indigo-600 rounded-xl transition-all group">
                        <span class="relative z-10">Dashboard</span>
                        <div class="absolute inset-0 bg-indigo-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <?php if ($_SESSION['user']['role_id'] == 1): ?>
                    <a href="/submit" class="relative px-4 py-2 text-sm font-medium text-slate-700 hover:text-indigo-600 rounded-xl transition-all group">
                        <span class="relative z-10">Submit Paper</span>
                        <div class="absolute inset-0 bg-indigo-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="hidden md:flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-slate-50 to-indigo-50/30 rounded-full border border-slate-200/50 shadow-sm">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900 leading-none"><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
                                <p class="text-xs text-slate-500 mt-1">
                                    <?php echo ['', 'Researcher', 'Reviewer', 'Editor', 'Librarian', 'Admin'][$_SESSION['user']['role_id']] ?? 'User'; ?>
                                </p>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white text-sm font-bold shadow-md">
                                <?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?>
                            </div>
                        </div>
                        <a href="/logout" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="px-5 py-2 text-sm font-medium text-slate-700 hover:text-indigo-600 transition-all">Sign in</a>
                        <a href="/register" class="btn-shimmer px-6 py-2.5 text-sm font-semibold text-white rounded-full shadow-lg">Get Started</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">
            <!-- Animated Flash Messages -->
            <?php if (isset($_SESSION['_flash'])): ?>
                <?php foreach ($_SESSION['_flash'] as $key => $message): ?>
                    <div class="mb-6 animate-fade-in-up">
                        <div class="rounded-2xl p-4 flex items-start gap-3 shadow-lg border <?= $key === 'success' ? 'bg-gradient-to-r from-emerald-50 to-green-50 border-emerald-200/50 text-emerald-900' : 'bg-gradient-to-r from-rose-50 to-red-50 border-red-200/50 text-red-900' ?>">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full <?= $key === 'success' ? 'bg-emerald-500' : 'bg-red-500' ?> flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <?php if ($key === 'success'): ?>
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    <?php else: ?>
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    <?php endif; ?>
                                </svg>
                            </div>
                            <p class="text-sm font-medium flex-1"><?= $message ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['_flash']); ?>
            <?php endif; ?>