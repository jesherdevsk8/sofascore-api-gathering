### Cálculo Simples em PHP para Converter Odds Fracionárias em Decimais

Abaixo está um exemplo de código PHP que converte odds fracionárias no formato fornecido para odds decimais:

#### Código PHP:

```php
<?php
// Dados das odds no formato fracionário
$fullTimeOdds = [
    ["fractionalValue" => "2/7", "name" => "1"],  // Vitória do time da casa
    ["fractionalValue" => "15/4", "name" => "X"], // Empate
    ["fractionalValue" => "14/1", "name" => "2"], // Vitória do time visitante
];

// Função para converter odds fracionárias para decimais
function fractionalToDecimal($fractionalValue) {
    // Divide a string no formato "numerador/denominador"
    list($numerator, $denominator) = explode('/', $fractionalValue);
    // Calcula as odds decimais
    return round(($numerator / $denominator) + 1, 2);
}

// Converte as odds fracionárias para decimais
$convertedOdds = [];
foreach ($fullTimeOdds as $odd) {
    $decimalValue = fractionalToDecimal($odd["fractionalValue"]);
    $convertedOdds[] = [
        "name" => $odd["name"],
        "decimalValue" => $decimalValue
    ];
}

// Exibe os resultados
echo "Odds convertidas para o formato decimal:\n";
foreach ($convertedOdds as $odd) {
    echo "Resultado: " . $odd["name"] . ", Odds Decimais: " . $odd["decimalValue"] . "\n";
}
?>
```

#### Saída do Código:
Com os dados fornecidos:
```
Odds convertidas para o formato decimal:
Resultado: 1, Odds Decimais: 1.29
Resultado: X, Odds Decimais: 4.75
Resultado: 2, Odds Decimais: 15.00
```

---

### Documentação: Como Calcular Odds Decimais a Partir de Odds Fracionárias

#### Fórmula de Conversão
A fórmula básica para converter odds fracionárias para o formato decimal é:

**Odds Decimais = (Numerador ÷ Denominador) + 1**

#### Passo a Passo:
1. **Identificar o Numerador e o Denominador**:
   - O formato fracionário é fornecido como `"numerador/denominador"`.
   - Exemplo: Para `"3/4"`, o numerador é `3` e o denominador é `4`.

2. **Dividir o Numerador pelo Denominador**:
   - No exemplo `"3/4"`, divida `3 ÷ 4 = 0.75`.

3. **Somar 1 ao Resultado**:
   - Adicione `1` ao valor calculado: `0.75 + 1 = 1.75`.

4. **Arredondar o Resultado (opcional)**:
   - Dependendo do contexto, arredonde o resultado para 2 casas decimais.

#### Exemplo:
Para a odd `"3/4"`:
- **Numerador**: 3
- **Denominador**: 4
- **Cálculo**: (3 ÷ 4) + 1 = **1.75**

---

### Exemplo Prático com os Dados da API
Para os dados:
```json
"choices": [
    {"fractionalValue": "2/7", "name": "1"},
    {"fractionalValue": "15/4", "name": "X"},
    {"fractionalValue": "14/1", "name": "2"}
]
```
As odds convertidas seriam:
- **"1"**: (2 ÷ 7) + 1 = **1.29**
- **"X"**: (15 ÷ 4) + 1 = **4.75**
- **"2"**: (14 ÷ 1) + 1 = **15.00**

---
