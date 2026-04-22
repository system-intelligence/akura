@props(['url' => null])
<tr>
<td class="header" style="padding: 0; text-align: center; width: 100%;">
<a href="{{ $url ?? config('app.url') }}" style="display: block;">
<img src="https://i.postimg.cc/Gtx33RW1/Twitter-header-1.jpg" alt="{{ config('app.name') }}" style="width: 100%; max-width: 650px; height: auto; display: block; margin: 0 auto;">
</a>
</td>
</tr>
