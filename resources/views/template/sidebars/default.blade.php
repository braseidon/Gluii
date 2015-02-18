<ul class="nav" role="menu">
	<li class="padder m-t m-b-sm text-muted text-sm"><span>Feeds</span></li>
	{!! HTML::liLinkSubNav('home', 'News Feed', 'icon icon-book-open') !!}
	{!! HTML::liLinkSubNav('feed/families', 'Families', 'icon icon-book-open') !!}
	{!! HTML::liLinkSubNav('feed/influences', 'Influences', 'icon icon-book-open') !!}
	<li class="hidden-folded padder m-t m-b-sm text-muted text-sm"><span>Your Influencers</span></li>
	{!! HTML::liLinkSubNav('influences', 'Mat Zo', 'icon icon-music-tone-alt') !!}
	{!! HTML::liLinkSubNav('influences', 'Web Development', 'icon icon-speech') !!}
</ul>