@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        body {
    font-size: 14px;
    font-family: 'Raleway', sans-serif;
    padding: 0;
    margin: 0;
    width:100vw;
}
.link{
    text-decoration:none;
}
.input-container, .col-md-6,.col-md-5, .col-md-3, .col-md-12{
    margin-top:40px !important;
}

#regForm{
    padding:50px;
    padding-top:10%
}
#nextBtn:hover{
    color:white !important;
}
#nextBtn{
    margin:20px;
    color:#1E50A0 !important;
}
#prevBtn{
    margin:20px;
    color:#1E50A0 !important;
} 
#prevBtn:hover{
    color:white !important;
}
label{
    font-family: Nunito;
    font-style: normal;
    font-weight: bold;
    font-size: 20px;
    line-height: 27px;
    color: #636363;
    margin-bottom:20px;
}

h5{
    font-family: Nunito;
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    line-height: 41px;
    /* identical to box height */


    color: #1B1B1B;
}

/***** background */
.bg-1 {
    background: #1A8BB3;
    color: #fff;
}
.bg-2 {
    background: #7FC8A9;
    color: #fff;
}
.bg-3 {
    background:#FA8072;
    color:#fff;
}
.bg-4{
    background:#F6D167;
    color:#fff;
}
.bg-5{
    background:#DF2E2E;
    color:#fff;
}
.bg-6{
    background:#989898;
    color:#fff;
}
.bg-7{
    background:#F3F3F3;
}
.bg-8{
    background:#616161;
}
.bg-9{
    background:#8d8d8d;
}
.bg-10{
    background:#D22F27;
}
.bg-11{
    background:#eaeaea;
}
.bg-white{
    background:#fff;
}
.bg-none{
    background:none;
}

/***** color */
.color-1{
    color:#1A8BB3;
}
.color-2{
    color:#7FC8A9;
}
.color-3{
    color:#FA8072;
}
.color-4{
    color:#F6D167;
}
.color-5{
    color:#DF2E2E;
}
.color-6{
    color:#989898;
}
.color-7{
    color:#F3F3F3;
}
.color-8{
    color:#616161;
}
.color-9{
    color:#8d8d8d;
}
.color-10{
    color:#D22F27;
}
.color-11{
    color:#eaeaea;
}
.color-black{
    color:#000;
}

/***** border */
.bd-1{
    border:1px solid #1A8BB3;
}

section{
    padding:20px 50px;
}

/***** font size */
.fs-30 {
    font-size: 30px;
}
.fs-28{
    font-size:28px;
}
.fs-20{
    font-size:20px;
}
.fs-18{
    font-size:18px;
}
.fs-16{
    font-size:16px;
}

/***** font weight */
.fw-900{
    font-weight:900;
}
.fw-700{
    font-weight:700;
}
.fw-600{
    font-weight:600;
}
.fw-500{
    font-weight:500;
}

/***** alignment */
.text-center{
    text-align:center;
}
.text-left{
    text-align:left;
}
.text-right{
    text-align:right;
}

/***** button */
button{
    outline:none;
    border:none;
    background:none;
    box-sizing: border-box;
    border-radius: 5px;
    cursor:pointer;
    color: #1E50A0 !important;
}
.btn-1{
    padding:17px;
}
.btn-2{
    padding:7px 12.5px;
}
.btn-3{
    padding:13px 85px;
}
.btn-4{
    padding:20px 45px;
}
.btn-5{
    padding:15px;
    border-radius:13px;
}

/***** select input */
.select{
    width:45px;
    background:none;
    outline:none;
    border:none;
    border-bottom:1px solid grey;
    height: 50px;
    left: 324px;
    top: 1012px;
}
.select-2{
    border: 1px solid #C8C8C8;
    box-sizing: border-box;
    border-radius: 6px;
    padding:12px;
    display:block;
    width:100%;
    outline:none;
    height: 50px;
    left: 324px;
    top: 1012px;
}

/***** text input */
input[type=text]{
    border: 1px solid #C8C8C8;
    box-sizing: border-box;
    border-radius: 6px;
    padding:10px;
    display:block;
    width:100%;
    outline:none;
    height: 50px;
   
   
}

