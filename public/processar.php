<?php

  try{

    // Conectar ao SQLite
    $db = new PDO('sqlite:/app/public/db_sitepoketrunfo.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar tabela se não existir
    $db->exec("CREATE TABLE IF NOT EXISTS assinaturas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL,
        telefone TEXT NOT NULL,
        forma_pagamento TEXT NOT NULL,
        plano TEXT NOT NULL,
        preco REAL NOT NULL
    )");

    // Inserir dados no banco
    $stmt = $db->prepare("INSERT INTO assinaturas (nome, email, telefone, forma_pagamento, plano, preco) 
      VALUES (:nome, :email, :telefone, :forma_pagamento, :plano, :preco)");
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':telefone', $_POST['telefone']);
    $stmt->bindParam(':forma_pagamento', $_POST['forma_pagamento']);
    $stmt->bindParam(':plano', $_POST['plano']);
    $stmt->bindParam(':preco', $_POST['preco']);
    $stmt->execute();

    if ($_POST['plano'] === 'Personalizado') {
      echo "<script>
              alert('Solicitação registrada com sucesso!');
              window.location.href = 'index.html';
            </script>";
    } else {
          echo "<script>
                  alert('Assinatura registrada com sucesso!');
                  window.location.href = 'index.html';
                </script>";
    }

  } catch (Exception $e) {
      // Exibir mensagem de erro
      echo "<script>
              alert('Erro ao registrar a assinatura: " . $e->getMessage() . "');
              window.location.href = 'contato.html';
            </script>";
  }

?>