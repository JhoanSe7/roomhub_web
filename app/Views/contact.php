<!-- Formulario de Contacto -->
<main class="container py-5">
    <h2 class="section-title text-center">Envíanos un mensaje</h2>
    <div class="row">
        <!-- Formulario -->
        <div class="col-md-8">
            <form action="<?= base_url() ?>roomhub/contact/submit" method="POST"
                  class="p-4 shadow bg-dark text-light rounded">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Tu correo electrónico"
                           required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Motivo del mensaje"
                           required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="5"
                              placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-orange">Enviar Mensaje</button>
                </div>
            </form>
        </div>

        <!-- Información de Contacto -->
        <div class="col-md-4">
            <div class="p-4 shadow bg-dark text-light rounded">
                <h4 class="text-orange">Información de Contacto</h4>
                <p>
                    <strong>Dirección:</strong> Calle de los Estudiantes #9-82, Ciudadela Real de Minas, Bucaramanga,
                    Santander
                </p>
                <p><strong>Teléfono:</strong> +57 300 123 1234</p>
                <p><strong>Correo Electrónico:</strong> contacto@roomhub.com</p>
                <h5 class="text-orange mt-4">Síguenos</h5>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/UnidadesTecnologicasdeSantanderUTS/" class="text-light">
                        <i class="ti ti-brand-facebook fs-4"></i>
                    </a>
                    <a href="https://x.com/Unidades_UTS" class="text-light">
                        <i class="ti ti-brand-twitter fs-4"></i>
                    </a>
                    <a href="https://www.instagram.com/unidades_uts/" class="text-light">
                        <i class="ti ti-brand-instagram fs-4"></i>
                    </a>
                    <a href="https://co.linkedin.com/school/unidades-tecnol-gicas-de-santander/" class="text-light">
                        <i class="ti ti-brand-linkedin fs-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
