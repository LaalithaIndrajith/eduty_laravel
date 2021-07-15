@component('mail::message')

## New user account is created for {{ $user->department->depart_name }} 


- User - {{ $user['user_fname'] }} {{ $user['user_lname'] }}
- Created By - {{ $createdBy }} 
- Created Time - {{ $user['user_created_at'] }}


Thanks,<br>
[{{ config('app.name') }}](http://eduty.local)
@endcomponent
