CREATE DATABASE CONTAS;

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

-- CRIANDO PROCEDURE DE INSERT PARA CONTAS A PAGAR
DELIMITER $

CREATE PROCEDURE P_INS_CONTAS_PAGAR(
    P_DESCRICAO_PAGAR VARCHAR(100),
    P_VALOR_PAGAR FLOAT,
    P_DATA_VENC_PAGAR VARCHAR(10)
)
BEGIN
    INSERT INTO CONTAS_PAGAR(DESCRICAO_PAGAR, VALOR_PAGAR, DATA_VENC_PAGAR)
    VALUES (P_DESCRICAO_PAGAR, P_VALOR_PAGAR, P_DATA_VENC_PAGAR);
END$

DELIMITER ;

-- CHAMANDO A PROCEDURE

CALL P_INS_CONTAS_PAGAR('CONTA DE LIMPEZA',200.00,'24.10.2023');

-- CRIANDO PROCEDURE DE INSERT DE CONTAS A RECEBER

DELIMITER $

CREATE PROCEDURE P_INS_CONTAS_RECEBER(
    P_DESCRICAO_RECEBER VARCHAR(100),
    P_VALOR_RECEBER FLOAT,
    P_DATA_VENC_RECEBER VARCHAR(10)
)
BEGIN
    INSERT INTO CONTAS_RECEBER(DESCRICAO_RECEBER, VALOR_RECEBER, DATA_VENC_RECEBER)
    VALUES (P_DESCRICAO_RECEBER, P_VALOR_RECEBER, P_DATA_VENC_RECEBER);
END$

DELIMITER ;

-- CHAMANDO A PROCEDURE

CALL P_INS_CONTAS_RECEBER('CONTA DE SERVIÇO',1500.00,'10.10.2023');

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