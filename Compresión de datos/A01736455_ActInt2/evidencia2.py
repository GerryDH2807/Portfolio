import heapq
from collections import defaultdict
import time
from heapq import heappop, heappush
from ast import literal_eval

#Inicio de funciones para SA-IS del código base
def getBuckets(T):
  count = {}
  buckets = {}
  for c in T:
    count[c] = count.get(c, 0) + 1
  start = 0
  for c in sorted(count.keys()):
    buckets[c] = (start, start + count[c])
    start += count[c]
  return buckets
def sais(T):
  t = ["_"] * len(T)

  t[len(T) - 1] = "S"
  for i in range(len(T) - 1, 0, -1):
    if T[i - 1] == T[i]:
      t[i - 1] = t[i]
    else:
      t[i - 1] = "S" if T[i - 1] < T[i] else "L"

  buckets = getBuckets(T)

  count = {}
  SA = [-1] * len(T)
  LMS = {}
  end = None
  for i in range(len(T) - 1, 0, -1):
    if t[i] == "S" and t[i - 1] == "L":
      revoffset = count[T[i]] = count.get(T[i], 0) + 1
      SA[buckets[T[i]][1] - revoffset] = i
      if end is not None:
        LMS[i] = end
      end = i

  LMS[len(T) - 1] = len(T) - 1
  count = {}
  for i in range(len(T)):
    if SA[i] >= 0:
      if t[SA[i] - 1] == "L":
        symbol = T[SA[i] - 1]
        offset = count.get(symbol, 0)
        SA[buckets[symbol][0] + offset] = SA[i] - 1
        count[symbol] = offset + 1

  count = {}
  for i in range(len(T) - 1, 0, -1):
    if SA[i] > 0:
      if t[SA[i] - 1] == "S":
        symbol = T[SA[i] - 1]
        revoffset = count[symbol] = count.get(symbol, 0) + 1
        SA[buckets[symbol][1] - revoffset] = SA[i] - 1

  namesp = [-1] * len(T)
  name = 0
  prev = None
  for i in range(len(SA)):
    if t[SA[i]] == "S" and t[SA[i] - 1] == "L":
        LMS_end = LMS.get(SA[i], len(T) - 1)
        LMS_prev_end = LMS.get(SA[prev], len(T) - 1) if prev is not None else len(T) - 1
        if prev is not None and T[SA[prev]:LMS_prev_end] != T[SA[i]:LMS_end]:
            name += 1
        prev = i
        namesp[SA[i]] = name


  names = []
  SApIdx = []
  for i in range(len(T)):
    if namesp[i] != -1:
      names.append(namesp[i])
      SApIdx.append(i)

  if name < len(names) - 1:
    names = sais(names)

  names = list(reversed(names))

  SA = [-1] * len(T)
  count = {}
  for i in range(len(names)):
    pos = SApIdx[names[i]]
    revoffset = count[T[pos]] = count.get(T[pos], 0) + 1
    SA[buckets[T[pos]][1] - revoffset] = pos

  count = {}
  for i in range(len(T)):
    if SA[i] >= 0:
      if t[SA[i] - 1] == "L":
        symbol = T[SA[i] - 1]
        offset = count.get(symbol, 0)
        SA[buckets[symbol][0] + offset] = SA[i] - 1
        count[symbol] = offset + 1

  count = {}
  for i in range(len(T) - 1, 0, -1):
    if SA[i] > 0:
      if t[SA[i] - 1] == "S":
        symbol = T[SA[i] - 1]
        revoffset = count[symbol] = count.get(symbol, 0) + 1
        SA[buckets[symbol][1] - revoffset] = SA[i] - 1

  return SA
#Final de funciones para SA-IS del código base

#------------- E2. A C T I V I D A D    I N T E G R A D O R A 2 -------------

