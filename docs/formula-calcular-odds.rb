# frozen_string_literal: true

# No formato fracionário 3/4:
# Numerador = 3
# Denominador = 4
# Odds Decimais = (3 ÷ 4) + 1 = 1.75
# em ruby
# ((2.0 / 7.0) + 1).round(2) = 1.29

# Dados das odds no formato fracionário
full_time_odds = [
  { fractional_value: '2/7', name: '1' }, # Vitória do time da casa
  { fractional_value: '15/4', name: 'X' }, # Empate
  { fractional_value: '14/1', name: '2' }  # Vitória do time visitante
]

# Função para converter odds fracionárias para decimais
def fractional_to_decimal(fractional_value)
  numerator, denominator = fractional_value.split('/').map(&:to_f)
  ((numerator / denominator) + 1).round(2)
end

# Converte as odds fracionárias para decimais
converted_odds = full_time_odds.map do |odd|
  decimal_value = fractional_to_decimal(odd[:fractional_value])
  { name: odd[:name], decimal_value: decimal_value }
end

# Exibe os resultados
puts 'Odds convertidas para o formato decimal:'
converted_odds.each do |odd|
  puts "Resultado: #{odd[:name]}, Odds Decimais: #{odd[:decimal_value]}"
end
