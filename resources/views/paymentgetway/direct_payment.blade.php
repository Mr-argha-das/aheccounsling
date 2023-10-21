<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pay-page.css') }}">

        {{-- Font CSS Links --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />

    </head>
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
                    <a href="{{route('PayUBiz', ['id' => base64_encode($payment_data->id)])}}">
                        <button>PAY {{$payment_data->symbol}} {{$payment_data->amount}}</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
