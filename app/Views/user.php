<?php




 $this->layout('master', ['title' => $title]) ?>

<h1>User </h1>
<?php echo flash('created', )?>


<form action="/user/update" method="post">
    <?php echo flash('firstName')?>
    <input type="text" name="firstName" value="vitor">

    <?php echo flash('lastName')?>
    <input type="text" name="lastName" value="lima">

    <?php echo getToken();?>

    <?php echo flash('email')?>
    <input type="text" name="email" value="vitorbarbosalima42@gmail.com">
    
    <?php echo flash('password')?>
    <input type="password" name="password" value="1234">

    <button type="submit">Atualizar</button>


</form>