/***** containers */
.double-container{
    display:grid;
    grid-template-columns:repeat(2, 45%);
    justify-content:space-between;
}

/***** navigation */
.navigation .top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-bottom:30px;
    margin-bottom:50px;
    border-bottom: 1px solid #E5E5E5;
}
.navigation .top .left,
.navigation .top .right{
    display:flex;
    align-items:center;
}
.navigation .top .left img{
    margin-right:5px;
}
.navigation .bottom{
    display:flex;
    align-items:center;
    justify-content:space-between;
}
.navigation .bottom span{
    margin-right:70px;
}
.navigation .bottom span:last-child{
    margin:0;
}
.navigation .back{
    display:flex;
    align-items:center;
    margin-top:60px;
}

/***** country category */
.country-category{
    padding:0 335px;
}
.country-category .card-container{
    margin:50px 0;
}
.country-category .card-container .card{
    height:142px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:30px;
}
.country-category .card-container .card .inner{
    padding:35px;
}

/***** purchase */
.purchase{
    padding:0 123px;
}
.purchase .card-container{
    margin:50px 0;
}
.purchase .card-container .card{
    padding:24px 155px 24px 45px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
}
.purchase .card-container .card .currency{
    margin-left:18px;
}
.purchase .card-container .card .quantity{
    margin:0 13px;
}
.purchase .card-container .card .quantity-summary{
    margin-left:13px;
}

/***** cart */
.cart{
    padding:0 123px;
}
.cart .cart-container{
    margin:50px 0;
}
.cart .cart-container .card{
    display:grid;
    grid-template-columns:2fr 1fr 1fr 2fr;
    border-radius:5px;
    margin-bottom:25px;
}
.cart .cart-container .heading{
    margin-bottom:15px;
}
.cart .cart-container .card-item{
    height:80px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-right:1px solid #c2c2c2;
    padding:20px;
}
.cart .cart-container .card-item:first-child{
    justify-content:flex-start;
    padding-left:45px;
}
.cart .cart-container .card-item:last-child{
    justify-content:flex-end;
    border:none;
    padding-right:45px;
}
.cart .cart-container .card-item .remove-icon{
    margin-right:8px;
}
.cart .cart-container .total{
    text-align:right;
}
.cart .cart-container .total .price{
    margin-left:22px;
}
.cart .cart-container .button-container{
    margin:83px 0 50px 0;
    text-align:right;
}

/***** form page */
.form-page{
    padding:0 180px;
}
.form-page form{
    border: 1px solid #F2F2F2;
    box-sizing: border-box;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.04), 0px 2px 6px rgba(0, 0, 0, 0.04), 0px 0px 1px rgba(0, 0, 0, 0.04);
    border-radius: 7px;
    padding:60px 80px;
    margin:45px 0;
}
.form-page form .form-section{
    margin-bottom:55px;
}
.form-page form .form-section .title{
    margin-bottom:18px;
}
.form-page form .form-section .input-container{
    margin-bottom:10px;
}
.form-page form .form-section .input-container .label{
    margin-bottom:15px;
    color:black;
}
.form-page form .button-container{
    text-align:right;
    margin-top:35px;
}
.form-page form .button-container button{
    margin-left:28px;
}
.form-page form .flutterwave{
    margin-top:23px;
}
/* .form-page form .form-section .input-container input{
} */







/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */

/* start laptop version */
@media screen and (max-width: 2450px) {
}

/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */

/* tab version */
@media screen and (max-width: 1024px) {
    section{
        padding:20px;
    }

    /***** cart */
    .cart{
        padding:0;
    }

    /***** country category */
    .country-category, .form-page{
        padding:0;
    }

    /***** form page */
    .form-page form{
        padding:50px 0;
    }
}

/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */

/* mobile version */
@media screen and (max-width: 800px) {
    .cart .cart-container .card{
        grid-template-columns:2fr 1fr 2fr 2fr;
    }
}

/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */
/* break */

