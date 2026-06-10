<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PawDoc</title>
        <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Crimson Text', serif; background: #1a120b; overflow-x: hidden; }
            .tech-font { font-family: 'Chakra Petch', sans-serif; }
            .bg-industrial { background-image: url("https://www.transparenttextures.com/patterns/dark-leather.png"); }
            .scanlines { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(18,16,16,0) 50%, rgba(0,0,0,0.08) 50%); background-size: 100% 3px; pointer-events: none; z-index: 100; }
            .steam-pipe { background: linear-gradient(90deg, #5c4033 0%, #B8860B 50%, #5c4033 100%); box-shadow: 2px 0 10px rgba(0,0,0,0.5); }
            @keyframes rotate-gear { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
            .gear-anim { animation: rotate-gear 25s linear infinite; }
            input[type="email"], input[type="password"], input[type="text"] {
                background-color: rgba(217,197,163,0.3) !important;
                border: 2px solid #5c4033 !important;
                color: #2d1a0e !important;
                padding: 8px 12px; width: 100%; outline: none;
                font-family: 'Chakra Petch', sans-serif; font-size: 13px;
            }
            input[type="email"]:focus, input[type="password"]:focus { border-color: #B8860B !important; }
            label { color: #5c4033 !important; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; font-family: 'Chakra Petch', sans-serif; }
            button[type="submit"] { background-color: #5c4033 !important; color: #e2d1b3 !important; border: none; padding: 10px 24px; font-family: 'Chakra Petch', sans-serif; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; cursor: pointer; }
            button[type="submit"]:hover { background-color: #B8860B !important; color: #000 !important; }
        </style>
    </head>
    <body class="antialiased text-[#e2d1b3] bg-industrial" style="background-color:#1a120b;">
        <div class="scanlines"></div>
        <div style="position:fixed;top:-5%;left:-5%;font-size:20rem;color:#B8860B;opacity:0.03;pointer-events:none;" class="gear-anim">&#9881;</div>
        <div style="position:fixed;bottom:-5%;right:-5%;font-size:15rem;color:#5c4033;opacity:0.03;pointer-events:none;animation:rotate-gear 20s linear infinite reverse;">&#9881;</div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative px-4" style="z-index:10;">
            <div class="mb-8 text-center">
                <div style="font-size:4rem;filter:sepia(1);">&#128062;</div>
                <h1 class="tech-font" style="font-size:2rem;font-weight:900;letter-spacing:0.4em;color:#B8860B;margin-top:16px;text-transform:uppercase;font-style:italic;">PAWDOC</h1>
                <p class="tech-font" style="font-size:9px;color:#B8860B;letter-spacing:0.3em;text-transform:uppercase;margin-top:8px;opacity:0.6;">Klinik Hewan Digital Indonesia</p>
            </div>

            <div style="width:100%;max-width:28rem;position:relative;">
                <div style="position:absolute;left:-24px;top:0;bottom:0;width:12px;border-radius:9999px;" class="steam-pipe">
                    <div style="position:absolute;top:25%;left:-4px;width:20px;height:20px;background:#5c4033;border:1px solid #B8860B;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.5);"></div>
                    <div style="position:absolute;bottom:25%;left:-4px;width:20px;height:20px;background:#5c4033;border:1px solid #B8860B;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.5);"></div>
                </div>
                <div style="position:absolute;right:-24px;top:0;bottom:0;width:12px;border-radius:9999px;" class="steam-pipe">
                    <div style="position:absolute;top:33%;right:-4px;width:20px;height:20px;background:#5c4033;border:1px solid #B8860B;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.5);"></div>
                    <div style="position:absolute;bottom:33%;right:-4px;width:20px;height:20px;background:#5c4033;border:1px solid #B8860B;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.5);"></div>
                </div>

                <div style="padding:32px;border:4px solid #5c4033;box-shadow:15px 15px 40px rgba(0,0,0,0.6);position:relative;overflow:hidden;background-color:#e2d1b3;">
                    <div style="position:absolute;top:8px;left:8px;color:#5c4033;opacity:0.4;font-size:18px;">&#128297;</div>
                    <div style="position:absolute;top:8px;right:8px;color:#5c4033;opacity:0.4;font-size:18px;">&#128297;</div>
                    <div style="position:absolute;bottom:8px;left:8px;color:#5c4033;opacity:0.4;font-size:18px;">&#128297;</div>
                    <div style="position:absolute;bottom:8px;right:8px;color:#5c4033;opacity:0.4;font-size:18px;">&#128297;</div>

                    <div class="tech-font" style="text-align:center;font-size:10px;color:#5c4033;font-weight:700;margin-bottom:24px;padding-bottom:8px;border-bottom:1px solid rgba(92,64,51,0.2);letter-spacing:0.2em;">
                        [ TERMINAL AKSES AMAN ]
                    </div>

                    {{ $slot }}

                    <div style="margin-top:24px;text-align:center;border-top:1px solid rgba(92,64,51,0.2);padding-top:16px;">
                        <p class="tech-font" style="font-size:9px;color:#5c4033;opacity:0.7;letter-spacing:0.2em;">Belum punya akun? <a href="{{ route('register') }}" style="color:#B8860B;font-weight:900;text-decoration:underline;">Daftar di sini</a></p>
                    </div>
                </div>
            </div>

            <div class="tech-font" style="margin-top:32px;font-size:9px;color:#B8860B;letter-spacing:0.5em;opacity:0.5;display:flex;align-items:center;gap:8px;">
                <span>TEKANAN: 100 PSI</span>
                <span class="animate-pulse">&#9679;</span>
            </div>
        </div>
    </body>
</html>
