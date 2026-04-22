@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}" style="padding: 20px 0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td style="text-align: center;">
<a href="{{ $url }}" target="_blank" rel="noopener" style="display: block; width: 100%; padding: 16px 30px; background-color: #10b981; color: #ffffff; text-align: center; text-decoration: none; font-weight: 600; font-size: 18px; border-radius: 8px;">{!! $slot !!}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
