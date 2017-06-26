@component('mail::message')
# Hello,

<?php $event = "";?>
This is the Report for Virtual Expo Event

@component('mail::table')
| #     | User       | Company  | Stand      | Price    |
| ----- |:----------:| --------:|:----------:| -------- |
@foreach($bookins as $bookin)
@if($event != $bookin->event->name)
| {{$bookin->event->name}} | <?php $event = $bookin->event->name;?>
@endif
| {{$bookin->id}} | {{$bookin->user->name}}  | {{$bookin->user->company->name}}  | {{$bookin->stand->name}} | $ {{$bookin->stand->price}}  |
@endforeach

@endcomponent

Thanks
@endcomponent