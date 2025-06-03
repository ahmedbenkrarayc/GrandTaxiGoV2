<!DOCTYPE html>
<html>
<head>
    <title>Reservation Accepted</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>Your reservation {{ $reservation }} has been accepted on {{ $currentDate }}.</p>
    <p>Scan the QR Code below for details:</p>
    <p>Here is your QR code:</p>
    <div>
        <span style="display:block; width: 200px; height: 200px; background: url('data:image/png;base64,{{ $qrcode }}') no-repeat center center; background-size: contain;"></span>
    </div>

</body>
</html>
