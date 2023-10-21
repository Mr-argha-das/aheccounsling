@include('layouts.frontend')
<?php 
use \App\Model\Entry\Project_model as projecjModal;


    if(!isset($categrory_data)){

    $sampleproject = projecjModal::latest()->with('category_list')->get();

    }else{

     $sampleproject = projecjModal::where('project_categroy_id','=',$categrory_data->id)->latest()->with('category_list')->get();

    }

?>
<!--header end-->
<!--hero section start-->
<!--header end-->


<!--hero section start-->

<section class="position-relative">
  <div id="particles-js"></div>
  <div class="container">
    <div class="row  text-center">
      <div class="col">

        <h1>Sample-Projects</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
            <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a>
            </li>
              @if(isset($categrory_data)) 
              <li class="breadcrumb-item active text-primary" aria-current="page">{{ $categrory_data->name }}</li>
             @else
              <li class="breadcrumb-item active text-primary" aria-current="page">All-Sample-Projects</li>
             @endif
          </ol>
        </nav>
      </div>
    </div>
    <!-- / .row -->
  </div>
  <!-- / .container -->
</section>

<!--hero section end--> 


<!--body content start-->

<div class="page-content">

<!--blog start-->

<section>
  <div class="container">
    <div class="row">
     
 <?php $srk = 1; ?>
    @foreach($sampleproject as $project)

<?php  
 $firstStringCharacter = substr($project->created_at,5,2);
 ?>
 <div class="col-12 col-lg-4 mb-6 mb-lg-0">
        <!-- Blog Card -->
         
        <div class="card border-0 bg-transparent">
          <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ml-3 mt-3">


               <a href="/sample-project/{{ $project->category_list->cat_slug }}">
                {{ $project->category_list->name }}</div>
               </a>
             <a href="/document/{{ $project->slug }}">
              <img class="card-img-top shadow rounded" src="{{ asset('assets/uploads/projectthumb/'.$project->thub_img) }}" alt="Image">
             </a>
             <div class="card-body pt-5"> 
           
              
               <h2 class="h5 font-weight-medium">
                <a href="/document/{{ $project->slug }}" class="link-title"> {!! Str::limit($project->title,25) !!}</a>
              </h2>

                <small class="text-success">{{ $project->no_of_page }}</small> <small class="text-success add-dash">pages |</small>
                <small class="text-warning">{{ $project->word_count }}</small> <small class="text-warning add-dash">words |</small> 
                <small class="text-info d-md-block d-lg-inline"><?php echo date('d-M-Y',strtotime($project->created_at)) ?></small> 
                <small class="text-info btn-d-none pt-1"></small>


     
          </div>
          <div class="card-footer bg-transparent border-0 pt-0">
            <!--<ul class="list-inline mb-0">
              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 131</a>
              </li>
              <li class="list-inline-item pr-4"> <a href="#" class="text-muted"><i class="ti-eye mr-1 text-primary"></i> 255</a>
              </li>
              <li class="list-inline-item"> <a href="#" class="text-muted"><i class="ti-comments mr-1 text-primary"></i> 14</a>
              </li>
            </ul>-->
          </div>
          <div></div>
        </div>
</a>

        <!-- End Blog Card -->
</div>
    @endforeach
   

    <div class="row mt-11">
 <!-- <div class="col-12">
    <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item mr-auto"> <a class="page-link" href="#">Previous</a>
        </li>
        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">1</a>
        </li>
        <li class="page-item active" aria-current="page"> <a class="page-link border-0 rounded" href="#">2 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">3</a>
        </li>
        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">...</a>
        </li>
        <li class="page-item"><a class="page-link border-0 rounded text-dark" href="#">5</a>
        </li>
        <li class="page-item ml-auto"> <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>-->
</div>
  </div>
</section>

<!--blog end-->

</div>

<!--body content end--> 
  <!--body content end-->
<!-- footer start -->
@include('layouts.frontfooter')