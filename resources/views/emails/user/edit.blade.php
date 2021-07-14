@component('mail::message')

## Details of a User Account belongs to {{ $user->department->depart_name }} is Updated 


- User Account Name - {{ $user['username'] }} 
- Updated By - {{ $updatedBy }} 
- Updated Time - {{ $user['user_updated_at'] }}


Thanks,<br>
[{{ config('app.name') }}](http://eduty.local)
@endcomponent
