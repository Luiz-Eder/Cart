# Simulador de Carrinho de Compras  

Projeto da disciplina **Design Patterns & Clean Code**.  
Implementação em **PHP puro**, aplicando **PSR-12, KISS e DRY**, para simular um carrinho de compras básico de e-commerce.  

---

## Alunos  
- Poliana Rodriguez - 2000444  
- Eder Luiz - 1971959 

---

## Como rodar o projeto  

Clone este repositório ou baixe os arquivos.
git clone https://github.com/Luiz-Eder/Cart.git

Copie a pasta para o diretório htdocs do XAMPP:
C:\xampp\htdocs\carrinho

Inicie o servidor Apache pelo XAMPP.

Acesse no navegador:
http://localhost/carrinho/public/index.php

---

## Funcionalidades Implementadas

Adicionar item ao carrinho

Remover item do carrinho

Listar itens do carrinho

Calcular total

Aplicar desconto com cupom DESCONTO10

---

Exemplos de Uso (Casos de Teste)

Caso 1 — Usuário adiciona um produto válido
Entrada: produto id=1, quantidade=2
Saída esperada:
Sucesso: 'Camiseta' adicionado ao carrinho.
Itens no carrinho: Camiseta - Quantidade: 2 - Subtotal: R$ 119,80

Caso 2 — Usuário tenta adicionar além do estoque
Entrada: produto id=3, quantidade=10
Saída esperada:
Erro: Estoque insuficiente para o produto 'Tênis'.

Caso 3 — Usuário remove produto do carrinho
Entrada: produto id=2 (Calça Jeans)
Saída esperada:
Sucesso: 'Calça Jeans' removido do carrinho.

Caso 4 — Aplicação de cupom de desconto
Entrada: cupom DESCONTO10
Saída esperada:
Subtotal: R$ XXX,XX
Desconto: R$ XX,XX
Total Final: R$ XXX,XX

---

## Regras de Negócio

O estoque é atualizado automaticamente ao adicionar ou remover produtos.

O cupom válido é DESCONTO10, que aplica 10% de desconto no total.

Não é permitido adicionar quantidade menor ou igual a zero.

Mensagens de erro informam quando não há estoque suficiente ou quando o produto não existe.


## Limitações
Não há persistência de dados (uso apenas de arrays em memória).

Não há sistema de login/usuário.

Não há formulários ou inputs dinâmicos (valores definidos no código).

Projeto em PHP puro (sem frameworks).
