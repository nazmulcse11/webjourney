@extends('frontend.layouts.master')
@section('site_title'){{ 'WebJourney - Contact Us'}}@endsection
@section('description',get_static_option('description'))
@section('og_url'){{ route('contact.us') }}@endsection
@section('og_title','WebJourney - Contact Us')
@section('og_description'){{ 'You can contact us using the contact information or via contact form.'}}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection

@section('content')
   <!--  wrapper  -->
   <div id="wrapper">
       <!-- content-->
       <div class="content">
            <x-frontend.dynamic-breadcrumb :title="__('Contact Us')" />
           <!-- section-->
           <section  id="sec1" class="middle-padding grey-blue-bg">
               <div class="container">
                   <div class="row">
                       <div class="col-md-4">
                           <!--   list-single-main-item -->
                           <div class="list-single-main-item fl-wrap">
                               <div class="list-single-main-item-title fl-wrap">
                                   <h3>{{ get_static_option('contact_info_title') ?? __('Contact Info') }}</h3>
                               </div>
                               <div class="box-widget-list mar-top">
                                   <ul>
                                       @if(get_static_option('address'))
                                           <li>
                                               <span><i class="fal fa-map-marker"></i> {{ __('Address :') }}</span>
                                               {{ get_static_option('address') ?? '' }}
                                           </li>
                                       @endif
                                       @if(get_static_option('phone'))
                                           <li>
                                               <span><i class="fal fa-phone"></i> {{ __('Phone :') }}</span>
                                               {{ get_static_option('phone') ?? '' }}
                                           </li>
                                       @endif
                                       @if(get_static_option('email'))
                                           <li>
                                               <span><i class="fal fa-envelope"></i> {{ __('Email :') }}</span>
                                               {{ get_static_option('email') ?? '' }}
                                           </li>
                                       @endif
                                       @if(get_static_option('youtube'))
                                           <li>
                                               <span><i class="fal fa-browser"></i> {{ __('Youtube :') }}</span>
                                               <a href="{{ get_static_option('youtube') ?? '' }}" target="_blank">{{ __('Youtube Profile') }}</a>
                                           </li>
                                       @endif
                                       @if(get_static_option('facebook'))
                                           <li>
                                               <span><i class="fal fa-browser"></i> {{ __('Facebook :') }}</span>
                                               <a href="{{ get_static_option('facebook') ?? '' }}" target="_blank">{{ __('Facebook Profile') }}</a>
                                           </li>
                                       @endif
                                       @if(get_static_option('linkedin'))
                                           <li>
                                               <span><i class="fal fa-browser"></i> {{ __('Linkedin :') }}</span>
                                               <a href="{{ get_static_option('linkedin') ?? '' }}" target="_blank">{{ __('Linkedin Profile') }}</a>
                                           </li>
                                       @endif
                                       @if(get_static_option('github'))
                                           <li>
                                               <span><i class="fal fa-browser"></i> {{ __('Github :') }}</span>
                                               <a href="{{ get_static_option('github') ?? '' }}" target="_blank">{{ __('Github Profile') }}</a>
                                           </li>
                                       @endif
                                       @if(get_static_option('stackoverflow'))
                                           <li>
                                               <span><i class="fal fa-browser"></i> {{ __('Stackoverflow :') }}</span>
                                               <a href="{{ get_static_option('stackoverflow') ?? '' }}" target="_blank">{{ __('Stackoverflow Profile') }}</a>
                                           </li>
                                       @endif
                                   </ul>
                               </div>
                               <div class="list-widget-social">
                                   <ul>
                                       <li><a href="https://www.facebook.com/WebJourneybd" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                       <li><a href="https://www.youtube.com/c/WebJourneybd" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                       <li><a href="https://stackoverflow.com/users/12187513/nazmul-hoque" target="_blank" ><i class="fab fa-stack-overflow"></i></a></li>
                                   </ul>
                               </div>
                           </div>
                           <!--   list-single-main-item end -->
                       </div>
                       <div class="col-md-8">
                           <div class="list-single-main-item fl-wrap">
                               <div class="list-single-main-item-title fl-wrap">
                                   <h3>{{ __('Get In Touch') }}</h3>
                               </div>
                               <h3 class="contact_message_loader"></h3>

                               <x-frontend.v_error />

                               <div id="contact-form">
                                   <form method="post" class="custom-form" action="{{ route('contact.email.send') }}">
                                       @csrf
                                       <fieldset>
                                           <label><i class="fal fa-user"></i></label>
                                           <input type="text" name="name" id="name" placeholder="Your Name *" @if(Auth::guard('web')->check()) value="{{ Auth::guard('web')->user()->name}}" @else value="{{ old('name') }}"@endif />
                                           <div class="clearfix"></div>
                                           <label><i class="fal fa-envelope"></i></label>
                                           <input type="text" name="email" id="email" placeholder="Email Address*"  @if(Auth::guard('web')->check()) value="{{ Auth::guard('web')->user()->email}}" @else value="{{ old('email') }}"@endif/>
                                           <textarea name="message" id="message" cols="40" rows="5" placeholder="Your Message:">{{ old('message') }}</textarea>
                                       </fieldset>
                                       <button type="submit" class="btn float-btn color2-bg contact_message_btn" style="margin-top:15px;">{{__('Send Message')}}<i class="fal fa-angle-right"></i></button>
                                   </form>
                               </div>
                               <!-- contact form  end-->
                           </div>
                       </div>
                   </div>
               </div>
               <div class="limit-box fl-wrap"></div>
           </section>
           <!-- section end -->
       </div>
       <!-- content end-->
   </div>
   <!--wrapper end -->
@endsection

@section('scripts')
   <script>
       $(document).on('click','.contact_message_btn',function(e){
           let name = $('#name').val();
           let email = $('#email').val();
           let message = $('#message').val();
           if(name == '' || email == '' || message == ''){
               $('.contact_message_loader').html('<p style="color:red">'+'Please fill all fields'+'</p>');
               $('.validation_error_msg').hide();
               return false;
           }else{
               $('.contact_message_loader').html('<p style="color:green">'+'Please wait message sending...'+'</p>');
               $('.validation_error_msg').hide();
           }
       });
   </script>
@endsection
