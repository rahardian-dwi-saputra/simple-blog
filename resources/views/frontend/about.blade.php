@extends('frontend/template/main')
@section('title','About')
@section('container')

<div class="card mt-4 mb-4">
	<div class="card-body">
    	<h3 class="card-title">SIMPLE BLOG WEB APPLICATION</h3>
    	<h6 class="card-subtitle mb-2 text-muted">By Rahardian Dwi Saputra</h6>
    	<p class="card-text" style="text-align: justify;">Blog adalah website atau platform online yang memuat beragam informasi, seperti artikel yang selalu diperbarui secara rutin. Blog dapat mencakup berbagai topik, termasuk kisah pribadi, pendapat atau opini, pengalaman, hobi, atau topik lainnya. Siapa pun yang memiliki koneksi internet dapat menulis dan memulai blog, terlepas dari latar belakang atau pengalamannya. Update informasi yang terus-menerus dan kemudahan memilih topik yang sesuai dengan minat dan hobi menjadi dua dari sekian alasan mengapa orang-orang mulai melakukan blogging. Blog dapat membantu bisnis dan individu membangun brand dan mempromosikan produk atau layanan.</p>
    	<img src="{{ asset('assets/dist/img/avatar6.jpg') }}" class="img-fluid" alt="foto-creater" width="200" height="280">
  	</div>
</div>
@endsection