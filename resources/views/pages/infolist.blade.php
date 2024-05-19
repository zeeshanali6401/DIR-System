<div>
    <p>Time: {{ date('H:i:s') }}</p>
    <p>Date: {{ date('d-m-Y') }}</p>
    @php
        $currentTime = date('H:i');
        if ($currentTime >= '06:00' && $currentTime <= '13:59') {
            $shift = 'A';
        } elseif ($currentTime >= '14:00' && $currentTime <= '21:59') {
            $shift = 'B';
        } else {
            $shift = 'C';
        }
        $systemIp = request()->server('SERVER_ADDR') ?? 'IP not available';

    @endphp
    <p>Shift: {{ $shift }}</p>
    <p>System Name: {{ trim(`hostname`) }}</p>
    <p>System IP: {{ gethostbyname(trim(`hostname`)) }}</p>
    <p>User: {{ auth()->user()->name }}</p>
</div>
