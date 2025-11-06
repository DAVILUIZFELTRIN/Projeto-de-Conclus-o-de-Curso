// Função para scroll suave até a seção de contato
function scrollToContact() {
    const contactSection = document.querySelector(".contact-section");
    if (contactSection) {
        contactSection.scrollIntoView({ 
            behavior: "smooth",
            block: "start"
        });
    }
}

// Função para selecionar tipo de usuário na página de login
function selectUserType(type) {
    document.getElementById("userTypeInput").value = type;
    document.getElementById("loginFields").style.display = "block";
    document.querySelector(".user-types").style.display = "none"; // Oculta os cartões de seleção
}

// Validação do formulário
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contactForm");
    
    if (form) {
        form.addEventListener("submit", function(e) {
            // Validação adicional pode ser adicionada aqui
            const nome = document.getElementById("nome").value.trim();
            const email = document.getElementById("email").value.trim();
            const telefone = document.getElementById("telefone").value.trim();
            
            if (!nome || !email || !telefone) {
                e.preventDefault();
                alert("Por favor, preencha todos os campos obrigatórios!");
                return false;
            }
            
            // Validação de email
            const emailRegex = /^[^@]+@[^@]+\.[^@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert("Por favor, insira um e-mail válido!");
                return false;
            }
        });
    }
});

// Efeito de hover nos botões
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll("button");
    
    buttons.forEach(button => {
        button.addEventListener("mouseenter", function() {
            this.style.transition = "all 0.3s ease";
        });
    });
});

// Animação de entrada para elementos
window.addEventListener("load", function() {
    const elements = document.querySelectorAll(".hero-content, .content-text, .form-container, .login-container");
    
    elements.forEach((element, index) => {
        element.style.opacity = "0";
        element.style.transform = "translateY(20px)";
        
        setTimeout(() => {
            element.style.transition = "all 0.6s ease";
            element.style.opacity = "1";
            element.style.transform = "translateY(0)";
        }, index * 100);
    });
});