/* mobile version */
@media screen and (max-width: 468px) {
    #nextBtn{
    margin:0;
   
}
#prevBtn{
    margin:0;
   
} 
    section{
        padding:20px 20px;
    }

    button{
        display:block;
        width:100%;
    }

    .double-container{
        display:block;
    }

    #regForm{
    padding:10px;
    padding-top:10%
    }
    /***** navigation */
    .navigation{
        display:none;
    }

    /***** cart */
    .cart .cart-container .card{
        display:block;
    }
    .cart .cart-container .card-item{
        height:auto;
        display:flex;
        align-items:center;
        justify-content:center;
        border-right:none;
        border-bottom:1px solid #c2c2c2;
        padding:20px;
    }
    .cart .cart-container .card-item:first-child{
        justify-content:center;
        padding-left:20px;
    }
    .cart .cart-container .card-item:last-child{
        justify-content:center;
        padding-right:20px;
    }

    /***** form page */
    .form-page form{
        box-shadow:none;
        border:none;
    }
    .form-page form .button-container button{
        margin:0 0 28px 0;
    }

    /***** purchase */
    .purchase{
        padding:0;
    }
    .purchase .card-container .card{
        padding:24px 20px;
        display:block;
    }
    .purchase .card-container .card .purchase-name{
        display:flex;
        justify-content:space-between;
        margin-bottom:20px;
    }
    .purchase .card-container .card .btn-2{
        display:inline-block;
        width:auto;
    }
}
         /* Mark input boxes that gets an error on validation: */
     input.invalid {
        background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
         display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #BBBEFF;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
            float:none;
        }

    .iti--allow-dropdown{
        width:100%;
    }
    #backbutton{
        margin-bottom:190px;
    }
    .login_information p{
        font-weight: bolder;
    }
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }

        .choices__input {
            width: 100%;
            margin-bottom: 0px;
        }

        @media screen and (max-width: 800px) {
            .bs-stepper-header {
                display: block;
                align-items: center;
            }
        }

        #descript {
            margin-top: 20px;
            width: 90%;
        }


        .radio-group {
            position: relative;
            margin-bottom: 25px
        }

        .radio {
            display: inline-block;
            height: 64px;
            border-radius: 0;
            background: #eee;
            box-sizing: border-box;
            border: 1px solid lightgrey;
            cursor: pointer;
            margin: 8px 25px 8px 0px
        }

        .radio:hover {
            box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)
        }

        .radio.selected {
            box-shadow: 0px 0px 0px 4px rgba(0, 0, 0, 0.4)
        }

        @media screen and (max-width: 600px) {
            .radio {
                width: 100%
            }
        }
    </style>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css"
          integrity="sha512-DJ1SGx61zfspL2OycyUiXuLtxNqA3GxsXNinUX3AnvnwxbZ+YQxBARtX8G/zHvWRG9aFZz+C7HxcWMB0+heo3w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')

    <div class="main-container">
        <section class="contact-photo">
        <section class="content" >
            <div class="form-page ">
                <div class="header " style="margin-top:10%" >
                    <!-- <div class="fw-700 fs-28 text-center">Travel Information</div> -->

                    @include('errors.showerrors')
                <form action="{{ url('/post/booking') }}" method="post" id="regForm"  class="needs-validation bg-white" style="">
                    @csrf
                    <div class="tab ">
                        <div></div>
                         <h5>Personal Infomation</h5>
                                        <div class="col-md-5 ">
                                            <label>First Name <span class="show_required"> *</span> 
                                            </label>
                                            <input  type="text" placeholder="First name"
                                                   name="first_name"
                                                   value="{{ old('first_name') }}"  style="margin-bottom:0px;" required>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            <label>Surname <span class="show_required"> *</span></label>
                                            <input  type="text" placeholder="Surname"
                                                   name="last_name"
                                                   value="{{ old('last_name') }}" required>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>Contact Email: <span class="show_required"> *</span></label> <small class="text-muted" style="color:red"> Please provide only ONE email address</small>
   
                                            <input  type="text" name="email" value="{{ old('email') }}" required/>
                                        </div>
                                        <div class="col-md-12 " style="margin-top: 20px">
                                        <label>Phone number<span class="show_required"> *</span></label>
                                            <input id="phone" style="" type="text" value="{{ old('phone_no') }}" name="phone_no" class=" pr-5"  placeholder="Phone No" required>
                                        </div>
                                        <div class="col-md-5"
                                             style="margin-bottom: 20px">
                                            <label>Sex <span class="show_required"> *</span></label>
                                            <select class="select-2" name="sex" required>
                                                <option value="">Make a selection</option>
                                                <option value="1" @if(old('sex') == "1")
                                                selected
                                                        @endif>Male
                                                </option>
                                                <option value="2" @if(old('sex') == "2")
                                                selected
                                                        @endif>Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            <label>Date of Birth <span class="show_required"> *</span>
                                        </label>
                                            <input class="date_picker" type="text"
                                                   placeholder="Date of Birth"
                                                   name="dob"
                                                   value="{{ old('dob') }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Ethnicity <span class="show_required"> *</span></label>
                                            <select class="select-2" name="ethnicity" required>
                                                <option value="">Make a selection</option>
                                                <option value="1" @if(old('ethnicity') == "1")
                                                selected
                                                        @endif>White
                                                </option>
                                                <option value="2" @if(old('ethnicity') == "2")
                                                selected
                                                        @endif>Mixed/Multiple Ethnic groups
                                                </option>
                                                <option value="3" @if(old('ethnicity') == "3")
                                                selected
                                                        @endif>Asian/Asian British
                                                </option>
                                                <option value="4" @if(old('ethnicity') == "4")
                                                selected
                                                        @endif>
                                                    Black/African/Caribbean/Black British
                                                </option>
                                                <option value="5" @if(old('ethnicity') == "5")
                                                selected
                                                        @endif>Other Ethnic group
                                                </option>

                                            </select>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>NHS Number (If known and applicable): </label>
                                            <input class="" type="text" name="nhs_number" id="nhs"
                                                   value="{{ old('nhs_number') }}"/>
                                        </div>


                                        <div class="col-md-12">
                                            <label>Vaccination Status: <span class="show_required"> *</span></label>
                                            <select class="select-2" id="vaccination_status"
                                                    name="vaccination_status" onchange="vaccination_check()" required>
                                                <option value="">Make a selection</option>
                                                <option value="1">Not been vaccinated</option>

                                                <option value="2">Received the first dose, but not the second
                                                </option>

                                                <option value="3">Received both first and second dose
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-12" id="vaccination_type_div"
                                             style="margin-top: 30px;display: none;">
                                            <label>Vaccination Type:</label>
                                            <select class="select-2" id="vaccination_type" name="vaccination_type">
                                                <option value="">Make a selection</option>
                                                <option value="Janssen vaccine">Janssen Vaccine</option>
                                                <option value="Pfizer">Pfizer</option>
                                                <option value="Moderna">Moderna</option>
                                                <option value="Oxford/AZ">Oxford/AZ</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12" id="vaccination_date_div"
                                             style="margin-top: 20px;display: none;">
                                            <label>Vaccination Date:</label>
                                            <input class="date_picker" id="vaccination_date" type="text"
                                                   placeholder="Vaccination date"
                                                   name="vaccination_date"
                                                   value="{{ old('vaccination_date') }}">
                                        </div>

                                       
                    </div>
                    <div class="tab"><h5>Address Infomation</h5>
                        <div class="form-section">
                            
                            <div class="form-section">
                                <div class="fw-700 fs-20 title">Home Address</div>
                                <div class="color-8">This is the address where you reside</div>
                            </div>
                            <div class="input-container">
                                <label>Home Address 1: <span class="show_required"> *</span> </label>
                                <input class="" type="text" name="address_1"
                                                   value="{{ old('address_1') }}" required/>
                            </div>

                            <div class="input-container">
                                            <label>Home Address 2: </label>
                                            <input class="" type="text" name="address_2" id="address2"
                                                   value="{{ old('address_2') }}"/>
                             </div>

                            <div class="col-md-5" style="padding:0;">
                                            <label>Home City/Town: <span class="show_required"> *</span></label>
                                            <input class="" type="text" name="home_town"
                                                   value="{{ old('home_town') }}" required/>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5"  style="padding:0;">
                                            <label>Home Postcode: <span class="show_required"> *</span></label>
                                            <input class="" type="text" name="post_code"
                                                   value="{{ old('post_code') }}" required/>
                            </div>
                            <div class="container" style="padding:30px">

                            </div>
                            <div class="input-container" >
                                            <label>Home Country: <span class="show_required"> *</span></label>
                                            <select style="width: 100%;" class="select-2"
                                                    name="home_country_id" id="nationality"
                                                    required>
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('home_country_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                             </div>
                        </div>
                        <div class="form-section">
                            <div class="fw-700 fs-20 title">Isolation Address</div>
                            <div class="color-8">Your Test Package will be sent to this address</div>
                        </div>
                        <div class="input-container">
                                            <label>Isolation Address1: <span class="show_required"> *</span> </label>
                                            <input class="" type="text" name="isolation_address"
                                                   value="{{ old('isolation_address') }}" required/>
                                        </div>

                                        <div class="input-container">
                                            <label>Isolation Address2: </label>
                                            <input class="" type="text" name="isolation_address2"
                                                   id="isolation_address2"
                                                   value="{{ old('isolation_address2') }}"/>
                                        </div>

                                        <div class="input-container">
                                            <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                            <input class="" type="text" name="isolation_town"
                                                   value="{{ old('isolation_town') }}" required/>
                                        </div>
                                        <div class="input-container">
                                            <label>Isolation Postcode: <span class="show_required"> *</span></label>
                                            <input class="" type="text" name="isolation_postal_code"
                                                   value="{{ old('isolation_postal_code') }}" required/>
                                        </div>
                                        <div class="input-container">
                                            <label>Isolation Country: <span class="show_required"> *</span></label>
                                            <select style="width: 100%;" class="select-2"
                                                    name="isolation_country_id" required readonly>
                                                <option value="">Make a selection</option>

                                                <option value="225" selected
                                                        >UNITED KINGDOM
                                                </option>
                                            </select>
                                        </div>
                    </div>
                    <div class="tab"><h5>Travel Information</h5>
                        <div class="form-section">
                            <div class="fw-700 fs-20 title">Travel Details</div>
                        </div>
                        <div class="input-container" style="margin-top: 20px">
                                            <label>Travel Document ID/Passport Number: <span
                                                        class="show_required"> *</span> </label>
                                            <input  type="text" name="document_id"
                                                   value="{{ old('document_id') }}" required/>
                                        </div>
                                        <div class="input-container">
                                            <label>Country travelled from: <span
                                                        class="show_required"> *</span></label>
                                            <select class="select-2 select2 country_id__"
                                                    name="country_travelling_from_id" autocomplete="off"
                                                    id="travel_from" onchange="run()" onselect="selectCountry()">
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('country_travelling_from_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="input-container" style="margin-top: 20px">
                                            <label> Departure Date(from country of origin): <span class="show_required"> *</span></label>
                                            <input class="date_picker1" type="text"
                                                   placeholder="Departure Date in UK"
                                                   name="departure_date"
                                                   value="{{ old('departure_date') }}" required>
                                        </div>

                                        <div class="input-container" style="margin-top: 20px">
                                            <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                            <input class="date_picker1" type="text"
                                                   placeholder="Arrival Date in UK"
                                                   name="arrival_date"
                                                   value="{{ old('arrival_date') }}" required>
                                        </div>


                                       

                                        <div class="input-container" style="margin-top: 20px">
                                            <label> Last day you were in a country/territory that was not in a travel
                                                corridor
                                                arrangement with the UK: <span class="show_required"> *</span><br/>
                                                <span class="field-description">You can find the current list <a
                                                            href='https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england'
                                                            target="_blank">here</a>:</span>
                                            </label>
                                            <input class="date_picker1" type="text"
                                                   placeholder=""
                                                   name="last_day_travel"
                                                   value="{{ old('last_day_travel') }}" required>
                                        </div>


                                       

                                        <div class="input-container" style="margin-top: 20px">
                                            <label>Flight Number / Coach Number / Vessel Name / Airline: <span
                                                        class="show_required"> *</span></label>
                                            <input  type="text" required name="transport_no"
                                                   value="{{ old('transport_no') }}"/>
                                        </div>
                                        <input type="hidden" name="payment_method" value="flutterwave" id="payment_method"/>
                            
                        <div class="form-section" >
                            <div class="input-container" style="margin-top: 10px">
                                <label class="">Payment Method</label>
                                <div class="color-8"> All cardholders are advised to use Flutterwave</div>
                                    <div class='radio' style="background:none;border:none;padding:20px;height:100px;border-radius:25px" data-value="flutterwave" >
                                                    <img src="{{ url('/img/Flutterwave.png') }}" style="padding-bottom: 0px;width: 200px;">
                                    </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="input-container" id="card" style="margin-top:20px;display:none;">
                                            <label>Select Card types <span class="show_required"> *</span></label> <small class="text-muted" style="color:red"> <b>Please select a card payment option</b> </small>
                                            <select class="select-2 card_type" autocomplete="off" name="card_type">

                                            </select>
                            </div>
                            <div class="input-container color-9">
                                <div class=" fw-900"><b>Consent to Test</> <span class="color-10">*</span></div>
                                <div class="color-8  fw-700">I consent to this test being done, or if this test is for a child, I confirm I am a legal guardian of the child and consent to this test being done.</div>
                            </div>
                            <div class="input-container color-9 fw-700">
                                <input type="checkbox" name="consent" value="1" class="bg-1" /> <span class="color-10">Bookings can’t be cancelled or refunded</span>
                            </div>
                        </div>      
                
                    </div>

                    <div class="container-fluid mb-5" style="margin-top:50px;margin-bottom:30px;">
                    
                        <div class="text-center pb-5" >
                            
                            <button type="button" style="border:1px solid #1E50A0;color:#1E50A0;"  class="btn btn-purple btn-pill float-right " id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" style="border:1px solid #1E50A0;color:#1E50A0;" class="btn btn-purple btn-pill float-right" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div class="container-fluid mt-5 text-center" style ="width:100%">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>

                </form>
                </div>
            </div>
        </section>
        
        </section>
    </div>

@endsection

@section('script')

     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
            integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"
            integrity="sha512-ljeReA8Eplz6P7m1hwWa+XdPmhawNmo9I0/qyZANCCFvZ845anQE+35TuZl9+velym0TKanM2DXVLxSJLLpQWw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
     var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "gb",
            utilsScript: "/js/phone_lib/js/utils.js",
        });

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
        
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
        var d = document.getElementById("nextBtn");
        d.className += "submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
        //   for (i = 0; i < y.length; i++) {
        //     // If a field is empty...
        //     if (y[i].value == "") {
        //       // add an "invalid" class to the field:
        //       y[i].className += " invalid";
        //       // and set the current valid status to false:
        //       valid = false;
        //     }
        //   }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

    $(function () {
            $('.date_picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('.date_picker1').datetimepicker({
                format: 'MM/DD/YYYY'
            });

        });

    function vaccination_check() {
            var check = $("#vaccination_status").val();
            console.log(check);

            if (check == 2 || check == 3) {
                $("#vaccination_type_div").show();
                $("#vaccination_date_div").show();
            } else if (check == 1 || !check) {
                $("#vaccination_type_div").hide();
                $("#vaccination_date_div").hide();
            }
        }

        function run() {

            var nationality = document.getElementById("travel_from").value;

            if( nationality == 156){
                var $card = $(".card_type");
                $card.empty(); // remove old options
                $card.append($("<option value=''>Select type of card</option>"));
                $card.append($("<option></option>").attr("value", 1).text("Nigerian Card"));
                $card.append($("<option></option>").attr("value", 2).text("Non-Nigerian Card"));
                $("#card").show();
            }else{
                $("#card").hide();
            }


        }

</script>


@endsection