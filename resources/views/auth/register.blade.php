<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Daftar - PawDoc</title>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
.tech-font{font-family:'Chakra Petch',sans-serif;}
body{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
.si{background-color:#1a120b;border:2px solid rgba(184,134,11,0.3);color:#e2d1b3;outline:none;width:100%;padding:12px 16px;font-size:0.875rem;font-family:'Chakra Petch',sans-serif;}
.si:focus{border-color:#B8860B;}
.si::placeholder{color:rgba(226,209,179,0.3);}
</style>
</head>
<body class="tech-font min-h-screen flex items-center justify-center" style="background-color:#1a120b;">

<div style="width:100%;max-width:440px;padding:16px;">

<div class="text-center mb-8">
<a href="/" style="color:#B8860B;font-weight:900;font-size:1.5rem;text-transform:uppercase;letter-spacing:0.3em;font-style:italic;text-decoration:none;">
PAWDOC
</a>
<p style="color:rgba(226,209,179,0.3);font-size:9px;text-transform:uppercase;letter-spacing:0.5em;margin-top:4px;">Klinik Hewan Digital Indonesia</p>
</div>

<div style="background-color:#2a1d15;border:2px solid rgba(184,134,11,0.4);box-shadow:8px 8px 0px rgba(0,0,0,0.6);padding:32px;">

<h2 style="color:#B8860B;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.3em;margin-bottom:24px;font-style:italic;">Buat Akun Baru</h2>

<form method="POST" action="{{ route('register') }}" class="space-y-4">
@csrf

<div>
<label style="display:block;color:#B8860B;font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Nama Lengkap</label>
<input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
class="si" placeholder="Nama lengkap Anda">
@error('name')<p style="color:#f87171;font-size:9px;margin-top:4px;">{{ $message }}</p>@enderror
</div>

<div>
<label style="display:block;color:#B8860B;font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Email</label>
<input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
class="si" placeholder="nama@email.com">
@error('email')<p style="color:#f87171;font-size:9px;margin-top:4px;">{{ $message }}</p>@enderror
</div>

<div>
<label style="display:block;color:#B8860B;font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Kata Sandi</label>
<input type="password" name="password" required autocomplete="new-password"
class="si" placeholder="Minimal 8 karakter">
@error('password')<p style="color:#f87171;font-size:9px;margin-top:4px;">{{ $message }}</p>@enderror
</div>

<div>
<label style="display:block;color:#B8860B;font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Konfirmasi Kata Sandi</label>
<input type="password" name="password_confirmation" required autocomplete="new-password"
class="si" placeholder="Ulangi kata sandi">
</div>

<button type="submit"
style="width:100%;background-color:#B8860B;color:#000;padding:12px;font-weight:900;font-size:10px;letter-spacing:0.2em;text-transform:uppercase;border:none;cursor:pointer;box-shadow:4px 4px 0px #5c4033;margin-top:8px;">
Daftar Sekarang
</button>
</form>

<div style="margin-top:20px;text-align:center;border-top:1px solid rgba(184,134,11,0.2);padding-top:20px;">
<span style="color:rgba(226,209,179,0.4);font-size:9px;text-transform:uppercase;">Sudah punya akun?</span>
<a href="{{ route('login') }}" style="color:#B8860B;font-size:9px;font-weight:900;text-transform:uppercase;text-decoration:underline;margin-left:8px;">Masuk di sini</a>
</div>
</div>
</div>
</body>
</html>
