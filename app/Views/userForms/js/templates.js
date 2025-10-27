
document.addEventListener('DOMContentLoaded', () => {

    // Seleciona todos os cards
    const templateCards = document.querySelectorAll('.template-card')

    // Cria o modal dinamicamente (Bootstrap 5)
    const modalHtml = `
    <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="template_form">
            <div class="modal-header">
              <h5 class="modal-title" id="templateModalLabel">Criar Formulário</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="form_name" class="form-label">Nome do Formulário</label>
                <input type="text" class="form-control" id="form_name" name="name" placeholder="Digite o nome do formulário" >
              </div>
              <input type="hidden" id="template_id" name="template">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Criar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    `
    document.body.insertAdjacentHTML('beforeend', modalHtml)
    const modal = new bootstrap.Modal(document.getElementById('templateModal'))

    // Abrir modal ao clicar em qualquer card
    templateCards.forEach((card) => {
        card.addEventListener('click', () => {
            const templateId = card.getAttribute('data-template')
            document.getElementById('template_id').value = templateId
            document.getElementById('form_name').value = ''
            modal.show()
        })
    })

    // Envio do formulário do modal
    const form = document.querySelector('#template_form')
    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        const formData = new FormData(form)

        try {
            const data = await postCreateTemplateForm(formData)

            if (data.success === false) {
                showToast(data.message ?? 'Ocorreu um erro ao criar o formulário.')
                return
            }

            if (data.success === true) {
                redirect('/forms')
            }

        } catch (error) {
            console.error(error)
            showToast('Erro inesperado. Tente novamente.')
        }
    })
})

async function postCreateTemplateForm(formData) {
    const res = await fetch(`${site_url}templates/create`, {
        method: "POST",
        body: formData
    })
    return await res.json()
}
