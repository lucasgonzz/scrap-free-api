<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://api.scrapfree.com.ar/public/storage/logo.png" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
