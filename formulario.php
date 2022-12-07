<?php   
   session_start();
    
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $arquivo = $_FILES['file'];
    
    if(!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($password)){

        if((!empty($arquivo['name'])) && (!empty($nome))){
            // cria o caminho caso não tenha, e insere a imagem no diretorio
    
            $pasta = "./download";
            $pastaId = "/$nome";
            $arquivoName = "/{$arquivo['name']}";
    
            (!is_dir($pasta))? mkdir($pasta, 0755): "";
            (!is_dir($pasta . $pastaId))? mkdir($pasta . $pastaId, 0755): "";
            
            move_uploaded_file($arquivo["tmp_name"], $pasta . $pastaId . $arquivoName); 
            $_SESSION['cadastro'] = ' CADASTRADO COM SUCESO !!! ';
            
            // @ Redirecionar o cliente
            header("Locatrion: path");
            
        }
    }

    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Formulario PHP</title>
</head>

<body>
<form id='form-data' action="" method="POST" enctype="multipart/form-data">
    <div>
        <label for="nome">Nome: </label>
        <input id="nome" name="nome" placeholder="Digite seu nome" type="text" required>        
    </div>

    <div>
        <label for="sobrenome">Sobrenome: </label>
        <input id="sobrenome" name='sobrenome'placeholder="Digite seu nome" type="text" required>        
    </div>

    <div>
        <label for="email">E-mail: </label>
        <input id="email" name='email' placeholder="Digite seu nome" type="email" required >             
    </div>

    <div>
        <label for="password">Password: </label>
        <input id="password" name='password' placeholder="Digite seu nome" type="password" required>        
    </div>
    <div>
        <label for="arquivo">Sua foto: </label>
        <input id="arquivo" name='file' placeholder="Digite seu nome" type="file" >        
    </div>

    <?php if($_SESSION['cadastro']){
            echo $_SESSION['cadastro'];
            unset($_SESSION['cadastro']);           
        }

        ?>
    <input type="submit" value="Entrar">
</form>
    
</body>
</html>


