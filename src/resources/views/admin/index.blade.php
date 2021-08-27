<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>管理者ログイン画面</h1>
    <form>
    @csrf 
    <label for="id">ID</label><br>
    <input type="text" name="id" id="id"><br>
    <label for="password">パスワード</label><br>
    <input type="text" name="password" id="password"><br><br>
    <input type="button" value="ログイン">
    </form>
</body>
</html>