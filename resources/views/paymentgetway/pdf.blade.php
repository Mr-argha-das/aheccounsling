 <!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pay-page.css') }}">

        {{-- Font CSS Links --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script type="text/javascript">
      var verifyCallback = function(response) {
          if(response==''){
            console.log('select reCAPTCHA');
          }
         
      };
      var widgetId1;
      
      var onloadCallback = function() {
     
        widgetId1 = grecaptcha.render('example1', {
          'sitekey' : '6LfVF9QhAAAAALyFkYgThyzUhxFpcZFzjsX9tpJO',
          'theme' : 'light',
          'callback':'enableBtn'
        });
       };
    </script>

    </head>
    <style type="text/css">
        .disabled-element {
    opacity: 0.65;
    pointer-events: none;
}

    </style>
    <body class="pay-body">
        <div class="main-pay-box">
            <div class="pay-box">
                <div class="top-part">
                    <img src="https://www.ahecounselling.com/webassets/images/logo.png" />
                    <div class="user-detail">
                        <h4>Ahecounselling</h4>
                        <p>Order <strong>{{$payment_data->txnid}} </strong></p>

                        <h1>{{$payment_data->symbol}} {{$payment_data->amount}}</h1>
                    </div>
                </div>
                <div class="middle-part">
                    <div class="form-floating mb-3">
                        <div class="in-icon"><i class="fa fa-user"></i></div>
                        <input type="name" class="form-control"  value="{{$payment_data->firstname}}" readonly />
                        <label for="floatingInput">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <div class="in-icon"><i class="fa fa-phone"></i></div>
                        <input type="text" class="form-control"  value="+{{$payment_data->phone}}" readonly />
                        <label for="floatingInput">Phone</label>
                    </div>

                    <div class="form-floating mb-3">
                        <div class="in-icon"><i class="fa fa-envelope"></i></div>
                        <input type="email" class="form-control"  value="{{$payment_data->email}}" readonly />
                        <label for="floatingInput">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <div class="in-icon"><i class="fa fa-user"></i></div>
                        <input type="email" class="form-control"  value="{{$payment_data->rmid}}" readonly />
                        <label for="floatingInput">RMID</label>
                    </div>
                     <div class="form-floating mb-3">
                     <div id="example1"></div>
                 </div>
                </div>
                 
                <p class="note-p">We accept payment methods</p>
                <div class="bottom-part">
                    <div class="other-pay">
                        <div class="pay-option">
                            <img src="{{ asset('images/icon1.jpg') }}" />
                            <p>Card</p>
                        </div>
                        <div class="pay-option">
                            <img src="{{ asset('images/icon2.jpg') }}" />
                            <p>Netbanking</p>
                        </div>
                        <div class="pay-option">
                            <img src="{{ asset('images/icon3.jpg') }}" />
                            <p>International Card</p>
                        </div>
                        <div class="pay-option">
                            <img src="{{ asset('images/icon4.jpg') }}" />
                            <p>UPI</p>
                        </div>
                    </div>
                     <a class="disabled-element" id="submitable" href="{{route('PayUBiz', ['id' => base64_encode($payment_data->id)])}}">
                        <button>PAY {{$payment_data->symbol}} {{$payment_data->amount}}</button>
                    </a>
                </div>

            </div>
        </div>

          <script type="text/javascript">
            
               function enableBtn(){
                    
                  if(grecaptcha.getResponse(widgetId1)){
                    var element = document.getElementById("submitable");
                      element.classList.remove("disabled-element");
                   }
              }

         
        
      </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
    </body>
</html>
