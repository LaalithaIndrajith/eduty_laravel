@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			User Profile
			{{-- <small class="text-muted font-size-sm ml-2">12 messages</small> --}}
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>

	{{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
		{{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            {{-- <div class="symbol symbol-100 mr-5"> --}}
				@if (auth()->user()->user_profile_image != 'no_image.jpg')
				<div class="symbol symbol-100 mr-5">
                	<div class="symbol-label" style="background-image:url('{{ asset('storage/images/user_porfile_images/'.auth()->user()->user_profile_image ) }}')"></div>
					<i class="symbol-badge bg-success"></i>
				</div>
				@else
				<div class="symbol symbol-100 symbol-light-primary  mr-5">
					<div class="symbol-label font-size-h1">{{ substr(auth()->user()->username, 0, 1) }}</div>
					<i class="symbol-badge bg-success"></i>
				</div>
				@endif
            {{-- </div> --}}
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
					{{ auth()->user()->user_fname }} {{ auth()->user()->user_lname }}
				</a>
                <div class="text-muted mt-1">
                    {{ Session :: get('designation') }}
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
                            <span class="navi-text text-muted text-hover-primary">{{  auth()->user()->email }}</span>
                        </span>
                    </a>
                </div>
				<div class="navi-text">
					<form action="{{ route('logout') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-light-danger font-weight-bold btn-sm">
							<span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Electric\Shutdown.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" fill="#000000" fill-rule="nonzero"/>
									<rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/>
								</g>
							</svg><!--end::Svg Icon--></span>
							Logout
						</button>
					</form>
				</div>
            </div>
        </div>

		
    </div>
</div>
