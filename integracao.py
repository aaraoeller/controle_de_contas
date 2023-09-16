import tkinter as tk
import mysql.connector

# Função para executar a procedure com os parâmetros fornecidos pelo usuário
def executar_procedure(tipo_procedure):
    descricao = descricao_entry.get()
    valor = float(valor_entry.get())
    data_vencimento = data_vencimento_entry.get()

    try:
        conexao = mysql.connector.connect(
            host='localhost',
            database='contas',
            user='root',
            password='root'
        )

        if conexao.is_connected():
            cursor = conexao.cursor()
            if tipo_procedure == 'P_INS_CONTAS_PAGAR':
                procedure_contas = """CALL P_INS_CONTAS_PAGAR(%s, %s, %s);"""
            elif tipo_procedure == 'P_INS_CONTAS_RECEBER':
                procedure_contas = """CALL P_INS_CONTAS_RECEBER(%s, %s, %s);"""
            cursor.execute(procedure_contas, (descricao, valor, data_vencimento))
            conexao.commit()
            cursor.close()
            conexao.close()
            resultado_label.config(text="Procedure executada com sucesso!")
        else:
            resultado_label.config(text="Não foi possível conectar ao banco de dados.")

    except mysql.connector.Error as err:
        resultado_label.config(text=f"Erro: {err}")

# Crie uma janela
janela = tk.Tk()
janela.title("Interface Gráfica para Procedure SQL")

# Crie rótulos e campos de entrada para os parâmetros
descricao_label = tk.Label(janela, text="Descrição:")
descricao_label.pack()
descricao_entry = tk.Entry(janela)
descricao_entry.pack()

valor_label = tk.Label(janela, text="Valor:")
valor_label.pack()
valor_entry = tk.Entry(janela)
valor_entry.pack()

data_vencimento_label = tk.Label(janela, text="Data de Vencimento:")
data_vencimento_label.pack()
data_vencimento_entry = tk.Entry(janela)
data_vencimento_entry.pack()

# Crie botões para executar as procedures
executar_contas_pagar_button = tk.Button(janela, text="Enviar para Contas a Pagar", command=lambda: executar_procedure('P_INS_CONTAS_PAGAR'))
executar_contas_pagar_button.pack()

executar_contas_receber_button = tk.Button(janela, text="Enviar para Contas a Receber", command=lambda: executar_procedure('P_INS_CONTAS_RECEBER'))
executar_contas_receber_button.pack()

# Crie um rótulo para exibir o resultado
resultado_label = tk.Label(janela, text="")
resultado_label.pack()

# Inicie o loop principal da interface gráfica
janela.mainloop()