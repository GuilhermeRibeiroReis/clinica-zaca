 
        // Função de validação do lado cliente
        document.getElementById('adminForm').addEventListener('submit', function (e) {
            // Impede o envio do formulário se não passar pela validação
            let formIsValid = true;

            // Validação do nome
            let name = document.querySelector('input[name="name"]');
            if (name.value.trim() === '') {
                alert('O campo Nome é obrigatório!');
                formIsValid = false;
            }

            // Validação do email
            let email = document.querySelector('input[name="email"]');
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                alert('Por favor, insira um endereço de e-mail válido!');
                formIsValid = false;
            }

            // Validação das senhas
            let password = document.querySelector('input[name="password"]');
            let passwordConfirmation = document.querySelector('input[name="password_confirmation"]');
            if (password.value !== passwordConfirmation.value) {
                alert('As senhas não coincidem!');
                formIsValid = false;
            }

            // Validação do salário
            let salario = document.querySelector('input[name="salario"]');
            if (salario.value.trim() === '' || isNaN(salario.value) || salario.value <= 0) {
                alert('Por favor, insira um salário válido!');
                formIsValid = false;
            }

            // Se a validação falhar, previne o envio do formulário
            if (!formIsValid) {
                e.preventDefault();
            }
        });
