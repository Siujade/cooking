<form method="post" action="/cooking/articles/create" enctype="multipart/form-data">
    <label>
Заглавие:<input type="text" id="title" name='title' placeholder="Добави заглавие.." required="Полето е задължително!"><br>
Тагове:<input type="text" id="tags" name='tags' placeholder="Добави тагове.."><br>
Снимка: <input type="file" name="image" id="image">
Съдържание:<textarea id="text" name="content"></textarea>
    </label>
    <button type="submit" value="create">Добави</button>
    <button type="reset">Изчисти</button>
</form>
