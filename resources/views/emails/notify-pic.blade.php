<h2>Hi {{ $order->picUser->name }},</h2>

<p>You have been assigned a new Work Order:</p>

<ul>
    <li><strong>Title:</strong> {{ $order->title }}</li>
    <li><strong>Description:</strong> {{ $order->description }}</li>
    <li><strong>Due Date:</strong> {{ $order->due_date }}</li>
</ul>

<p>Please check the system for further details.</p>

<p>Regards,<br>Work Order System</p>
