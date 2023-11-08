<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat bot</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <form action= "{{ route('send-messenger') }}" method="post" class="form_create">
            @csrf
            <div style="display: block;">
                <label for="content">Content</label>
                <input type="text" name="content" class="content-input" placeholder="content">
            </div>
            <div>
                <label for="msg_type">MSG_type</label>
                <input type="text" name="msg_type" placeholder="msg_type" class="msg_type">
            </div>
            <input type="hidden" name="receive_id" id="" value="oc_ac799fa82a786377def428a034080170">
            <div>
                <h5>Click button to send messenger chatbot</h5>
                <button type="button" class="btn-save">Click me</button>
            </div>
        </form>
    </div>

    <script>
        $(document).on('click', '.btn-save', function() {
                let form = $('form.form_create');
                let url = form.attr('action');
                $.ajax({
                    url: `${url}`,
                    type: "POST",
                    data: form.serialize(),
                    cache: false,
                    success: function(data) {
                        $(".content-input").val('')
                        $(".msg_type").val('')
                    }                      
                });
            });

    </script>
</body>
</html>