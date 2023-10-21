@include('layouts.frontend')


 <style type="text/css">
   .error{
    color:red;
   }
 </style>
 <section class="position-relative">
   <div id="particles-js"></div>
   <div class="container">
      <div class="row  text-center">
       <div class="col">
         <h1>Blog</h1>
         <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
            <li class="breadcrumb-item"><a class="text-dark" href="{{route('home')}}">Home</a>
             </li>
              <li class="breadcrumb-item active text-primary" aria-current="page">Edit Blog</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
<section>

  <div class="container">
      <div class="row justify-content-center text-center">
          <div class="col-12 col-lg-10">
             <form  class="row" action="query/updateUserBlog" id="blog_user_save" method="post" enctype="multipart/form-data">
                 <div class="form-group col-md-12">
                  {{ csrf_field() }}
                     @if (Session::has('successFlash'))
                     <strong class="text-success alert alert-success">{!! Session::get('successFlash') !!}</strong>
                    @endif
                    @if (Session::has('errorFlash'))
                       <strong class="text-danger alert alert-danger">{!! Session::get('errorFlash') !!}</strong>
                    @endif
                </div>
   
                 <div class="form-group col-md-12">
                   <!-- <label class="text-right">BLog Title</label> -->
                  <input id="blog_title" type="text" value="{{$editBlog->blog_name}}" name="blog_title" class="form-control" placeholder="Blog Title">
                 </div>
                

                 <div class="form-group col-md-12">
                    <!-- <label class="text-right">Blog Seo Title</label> -->
                <input id="blog_seo_title" type="text" value="{{$editBlog->seo_tilte}}" name="blog_seo_title" class="form-control" placeholder="Blog Seo Title">
                 </div> -->

                  <div class="form-group col-md-12">
                   <!-- <label class="text-right">Blog Seo Description</label> -->
                  <input id="blog_seo_description" type="text" value="{{$editBlog->seo_description}}" name="blog_seo_description" class="form-control" placeholder="Blog Seo Description">
                 </div>
                 
                <div class="form-group col-md-12">
                    <textarea id="blog_description" name="blog_description" placeholder="Blog Description">{{$editBlog->blog_desc}}</textarea>
                   
               </div> 

               <input type="hidden" name="blog_id" value="{{$editBlog->blog_id}}">
                
                
              <div class="col-md-12 text-left mt-4">
                 <div class="input-file-container" style="width:100% !important;">
                  <?php if(!empty($editBlog->blog_image)){ ?>
                            <img src="{{ asset('assets/uploads/blogs/'.$editBlog->blog_image) }} " width="150" width="150">
                            <?php } ?>
                  <input  type="file" class="input-file" id="image" accept="image/*" name="image">
                   <label   for="image" id="multi_file_attachment" class="input-file-trigger">Blog Image</label>
                </div>
              </div>

              <div class="col-md-12 text-right mt-4">
                 <button class="btn btn-primary submit" type="submit"><span>Submit</span></button>
              </div>
          </form>
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
  @endsection
@include('layouts.frontfooter')