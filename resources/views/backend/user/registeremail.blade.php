Halo {{ $email_data['name'] }}
<br><br>
Selamat datang di Simple Blog!
<br>
Anda telah didaftarkan sebagai Akun resmi di Simple Blog
<br><br>
<b>Username : {{ $email_data['username'] }}</b><br>
<b>Password : {{ $email_data['password'] }}</b><br>
<br>
Silahkan gunakan akun tersebut untuk untuk login 
<a href="{{ route('login') }}">Disini</a>
<br><br>
Terima kasih!
<br>
Simple Blog Application