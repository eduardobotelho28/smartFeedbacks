function showToast(message, type = 'error') {
  const toastEl   = document.getElementById("liveToast");
  const toastBody = document.getElementById("toastMessage");

  toastEl.classList.remove("text-bg-success", "text-bg-danger");
  const classType = type === 'error' ? 'text-bg-danger' : 'text-bg-success'
  toastEl.classList.add(classType);

  if (typeof message === 'object' && message !== null) {
    message = Object.values(message).join('\n');
  }

  toastBody.textContent = message;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

function redirect (url) {
  window.location.href = `${site_url}${url}`
}

document.addEventListener("DOMContentLoaded", () => {
  if (window.toastMessage) {
    showToast(window.toastMessage.message, window.toastMessage.type)
  }
});
