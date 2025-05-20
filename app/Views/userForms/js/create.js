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
