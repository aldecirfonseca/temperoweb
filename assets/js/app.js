/*
 * Tempero Web - comportamentos de interface
 */
(function () {
    "use strict";

    // Cabeçalho ganha sombra ao rolar a página
    var header = document.querySelector(".site-header");

    function atualizaHeader() {
        if (header) {
            header.classList.toggle("is-scrolled", window.scrollY > 8);
        }
    }

    window.addEventListener("scroll", atualizaHeader, { passive: true });
    atualizaHeader();

    // Animação de entrada dos elementos .reveal ao aparecerem na tela
    var reveals = document.querySelectorAll(".reveal");
    var reduzMovimento = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    if (!("IntersectionObserver" in window) || reduzMovimento) {
        reveals.forEach(function (el) { el.classList.add("is-visible"); });
    } else {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                // Revela ao entrar na tela ou se o usuário já passou do elemento
                // (ex.: tecla End, link âncora), evitando conteúdo invisível
                if (entry.isIntersecting || entry.boundingClientRect.top < 0) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: "0px 0px -10% 0px" });

        reveals.forEach(function (el) { observer.observe(el); });
    }

    // Validação de formulários (padrão Bootstrap 5)
    document.querySelectorAll("form.needs-validation").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

                // Leva o foco ao primeiro campo com erro
                var primeiroInvalido = form.querySelector(":invalid");
                if (primeiroInvalido) {
                    primeiroInvalido.focus();
                }
            }
            form.classList.add("was-validated");
        });
    });

    // Datas não podem ser anteriores a hoje
    var hoje = new Date();
    hoje.setMinutes(hoje.getMinutes() - hoje.getTimezoneOffset());
    document.querySelectorAll("input[type=date][data-min-hoje]").forEach(function (input) {
        input.min = hoje.toISOString().slice(0, 10);
    });

    // Máscara de telefone (jQuery Mask)
    if (window.jQuery && jQuery.fn.mask) {
        var mascaraTelefone = function (val) {
            return val.replace(/\D/g, "").length === 11 ? "(00) 00000-0000" : "(00) 0000-00009";
        };

        jQuery("[data-mascara=telefone]").mask(mascaraTelefone, {
            onKeyPress: function (val, e, field, options) {
                field.mask(mascaraTelefone.apply({}, arguments), options);
            }
        });
    }
})();
