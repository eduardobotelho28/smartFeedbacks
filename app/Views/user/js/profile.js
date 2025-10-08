// public/js/userProfile.js

const form = document.querySelector('#profileForm');
const button = document.querySelector('#saveProfile');

if (form) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const firstname = form.querySelector('[name="firstname"]').value.trim();
        const lastname = form.querySelector('[name="lastname"]').value.trim();
        const email = form.querySelector('[name="email"]').value.trim();

        if (!firstname || !lastname || !email) {
            showToast('Preencha todos os campos obrigatórios.');
            return;
        }

        const formData = new FormData(form);
        button.setAttribute('disabled', true);

        try {
            const data = await postProfileForm(formData);

            if (!data || data.success === false) {
                showToast(data?.message ?? 'Erro ao atualizar perfil.');
                return;
            }

            showToast('Perfil atualizado com sucesso!', 'success');

        } catch (error) {
            console.error('Erro no envio:', error);
            showToast('Ocorreu um erro ao atualizar o perfil.');
        } finally {
            button.removeAttribute('disabled');
        }
    });
}

async function postProfileForm(formData) {
    const res = await fetch(`${site_url}user/updateProfile`, {
        method: 'POST',
        body: formData,
    });

    if (!res.ok) {
        throw new Error(`Erro HTTP: ${res.status}`);
    }

    return await res.json();
}
