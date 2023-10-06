$(document).ready(function() {
    // Intercepta o envio do formulário de relatórios
    $("#relatoriosForm").submit(function(event) {
        event.preventDefault(); // Impede o envio normal do formulário

        // Faz uma requisição AJAX
        $.ajax({
            type: "POST",
            url: "executar_views.php",
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function(data) {
                // Atualiza a div de resultado com o retorno da requisição
                $("#resultado").html(data);
            },
            error: function(error) {
                console.log("Erro na requisição AJAX:", error);
            }
        });
    });
});
