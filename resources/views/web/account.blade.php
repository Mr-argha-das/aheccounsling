  @include('layouts.frontend')
<?php
  $value = session()->get('userLg');
  if(empty($value)){
     $req->session()->flash('errorFlash','Please Login');
      return redirect('/sign-in');
   }
 $id = base64_decode(urldecode($value));
 $findUser =  DB::table('bloger_user')->where('bloger_id',$id)->first(); 
 $content  = DB::table('entry_menu')->where('menu_alias',$fileName)->first();

 $blogList  = DB::table('entry_blog')->where('blog_user_id',$id)->get(); 

 ?>
 <style type="text/css">
   .btn{
    padding:0!important; 
   }
 </style>
<section class="position-relative">
  <div id="particles-js"></div>
    <div class="container">
       <div class="row  text-center">
         <div class="col">
             <h1><?php echo $content->menu_name?></h1>

        <nav aria-label="breadcrumb">
           <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a class="text-dark" href="{{route('home')}}">Home</a></li>
               <li class="breadcrumb-item active text-primary" aria-current="page">Account</li>
          </ol>
       </nav>


         @if (Session::has('successFlash'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
               <h4 class="alert-heading">{!! Session::get('successFlash') !!}</h4>
              
               
            </div>
        @endif 

         @if (Session::has('errorFlash'))
            <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
               <h4 class="alert-heading">{!! Session::get('errorFlash') !!}</h4>
               
               
            </div>
        @endif  

      </div>
     </div>
  </div>
</section>


<section>
  <div class="container">






  
   <br>


  <div class="tab-content border border-success border-5 rounded">
    <div id="home" class="container tab-pane active">
    <br>

<div class="row">
  <div class="col-md-3">

     <ul class="nav nav-tabs" role="tablist">
     <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Blog List</a>
      <a class="nav-link active"  href="/add-user-blog">Add User Blog</a>
     </li>
    <li class="nav-item">
      <a class="nav-link"  href="query/logout">Logout</a>
    </li>
 </ul>
  </div>
</div>



    
      <h3 class="text-center">My Blog List</h3>
       <br>
         <div class="table-responsive ">
         <table class="table table-bordered">
          <tr>
            <th>Sr</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
            <tbody>
              @foreach($blogList as $key => $blog)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$blog->blog_name}}</td>
                <td>
                 @if($blog->blog_status==1)
                 <button type="button" class="btn-sm btn btn-success">Active</button>
                 @else
                 <button type="button" class="btn-sm btn btn-warning">Inactive</button>
                 @endif
               </td>
                <td>
                     @if($blog->blog_status!=1)
                      <button type="button" class="btn-sm btn btn-link"><a href="{{route('editUserBlog',$blog->blog_id)}}">Edit</a> </button>
                      <button type="button" class="btn-sm btn btn-link"><a href="{{route('deleteUserBlog',$blog->blog_id)}}">Delete</a> </button>
                      @else
                      <button type="button" class="btn-sm btn btn-link"><a target="_blank" href="<?=route('blogpage', str_replace(" ","_",strtolower($blog->blog_name)))?>">View</a> </button>
                     @endif
                </td>
              </tr>
              @endforeach;
            </tbody>
         </table>
        </div>
     </div>
   </div>
  </div>
</section>
@include('layouts.frontfooter')

 