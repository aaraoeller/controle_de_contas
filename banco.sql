START TRANSACTION;

CREATE DATABASE CONTAS;

USE CONTAS;

CREATE TABLE CONTAS_PAGAR(
    IDPAGAR INT PRIMARY KEY AUTO_INCREMENT,
    DESCRICAO_PAGAR VARCHAR(100) NOT NULL,
    VALOR_PAGAR FLOAT(10,2) NOT NULL ,
    DATA_VENC_PAGAR VARCHAR(10) NOT NULL
);

CREATE TABLE CONTAS_RECEBER(
    IDRECEBER INT PRIMARY KEY AUTO_INCREMENT,
    DESCRICAO_RECEBER VARCHAR(100) NOT NULL,
    VALOR_RECEBER FLOAT(10,2) NOT NULL ,
    DATA_VENC_RECEBER VARCHAR(10) NOT NULL
);

-- INSERT DE TESTE
INSERT INTO CONTAS_PAGAR(DESCRICAO_PAGAR,VALOR_PAGAR,DATA_VENC_PAGAR) VALUES('CONTA DE ÁGUA',350.00,'20.09.2023');
INSERT INTO CONTAS_PAGAR(DESCRICAO_PAGAR,VALOR_PAGAR,DATA_VENC_PAGAR) VALUES('CONTA DE LUZ',300.00,'20.09.2023');
INSERT INTO CONTAS_RECEBER(DESCRICAO_RECEBER,VALOR_RECEBER,DATA_VENC_RECEBER) VALUES('CONTA TESTE 1',1000.00,'19.09.2023');
INSERT INTO CONTAS_RECEBER(DESCRICAO_RECEBER,VALOR_RECEBER,DATA_VENC_RECEBER) VALUES('CONTA TESTE 2',2000.00,'19.09.2023');

-- FUNÇÃO DE INSERT
DELIMITER $

CREATE FUNCTION FN_INS_CONTAS_PAGAR(
    FN_DESCRICAO_PAGAR VARCHAR(100),
    FN_VALOR_PAGAR FLOAT(10.2),
    FN_DATA_VENC_PAGAR VARCHAR(10)
)

RETURNS VOID AS
BEGIN
    INSERT INTO CONTAS_PAGAR(DESCRICAO_PAGAR,VALOR_PAGAR,DATA_VENC_PAGAR) VALUES(FN_DESCRICAO_PAGAR,FN_VALOR_PAGAR,FN_DATA_VENC_PAGAR);
END;
DELIMITER ;








CREATE OR REPLACE FUNCTION InserirCliente(
    nome_cliente VARCHAR(255),
    email_cliente VARCHAR(255)
)
RETURNS VOID AS $$
BEGIN
    INSERT INTO Clientes (nome, email)
    VALUES (nome_cliente, email_cliente);
END;
$$ LANGUAGE plpgsql;




-- CRIANDO VIEW LISTAGEM DE CONTAS

CREATE VIEW V_LISTA_CONTAS
AS
    SELECT CP.DESCRICAO_PAGAR AS DESCRICAO, 
           CP.VALOR_PAGAR AS VALOR_PAGAR, 
           CP.DATA_VENC_PAGAR AS VENCIMENTO_PAGAMENTO, 
           CR.DESCRICAO_RECEBER AS DESCIRCAO, 
           CR.VALOR_RECEBER AS VALOR_RECEBER, 
           CR.DATA_VENC_RECEBER AS VENCIMENTO_RECEBIMENTO
    FROM CONTAS_PAGAR CP
    INNER JOIN CONTAS_RECEBER CR
    ON CP.IDPAGAR = CR.IDRECEBER;

-- CHAMANDO A VIEW

SELECT * FROM V_LISTA_CONTAS;

-- CRIANDO VIEW TOTAL CONTAS A PAGAR

CREATE VIEW V_TOTAL_PAGAR
AS
    SELECT SUM(VALOR_PAGAR) AS TOTAL_A_PAGAR
    FROM CONTAS_PAGAR;

-- CHAMANDO A VIEW

SELECT * FROM V_TOTAL_PAGAR;

-- CRIANDO VIEW TOTAL CONTAS A RECEBER

CREATE VIEW V_TOTAL_RECEBER
AS
    SELECT SUM(VALOR_RECEBER) AS TOTAL_A_RECEBER
    FROM CONTAS_RECEBER;

-- CHAMANDO A VIEW

SELECT * FROM V_TOTAL_RECEBER;

-- CRIANDO VIEW TOTAL GERAL

CREATE VIEW V_CONTAS_TOTAL
AS
    SELECT SUM(VALOR_PAGAR + VALOR_RECEBER) AS TOTAL_GERAL
    FROM CONTAS_PAGAR CP
    JOIN CONTAS_RECEBER CR
    ON CP.IDPAGAR = CR.IDRECEBER;

-- CHAMANDO A VIEW

SELECT * FROM V_CONTAS_TOTAL;