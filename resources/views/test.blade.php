<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="get" action="/asd" enctype="multipart/form-data">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="password" >
    <label>
        <input type="checkbox" name="permissions[]" value="create_users"> اضافة                                                </label>
    <label>
        <input type="checkbox" name="permissions[]" value="update_users"> تعديل                                                </label>
    <label>
        <input type="checkbox" name="permissions[]" value="delete_users"> حذف                                                </label>
    <label>
        <input type="checkbox" name="permissions[]" value="read_users">
        <input type="submit">
</form>
</body>
</html>