<x-mail::message>
# Email delivery report

<strong>Passed:</strong>
@foreach ($passed as $pass)
	<div style="color:#0f6848">{{ $pass }}</div>
@endforeach


<strong>Failed:</strong>
@foreach ($failed as $fail)
	<div style="color:#dc3545">{{ $fail }}</div>
@endforeach


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
