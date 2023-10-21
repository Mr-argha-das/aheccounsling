@include('layouts.frontend')
<?php
$content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first(); 
   
?>
 <style type="text/css">
   .error{
    color:red;
   }
   
   .blog-1{
    border-radius: 15px;
   }
   .cke_chrome{
    border-radius: 15px;
   }
   .userblog-1{
margin-top:50px;

   }
   .userblog-2{
border-radius:10px
   }
   .userblog-3{
    width: 50% !important;
   }
.userblog{
    height: 100px;
    width: 100px;
}
   @media only screen and (min-width: 300px) and (max-width: 800px){
     .userblog-3{
    width: 75% !important;
   }
   }
 </style>
 <section class="position-relative">
   <div id="particles-js"></div>
   <div class="container">
      <div class="row  text-center">
       <div class="col">
         <h1><?=$content->menu_name?></h1>
         <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
            <li class="breadcrumb-item"><a class="text-dark" href="{{route('home')}}">Home</a>
             </li>
              <li class="breadcrumb-item active text-primary" aria-current="page"><?=$content->menu_name?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
<section>

  <div class="container">

 <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="row justify-content-center text-center" style="margin-top:-110px">
          <div class="shadow-lg blog-1 p-4">
             <form  class="row" action="query/addUserBlog" id="blog_user_save" method="post" enctype="multipart/form-data">

                 <div class="form-group col-md-12">
                  {{ csrf_field() }}
                     @if (Session::has('successFlash'))
                     <strong class="text-success alert alert-success">{!! Session::get('successFlash') !!}</strong>
                    @endif
                    @if (Session::has('errorFlash'))
                       <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>
                    @endif
                </div>
                 
                 
  <div class="form-group col-md-6  ">
                   <!-- <label class="text-right">BLog Title</label> -->
                  <input id="blog_title" type="text" name="blog_title" class="shadow form-control w-100 userblog-2" placeholder="Blog Title">
                 </div>
                

                 <div class="form-group col-md-6 ">
                    <!-- <label class="text-right">Blog Seo Title</label> -->
                  <input id="blog_seo_title" type="text" name="blog_seo_title" class="form-control w-100 shadow userblog-2"  placeholder="Blog Seo Title">
                 </div>
               
               

                 <div class="form-group col-md-12 ">
                   <!-- <label class="text-right">Blog Seo Description</label> -->
                  <input id="blog_seo_description" type="text" name="blog_seo_description" class="form-control shadow userblog-2" placeholder="Blog Seo Description">
                 </div>
                
                <div class="form-group col-md-12">
                   <textarea id="blog_description" class=" shadow"  name="blog_description"  placeholder="Blog Description"></textarea>
                   
               </div>
                
                <!-- <textarea id="content" name="content" class="d-none"></textarea> -->
              <div class="col-md-6 text-left">
                
                 <div class="input-file-container userblog-3">
                    <input  type="file" class="input-file " id="image" accept="image/*" name="image" onchange="previewFile(this);">
                  <img id="previewImg" class="mb-3 shadow rounded userblog  img-fluid" src="webassets/images/blankimage.png">
                    <label   for="image" id="multi_file_attachment" class="input-file-trigger userblog-2">Blog Image</label>
                  
                   
                </div>
              </div>

              <div class="col-md-6 text-right  userblog-1">
                 <button class="btn btn-primary submit px-4 py-2" type="submit"><span>Submit</span></button>
              </div>
          </form>
       </div>
   </div>
</div>
<div class="col-md-2">
    </div>
</div>

  </div>
 </section>
  
  @section('javascript')
     <script src="https://www.ahecounselling.com/admin/assets/ckeditor/ckeditor.js"></script>
     <script type="text/javascript">
     
      $(document).ready(function(){
           $(".submit").click(function(){
              var desc = CKEDITOR.instances['blog_description'].getData();
               if (!$("#blog_user_save").valid()) {
                 return false;
             }else{
              $( "#blog_user_save" )[0].submit();
             }
           });
           CKEDITOR.replace( 'blog_description' );
          $('#blog_user_save').validate({

                   onfocusout: function(element) {$(element).valid()}
                         , rules: {

                     "blog_title": {
                         required: true,
                      },
                      "blog_seo_title": {
                         required: true,
                      },"blog_seo_description": {
                         required: true,
                      }, 
                  },
                  
                 });

         });
   
   </script>

   <script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
  @endsection
@include('layouts.frontfooter')