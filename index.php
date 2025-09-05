<?php

require_once 'CartManager.php';


// CartManager
$cartManager = new CartManager();

echo "<h1>Simulador de Carrinho de Compras</h1>";
echo "<p>Projeto da disciplina de Design Patterns & Clean Code.</p>";
echo "<hr>";

// Funções auxiliares para exibição
function listCartItems(CartManager $cartManager)
{
    $items = $cartManager->getCartItems();
    if (empty($items)) {
        echo "<p>Seu carrinho está vazio.</p>";
        return;
    }

    echo "<h3>Itens do Carrinho:</h3>";
    echo "<ul>";
    foreach ($items as $item) {
        $product = $cartManager->getProductData($item['id_produto']);
        if ($product) {
            echo "<li>{$product['nome']} - Quantidade: {$item['quantidade']} - Subtotal: R$ " . number_format($item['subtotal'], 2, ',', '.') . "</li>";
        }
    }
    echo "</ul>";
}

function listProductStock(CartManager $cartManager)
{
    $products = $cartManager->getProductsList();
    echo "<h3>Estado Final dos Produtos (Estoque):</h3>";
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li>{$product['nome']}: Estoque restante: {$product['estoque']}</li>";
    }
    echo "</ul>";
}

echo "<h2>Casos de Teste:</h2>";

// Adicionar um produto 
echo "<h3>Caso 1 — Adicionando 2 Camisetas (id=1)</h3>";
$message = $cartManager->addItem(1, 2);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
listCartItems($cartManager);
echo "<hr>";

// Tentar adicionar além do estoque
echo "<h3>Caso 2 — Tentando adicionar 10 Tênis (id=3)</h3>";
$message = $cartManager->addItem(3, 10);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
listCartItems($cartManager);
echo "<hr>";

// Remover produto do carrinho
echo "<h3>Caso 3 — Removendo Calça Jeans (id=2)</h3>";
$cartManager->addItem(2, 1);
listCartItems($cartManager);
$message = $cartManager->removeItem(2);
echo "<p>Resultado: " . htmlspecialchars($message) . "</p>";
listCartItems($cartManager);
echo "<hr>";

// Aplicação de desconto
echo "<h3>Caso 4 — Aplicando cupom de desconto 'DESCONTO10'</h3>";
$cartManager->addItem(1, 1);
$cartManager->addItem(4, 3);
listCartItems($cartManager);

$totals = $cartManager->calculateTotal('DESCONTO10');
echo "<ul>";
echo "<li>Subtotal: R$ " . number_format($totals['subtotal'], 2, ',', '.') . "</li>";
echo "<li>Desconto: R$ " . number_format($totals['discount'], 2, ',', '.') . "</li>";
echo "<li>Total Final: R$ " . number_format($totals['total'], 2, ',', '.') . "</li>";
echo "</ul>";
echo "<hr>";

echo "<h3>Estado Final do Carrinho:</h3>";
listCartItems($cartManager);

listProductStock($cartManager);

?>
