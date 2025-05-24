
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-12 footer-logo-icon">
				<a class="d-block" href="{{url(route('frontend.home'))}}"><img class="footer-logo" src="{{url(setting('footer_logo'))}}" /> </a>
			</div>
			<div class="col-md-2 col-6">
				<h3 class="title-of-footer">{{__('apps::frontend.home._footer.site_map')}}</h3>
				<div class="links">
					<ul>
						<li><a  href="{{url(route('frontend.home'))}}">{{__('apps::frontend.home._header.home')}}</a></li>
						<li><a href="{{url(route('frontend.projects.index'))}}">{{__('apps::frontend.home._header.projects')}}</a></li>
						<li><a href="{{url(route('frontend.contact-us.index'))}}">{{__('apps::frontend.home._header.contact_us')}}  </a></li>
						<a href="{{$about_us_page ? url(route('front.pages.show',$about_us_page['slug'])) : '#'}}">{{__('apps::frontend.home._header.about_us')}}</a>

					</ul>
				</div>
			</div>

			<div class="col-md-4 col-12 footer-subscribe">
				<h3 class="title-of-footer">{{__('apps::frontend.home._footer.subscribe_to_receive_all_new')}} </h3>
				<div class="subscribe-form">
					<form>
						<input type="email" required class="form-control" placeholder="{{__('apps::frontend.home._footer.email')}}" />
						<button class="btn" type="submit"> {{__('apps::frontend.home._footer.subscribe')}}</button>
					</form>
				</div>
				<h3 class="title-of-footer">{{__('apps::frontend.home._footer.follow_us_via')}}  </h3>
				<div class="footer-social">
					@if (setting('social','facebook'))

					<a href="{{setting('social','facebook')}}" class="social-icon"><i class="ti-facebook"></i></a>
					@endif
					@if (setting('social','instagram'))

					<a href="{{setting('social','instagram')}}" class="social-icon"><i class="ti-instagram"></i></a>
					@endif
					@if (setting('social','linkedin'))

					<a href="{{setting('social','linkedin')}}" class="social-icon"><i class="ti-linkedin"></i></a>
					@endif
					@if (setting('social','twitter'))

						<a href="{{setting('social','twitter')}}" class="social-icon"><i class="ti-twitter-alt"></i></a>
					@endif
				</div>
			</div>

			<div class="col-md-4 col-12 footer-subscribe">
				<h3 class="title-of-footer">{{__('Download App')}} </h3>
				<div class="subscribe-form">
					@if(setting('qr_code'))
						<p style="text-align: center;    margin-bottom: 10px;">
							<img width="188" height="188" loading="lazy" decoding="async" src="{{ asset(setting('qr_code')) }}"/>
						</p>
					@endif
					<div class="links row">

						<div class="col-lg-6">

							@if(setting('apps','android_url'))
								<a href="{{setting('apps','android_url')}}" target="_blank">
									<img style="width: 160px;border-radius:0px" class="footer-logo" src="{{ asset('frontend/images/icons/android.png') }}"/>
								</a>
							@endif
						</div>
						<div class="col-lg-6">
							@if(setting('apps','ios_url'))
								<a href="{{setting('apps','ios_url')}}" target="_blank">
									<img style="width: 160px;border-radius:0px" class="footer-logo" src="{{ asset('frontend/images/icons/ios.png') }}"/>
								</a>
							@endif
						</div>

					 </div>
				</div>

			</div>
		</div>
	</div>
</footer>
<div class="text-center copyrights">
	<a href="https://www.tocaan.com" style="color: white">
		<p class="container">{{__('apps::frontend.home._footer.copyright_all_rights_reserved')}} © {{date('Y')}}</p>
	</a>
</div>
