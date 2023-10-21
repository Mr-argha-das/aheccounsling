@extends('layouts.'.config('backendLayout'))
 
@section('content')

<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $orderData->en_first_name }} {{ $orderData->en_last_name }}  
 <label class="text-success"> Order Number :- <?php echo $orderData->rmid.'-'.date('d-m-y',$orderData->tranxid).'_'.sprintf("%02d", $orderData->order_number); ?></label>
                </h3>
                <h4></h4>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                    <a class="btn btn-primary" href="{{route('admin.entry.orders.production-cost')}}"><i class="fa fa-plus mr-1"></i> List View</a>
                </span>
            </div>
        </div>
    </div>
</div>
 <div class="block p-3" style="border-radius:15px"> 

    <form method="POST" action="{{route('admin.entry.orders.production-cost.store')}}" enctype="multipart/form-data">
    <div class="row">
    @csrf 
         <div class="col-md-12">
          <label class="text-primary">     Word Count  :- {{$orderData->word_count}}</label>,
                 <label class="text-danger">Amount  :- {{$orderData->inr_amount}}</label>
          <button class="btn btn-warning btn-lg float-right" type="button"id="add_more"><i class="fa fa-plus mr-1"></i>Add</button>
           
         </div>

         <input type="hidden" name="tranxid" value="{{$orderData->tranxid}}">

          @php $key_val=$extra_charges=0; @endphp
         @if(!empty($pre_data))
           @foreach($pre_data as $key_val => $val)
             @php $extra_charges=$val->extra_charges; @endphp
           <div class="col-md-3 remove_{{$key_val}}">
            <label class="control-label">Cost</label>
            <input required type="" name="cost_value[]" value="{{$val->cost_value}}" class="form-control form-control-lg numbers">
           </div>

           <div class="col-md-3 remove_{{$key_val}}">
            <label class="control-label">Word Count</label>
            <input required type="text" name="word_count[]" value="{{$orderData->word_count}}" value="{{$val->word_count}}" class="form-control form-control-lg numbers">
           </div>
          <div class="col-md-4 remove_{{$key_val}}">
             <label class="control-label">Select Write</label>
             <select   id="write_id" name="write_id[]" class="form-control form-control-lg"> 
                 @foreach($writesList as  $id =>$name)
                 <option  value="{{$id}}" @if($val->write_id==$id) @php echo 'selected'; @endphp @endif>{{$name}}</option>
                 @endforeach
            </select> 
          </div>

          <div class="col-md-2 remove_{{$key_val}}">
            <input type="hidden" name="edit_id[]" value="{{$val->id}}">
          <button class="btn btn-danger btn-lg float-right mt-4 remvoe" data-count='{{$key_val}}' data-id='{{$val->id}}' type="button"><i class="fa fa-trash mr-1"></i>Remvoe</button>
         </div>
          @endforeach;
       @endif


          

         <div class="row col-md-12" id="append_more">
           
         </div>


       <div class="col-md-4">
          <label class="control-label">Extra Charges(%)</label>
          <input required type="text" required name="extra_charges" value="{{$extra_charges}}" class="form-control form-control-lg numbers">
         </div>
        <div class="col-md-6">
            <br> </br>  
             <input required class="btn btn-success btn-lg float-right" type="submit"  value="Submit">
        </div>
    </div>
   </form>
 </div>
 <script type="text/javascript">

   $(document).ready(function(){
    $('.numbers').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $('input[type=submit]').click(function() {
        $(this).attr('disabled', 'disabled');
        $(this).parents('form').submit();
    });
  
       var count ='{{$key_val+1}}';
         
        $(document).on("click",".remvoe",function() {
         let count_nu = $(this).attr("data-count");
         let remove_data_id = $(this).attr("data-id");
         $(`div.remove_${count_nu}`).remove();
         if(remove_data_id>0){

           let route_url = '{{ route('admin.entry.orders.production-cost.remove') }}';
             $.ajax({
              type: 'GET',
              url: `${route_url}/${remove_data_id}`,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               data: {},  
               dataType: "json",
               success: function (data) {}
              });
           }
       });

      
     $("#add_more").on("click", function(e) {
          count++;
         var add_more = `
           <div class="col-md-3 remove_${count}"  >
          <label class="control-label">Cost</label>
          <input required type="" name="cost_value[]" class="form-control form-control-lg numbers">
         </div>
         <div class="col-md-3 remove_${count}">
          <label class="control-label">Word Count</label>
          <input required type="text" name="word_count[]" value="0" class="form-control form-control-lg numbers">
         </div>
         <div class="col-md-4 remove_${count}">
           <label class="control-label">Select Write</label>
           <select   id="write_id" name="write_id[]" class="form-control form-control-lg"> 
               @foreach($writesList as  $id =>$name)
               <option  value="{{$id}}">{{$name}}</option>
               @endforeach
          </select> 
       </div>
        <div class="col-md-2 remove_${count}">
          <button class="btn btn-danger btn-lg float-right mt-4 remvoe" data-count='${count}' data-id='0' type="button"><i class="fa fa-trash mr-1"></i>Remvoe</button>
         </div>
         `;
        $('#append_more').append(add_more);
    });
   });
</script>
@endsection

