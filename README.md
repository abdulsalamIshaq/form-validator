# Simple Form validator library 
You are to note this project is an open source project incase there is an issue and i was unable to respose quickly, try your best to contribute and fix the issue.
## Documentation 
This project has not beeen publish to packagis yet.
### INSTALLATION
```
$  composer install
```
this library has the following methods and property
```PHP
use FormValidator\Form;

$validator = new form($_POST);
//validate methods: this is the method were you will be setting your validation rules
$validator->validate([]);
//passed methods: this methods will be use to check if each input passed the validation rules
$validator->passed();
//errors property: this property will be use to output all errors
$validator->errors[];
//errors property is the only available property
```

### SETTING VALIDATION RULES FOR FORM
the ```$validator->validate([])``` method is use for setting validation rules example:
```PHP
<?php
use FormValidator\Form;

$validator = new form($_POST);
//check if the request methid is post
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $validator->validate([
        'first_name' => 'required|string|min|3',
        'last_name' => 'required|string|min|3',
        'github_link' => 'required|url',
    ]);
}
?>
```
and the form will look like
```PHP
<form action='' method='POST'>
    <input type='text' name='first_name'><br>
    <input type='text' name='last_name'>
    <input type='text' name='github_link'>
        
    <button type='submit' name="submit">submit</button>
</form>
```
### OUTPUTING ERRORS
to output form errors use the ```$validator->errors``` property
```PHP
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
```
looping through errors
```PHP
<form action='' method='POST'>
    <?php 
        foreach($validator->errors as $error)
        {
            echo '<p>'.$error.'</p>';
        }
    ?>
    <input type='text' name='first_name'><br>
    <input type='text' name='last_name'>
    <input type='text' name='github_link'><br>
        
    <button type='submit' name="submit">submit</button>
</form>
```
### HOW TO USE MIN AND MAX VALIDATION RULES
To use the ```min``` or ```max``` validation rules the next value must be the value for min or max
```PHP
    $validator->validate([
        'minimum' => 'min|3',
        'maximum' => 'max|6',
    ]);
```
### PASSED
To check if each form passed validation rules use the ```$validator->passed()``` method
```PHP
if($validator->passed()){
    echo 'submited sucessfully';
}
```
### ALL AVAILABLE VALIDATION RULES
These are all the list of available validation rules
1. ```required```   => validate empty field
2. ```string```     => validate a string
3. ```email```      => validate an email
4. ```url```        => validate a url
5. ```numeric```    => validate a mumeric
6. ```int```        => validate an integer
7. ```float```      => validate an float
8. ```min```        => validate minimum value of an input field
9. ```min```        => validate maximum value of an input field

This is an Open Source proect, you can contribute and add more validation rules

