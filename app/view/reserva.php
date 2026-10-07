<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Reserva", "Garanta sua mesa em menos de um minuto.") ?>

<section class="section">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-5">
                <span class="eyebrow">Viva a experiência</span>
                <h2 class="section-title">Uma mesa esperando por você</h2>
                <p class="section-lead">
                    Atendemos almoços, jantares e eventos em qualquer dia da semana,
                    com o cuidado e o sabor que só o Tempero Web oferece.
                </p>

                <div class="mt-4">
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-clock"></i></span>
                        <div>
                            <h3>Atendimento</h3>
                            <p>Segunda a sexta, das 9h às 18h</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-people"></i></span>
                        <div>
                            <h3>Grupos e eventos</h3>
                            <p>Para mais de 10 pessoas, fale com a gente pelo telefone.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon-circle" aria-hidden="true"><i class="bi bi-telephone"></i></span>
                        <div>
                            <h3>Prefere ligar?</h3>
                            <a href="tel:553237211026">(32) 3721-1026</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="form-card">
                    <h2 class="h3 mb-1">Reserve uma mesa</h2>
                    <p class="text-muted-tw mb-4">Campos marcados com <span class="text-danger" aria-hidden="true">*</span> são obrigatórios.</p>

                    <form class="needs-validation" action="#" method="post" novalidate>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="nome" class="form-label">Nome completo <span class="req" aria-hidden="true">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" autocomplete="name" required>
                                <div class="invalid-feedback">Informe seu nome.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail <span class="req" aria-hidden="true">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
                                <div class="invalid-feedback">Informe um e-mail válido.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone <span class="req" aria-hidden="true">*</span></label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" autocomplete="tel"
                                    data-mascara="telefone" placeholder="(32) 99999-9999" required>
                                <div class="invalid-feedback">Informe um telefone para contato.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="data" class="form-label">Data <span class="req" aria-hidden="true">*</span></label>
                                <input type="date" class="form-control" id="data" name="data" data-min-hoje required>
                                <div class="invalid-feedback">Escolha uma data a partir de hoje.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="horario" class="form-label">Horário <span class="req" aria-hidden="true">*</span></label>
                                <select class="form-select" id="horario" name="horario" required>
                                    <option value="">Selecione</option>
                                    <?php foreach (['11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '17:00', '17:30'] as $horario): ?>
                                        <option value="<?= $horario ?>"><?= $horario ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Escolha um horário.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="pessoas" class="form-label">Pessoas <span class="req" aria-hidden="true">*</span></label>
                                <select class="form-select" id="pessoas" name="pessoas" required>
                                    <option value="">Selecione</option>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?> <?= ($i == 1 ? "pessoa" : "pessoas") ?></option>
                                    <?php endfor; ?>
                                </select>
                                <div class="invalid-feedback">Informe a quantidade de pessoas.</div>
                            </div>

                            <div class="col-12">
                                <label for="observacao" class="form-label">Observações</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3" aria-describedby="observacaoAjuda"></textarea>
                                <div id="observacaoAjuda" class="form-text">Aniversário, restrição alimentar, cadeira para bebê...</div>
                            </div>

                            <div class="col-12 pt-2">
                                <button class="btn btn-primary btn-lg w-100" type="submit">
                                    <i class="bi bi-calendar-check" aria-hidden="true"></i>Confirmar reserva
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
