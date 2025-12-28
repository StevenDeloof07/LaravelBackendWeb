<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>
    Uw vraag {{  $data['question'] }}<br> 
    is beantwoord door {{ $data['sender'] }}

    <div>
        Van: {{ $data['sender_mail'] }}
        
        <br>

        <div>
            {{ $data['anwser'] }}
        </div>
    </div>
</body>
</html>