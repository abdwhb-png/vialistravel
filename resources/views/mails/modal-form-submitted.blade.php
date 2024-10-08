<x-mail::message>
# Form request for : {{ $section }}

Someone have submitted a form. Here are the details.

@foreach ($data as $key => $value)
    {{ $key .' : '.$value}}
@endforeach

Sended from,<br>
{{ config('app.name') }}
</x-mail::message>
