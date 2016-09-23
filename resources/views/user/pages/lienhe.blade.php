@extends('user.layout.master')
@section('title')
Tin tức 24h | Liên Hệ
@endsection

@section('main-content')
<div class="breadcrumbs column">
                    <p><a href="#">Home.</a>  \\   Liên Hệ.</p>
</div>

<div class="main-content">
                    
                    <!-- Single -->
         <div class="column-two-third single">
                        <div id="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.1577913641445!2d109.22576851435129!3d12.70312222415065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317018e7690cd749%3A0xe4d823add0605fb4!2zQuG6v24gWGUgVuG6oW4gR2nDow!5e0!3m2!1sen!2s!4v1470984679578" frameborder="0" style="border:0" allowfullscreen id="map_lienhe"></iframe>
                        </div>
                        <div class="outerwide">
                            <h5 class="line"><span>LIÊN LẠC THÔNG QUA.</span></h5>
                            <p></p>
                            
                            <div class="contact-info">
                                <p class="man"><i class="icon-location"></i>Địa Chỉ<br />Bến Xe Vạn Giã Lê Hồng Phong, tt. Vạn Giã, Vạn Ninh, Khánh Hòa, Vietnam.</p>
                                <p class="phone"><i class="icon-phone"></i> Phone:  01686 ... ... <br />Fax:  73 443 11 23.</p>
                                <p class="envelop"><i class="icon-mail"></i>Email: <a href="#">tankiet@gmail.com</a> <br /> Web: <a href="#">www.web_news.com</a></p> 
                            </div>
                        </div>

                        <div class="contact-form">
                            <h5 class="line"><span >THÔNG TIN LIÊN HỆ.</span></h5>
                            <form action="{{ route('postlienhe') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form">
                                    <label>Name*<span style="color:red;margin-left:50px;" id="error_name_contact"><span class="error_contact">{{$errors->first('name_contact')}} </span></span></label>
                                    <div class="input">
                                        <span class="name"></span>
                                        <input type="text" class="name"  name="name_contact" id="name_contact" />
                                    </div>
                                </div>
                                <div class="form">
                                    <label>Email*<span style="color:red;margin-left:50px;" id="error_email_contact"><span class="error_contact">{{$errors->first('email_contact')}} </span></span></label>
                                    <div class="input">
                                        <span class="email"></span>
                                        <input type="email" class="name"  name="email_contact" id="email_contact" />
                                    </div>
                                </div>
                                
                                <div class="form">
                                    <label>Message* </label><span style="color:red;margin-left:35px;" id="error_noidung_contact"><span class="error_contact">{{$errors->first('noidung_lienhe')}} </span> </span>
                                    <textarea rows="10" cols="20" id="noidung_lienhe" name="noidung_lienhe"></textarea>
                                </div>
                                <div class="form2" id="form2_contact">
                                    <input id="submit_contact" type="submit" class="send-message" value="Gửi phản hồi" />
                                   
                                </div>
                                
                                </form>
                    
                        </div>
         </div>
                    <!-- /Single -->
                    
</div>
@endsection