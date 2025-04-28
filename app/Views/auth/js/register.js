const form = document.querySelector('#registerForm')

if(form) {

    form.addEventListener('submit', async (e) => {

        e.preventDefault()

        const formData = new FormData(form)


        try {
            
            const data = await postNewUser(formData)

            if(data.success == false) {
                showToast(data.message ?? '')
            }

            else {
                window.location.href = `${site_url}/authentication/login`
            }

        } catch (error) {
            console.log(error)
        }

    })

}

async function postNewUser (formData) {

   const res = await fetch(`${site_url}authentication/register`, {
    method:"POST" ,
    body:formData , 
   })

   return await res.json()

}
