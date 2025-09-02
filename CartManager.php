<?php

// src/CartManager.php

class CartManager
{
    private array $products;
    private array $cartItems = [];

    public function __construct()
    {
        // Define a lista de produtos no construtor
        $this->products = [
            ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
            ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
            ['id' => 4, 'nome' => 'Relógio Digital', 'preco' => 89.90, 'estoque' => 15],
        ];
    }
    
    // Método auxiliar para buscar um produto
    private function getProductById(int $id): ?array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $id) {
                return $product;
            }
        }
        return null;
    }

    // Método auxiliar para atualizar o estoque
    private function updateProductStock(int $id, int $quantity)
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $id) {
                $product['estoque'] += $quantity;
                return;
            }
        }
    }

    public function addItem(int $productId, int $quantity): string
    {
        $product = $this->getProductById($productId);
        
        if ($product === null) {
            return "Erro: Produto não encontrado.";
        }
        
        if ($quantity <= 0) {
            return "Erro: A quantidade deve ser maior que zero.";
        }
        
        if ($product['estoque'] < $quantity) {
            return "Erro: Estoque insuficiente para o produto '{$product['nome']}'.";
        }

        $subtotal = $product['preco'] * $quantity;

        if (isset($this->cartItems[$productId])) {
            $this->cartItems[$productId]['quantidade'] += $quantity;
            $this->cartItems[$productId]['subtotal'] += $subtotal;
        } else {
            $this->cartItems[$productId] = [
                'id_produto' => $productId,
                'quantidade' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        $this->updateProductStock($productId, -$quantity);
        return "Sucesso: '{$product['nome']}' adicionado ao carrinho.";
    }

    public function removeItem(int $productId): string
    {
        if (!isset($this->cartItems[$productId])) {
            return "Erro: Item não encontrado no carrinho.";
        }

        $itemQuantity = $this->cartItems[$productId]['quantidade'];
        unset($this->cartItems[$productId]);
        
        $this->updateProductStock($productId, $itemQuantity);
        
        $product = $this->getProductById($productId);
        return "Sucesso: '{$product['nome']}' removido do carrinho.";
    }

    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function getProductData(int $productId): ?array
    {
        return $this->getProductById($productId);
    }

    public function getProductsList(): array
    {
        return $this->products;
    }

    public function calculateTotal(?string $coupon = null): array
    {
        $subtotal = 0;
        foreach ($this->cartItems as $item) {
            $subtotal += $item['subtotal'];
        }

        $discount = 0;
        if ($coupon === 'DESCONTO10') {
            $discount = $subtotal * 0.10;
        }

        $total = $subtotal - $discount;
        
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];
    }
}