<h1>New traveler inquiry</h1>

<p>You received a direct inquiry for <strong>{{ $listing->title }}</strong>.</p>

<dl>
    <dt>Guest</dt>
    <dd>{{ $lead->guest_name }}</dd>

    <dt>Email</dt>
    <dd><a href="mailto:{{ $lead->guest_email }}">{{ $lead->guest_email }}</a></dd>

    @if($lead->guest_phone)
        <dt>Phone</dt>
        <dd>{{ $lead->guest_phone }}</dd>
    @endif

    @if($lead->travel_date)
        <dt>Travel date</dt>
        <dd>{{ $lead->travel_date->toDateString() }}</dd>
    @endif

    <dt>Guests</dt>
    <dd>{{ $lead->guests_count }}</dd>

    <dt>Message</dt>
    <dd>{{ $lead->message }}</dd>
</dl>

<p>Reply to this email to contact the guest.</p>
