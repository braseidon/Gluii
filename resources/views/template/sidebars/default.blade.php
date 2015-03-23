<ul class="nav" role="menu">
	<li class="padder m-t m-b-sm text-muted text-sm"><span>Feeds</span></li>
	{!! HTML::liLinkSubNav('home', 'News Feed', 'icon icon-globe') !!}
	{!! HTML::liLinkSubNav('feed/families', 'Families', 'icon icon-share') !!}
	{!! HTML::liLinkSubNav('feed/areas', 'Areas', 'icon icon-map') !!}
	{!! HTML::liLinkSubNav('feed/influencers', 'Influences', 'icon icon-star') !!}
	<li class="hidden-folded padder m-t m-b-sm text-muted text-sm"><span>Your Influencers</span></li>
	{!! HTML::liLinkSubNav('influencers', 'Mat Zo', 'icon icon-music-tone-alt') !!}
	{!! HTML::liLinkSubNav('influencers', 'Web Development', 'icon icon-speech') !!}
</ul>