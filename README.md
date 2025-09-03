# Cadastro de Produtos - 
Sistema completo para cadastro, consulta, edição e exclusão de produtos, com design moderno inspirado no Homem-Aranha, utilizando PHP, MySQL e PDO.

---

## 🚀 Funcionalidades

- Cadastro de produtos com nome, descrição, preço e quantidade
- Listagem completa com total em dinheiro por produto e total geral do estoque
- Edição e exclusão de produtos
- Busca por nome ou descrição
- Design dark premium com tema Homem-Aranha
- Animações suaves e efeitos visuais com confetes temáticos no cadastro

---

## 🛠 Tecnologias Utilizadas

- PHP 8+
- MySQL
- PDO para acesso seguro ao banco de dados
- Bootstrap 5 para layout responsivo
- Font Awesome para ícones
- Animate.css para animações
- Canvas Confetti para efeitos visuais

---

## 📁 Estrutura do Projeto

produtos-php/
│── cadastro.php # Página para cadastrar produtos
│── consulta.php # Listagem e gerenciamento de produtos
│── editar.php # Edição de produtos
│── deletar.php # Exclusão de produtos
│── procurar.php # Busca de produtos
│── includes/
│ ├── header.php # Cabeçalho com tema Homem-Aranha
│ └── footer.php # Rodapé
│── config/
│ └── Database.php # Configuração da conexão com banco
│── models/
│ └── Produto.php # Classe Produto com métodos CRUD
│── assets/
│ ├── img/ # Imagens (ex: fundo, logos)
│ └── video/ # Vídeos para background animado (opcional)
│── .gitignore # Arquivos ignorados pelo Git
│── README.md # Este arquivo