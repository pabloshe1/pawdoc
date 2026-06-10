<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PawDoc | Royal Veterinary Terminal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        .tech-font{font-family:'Chakra Petch',sans-serif;}
        .parchment-font{font-family:'Crimson Text',serif;}
        body{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");color:#e2d1b3;}
        .steam-text{text-shadow:0 0 30px rgba(184,134,11,0.4);}
        .text-gold{color:#B8860B;}
        @keyframes spin{from{transform:rotate(0deg);}to{transform:rotate(360deg);}}
        .gear-rotate{animation:spin 30s linear infinite;}
        .gear-rotate-rev{animation:spin 20s linear infinite reverse;}
        @keyframes pulse2{0%,100%{opacity:1;}50%{opacity:0.5;}}
        .anim-pulse{animation:pulse2 2s infinite;}
        #pawbot-fab{position:fixed;bottom:28px;right:28px;z-index:9999;width:62px;height:62px;border-radius:50%;background:#B8860B;border:3px solid #e2d1b3;box-shadow:0 0 0 0 rgba(184,134,11,0.6),4px 4px 0 #5c4033;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:transform 0.2s;animation:fabPulse 2.5s infinite;}
        #pawbot-fab:hover{transform:scale(1.08);}
        #pawbot-fab svg{width:28px;height:28px;fill:#1a120b;}
        @keyframes fabPulse{0%,100%{box-shadow:0 0 0 0 rgba(184,134,11,0.5),4px 4px 0 #5c4033;}50%{box-shadow:0 0 0 12px rgba(184,134,11,0),4px 4px 0 #5c4033;}}
        #pawbot-window{position:fixed;bottom:104px;right:28px;z-index:9998;width:360px;max-height:560px;background:#1e140c;border:2px solid #B8860B;box-shadow:8px 8px 0 #000,0 0 40px rgba(184,134,11,0.15);display:flex;flex-direction:column;transform:scale(0.85) translateY(20px);opacity:0;pointer-events:none;transform-origin:bottom right;transition:transform 0.25s cubic-bezier(0.34,1.56,0.64,1),opacity 0.2s;}
        #pawbot-window.open{transform:scale(1) translateY(0);opacity:1;pointer-events:all;}
        #pawbot-header{background:#B8860B;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid #5c4033;}
        .pb-info{display:flex;align-items:center;gap:10px;}
        .pb-avatar{width:38px;height:38px;border-radius:50%;background:#1a120b;border:2px solid #5c4033;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:13px;color:#B8860B;flex-shrink:0;font-family:'Chakra Petch',sans-serif;}
        .pb-title{font-size:13px;font-weight:700;color:#1a120b;text-transform:uppercase;letter-spacing:0.1em;font-family:'Chakra Petch',sans-serif;}
        .pb-sub{font-size:9px;color:rgba(26,18,11,0.65);text-transform:uppercase;letter-spacing:0.15em;font-family:'Chakra Petch',sans-serif;}
        .pb-online{display:flex;align-items:center;gap:4px;font-size:9px;color:rgba(26,18,11,0.7);font-weight:600;text-transform:uppercase;letter-spacing:0.1em;font-family:'Chakra Petch',sans-serif;}
        .dot-on{width:7px;height:7px;border-radius:50%;background:#1a120b;animation:blink 1.5s infinite;}
        @keyframes blink{0%,100%{opacity:1;}50%{opacity:0.3;}}
        #pb-close{background:none;border:none;cursor:pointer;color:#1a120b;font-size:18px;font-weight:900;opacity:0.7;padding:2px 6px;}
        #pb-close:hover{opacity:1;}
        #pb-chips{padding:10px 12px 0;display:flex;flex-wrap:wrap;gap:6px;}
        .chip{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;padding:5px 10px;border:1px solid rgba(184,134,11,0.45);color:#B8860B;background:rgba(184,134,11,0.07);cursor:pointer;transition:all 0.15s;font-family:'Chakra Petch',sans-serif;}
        .chip:hover{background:#B8860B;color:#000;}
        #pb-messages{flex:1;overflow-y:auto;padding:12px;display:flex;flex-direction:column;gap:10px;scroll-behavior:smooth;max-height:320px;}
        #pb-messages::-webkit-scrollbar{width:4px;}
        #pb-messages::-webkit-scrollbar-thumb{background:#5c4033;border-radius:2px;}
        .msg{display:flex;gap:8px;animation:msgIn 0.25s ease;}
        @keyframes msgIn{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
        .msg.user{flex-direction:row-reverse;}
        .msg-bubble{padding:9px 13px;font-size:12px;line-height:1.55;font-family:'Crimson Text',serif;font-style:italic;max-width:78%;}
        .msg.bot .msg-bubble{background:#2a1d15;border:1px solid rgba(184,134,11,0.3);color:#e2d1b3;border-radius:0 8px 8px 8px;}
        .msg.user .msg-bubble{background:#B8860B;color:#1a120b;font-style:normal;font-weight:600;border-radius:8px 0 8px 8px;}
        .msg-ico{width:28px;height:28px;border-radius:50%;flex-shrink:0;margin-top:2px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;font-family:'Chakra Petch',sans-serif;}
        .msg.bot .msg-ico{background:#B8860B;color:#1a120b;border:1px solid #5c4033;}
        .msg.user .msg-ico{background:#3d2b1f;color:#e2d1b3;border:1px solid #5c4033;}
        .typing-dots{display:flex;gap:4px;align-items:center;padding:4px 0;}
        .typing-dots span{width:6px;height:6px;border-radius:50%;background:#B8860B;animation:td 1.2s infinite;}
        .typing-dots span:nth-child(2){animation-delay:0.2s;}
        .typing-dots span:nth-child(3){animation-delay:0.4s;}
        @keyframes td{0%,100%{opacity:0.3;transform:translateY(0);}50%{opacity:1;transform:translateY(-3px);}}
        #pb-footer{padding:10px 12px;border-top:1px solid rgba(184,134,11,0.25);display:flex;gap:8px;align-items:flex-end;background:#150e08;}
        #pb-input{flex:1;background:#1a120b;border:1px solid rgba(184,134,11,0.35);color:#e2d1b3;padding:9px 12px;font-size:12px;resize:none;font-family:'Chakra Petch',sans-serif;outline:none;max-height:90px;line-height:1.4;}
        #pb-input::placeholder{color:rgba(226,209,179,0.3);font-style:italic;}
        #pb-input:focus{border-color:#B8860B;}
        #pb-send{background:#B8860B;border:none;cursor:pointer;padding:9px 14px;color:#1a120b;font-weight:900;font-size:14px;flex-shrink:0;box-shadow:2px 2px 0 #5c4033;height:38px;}
        #pb-send:hover{background:#e2d1b3;}
        #pb-send:disabled{opacity:0.4;cursor:not-allowed;}
        #pb-disc{padding:6px 12px 8px;font-size:8px;color:rgba(226,209,179,0.3);text-align:center;text-transform:uppercase;letter-spacing:0.1em;background:#150e08;font-family:'Chakra Petch',sans-serif;}
    </style>
</head>
<body class="tech-font overflow-x-hidden">

<nav style="position:sticky;top:0;z-index:50;background-color:rgba(26,18,11,0.95);backdrop-filter:blur(8px);border-bottom:1px solid rgba(184,134,11,0.3);padding:16px 24px;">
    <div style="max-width:1280px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;">
        <div class="text-gold" style="font-size:1.25rem;font-weight:900;letter-spacing:0.3em;">&#9881; PAWDOC</div>
        <div style="gap:32px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;display:flex;">
            <a href="#about" style="color:#e2d1b3;text-decoration:none;" onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color='#e2d1b3'">About Us</a>
            <a href="#services" style="color:#e2d1b3;text-decoration:none;" onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color='#e2d1b3'">Services</a>
            <a href="#testi" style="color:#e2d1b3;text-decoration:none;" onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color='#e2d1b3'">Citizens Review</a>
            <a href="#faq" style="color:#e2d1b3;text-decoration:none;" onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color='#e2d1b3'">FAQ</a>
        </div>
        <div style="display:flex;gap:12px;align-items:center;">
            @auth
                <a href="{{ url('/dashboard') }}" style="font-size:10px;font-weight:900;border:2px solid #B8860B;padding:8px 20px;text-transform:uppercase;color:#B8860B;text-decoration:none;" onmouseover="this.style.background='#B8860B';this.style.color='#000'" onmouseout="this.style.background='transparent';this.style.color='#B8860B'">Enter Terminal</a>
            @else
                <a href="{{ route('login') }}" style="font-size:10px;font-weight:900;padding:8px 16px;text-transform:uppercase;color:rgba(226,209,179,0.6);text-decoration:none;">Login</a>
                <a href="{{ route('register') }}" style="font-size:10px;font-weight:900;background:#B8860B;color:#000;padding:8px 20px;text-transform:uppercase;text-decoration:none;box-shadow:3px 3px 0 #5c4033;">Join Us</a>
            @endauth
        </div>
    </div>
</nav>

<header style="position:relative;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:40px 24px;overflow:hidden;">
    <div class="gear-rotate" style="position:absolute;top:-5%;left:-5%;font-size:22rem;opacity:0.05;color:#B8860B;pointer-events:none;line-height:1;">&#9881;</div>
    <div class="gear-rotate-rev" style="position:absolute;bottom:-5%;right:-5%;font-size:16rem;opacity:0.05;color:#5c4033;pointer-events:none;line-height:1;">&#9881;</div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(184,134,11,0.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:relative;z-index:10;">
        <div style="display:inline-block;border:1px solid rgba(184,134,11,0.4);padding:6px 20px;margin-bottom:24px;">
            <span class="text-gold anim-pulse" style="font-size:10px;font-weight:900;letter-spacing:0.5em;text-transform:uppercase;">OFFICIAL VETERINARY STATION V3.4</span>
        </div>
        <h1 class="text-gold steam-text" style="font-size:clamp(5rem,14vw,10rem);font-weight:900;text-transform:uppercase;font-style:italic;letter-spacing:-0.02em;line-height:0.9;margin-bottom:8px;">PAWDOC</h1>
        <h2 style="font-size:clamp(1.2rem,4vw,2.8rem);font-weight:900;text-transform:uppercase;letter-spacing:0.4em;color:rgba(226,209,179,0.6);margin-bottom:40px;">STATION</h2>
        <p class="parchment-font" style="font-size:1.15rem;font-style:italic;color:rgba(226,209,179,0.75);max-width:500px;margin:0 auto 48px;line-height:1.8;">Solusi kesehatan hewan masa kini dengan sentuhan teknologi klasik. Dari warga, oleh warga, untuk hewan kesayangan kita semua.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:16px;">
            <a href="{{ route('register') }}" style="background:#B8860B;color:#000;padding:16px 36px;font-weight:900;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;text-decoration:none;box-shadow:4px 4px 0 #5c4033;">START YOUR JOURNEY &gt;</a>
            <div style="display:flex;align-items:center;gap:10px;padding:16px 24px;border:1px solid rgba(184,134,11,0.35);font-size:11px;letter-spacing:0.1em;color:rgba(226,209,179,0.65);">
                <span style="width:8px;height:8px;border-radius:50%;background:#B8860B;display:inline-block;"></span> 1.2k+ Beasts Recovered
            </div>
        </div>
    </div>
    <div style="position:absolute;bottom:32px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:6px;opacity:0.3;">
        <span style="font-size:9px;text-transform:uppercase;letter-spacing:0.3em;">Scroll</span>
        <div style="width:1px;height:32px;background:linear-gradient(to bottom,#B8860B,transparent);"></div>
    </div>
</header>

<section style="background:#B8860B;color:#000;padding:32px 24px;">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:16px;text-align:center;">
        <div><div style="font-size:2.5rem;font-weight:900;font-style:italic;">500+</div><div style="font-size:10px;text-transform:uppercase;font-weight:900;letter-spacing:0.15em;margin-top:4px;">Healthy Beasts</div></div>
        <div><div style="font-size:2.5rem;font-weight:900;font-style:italic;">20+</div><div style="font-size:10px;text-transform:uppercase;font-weight:900;letter-spacing:0.15em;margin-top:4px;">Royal Clinics</div></div>
        <div><div style="font-size:2.5rem;font-weight:900;font-style:italic;">24/7</div><div style="font-size:10px;text-transform:uppercase;font-weight:900;letter-spacing:0.15em;margin-top:4px;">Steam Support</div></div>
        <div><div style="font-size:2.5rem;font-weight:900;font-style:italic;">100%</div><div style="font-size:10px;text-transform:uppercase;font-weight:900;letter-spacing:0.15em;margin-top:4px;">Lokal Terpercaya</div></div>
    </div>
</section>

<section id="services" style="padding:80px 24px;max-width:1280px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:56px;">
        <h2 class="text-gold steam-text" style="font-size:2.5rem;font-weight:900;text-transform:uppercase;font-style:italic;letter-spacing:0.15em;margin-bottom:16px;">Core Protocols</h2>
        <div style="width:64px;height:3px;background:#B8860B;margin:0 auto;"></div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:32px;">
        <div style="background:#2a1d15;border:2px solid rgba(184,134,11,0.3);padding:32px;box-shadow:6px 6px 0 rgba(0,0,0,0.5);transition:border-color 0.2s;" onmouseover="this.style.borderColor='rgba(184,134,11,0.8)'" onmouseout="this.style.borderColor='rgba(184,134,11,0.3)'">
            <div style="width:48px;height:48px;border:2px solid #B8860B;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#B8860B"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
            </div>
            <h3 class="text-gold" style="font-size:13px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;">Digital Diagnosis</h3>
            <p class="parchment-font" style="font-style:italic;opacity:0.75;line-height:1.7;">Gak usah panik kalo anabul lagi lemes. Cukup ketik gejalanya, biar dokter kita yang analisa via Medical Scroll.</p>
        </div>
        <div style="background:#2a1d15;border:2px solid rgba(184,134,11,0.3);padding:32px;box-shadow:6px 6px 0 rgba(0,0,0,0.5);transition:border-color 0.2s;" onmouseover="this.style.borderColor='rgba(184,134,11,0.8)'" onmouseout="this.style.borderColor='rgba(184,134,11,0.3)'">
            <div style="width:48px;height:48px;border:2px solid #B8860B;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#B8860B"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
            </div>
            <h3 class="text-gold" style="font-size:13px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;">Medicine Dispatch</h3>
            <p class="parchment-font" style="font-style:italic;opacity:0.75;line-height:1.7;">Terima resep obat resmi yang udah di-verify sama Royal Physician. Tinggal tebus dan beres!</p>
        </div>
        <div style="background:#2a1d15;border:2px solid rgba(184,134,11,0.3);padding:32px;box-shadow:6px 6px 0 rgba(0,0,0,0.5);transition:border-color 0.2s;" onmouseover="this.style.borderColor='rgba(184,134,11,0.8)'" onmouseout="this.style.borderColor='rgba(184,134,11,0.3)'">
            <div style="width:48px;height:48px;border:2px solid #B8860B;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#B8860B"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <h3 class="text-gold" style="font-size:13px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;">Clinic Locator</h3>
            <p class="parchment-font" style="font-style:italic;opacity:0.75;line-height:1.7;">Cari klinik dokter hewan terdekat di sekitar lo. Langsung terhubung ke Maps kerajaan!</p>
        </div>
    </div>
</section>

<section id="testi" style="padding:80px 24px;background:rgba(42,29,21,0.6);border-top:1px solid rgba(184,134,11,0.2);border-bottom:1px solid rgba(184,134,11,0.2);">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:48px;align-items:center;">
        <div id="about">
            <div style="font-size:3rem;color:#B8860B;opacity:0.3;font-family:Georgia,serif;line-height:1;">"</div>
            <h2 class="text-gold" style="font-size:1.8rem;font-weight:900;text-transform:uppercase;font-style:italic;line-height:1.2;margin-bottom:24px;">The Architect Behind<br>The Machine.</h2>
            <div style="background:#1a120b;padding:24px;border-right:4px solid #B8860B;box-shadow:6px 6px 0 rgba(0,0,0,0.5);">
                <p class="parchment-font" style="font-style:italic;font-size:1.05rem;margin-bottom:16px;color:rgba(226,209,179,0.85);line-height:1.7;">"PawDoc bukan sekadar kode, tapi ambisi untuk mendigitalisasi kesehatan hewan di seluruh Nusantara dengan sentuhan estetika Industrial."</p>
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;background:#B8860B;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#000;font-weight:900;font-size:14px;flex-shrink:0;">FN</div>
                    <div>
                        <p class="text-gold" style="font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;">Febriana Nugraha</p>
                        <p style="font-size:9px;color:rgba(226,209,179,0.5);text-transform:uppercase;letter-spacing:0.2em;">Lead Developer &amp; Founder</p>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:24px;">
            <h3 class="text-gold" style="font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.3em;display:flex;align-items:center;gap:12px;"><span style="width:32px;height:2px;background:rgba(184,134,11,0.5);display:inline-block;"></span> Citizen Feedback</h3>
            <div style="background:#e2d1b3;padding:24px;box-shadow:6px 6px 0 #B8860B;transition:transform 0.3s;" onmouseover="this.style.transform='rotate(-1deg)'" onmouseout="this.style.transform='rotate(0)'">
                <p class="parchment-font" style="font-style:italic;color:#2d1a0e;margin-bottom:16px;line-height:1.7;">"Gacor parah! Pelayanan dokternya cepet, respon resepnya detail banget. Fitur Clinic Locator-nya ngebantu banget pas lagi urgent malem-malem. Mantap PawDoc!"</p>
                <div style="display:flex;justify-content:space-between;align-items:center;border-top:1px solid rgba(92,64,51,0.3);padding-top:12px;">
                    <span style="font-size:11px;font-weight:900;color:#3d2b1f;text-transform:uppercase;">Hasna Nabila</span>
                    <span style="font-size:9px;font-weight:700;background:#3d2b1f;color:#e2d1b3;padding:4px 12px;text-transform:uppercase;">Feline Owner</span>
                </div>
            </div>
            <p style="font-size:10px;text-align:center;font-style:italic;opacity:0.4;text-transform:uppercase;letter-spacing:0.15em;">-- Join 1,000+ Citizens in the Royal Archive --</p>
        </div>
    </div>
</section>

<section id="faq" style="padding:80px 24px;max-width:960px;margin:0 auto;">
    <h2 class="text-gold steam-text" style="text-align:center;font-size:2rem;font-weight:900;text-transform:uppercase;font-style:italic;margin-bottom:48px;letter-spacing:0.2em;">Frequently Asked Protocols</h2>
    <div style="display:flex;flex-direction:column;gap:12px;">
        <details style="background:#2a1d15;padding:20px 24px;border:1px solid rgba(184,134,11,0.3);">
            <summary style="list-style:none;cursor:pointer;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:0.1em;display:flex;justify-content:space-between;align-items:center;color:#B8860B;">Apakah PawDoc berbayar? <span>&#9660;</span></summary>
            <p class="parchment-font" style="margin-top:12px;font-style:italic;opacity:0.75;font-size:0.95rem;line-height:1.7;">Untuk saat ini, akses ke terminal PawDoc gratis untuk seluruh warga di Indonesia.</p>
        </details>
        <details style="background:#2a1d15;padding:20px 24px;border:1px solid rgba(184,134,11,0.3);">
            <summary style="list-style:none;cursor:pointer;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:0.1em;display:flex;justify-content:space-between;align-items:center;color:#B8860B;">Gimana cara mencatat hewan baru? <span>&#9660;</span></summary>
            <p class="parchment-font" style="margin-top:12px;font-style:italic;opacity:0.75;font-size:0.95rem;line-height:1.7;">Masuk ke dashboard, temukan panel "Daftarkan Hewan Baru", isi nama, jenis, dan unggah foto.</p>
        </details>
        <details style="background:#2a1d15;padding:20px 24px;border:1px solid rgba(184,134,11,0.3);">
            <summary style="list-style:none;cursor:pointer;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:0.1em;display:flex;justify-content:space-between;align-items:center;color:#B8860B;">Apakah data hewan saya aman? <span>&#9660;</span></summary>
            <p class="parchment-font" style="margin-top:12px;font-style:italic;opacity:0.75;font-size:0.95rem;line-height:1.7;">Tentu! Setiap data diproteksi oleh Royal Encryption System. Hanya Anda dan Physician yang dapat melihat laporan medis.</p>
        </details>
        <details style="background:#2a1d15;padding:20px 24px;border:1px solid rgba(184,134,11,0.3);">
            <summary style="list-style:none;cursor:pointer;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:0.1em;display:flex;justify-content:space-between;align-items:center;color:#B8860B;">Berapa lama dokter membalas laporan? <span>&#9660;</span></summary>
            <p class="parchment-font" style="margin-top:12px;font-style:italic;opacity:0.75;font-size:0.95rem;line-height:1.7;">Umumnya diagnosa resmi muncul dalam waktu kurang dari 24 jam setelah laporan dikirim.</p>
        </details>
        <details style="background:#2a1d15;padding:20px 24px;border:1px solid rgba(184,134,11,0.3);">
            <summary style="list-style:none;cursor:pointer;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:0.1em;display:flex;justify-content:space-between;align-items:center;color:#B8860B;">Siapa yang mengembangkan sistem ini? <span>&#9660;</span></summary>
            <p class="parchment-font" style="margin-top:12px;font-style:italic;opacity:0.75;font-size:0.95rem;line-height:1.7;">Sistem PawDoc dikembangkan oleh <span class="text-gold" style="font-weight:700;">Febriana Nugraha</span>, siswa RPL dari <span class="text-gold">SMKIT Assyifa Boarding School Subang</span>.</p>
        </details>
    </div>
</section>

<footer style="background:#000;padding:48px 24px;text-align:center;border-top:1px solid rgba(184,134,11,0.3);">
    <div class="text-gold" style="font-size:1.75rem;font-weight:900;letter-spacing:0.3em;margin-bottom:12px;font-style:italic;">PAWDOC</div>
    <p class="parchment-font" style="font-style:italic;opacity:0.4;font-size:0.9rem;margin-bottom:24px;">Established in 2025. Purveyor of medical excellence for biological beasts alike.</p>
    <div style="display:flex;justify-content:center;gap:32px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;opacity:0.4;margin-bottom:24px;">
        <a href="#" style="color:#e2d1b3;text-decoration:none;">Instagram</a>
        <a href="#" style="color:#e2d1b3;text-decoration:none;">Steam Community</a>
        <a href="#" style="color:#e2d1b3;text-decoration:none;">Contact Physician</a>
    </div>
    <div style="font-size:9px;font-family:monospace;letter-spacing:0.5em;text-transform:uppercase;opacity:0.3;">Propelled by SMKIT Assyifa Boarding School 2025</div>
</footer>

<button id="pawbot-fab" onclick="toggleChat()" title="Chat dengan ARIA">
    <svg viewBox="0 0 24 24"><path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"/></svg>
</button>

<div id="pawbot-window">
    <div id="pawbot-header">
        <div class="pb-info">
            <div class="pb-avatar">AR</div>
            <div><div class="pb-title">ARIA</div><div class="pb-sub">by PawDoc</div></div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            <div class="pb-online"><span class="dot-on"></span> Online</div>
            <button id="pb-close" onclick="toggleChat()">&#10005;</button>
        </div>
    </div>
    <div id="pb-chips">
        <div class="chip" onclick="sendChip(this)">Hewan saya lemas</div>
        <div class="chip" onclick="sendChip(this)">Jadwal vaksin</div>
        <div class="chip" onclick="sendChip(this)">Cara daftar hewan</div>
        <div class="chip" onclick="sendChip(this)">Cari klinik terdekat</div>
    </div>
    <div id="pb-messages">
        <div class="msg bot">
            <div class="msg-ico">AR</div>
            <div class="msg-bubble">Halo! Saya <strong>ARIA</strong> asisten virtual PawDoc. Siap bantu konsultasi kesehatan hewan peliharaan kamu!</div>
        </div>
    </div>
    <div id="pb-footer">
        <textarea id="pb-input" rows="1" placeholder="Tanyakan seputar hewan peliharaanmu..." onkeydown="handleKey(event)" oninput="autoResize(this)"></textarea>
        <button id="pb-send" onclick="sendMessage()">&#9658;</button>
    </div>
    <div id="pb-disc">ARIA hanya saran umum - bukan pengganti dokter hewan</div>
</div>

<script>
let ariaOpen=false,ariaLoading=false,ariaMessages=[];
const csrfToken=document.querySelector('meta[name=csrf-token]').content;
function toggleChat(){ariaOpen=!ariaOpen;document.getElementById('pawbot-window').classList.toggle('open',ariaOpen);if(ariaOpen)document.getElementById('pb-input').focus();}
function handleKey(e){if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMessage();}}
function autoResize(el){el.style.height='auto';el.style.height=Math.min(el.scrollHeight,90)+'px';}
function sendChip(el){document.getElementById('pb-input').value=el.textContent;sendMessage();}
function appendMsg(role,text){
    const box=document.getElementById('pb-messages');
    const div=document.createElement('div');
    div.className='msg '+role;
    div.innerHTML='<div class="msg-ico">'+(role==='bot'?'AR':'KM')+'</div><div class="msg-bubble">'+text.replace(/\n/g,'<br>')+'</div>';
    box.appendChild(div);box.scrollTop=box.scrollHeight;
}
function showTyping(){
    const box=document.getElementById('pb-messages');
    const div=document.createElement('div');div.className='msg bot';div.id='pb-typing';
    div.innerHTML='<div class="msg-ico">AR</div><div class="msg-bubble"><div class="typing-dots"><span></span><span></span><span></span></div></div>';
    box.appendChild(div);box.scrollTop=box.scrollHeight;
}
function removeTyping(){const el=document.getElementById('pb-typing');if(el)el.remove();}
async function sendMessage(){
    const input=document.getElementById('pb-input');
    const text=input.value.trim();
    if(!text||ariaLoading)return;
    input.value='';input.style.height='auto';
    appendMsg('user',text);
    ariaMessages.push({role:'user',content:text});
    ariaLoading=true;document.getElementById('pb-send').disabled=true;
    showTyping();document.getElementById('pb-chips').style.display='none';
    try{
        const res=await fetch('/aria/chat',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},body:JSON.stringify({messages:ariaMessages})});
        const data=await res.json();
        removeTyping();
        const reply=data.content?.[0]?.text||'Maaf, tidak bisa menjawab sekarang.';
        ariaMessages.push({role:'assistant',content:reply});
        appendMsg('bot',reply);
    }catch(e){removeTyping();appendMsg('bot','Koneksi ke Royal Archive terputus. Coba lagi ya!');}
    ariaLoading=false;document.getElementById('pb-send').disabled=false;document.getElementById('pb-input').focus();
}
</script>
</body>
</html>
