@if(isset($user))
	{{ $user->first_name }},
@else
	Hello!
@endif

@yield('body')

<p>
	Regards,<br />
	The {{ Config::get('gluii.appname') }} team
</p>