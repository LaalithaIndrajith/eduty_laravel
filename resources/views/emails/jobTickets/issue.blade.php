@component('mail::message')
# Job ticket is issued regarding your requirement.

- Job Ticket no - {{ $jobTicketDetails }}
- Requirement - {{ $taskflow['task_flow_name'] }}

If you have any issues regarding your requirement, You can use above job ticket as reference.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
