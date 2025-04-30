const form = document.querySelector('#loginForm')

if(form) {

    form.addEventListener('submit', async (e) => {

        e.preventDefault()

        const formData = new FormData(form)

        try {
            
            const data = await postLoginUser(formData)

            if(data.success == false) {
                showToast(data.message ?? '')
                return
            }

            if(data.success == true) {
                redirect('')
            }
            
        } catch (error) {
            console.log(error)
        }

    })

}

async function postLoginUser (formData) {

   const res = await fetch(`${site_url}authentication/login`, {
    method:"POST" ,
    body:formData , 
   })

   return await res.json()

}
