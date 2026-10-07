<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Contato", "Dúvidas, sugestões ou elogios? Respondemos em até 1 dia útil.") ?>

<section class="section">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-7 order-lg-2">
                <div class="form-card">
                    <h2 class="h3 mb-1">Envie uma mensagem</h2>
                    <p class="text-muted-tw mb-4">Campos marcados com <span class="text-danger" aria-hidden="true">*</span> são obrigatórios.</p>

                    <form class="needs-validation" action="#" method="post" id="contactForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome <span class="req" aria-hidden="true">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" autocomplete="name" required>
                                <div class="invalid-feedback">Informe seu nome.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" autocomplete="tel"
                                    data-mascara="telefone" placeholder="(32) 99999-9999">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">E-mail <span class="req" aria-hidden="true">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
                                <div class="invalid-feedback">Informe um e-mail válido para respondermos.</div>
                            </div>

                            <div class="col-12">
                                <label for="mensagem" class="form-label">Mensagem <span class="req" aria-hidden="true">*</span></label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="6" minlength="10" required></textarea>
                                <div class="invalid-feedback">Escreva sua mensagem (mínimo de 10 caracteres).</div>
                            </div>

                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send" aria-hidden="true"></i>Enviar mensagem
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5 order-lg-1">
                <span class="eyebrow">Fale conosco</span>
                <h2 class="section-title">Estamos por perto</h2>

                <div class="mt-4">
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-geo-alt"></i></span>
                        <div>
                            <h3>Endereço</h3>
                            <p>Praça Aninna Bisegna, 40 - Centro<br>Muriaé - MG, 36880-000</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-telephone"></i></span>
                        <div>
                            <h3>Telefone</h3>
                            <a href="tel:553237211026">(32) 3721-1026</a>
                            <p>Segunda a sexta, das 9h às 18h</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-envelope"></i></span>
                        <div>
                            <h3>E-mail</h3>
                            <a href="mailto:contato@temperoweb.com.br">contato@temperoweb.com.br</a>
                            <p>Envie sua mensagem a qualquer momento.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Mapa via embed do Google (não precisa de chave de API) -->
        <div class="mt-5 reveal">
            <iframe class="map-frame" src="https://maps.google.com/maps?q=-21.132654,-42.3678817&z=17&output=embed"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa com a localização do Tempero Web"></iframe>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