# Función para medir el tiempo de ejecución de cada función
def measure_execution_time(func, *args, **kwargs):
    start_time = time.time()
    result = func(*args, **kwargs)
    end_time = time.time()
    execution_time = end_time - start_time
    return result, execution_time


# Función que lee el contenido de un archivo y devuelve una lista con los caracteres convertidos
def read_file(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        content = list(file.read())  # Leer y convertir a lista de caracteres
        return content
    
# NOTA: Todas las funciones ya cuentan con la función necesaria para el calculo del tiempo de ejecución

# 1. Lectura del archivo de texto y conversión de caracteres 
file_path = "test.txt"
T, execution_time = measure_execution_time(read_file, file_path)
with open("1_contenido_archivo.txt", 'w', encoding='utf-8') as file:
    file.write("".join(T))  # Junta la conversión de caracteres en un solo archivo
print("Tiempo de ejecución de la función read_file:", execution_time)

# 2. Guardado del resultado de la función SA-IS 
SA, execution_time = measure_execution_time(sais, T)
with open("2_suffix_array.txt", 'w', encoding='utf-8') as file:
    file.write(" ".join(map(str, SA)))
print("Tiempo de ejecución de la función sais:", execution_time)

# 3. Obtención y guardado del resultado del BWT en un archivo 
bwt, execution_time = measure_execution_time(lambda T: ['_'] * len(T), T)
for i in range(len(T)):
    bwt[i] = T[SA[i] - 1] 

with open("3_burrows_wheeler.txt", 'w', encoding='utf-8') as file:
    file.write("".join(bwt))
print("Tiempo de ejecución de la generación de Burrows Wheeler:", execution_time)

# 4. Crear alfabeto usado apartir del BWT 
alphabet_used, execution_time = measure_execution_time(lambda: sorted(set(bwt)))
with open("4_alfabeto_usado.txt", 'w', encoding='utf-8') as file:
    file.write(" ".join(map(str, alphabet_used)))
print("Tiempo de ejecución de la generación de alfabeto usado:", execution_time)

#5.Obtención y guardado del Move-To-Front en archivo de texto
def move_to_front(bwt):
  alphabet = sorted(set(bwt))
  result = []
  for char in bwt:
    index = alphabet.index(char)
    result.append(index)
    alphabet.pop(index)
    alphabet.insert(0, char)
  return result

mtf_result, execution_time = measure_execution_time(move_to_front, bwt)
with open("5_move_to_front.txt", 'w', encoding='utf-8') as file:
    file.write(" ".join(map(str, mtf_result)))
print("Tiempo de ejecución de la función move_to_front:", execution_time)

#6. Reducción del tamaño del Move-To-Front mediante Run-Length Encoder
def run_length_encoder(symbols):
  encoded_result = []
  count = 1

  for i in range(1, len(symbols)):
      if symbols[i] == symbols[i - 1]:
          count += 1
      else:
          if count > 1:
              encoded_result.append((symbols[i - 1], count))
          else:
              encoded_result.append(symbols[i - 1])
          count = 1

  if count > 1:
      encoded_result.append((symbols[-1], count))
  else:
      encoded_result.append(symbols[-1])

  return encoded_result

rle_result, execution_time = measure_execution_time(run_length_encoder, mtf_result)
with open("6_run_length_encoder.txt", 'w', encoding='utf-8') as file:
    file.write(repr(rle_result))
print("Tiempo de ejecución de la función run_length_encoder:", execution_time)

#7. Creación del arhcivo codificado mediante Huffman
def build_huffman_tree(frequencies):
    heap = [[weight, [symbol, ""]] for symbol, weight in frequencies.items()]
    heapq.heapify(heap)
    while len(heap) > 1:
        lo = heapq.heappop(heap)
        hi = heapq.heappop(heap)
        for pair in lo[1:]:
            pair[1] = '0' + pair[1]
        for pair in hi[1:]:
            pair[1] = '1' + pair[1]
        heapq.heappush(heap, [lo[0] + hi[0]] + lo[1:] + hi[1:])
    return sorted(heap[0][1:], key=lambda x: (len(x[-1]), x))

# Función para generar códigos de correspondencia para la codificación de Huffman
def huffman_codes(tree):
    codes = {}
    for pair in tree:
        codes[pair[0]] = pair[1]
    return codes
frequencies, execution_time = measure_execution_time(lambda T: defaultdict(int), mtf_result)
for symbol in mtf_result:
    frequencies[symbol] += 1

huffman_tree, execution_time = measure_execution_time(build_huffman_tree, frequencies)
huffman_mapping, execution_time = measure_execution_time(huffman_codes, huffman_tree)
huffman_encoded, execution_time = measure_execution_time(lambda T, _: "".join(huffman_mapping[symbol] for symbol in T), mtf_result, None)

with open("7_huffman_coding.txt", 'w', encoding='utf-8') as file:
    file.write(huffman_encoded)
print("Tiempo de ejecución de la generación de códigos Huffman:", execution_time)

# 8. Crear tabla de correspondencia correspondiente
correspondence_table, execution_time = measure_execution_time(lambda T: {str(symbol): huffman_mapping[symbol] for symbol in huffman_mapping}, mtf_result)

# Guardar tabla de correspondencia en archivo de texto
with open("8_correspondence_table.txt", 'w', encoding='utf-8') as file:
    for symbol, code in correspondence_table.items():
        file.write(f"{symbol}: {code}\n")
print("Tiempo de ejecución de la generación de tabla de correspondencia:", execution_time)

def binary_to_integer(binary_string, correspondence_table):
    reversed_table = {v: int(k) for k, v in correspondence_table.items()}
    integer_values = []

    current_code = ""
    for bit in binary_string:
        current_code += bit
        if current_code in reversed_table:
            integer_values.append(reversed_table[current_code])
            current_code = ""

    if current_code:
        print(f"Warning: Incomplete binary code {current_code}. Skipping.")

    return integer_values

def save_integer_to_file(integer_values, output_file):
    with open(output_file, 'wb') as file:
        for value in integer_values:
            file.write(value.to_bytes((value.bit_length() + 7) // 8, 'big'))

# Lee la tabla de correspondencia generada
correspondence_table_file = "8_correspondence_table.txt"
with open(correspondence_table_file, 'r', encoding='utf-8') as file:
    correspondence_table_lines = file.readlines()

correspondence_table = {}
for line in correspondence_table_lines:
    symbol, code = line.strip().split(': ')
    correspondence_table[symbol] = code

# Lee las secuencias binarias codificadas con Huffman
huffman_coding_file = "7_huffman_coding.txt"
with open(huffman_coding_file, 'r', encoding='utf-8') as file:
    huffman_encoded_string = file.read()

# Convierte las secuencias binarias a valores enteros consiguiendo la compresión de archivos
len_code = len(next(iter(correspondence_table.values())))
integer_values = binary_to_integer(huffman_encoded_string, correspondence_table)

# Guarda los valores enteros en un nuevo archivo que representa el resultado final ya comprimido
output_file = "9_integer_values.bin"
save_integer_to_file(integer_values, output_file)

#----------------- D E S C O M P R E N S I Ó N -----------------

# Huffman Decoding
#Se crea la función que decodificará la cadena de huffman 
def huffman_decode(encoded_string, huffman_mapping):
    decoded_string = ""
    current_code = ""
    
    for bit in encoded_string:
        current_code += bit
        if current_code in huffman_mapping.values():
            decoded_symbol = next(symbol for symbol, code in huffman_mapping.items() if code == current_code)
            decoded_string += str(decoded_symbol) 
            current_code = ""

    return decoded_string
  
# Se abre el archivo de la codificación de Huffman y se leen las secuencias binarias
huffman_coding_file = "7_huffman_coding.txt"
with open(huffman_coding_file, 'r', encoding='utf-8') as file:
    huffman_encoded_string = file.read()

# Se mandan los valores del archivo a la función que decodifica huffman 
huffman_decoded = huffman_decode(huffman_encoded_string, huffman_mapping)

# Run-Length Decoding
# Creación de función principal para la decodificación del Run-Length Encoder
def run_length_decoder(encoded_result):
    decoded_result = []

    current_entry = encoded_result[0]
    count = 1

    for entry in encoded_result[1:]:
        if entry == current_entry:
            count += 1
        else:
            if count > 1:
                decoded_result.append((current_entry, count))
            else:
                decoded_result.append(current_entry)
            current_entry = entry
            count = 1

    if count > 1:
        decoded_result.append((current_entry, count))
    else:
        decoded_result.append(current_entry)

    return decoded_result

#10. Decodifica Run-Length usando la secuencia decodificada con Huffman
rle_decoded, execution_time = measure_execution_time(run_length_decoder, huffman_decoded)
with open("10_Inverse_run_length_code.txt", 'w', encoding='utf-8') as file:
    file.write(repr(rle_decoded))
print("Tiempo de ejecución de la función run_length_decoder:", execution_time)

#Lee el resultado del Run-Length Decoding inverso
inverse_rle_file = "10_Inverse_run_length_code.txt"
with open(inverse_rle_file, 'r', encoding='utf-8') as file:
    inverse_rle_encoded_result = literal_eval(file.read())  

#Creación de la función principal para la decodificación del Move-To-Front
def inverse_move_to_front(encoded_result):
    decoded_result = []

    for entry in encoded_result:
        if isinstance(entry, tuple):
            decoded_result.extend([entry[0]] * entry[1])
        else:
            decoded_result.append(entry)

    return decoded_result

# Manda la información leida al Move-To-Front inverso
inverse_rle_decoded = inverse_move_to_front(inverse_rle_encoded_result)

# Aplica Move to Front inverso
inverse_mtf_result = inverse_move_to_front(inverse_rle_decoded)

#11. Guarda el resultado de Move to Front inverso
with open("11_inverse_move_to_front.txt", 'w', encoding='utf-8') as file:
    file.write("".join(map(str, inverse_mtf_result)))
print("Tiempo de ejecución de la función inverse_move_to_front:", execution_time)

bwt = inverse_mtf_result

def inverse_bwt(bwt, alphabet_used, inverse_mtf_result):
    mtf_values = list(range(len(alphabet_used)))
    mtf_order = {char: i for i, char in enumerate(alphabet_used)}

    count_before = {char: 0 for char in alphabet_used}

    result = [''] * len(bwt)
    for i in range(len(bwt)):
        mtf_value = inverse_mtf_result[i]
        char = None
        for c, mtf in mtf_order.items():
            if mtf == mtf_value:
                char = c
                break

        if char is not None:
            result[i] = char
            if char in count_before:  # Asegúrate de que la clave esté presente en alphabet_used
                count_before[char] += 1

    return ''.join(result)

# Se puede usar la función con los datos existentes
try:
    # Obtener el índice de la fila original en la matriz ordenada
    index_of_original_row = SA.index(0)

    # Obtener la columna correspondiente a la fila original
    sorted_bwt_column = [T[i - 1] for i in SA]

    # Crear una cadena siguiendo el orden de los números
    ordered_string = ''.join(char for char in sorted_bwt_column)

    # Guardar la cadena en un archivo
    ordered_string_file = "12_ordered_string.txt"
    with open(ordered_string_file, 'w', encoding='utf-8') as file:
        file.write(ordered_string)

except ValueError as e:
    print(f"Error: {e}")

#Calcula el tiempo de ejecución de la función inverse_bwt
original_string, execution_time = measure_execution_time(inverse_bwt, bwt, alphabet_used, inverse_mtf_result)
print(f"Tiempo de ejecución de la función inverse_bwt: {execution_time} segundos")

