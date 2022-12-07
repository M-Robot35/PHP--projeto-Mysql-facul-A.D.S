<?php


class TabelaPessoas{
    private string $root= "localhost";
    private string $user= "root";
    private string $password= "";
    private string $dbname= "usuario";
    private string $port = '3306';
    
    private function pdo(){
        return new PDO("mysql:root=$this->root;dbname=" . $this->dbname, $this->user, $this->password);
    }

    public function criarTabela(){

        $query = "
            CREATE TABLE IF NOT EXISTS pessoas(
            id INT PRIMARY KEY  AUTO_INCREMENT, 
            nome VARCHAR(200) NOT NULL, 
            login VARCHAR(200) NOT NULL, 
            senha VARCHAR(200) NOT NULL, 
            create_data DATETIME);            
        ";
        
        $this->pdo()->exec($query);     
        echo "ok";
        
    }

    // @ ALIMENTAR TABELA
    public function inserirTable(){
        // @teste
        $nome = "zebra";
        $login = "paginalogin";
        $senha = "12346579";        
        
        $query = "
        INSERT INTO pessoas(nome , login , senha, create_data) VALUES(:nome, :login, :senha, NOW());            
        ";
        
        $inserir_usuario = $this->pdo()->prepare($query);
        $inserir_usuario->bindParam(":nome", $nome , PDO::PARAM_STR);
        $inserir_usuario->bindParam(":login", $login , PDO::PARAM_STR);
        $inserir_usuario->bindParam(":senha", $senha , PDO::PARAM_STR);

        $inserir_usuario->execute();

        echo "<br>" . "<h1>Executado com sucesso</h1>";

    }
    
    // SELECIONAR USUARIO
    function selecId(){
        // entrada de parametros int id
        $id = 1;

        $query = "
            SELECT * FROM pessoas WHERE id=:id LIMIT 1;
        ";
        
        $usuario = $this->pdo()->prepare($query);
        $usuario->bindParam(":id", $id, PDO::PARAM_INT);
        $usuario->execute();
        $row_usuario = $usuario->fetchAll(PDO::FETCH_ASSOC);
        

        echo "<br>" . "<h1>Selecionado user</h1>";
        print_r($row_usuario);

    }

    // SELECIONAR USUARIO
    function selecAll(){
        $query = "
            SELECT * FROM pessoas ORDER BY nome ASC;
        ";
        
        $usuario = $this->pdo()->prepare($query);
        $usuario->execute();
        $row_usuario = $usuario->fetchAll(PDO::FETCH_ASSOC);
        
        // return $row_usuario;

        // @teste tabela
        foreach ($row_usuario as $key =>$value) {
            echo "ID -" . $key . "<br>";
            echo  $value['nome'] . "<br>";
            echo $value['login'] . "<br>";
            echo $value['senha'] . "<br>";
            echo "<hr>";
        }

        
        echo "<br>" . "<h1>função para selecionar todos</h1>";

    }
}


$dados = new TabelaPessoas;

// $dados->criarTabela();
// $dados->inserirTable();
// $dados->selecId();
$dados->selecAll();







