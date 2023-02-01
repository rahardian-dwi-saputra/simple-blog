Hello {{ $email_data['name'] }}
<br><br>
Welcome to my Website!
<br>
Please click the below link to verify your email and activate your account!
<br><br>
<a href="{{ route('verification.verify', ['id' => $email_data['id'],'token' => $email_data['token']]) }}">Click Here!</a>
<br><br>
Thank you!
<br>
Simple Blog Application