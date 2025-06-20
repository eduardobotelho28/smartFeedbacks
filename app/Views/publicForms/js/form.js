const form = document.querySelector('#replyForm');
const hash = form?.dataset?.hash;
const button = document.querySelector('#submit-form')

if (form) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validação de NPS e CSAT se estiverem presentes
        const requiresNps = form.querySelector('[name="nps"]') !== null;
        const requiresCsat = form.querySelector('[name="csat"]') !== null;

        const npsChecked = form.querySelector('input[name="nps"]:checked');
        const csatChecked = form.querySelector('input[name="csat"]:checked');

        if (requiresNps && !npsChecked) {
            showToast('Selecione uma nota NPS.');
            return;
        }

        if (requiresCsat && !csatChecked) {
            showToast('Selecione uma avaliação de satisfação (CSAT).');
            return;
        }

        const formData = new FormData(form);

        button.setAttribute('disabled', true)

        try {
            const data = await postReplyForm(formData);

            if (data.success === false) {
                showToast(data.message ?? 'Erro ao enviar formulário.');
                return;
            }

            showToast('Obrigado pelo feedback!', 'success');

        } catch (error) {
            console.error('Erro no envio:', error);
            showToast('Ocorreu um erro no envio.');
        }
    });
}

async function postReplyForm(formData) {
    const res = await fetch(`${site_url}forms/reply/${hash}`, {
        method: 'POST',
        body: formData,
    });

    return await res.json();
}
