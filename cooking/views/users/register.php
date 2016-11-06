<?php
$register_result = $this->reg_result;

if($register_result) {
    $this->redirectTo('/cooking/users/login');
}
?>


<form method="post" action="/cooking/users/register">
  <label>
    Име:<input type="text" id="name" name='name' required="Полето е задължително!"><br>
    Парола:<input type="password" id="pass" name='password' required="Полето е задължително!"><br>
    Email:<input type="text" id="email" name='email'  required="Полето е задължително!"><br>
    Град:<input type="text" id="location" name='location' ><br>
  </label>
    <button type="submit" value="register">Добави</button>
    <button type="reset">Изчисти</button>
</form>