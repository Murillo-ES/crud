<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Carrinho</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        strong {
            color: #000;
        }
        .total {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Relatório de Carrinho</h2>
    
    <h3>Itens no Carrinho</h3>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartCollection as $item)
                <tr>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->attributes->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>R$ {{ number_format($item->getPriceSum(), 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p class="total"><strong>Valor total da compra:</strong> R$ {{ number_format(Cart::getTotal(), 2, ',', '.') }}</p>
    
    <div class="footer">
        Relatório gerado em {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>
