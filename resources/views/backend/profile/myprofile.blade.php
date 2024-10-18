@extends('backend/template/main')
@section('title','My Profile')
@section('container')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">

<style type="text/css">
   .btn-dark {
      background-color: #7c4dff !important;
      border-color: #7c4dff !important;
   }
   .btn-dark .file-upload {
      width: 100%;
      padding: 10px 0px;
      position: absolute;
      left: 0;
      opacity: 0;
      cursor: pointer;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">My Profile</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
      <div class="container-fluid">

         <div class="row">
            <div class="col-md-3">

               <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                     <div class="text-center mb-3">

                        @if( auth()->user()->foto)
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.auth()->user()->foto) }}" id="profile-pic" alt="User profile picture">
                        @else
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/dist/img/default-profil.png') }}" id="profile-pic"alt="User profile picture">
                        @endif

                     </div>

                     <div class="btn btn-dark btn-block">
                        <input type="file" class="file-upload" id="file-upload" name="profile_picture" accept="image/*">
                        Unggah Foto
                     </div>

                     <a href="/ubahsandi" class="btn btn-success btn-block">
                        <b><i class="fa fa-key"></i> Ubah Sandi</b>
                     </a>

                  </div>
               </div>

            </div>
            <div class="col-md-9">

               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Tentang Saya</h3>
                  </div>
              
                  <div class="card-body">

                     @if(session()->has('success'))
                     <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     @endif

                     <strong><i class="fas fa-id-card mr-1"></i> Nama</strong>
                     <p class="text-muted">
                        {{ auth()->user()->name }}
                     </p>
                     <hr>

                     <strong><i class="fas fa-user mr-1"></i> Username</strong>
                     <p class="text-muted">
                        {{ auth()->user()->username }}
                     </p>
                     <hr>

                     <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                     <p class="text-muted">
                        {{ auth()->user()->email }}
                     </p>
                     
                     @if(auth()->user()->created_at)
                     <hr>
                     <strong><i class="far fa-calendar mr-1"></i> Waktu bergabung</strong>
                     <p class="text-muted">{{ date('d-m-Y H:i', strtotime(auth()->user()->created_at)) }}</p>
                     @endif
                     <br>

                     <a href="/myprofil/edit" class="btn btn-info">
                        <b><i class="fa fa-edit"></i> Edit Data Profil</b>
                     </a>

                  </div>
               </div>

            </div>

         </div>
      </div>
   </section>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Crop Image And Upload</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <div id="resizer"></div>
            <button class="btn rotate float-lef" data-deg="90"> 
               <i class="fas fa-undo"></i>
            </button>
            <button class="btn rotate float-right" data-deg="-90"> 
               <i class="fas fa-redo"></i>
            </button>
            <hr>
            <button class="btn btn-block btn-dark" id="upload"> 
               Crop And Upload
            </button>
         </div>
      </div>
   </div>
</div>

<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/croppie/croppie.min.js') }}"></script>

<script type="text/javascript">
   $(function(){ 

      var croppie = null;
      var el = document.getElementById('resizer');

      $.base64ImageToBlob = function(str){
         // extract content type and base64 payload from original string
         var pos = str.indexOf(';base64,');
         var type = str.substring(5, pos);
         var b64 = str.substr(pos + 8);
      
         // decode base64
         var imageContent = atob(b64);
      
         // create an ArrayBuffer and a view (as unsigned 8-bit)
         var buffer = new ArrayBuffer(imageContent.length);
         var view = new Uint8Array(buffer);
      
         // fill the view, using the decoded base64
         for (var n = 0; n < imageContent.length; n++) {
            view[n] = imageContent.charCodeAt(n);
         }
      
         // convert ArrayBuffer to Blob
         var blob = new Blob([buffer], { type: type });
      
         return blob;
      }
    
      $.getImage = function(input, croppie){
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
               croppie.bind({
                  url: e.target.result,
               });
            }
            reader.readAsDataURL(input.files[0]);
         }
      }

      $("#file-upload").on("change", function(event){
         $("#myModal").modal();

         croppie = new Croppie(el, {
               viewport: {
                  width: 200,
                  height: 200,
                  type: 'circle'
               },
               boundary: {
                  width: 250,
                  height: 250
               },
               enableOrientation: true
            });
         $.getImage(event.target, croppie); 
      });

      $("#upload").on("click", function() {
         croppie.result('base64').then(function(base64) {
            $("#myModal").modal("hide"); 
            $("#profile-pic").attr("src","/assets/dist/img/ajax-loader.gif");

            var formData = new FormData();
            formData.append("profile_picture", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               type: 'POST',
               url: "/change-foto",
               data: formData,
               processData: false,
               contentType: false,
               success: function(response){
                  if (response.success == true) {
                     $("#profile-pic").attr("src", base64);
                     $("#user-foto").attr("src", base64); 
                  }else{
                     $("#profile-pic").attr("src","{{ asset('assets/dist/img/default-profil.png') }}");
                     $("#user-foto").attr("src", "{{ asset('assets/dist/img/default-profil.png') }}");  
                     console.log(data['profile_picture']);
                  }
               },
               error: function(error) {
                  console.log(error);
                  $("#profile-pic").attr("src","{{ asset('assets/dist/img/default-profil.png') }}");
                  $("#user-foto").attr("src", "{{ asset('assets/dist/img/default-profil.png') }}"); 
               }
            });
         });
      });

      // To Rotate Image Left or Right
      $(".rotate").on("click", function() {
         croppie.rotate(parseInt($(this).data('deg'))); 
      });

      $('#myModal').on('hidden.bs.modal', function (e) {
         // This function will call immediately after model close
         // To ensure that old croppie instance is destroyed on every model close
         setTimeout(function() { croppie.destroy(); }, 100);
      })

   });
</script>

@endsection