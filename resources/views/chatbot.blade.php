<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat bot</title>
</head>
<body>
    <div>
        <form action= "/api/send-message" method="post">
            @csrf
            <input type="text" name="content">
            <input type="hidden" name="msg_type" value="text">
            <input type="hidden" name="receive_id" id="" value="oc_ac799fa82a786377def428a034080170">
            <div>
                <h5>Click button to send messenger chatbot</h5>
                <button type="submit">Click me</button>
            </div>
        </form>
    </div>
</body>
</html>