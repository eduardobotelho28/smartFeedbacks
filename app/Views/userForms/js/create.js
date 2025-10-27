const form = document.querySelector('#create_form')

if(form) {

    form.addEventListener('submit', async (e) => {

        e.preventDefault()

        const formData = new FormData(form)

        try {
            
            const data = await postCreateForm(formData)

            if(data.success == false) {
                showToast(data.message ?? '')
                return
            }

            if(data.success == true) {
                redirect('forms')
            }
            
        } catch (error) {
            console.log(error)
        }

    })

}

async function postCreateForm (formData) {

   const res = await fetch(`${site_url}forms/create`, {
    method:"POST" ,
    body:formData , 
   })

   return await res.json()

}

//previas das perguntas
document.addEventListener('DOMContentLoaded', () => {
    const previewButtons = document.querySelectorAll('.preview-btn');

    previewButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const metricCard = btn.closest('.metric-card');
            const previewText = metricCard.dataset.preview;
            const metricKey = btn.dataset.metric;

            let modalBody = '';

            if (metricKey === 'nps' || metricKey === 'cli') {
                modalBody = '<div class="d-flex justify-content-center gap-2 mt-2">';
                for (let i = 1; i <= 10; i++) {
                    modalBody += `
                        <div class="preview-number" style="
                            padding: 0.5rem 0.7rem; 
                            border: 2px solid #007BFF; 
                            border-radius: 8px; 
                            background-color: #eef6ff; 
                            color: #007BFF; 
                            font-weight: 500; 
                            text-align:center;
                        ">${i}</div>`;
                }
                modalBody += '</div>';
            } else if (metricKey === 'ces') {
                modalBody = '<div class="d-flex justify-content-center gap-2 mt-2">';
                for (let i = 1; i <= 7; i++) {
                    modalBody += `
                        <div class="preview-number" style="
                            padding: 0.5rem 0.7rem; 
                            border: 2px solid #007BFF; 
                            border-radius: 8px; 
                            background-color: #eef6ff; 
                            color: #007BFF; 
                            font-weight: 500; 
                            text-align:center;
                        ">${i}</div>`;
                }
                modalBody += '</div>';
            } else if (metricKey === 'csat') {
                const emojis = [
                    { icon: '😠', title: 'Muito insatisfeito' },
                    { icon: '😕', title: 'Insatisfeito' },
                    { icon: '😐', title: 'Neutro' },
                    { icon: '😊', title: 'Satisfeito' },
                    { icon: '😍', title: 'Muito satisfeito' }
                ];

                modalBody = `
                    <style>
                    .emoji-option {
                        position: relative;
                        font-size: 1.8rem;
                        padding: 0.5rem 0.7rem;
                        border-radius: 50%;
                        background-color: #eef6ff;
                        color: #007BFF;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        transition: transform 0.2s ease, background-color 0.2s ease;
                        cursor: pointer;
                    }
                    .emoji-option:hover {
                        transform: scale(1.2);
                        background-color: #dceeff;
                    }
                    .emoji-option::after {
                        content: attr(data-title);
                        position: absolute;
                        bottom: 130%;
                        left: 50%;
                        transform: translateX(-50%);
                        background: #007BFF;
                        color: #fff;
                        font-size: 0.75rem;
                        padding: 0.3rem 0.5rem;
                        border-radius: 5px;
                        white-space: nowrap;
                        opacity: 0;
                        pointer-events: none;
                        transition: opacity 0.2s;
                    }
                    .emoji-option:hover::after {
                        opacity: 1;
                    }
                    </style>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                `;

                emojis.forEach(e => {
                    modalBody += `
                    <div class="emoji-option" data-title="${e.title}">
                        ${e.icon}
                    </div>
                    `;
                });

                modalBody += '</div>';
            } else if (metricKey === 'stars') {
                const stars = ['⭐','⭐','⭐','⭐','⭐'];
                modalBody = '<div class="d-flex justify-content-center gap-2 mt-2">';
                stars.forEach(s => {
                    modalBody += `
                        <div style="
                            font-size:1.5rem;
                            padding: 0.4rem 0.6rem;
                            background-color: #eef6ff;
                            border-radius: 8px;
                            color: #007BFF;
                            display:inline-flex;
                            align-items:center;
                            justify-content:center;
                        ">${s}</div>`;
                });
                modalBody += '</div>';
            } else if (metricKey === 'exit_survey') {
                modalBody = `
                    <input type="text" class="form-control" disabled placeholder="Resposta do cliente...">
                `;
            }

            // Cria modal Bootstrap
            const modalHtml = `
                <div class="modal fade" id="metricPreviewModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">${previewText}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        ${modalBody}
                      </div>
                    </div>
                  </div>
                </div>
            `;

            const existingModal = document.getElementById('metricPreviewModal');
            if (existingModal) existingModal.remove();
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            const modal = new bootstrap.Modal(document.getElementById('metricPreviewModal'));
            modal.show();
        });
    });
});


