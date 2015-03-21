<ul class="nav" role="menu">
	<li class="hidden-folded padder m-t m-b-sm text-muted text-sm"><span>Settings</span></li>
	{!! HTML::liLinkSubNav('account/settings', 'General Settings') !!}
	{!! HTML::liLinkSubNav('account/settings/notifications', 'Notifications') !!}
	<li class="hidden-folded padder m-t m-b-sm text-muted text-sm"><span>Security</span></li>
	{!! HTML::liLinkSubNav('account/security', 'Security Dashboard') !!}
	{!! HTML::liLinkSubNav('account/security/update-email', 'Update Email') !!}
	{!! HTML::liLinkSubNav('account/security/update-password', 'Update Password') !!}
	{!! HTML::liLinkSubNav('account/security/sessions', 'Active Sessions') !!}
</ul>