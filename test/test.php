<?php
    require_once __DIR__.'/../vendor/autoload.php';

    use FormValidator\Form;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORM VALIDATOR</title>
</head>
<body>
    <?php
    $validator = new Form($_POST);
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $validator->validate([
            'first_name' => 'required|string|min|3',
            'last_name' => 'required|string|min|3',
            'github_link' => 'required|url',
        ]);
    }
    ?>
    <!--
    <form action='' method='POST'>
        <?php 
        /*
            foreach($validator->errors as $error)
            {
                echo '<p>'.$error.'</p>';
            }
        */
        ?>
        <input type='text' name='first_name'><br>
        <input type='text' name='last_name'>
        <input type='text' name='github_link'><br>
            
        <button type='submit' name="submit">submit</button>
    </form>
    -->

    <form action='' method='POST'>
        <?php 
            if($validator->errors['first_name'])
                echo '<p>'.$validator->errors['first_name'].'</p>'; 
        ?>
        <input type='text' name='first_name'><br>

        <?php 
            if($validator->errors['last_name'])
                echo '<p>'.$validator->errors['last_name'].'</p>'; 
        ?>
        <input type='text' name='last_name'>

        <?php 
            if($validator->errors['github_link'])
                echo '<p>'.$validator->errors['github_link'].'</p>'; 
        ?>
        <input type='text' name='github_link'><br>
            
        <button type='submit' name="submit">submit</button>
    </form>
    <?php
    if($validator->passed()){
        echo 'submited sucessfully';
    }
    ?>
</body>
</html>
