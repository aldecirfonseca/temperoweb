
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row g-5">

                    <div class="col-lg-4">
                        <a class="brand mb-3" href="<?= baseUrl() ?>Home" aria-label="Tempero Web - página inicial">
                            <span class="brand-mark" aria-hidden="true">TW</span>
                            <span class="brand-name">Tempero Web</span>
                        </a>
                        <p class="mt-3 mb-4">Comida fresca, preparada com cuidado e servida com carinho no centro de Muriaé.</p>
                        <ul class="social-links">
                            <li><a href="#" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-lg-2">
                        <h2>Navegação</h2>
                        <ul>
                            <li><a href="<?= baseUrl() ?>Home">Início</a></li>
                            <li><a href="<?= baseUrl() ?>Home/quemSomos">Quem somos</a></li>
                            <li><a href="<?= baseUrl() ?>Home/menu">Cardápio</a></li>
                            <li><a href="<?= baseUrl() ?>Home/chef">Chefs</a></li>
                            <li><a href="<?= baseUrl() ?>Home/blog">Blog</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-lg-3">
                        <h2>Contato</h2>
                        <ul>
                            <li>Praça Aninna Bisegna, 40<br>Centro - Muriaé/MG</li>
                            <li><a href="tel:553237211026">(32) 3721-1026</a></li>
                            <li><a href="mailto:contato@temperoweb.com.br">contato@temperoweb.com.br</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <h2>Atendimento</h2>
                        <ul>
                            <li>Segunda a sexta: 9h às 18h</li>
                            <li>Reservas para eventos todos os dias</li>
                        </ul>
                        <a class="btn btn-primary mt-4" href="<?= baseUrl() ?>Home/reserva">
                            <i class="bi bi-calendar-check" aria-hidden="true"></i>Reservar mesa
                        </a>
                    </div>
                </div>

                <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between gap-2">
                    <span>&copy; <?= date('Y') ?> Tempero Web. Todos os direitos reservados.</span>
                    <span>PHP Básico - 4º Período</span>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= baseUrl() ?>assets/js/app.js"></script>
    </body>

</html>
