@component('mail::message')
# Introduction

@foreach($mensaje as $parrafo)
<p>
	{{ $parrafo }}
</p>
@endforeach


Muchas gracias,<br>
{{ config('app.name') }}
@endcomponent
